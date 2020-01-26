<?php 
class Login
{
	private $conn;
	private $table_name = "pengguna";
	
    public $user;
    public $userid;
    public $passid;

    public function __construct($db){
		$this->conn = $db;
	}

    public function login()
    {
        $user = $this->checkCredentials();
        if ($user) {
            $this->user = $user;
			session_start();
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['id_pengguna'] = $user['id_pengguna'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = base64_encode($user['role']);

            return $user['nama_lengkap'];
        }
        
        return false;
    }

    protected function checkCredentials()
    {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_name.' WHERE username = :uname OR email = :umail AND password = :upass');
		$stmt->bindParam(':uname', $this->userid);
        $stmt->bindParam(':umail', $this->userid);
		$stmt->bindParam(':upass', $this->passid);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->passid;
            if ($submitted_pass == $data['password']) {
                return $data;
            }
        }
        return false;
    }

    public function getUser()
    {
        return $this->user;
    }
}
?>
