<?php 
class PenjualanForm extends CFormModel
{
	public $id_penjualan;
	public $tanggal;
	public $id_barang;
	public $jumlah;
	public $laba;
	public $keterangan;
	public $saveType;
	
	

	/**
	 * Declares the validation rules.
	 * The rules state that nama and jumlah are required,
	 * and jumlah needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// nama and jumlah are required
			array('tanggal, id_barang, jumlah, laba, saveType', 'required'),
			array('keterangan', 'safe'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'tanggal'=>'Tanggal',
			'id_barang'=>'Barang',
			'jumlah'=>'Jumlah',
			'laba'=>'Laba',
			'keterangan'=>'Keterangan',
		);
	}

	public function dataSource($object){
        switch($object){
			case 'barang' :
				$return = CHtml::listData(Barang::model()->findAll(),'id_barang','nama_barang');
				break;
		}
        return $return;
    }

	public function editcontent($i){
		$criteria = new CDbCriteria;
		$criteria->addSearchCondition('id_penjualan',$i,true,'=');
		$data = Penjualan::model()->find($criteria);
		$tanggal = new DateTime($data->tanggal);
        $tanggal = $tanggal->format('d/m/Y');
        
		$this->id_penjualan = $data->id_penjualan;
		$this->tanggal = $tanggal;
		$this->id_barang = $data->id_barang;
		$this->jumlah = $data->jumlah;
		$this->laba = $data->laba;
		$this->keterangan = $data->keterangan;
		$this->saveType = 'edit';
	}

	public function save(){

		$post = new Penjualan;
		$tanggal = new DateTime();
		$tanggal = $tanggal->createFromFormat('d/m/Y', $this->tanggal);
		$tanggal = $tanggal->format('Y-m-d');
		if ($this->saveType=='edit'){
			$update = $post->updateByPk($_GET['i'],array(
					'tanggal' => $tanggal,
					'id_barang' =>  $this->id_barang,
					'jumlah' => $this->jumlah,
					'laba' => $this->laba,
					'keterangan' => $this->keterangan,
				));
			if($update){
			   return true;
			}else{
				return false;
			}
		}elseif ($this->saveType=='add'){

			$post->tanggal = $tanggal;
			$post->id_barang =  $this->id_barang;
			$post->jumlah = $this->jumlah;
			$post->laba = $this->laba;
			$post->keterangan = $this->keterangan;
			$post->save();

			if ($post->validate()){
				$post->save();
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}
?>