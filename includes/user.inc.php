<?php
class User{
	
	private $conn;
	private $table_name = "pengguna";
	
	public $id;
	public $mail;
	public $nl;
	public $un;
	public $pw;
	public $rl;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		
		$query = "insert into ".$this->table_name." values(NULL,:nl,:mail,:un,:pw,:rl)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':mail', $this->mail);
		$stmt->bindParam(':nl', $this->nl);
		$stmt->bindParam(':un', $this->un);
		$stmt->bindParam(':pw', $this->pw);
		$stmt->bindParam(':rl', $this->rl);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function readAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_pengguna ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	// used when filling up the update product form
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_pengguna = :id LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':id', $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['id_pengguna'];
		$this->nl = $row['nama_lengkap'];
		$this->mail = $row['email'];
		$this->un = $row['username'];
		$this->pw = $row['password'];
	}
	
	// update the product
	function update(){
		$query = "UPDATE " . $this->table_name . " SET nama_lengkap = :nl, email = :mail, password = :pw, role = :rl WHERE id_pengguna = :id AND username = :un";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':rl', $this->rl);
		$stmt->bindParam(':nl', $this->nl);
		$stmt->bindParam(':mail', $this->mail);
		$stmt->bindParam(':un', $this->un);
		$stmt->bindParam(':pw', $this->pw);
		$stmt->bindParam(':id', $this->id);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// delete the product
	function delete(){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_pengguna = :id";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $this->id);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>
