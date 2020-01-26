<?php
class transaksi{
	
	private $conn;
	private $table_satu = "transaksi";
	private $table_dua = "pengguna";
	private $table_tiga = "item";
	
	public $itrans; //ID Transaksi
	public $ip; //ID Pengguna
	public $ki; //Kode item
	public $jt; //Jumlah Transaksi
	public $totaltrans; //Total Transaksi
	public $tgltrans; //Tanggal Transaksi
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		$query = "insert into ".$this->table_satu." values(:itrans,:ip,:ki,:jt,:totaltrans,:tgltrans)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':itrans', $this->itrans);
		$stmt->bindParam(':ip', $this->ip);
		$stmt->bindParam(':ki', $this->ki);
		$stmt->bindParam(':jt', $this->jt);
		$stmt->bindParam(':totaltrans', $this->totaltrans);
		$stmt->bindParam(':tgltrans', $this->tgltrans);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function readAll(){

		$query = "SELECT a.id_transaksi,c.nama_item,a.jumlah_transaksi,a.total_transaksi,a.tgl_transaksi,b.nama_lengkap AS pembeli FROM ".$this->table_satu." AS a JOIN ".$this->table_dua." AS b ON a.id_pengguna = b.id_pengguna JOIN ".$this->table_tiga." AS c ON a.kode_item = c.kode_item ORDER BY a.id_transaksi ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}

	function readCount(){

		$query = "SELECT COUNT(id_transaksi) AS jumlahdata FROM ".$this->table_satu."";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}

	function readMaxTrans($value)
	{
		$query = "SELECT MAX(id_transaksi) AS last FROM ".$this->table_satu." WHERE id_transaksi LIKE '%".$value."%'";
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

	function penguranganStok($stoksaatini){

		$query = "UPDATE " . $this->table_tiga . " SET stok_item = ".$stoksaatini." WHERE kode_item = :ki";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':ki', $this->ki);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
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