<?php
class barang{
	
	private $conn;
	private $table_satu = "item";
	private $table_dua = "kategori_item";
	
	public $ki; //Kode item
	public $kk; //Kode kategori
	public $ni; //Nama item
	public $hi; //Harga item
	public $si; //Stok item
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		$query = "insert into ".$this->table_satu." values(:ki,:kk,:ni,:hi,:si)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':ki', $this->ki);
		$stmt->bindParam(':kk', $this->kk);
		$stmt->bindParam(':ni', $this->ni);
		$stmt->bindParam(':hi', $this->hi);
		$stmt->bindParam(':si', $this->si);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function readAll(){

		$query = "SELECT a.*,b.nama_kategoriitem FROM ".$this->table_satu." AS a,".$this->table_dua." AS b WHERE a.kode_kategoriitem = b.kode_kategoriitem ORDER BY a.kode_item ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}

	function readAllKategori(){

		$query = "SELECT * FROM ".$this->table_dua." ORDER BY kode_kategoriitem ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}

	function readCount(){

		$query = "SELECT COUNT(kode_item) AS jumlahdata FROM ".$this->table_satu."";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}

	function readCountKategori(){

		$query = "SELECT COUNT(kode_kategoriitem) AS jumlahdata FROM ".$this->table_dua."";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	// used when filling up the update product form
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_satu . " WHERE kode_item = :ki LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':ki', $this->ki);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->ki = $row['kode_item'];
		$this->kk = $row['kode_kategoriitem'];
		$this->ni = $row['nama_item'];
		$this->hi = $row['harga_item'];
		$this->si = $row['stok_item'];
	}
	
	// update the product
	function update(){

		$query = "UPDATE 
					" . $this->table_satu . " 
				SET 
					kode_kategoriitem = :kk,  
					nama_item = :ni,
					harga_item = :hi,
					stok_item = :si
				WHERE
					kode_item = :ki";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':ki', $this->ki);
		$stmt->bindParam(':kk', $this->kk);
		$stmt->bindParam(':ni', $this->ni);
		$stmt->bindParam(':hi', $this->hi);
		$stmt->bindParam(':si', $this->si);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// delete the product
	function delete(){
	
		$query = "DELETE FROM " . $this->table_satu . " WHERE kode_item = :ki";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':ki', $this->ki);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>