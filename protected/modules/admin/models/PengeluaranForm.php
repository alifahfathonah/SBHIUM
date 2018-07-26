<?php 
class PengeluaranForm extends CFormModel
{
	public $id_pengeluaran;
	public $nama;
	public $keterangan;
	public $jumlah;
	public $tanggal;
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
			array('nama, jumlah, tanggal, saveType', 'required'),
			array('keterangan', 'safe'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			
			'nama'=>'Nama Pengeluaran',
			'keterangan'=>'Keterangan',
			'tanggal'=>'Tanggal',
		);
	}

	public function dataSource($object){
    }

	public function editcontent($i){
		$criteria = new CDbCriteria;
		$criteria->addSearchCondition('id_pengeluaran',$i,true,'=');
		$data = Pengeluaran::model()->find($criteria);
		$tanggal = new DateTime($data->tanggal);
        $tanggal = $tanggal->format('d/m/Y');
        
		$this->id_pengeluaran = $data->id_pengeluaran;
		$this->nama = $data->nama;
		$this->jumlah = $data->jumlah;
		$this->keterangan = $data->keterangan;
		$this->tanggal = $tanggal;
		$this->saveType = 'edit';
	}

	public function save(){

		$post = new Pengeluaran;
		$tanggal = new DateTime();
		$tanggal = $tanggal->createFromFormat('d/m/Y', $this->tanggal);
		$tanggal = $tanggal->format('Y-m-d');
		if ($this->saveType=='edit'){
			$update = $post->updateByPk($_GET['i'],array(
					'nama' =>  $this->nama,
					'jumlah' => $this->jumlah,
					'keterangan' => $this->keterangan,
					'tanggal' => $tanggal
				));
			if($update){
			   return true;
			}else{
				return false;
			}
		}elseif ($this->saveType=='add'){

			$post->nama =  $this->nama;
			$post->jumlah = $this->jumlah;
			$post->keterangan = $this->keterangan;
			$post->tanggal = $tanggal;
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