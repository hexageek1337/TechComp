<?php
class kategori{
	
	private $conn;
	private $table_satu = "kategori_item";
	
	public $kk; //Kode kategori
	public $nk; //Nama kategori
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		$query = "insert into ".$this->table_satu." values(:kk,:nk)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':kk', $this->kk);
		$stmt->bindParam(':nk', $this->nk);
		
		if($stmt->execute()){
			return true;
		} else {
			return false;
		}
		
	}
	
	function readAll(){

		$query = "SELECT * FROM ".$this->table_satu." ORDER BY kode_kategoriitem ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}

	function readCount(){

		$query = "SELECT COUNT(kode_kategoriitem) AS jumlahdata FROM ".$this->table_satu."";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	// used when filling up the update product form
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_satu . " WHERE kode_kategoriitem = :kk LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':kk', $this->kk);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->kk = $row['kode_kategoriitem'];
		$this->nk = $row['nama_kategoriitem'];
	}
	
	// update the product
	function update(){

		$query = "UPDATE " . $this->table_satu . " SET nama_kategoriitem = :nk WHERE kode_kategoriitem = :kk";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':kk', $this->kk);
		$stmt->bindParam(':nk', $this->nk);
		
		// execute the query
		if($stmt->execute()){
			return true;
		} else {
			return false;
		}
	}
	
	// delete the product
	function delete(){
	
		$query = "DELETE FROM " . $this->table_satu . " WHERE kode_kategoriitem = :kk";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':kk', $this->kk);

		if($result = $stmt->execute()){
			return true;
		} else {
			return false;
		}
	}
}
?>