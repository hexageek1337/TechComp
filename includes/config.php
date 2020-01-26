<?php
class Config{
	/* Letak Folder Project Berada */
	public $folder = ''; // if this project is on the webroot, leave it blank
	/* Config Connection Database */
	private $host = "localhost";
	private $db_name = "techcomp";
	private $username = "root";
	private $password = "";
	public $conn;
	/* Config Site */
	public $title = "TechComp"; // this title your website
	public $description = "TechComp merupakan sebuah toko yang menjual kebutuhan komputer";
	public $keywords = "techcomp,computer,teknologi,accessoris,printer,lcd,monitor,mouse,keyboard,cpu,vga,psu"; // this keyword your website
	public $author = "Denny Septian";
	/* Meta Tag Config */
	public $google = "-aEi2vbBOMhSakw1f8_Kd2opa9bnJMNKCMOEsX4lROw";
	public $alexa = "";
	/* Meta Tag Sosial Media */
	// Facebook
	public $fbpagesid = "1867255716844226";
	public $fbid = "";
	// Twitter
	public $twsiteid = "";
	public $twtid = "";
	
	public function getConnection(){
	
		$this->conn = null;
		
		try{
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
		}catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
		
		return $this->conn;
	}

	public function link($option = '')
	{
		return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST']."/".$option;
	}
}
?>