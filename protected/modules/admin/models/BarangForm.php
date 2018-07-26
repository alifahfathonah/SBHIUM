<?php 
class BarangForm extends CFormModel
{
	public $id_barang;
	public $kode_barang;
	public $nama_barang;
	public $keterangan;
	public $saveType;
	
	

	/**
	 * Declares the validation rules.
	 * The rules state that kode_barang and jumlah are required,
	 * and jumlah needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// kode_barang and jumlah are required
			array('kode_barang, nama_barang, keterangan, saveType', 'required')
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			
			'kode_barang'=>'Kode Barang',
			'nama_barang'=>'Nama Barang',
			'keterangan'=>'Keterangan',
		);
	}

	public function dataSource($object){
    }

	public function editcontent($i){
		$criteria = new CDbCriteria;
		$criteria->addSearchCondition('id_barang',$i,true,'=');
		$data = Barang::model()->find($criteria);
        
		$this->id_barang = $data->id_barang;
		$this->kode_barang = $data->kode_barang;
		$this->nama_barang = $data->nama_barang;
		$this->keterangan = $data->keterangan;
		$this->saveType = 'edit';
	}

	public function save(){

		$post = new Barang;
		if ($this->saveType=='edit'){
			$update = $post->updateByPk($_GET['i'],array(
					'kode_barang' =>  $this->kode_barang,
					'nama_barang' => $this->nama_barang,
					'keterangan' => $this->keterangan
				));
			if($update){
			   return true;
			}else{
				return false;
			}
		}elseif ($this->saveType=='add'){

			$post->kode_barang =  $this->kode_barang;
			$post->nama_barang = $this->nama_barang;
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