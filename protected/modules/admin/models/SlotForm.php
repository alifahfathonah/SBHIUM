<?php 
class SlotForm extends CFormModel
{
	public $id_slot;
	public $userid;
	public $debit;
	public $kredit;
	public $slot_akhir;
	public $input_date;
	public $active_date;
	public $keterangan;
	public $saveType;
	
	

	/**
	 * Declares the validation rules.
	 * The rules state that nama and kredit are required,
	 * and kredit needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('userid, input_date, active_date, saveType', 'required'),
			array('userid, debit, kredit, slot_akhir', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('keterangan', 'safe'),
			// array('id_slot, userid, debit, input_date, active_date, kredit, keterangan', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'id_slot' => 'Id Slot',
			'userid' => 'Userid',
			'debit' => 'Debit',
			'kredit' => 'Kredit',
			'slot_akhir' => 'Slot Akhir',
			'input_date' => 'Input Date',
			'active_date' => 'Active Date',
			'keterangan' => 'Keterangan',
		);
	}

	public function beforeValidate() 
    {
        if (empty($this->debit) && empty($this->kredit)) 
        {
            $this->addError('debit', 'Debit atau kredit harus diisi');
        }
        if (!empty($this->debit) && !empty($this->kredit)){
        	$this->addError('debit', 'Debit atau Kredit Harus diisi salah satu');
        }

        /*validasi tidak bisa ubah data menjadi kredit jika data slot awal*/
        if($this->saveType=='edit'){
			$criteria = new CDbCriteria();
			$criteria->condition  = "userid=$this->userid AND id_slot < ".$_GET['i']."";
			$criteria->order = "id_slot DESC";
			$SlotAkhirSebelumnya = Slot::model()->findAll($criteria);
			if(empty($this->debit) AND empty($SlotAkhirSebelumnya)){
				$this->addError('kredit', 'Slot awal tidak memungkinkan untuk di kredit');
			}
        }
		/*validasi tidak bisa ubah data menjadi kredit jika data slot awal*/
        return parent::beforeValidate();
    }

	public function dataSource($object){
        switch($object){
			case 'investor' :
				$return = CHtml::listData(UserAccount::model()->findAll(array('condition'=>'role=2')),'userid','Fullname');
				break;
		}
        return $return;
    }

	public function editcontent($i){
		$criteria = new CDbCriteria;
		$criteria->addSearchCondition('id_slot',$i,true,'=');
		$data = Slot::model()->find($criteria);
		$input_date = new DateTime($data->input_date);
        $input_date = $input_date->format('d/m/Y');
        $active_date = new DateTime($data->active_date);
        $active_date = $active_date->format('d/m/Y');
        
		$this->id_slot = $data->id_slot;
		$this->userid = $data->userid;
		$this->debit = $data->debit;
		$this->kredit = $data->kredit;
		$this->slot_akhir = $data->slot_akhir;
		$this->input_date = $input_date;
		$this->active_date = $active_date;
		$this->keterangan = $data->keterangan;
		$this->saveType = 'edit';
	}

	public function save(){

		$post = new Slot;
		$input_date = new DateTime();
		$input_date = $input_date->createFromFormat('d/m/Y', $this->input_date);
		$input_date = $input_date->format('Y-m-d');
		$active_date = new DateTime();
		$active_date = $active_date->createFromFormat('d/m/Y', $this->active_date);
		$active_date = $active_date->format('Y-m-d');

		if ($this->saveType=='edit'){
			/*Nilai sebelumnya*/
			$criteria1 = new CDbCriteria;
			$criteria1->addSearchCondition('id_slot',$_GET['i'],true,'=');
			$dataNilaiSebelumnya = Slot::model()->find($criteria1);
			/*Nilai sebelumnya*/

		/*SlotAkhirSebelumnya*/
			$criteria = new CDbCriteria();
			$criteria->condition  = "userid=$this->userid AND id_slot < ".$_GET['i']."";
			$criteria->order = "id_slot DESC";
			$SlotAkhirSebelumnya = Slot::model()->find($criteria);
		/*SlotAkhirSebelumnya*/
			if (!empty($SlotAkhirSebelumnya->slot_akhir)){
				if(!empty($this->debit)){
					$this->slot_akhir = $SlotAkhirSebelumnya->slot_akhir + $this->debit;
				}
				if(!empty($this->kredit)){
					$this->slot_akhir = $SlotAkhirSebelumnya->slot_akhir - $this->kredit;
				}
			}else{
				$this->slot_akhir = $this->debit;
			}
			$update = $post->updateByPk($_GET['i'],array(
					'userid' =>  $this->userid,
					'debit' =>  $this->debit,
					'kredit' => $this->kredit,
					'slot_akhir' => $this->slot_akhir,
					'input_date' => $input_date,
					'active_date' => $active_date,
					'keterangan' => $this->keterangan,
				));
			if($update){
				/*cara baru*/
				$criteriaSlotSetelahnya = new CDbCriteria();
				$criteriaSlotSetelahnya->condition  = "userid=$this->userid AND id_slot > ".$_GET['i']."";
				$SlotAkhirSetelahnya = Slot::model()->findAll($criteriaSlotSetelahnya);

				if(!empty($this->debit) AND !empty($dataNilaiSebelumnya->debit)){
					if($dataNilaiSebelumnya->debit < $this->debit){/*tambah*/
						$selisih = $this->debit - $dataNilaiSebelumnya->debit;
							foreach ($SlotAkhirSetelahnya as $keySlotAkhirSetelahnya) {
								$update1 = $post->updateByPk($keySlotAkhirSetelahnya->id_slot,array(
									'slot_akhir' => $keySlotAkhirSetelahnya->slot_akhir + $selisih
								));
							}
					}
					if($dataNilaiSebelumnya->debit > $this->debit){/*kurang*/
						$selisih = $dataNilaiSebelumnya->debit - $this->debit;
							foreach ($SlotAkhirSetelahnya as $keySlotAkhirSetelahnya) {
								$update1 = $post->updateByPk($keySlotAkhirSetelahnya->id_slot,array(
									'slot_akhir' => $keySlotAkhirSetelahnya->slot_akhir - $selisih
								));
							}
					}
				}
				if(!empty($this->kredit) AND !empty($dataNilaiSebelumnya->kredit)){
					if($dataNilaiSebelumnya->kredit < $this->kredit){/*tambah*/
						$selisih = $this->kredit - $dataNilaiSebelumnya->kredit;
							foreach ($SlotAkhirSetelahnya as $keySlotAkhirSetelahnya) {
								$update1 = $post->updateByPk($keySlotAkhirSetelahnya->id_slot,array(
									'slot_akhir' => $keySlotAkhirSetelahnya->slot_akhir - $selisih
								));
							}
					}
					if($dataNilaiSebelumnya->kredit > $this->kredit){/*kurang*/
						$selisih = $dataNilaiSebelumnya->kredit - $this->kredit;
							foreach ($SlotAkhirSetelahnya as $keySlotAkhirSetelahnya) {
								$update1 = $post->updateByPk($keySlotAkhirSetelahnya->id_slot,array(
									'slot_akhir' => $keySlotAkhirSetelahnya->slot_akhir + $selisih
								));
							}
					}
				}
				/*Case Selanjutnya jika edit yang tadinya nilai debit diganti kredit atau sebaliknya*/
				if(!empty($this->kredit) AND !empty($dataNilaiSebelumnya->debit)){
					$selisih = $dataNilaiSebelumnya->debit + $this->kredit;
					foreach ($SlotAkhirSetelahnya as $keySlotAkhirSetelahnya) {
								$update1 = $post->updateByPk($keySlotAkhirSetelahnya->id_slot,array(
									'slot_akhir' => $keySlotAkhirSetelahnya->slot_akhir - $selisih
								));
							}
				}

				if(!empty($this->debit) AND !empty($dataNilaiSebelumnya->kredit)){
					$selisih = $dataNilaiSebelumnya->kredit + $this->debit;
					foreach ($SlotAkhirSetelahnya as $keySlotAkhirSetelahnya) {
								$update1 = $post->updateByPk($keySlotAkhirSetelahnya->id_slot,array(
									'slot_akhir' => $keySlotAkhirSetelahnya->slot_akhir + $selisih
								));
							}
				}

				/*cara baru*/
			   	return true;
			}else{
				return false;
			}
		}elseif ($this->saveType=='add'){

			/*SlotAkhirSebelumnya*/
			$criteria = new CDbCriteria();
			$criteria->condition  = "userid=$this->userid";
			$criteria->order = "id_slot DESC";
			// $criteria->limit = 1;
			$SlotAkhirSebelumnya = Slot::model()->find($criteria);
			/*SlotAkhirSebelumnya*/
			if (!empty($SlotAkhirSebelumnya)){
				if(!empty($this->debit)){
					$this->slot_akhir = $SlotAkhirSebelumnya->slot_akhir + $this->debit;
				}
				if(!empty($this->kredit)){
					$this->slot_akhir = $SlotAkhirSebelumnya->slot_akhir - $this->kredit;
				}
			}else{
				$this->slot_akhir = $this->debit;
			}

			$post->userid =  $this->userid;
			$post->debit =  $this->debit;
			$post->kredit = $this->kredit;
			$post->slot_akhir = $this->slot_akhir;
			$post->input_date = $input_date;
			$post->active_date = $active_date;
			$post->keterangan = $this->keterangan;
			// $post->save();

			if ($post->validate()){
				$post->save();
				return true;
			}else{
				print_r($post->getErrors());exit();
				return false;
			}
		}else{
			return false;
		}
	}
}
?>