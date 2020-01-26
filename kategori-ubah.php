<?php
include_once 'header.php';
$id = isset($_GET['id']) ? base64_decode($_GET['id']) : die('ERROR: missing ID.');

include_once 'includes/kategori.inc.php';
$eks = new kategori($db);

$eks->kk = addslashes($id);

$eks->readOne();

if($_POST){

	if (empty($_POST['kk'])) { ?>
		<div class="alert alert-danger alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong>Gagal Ubah Data!</strong> Harap mengisi kode kategori terlebih dahulu.
		</div>
	<?php } else {
		$eks->nk = $_POST['nk'];
		
		if($eks->update()){
			echo "<script>location.href='kategori.php'</script>";
		} else {
	?>
	<div class="alert alert-danger alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>Gagal Ubah Data!</strong> Terjadi kesalahan, coba sekali lagi.
	</div>
	<?php
		}
	}
}
?>
		<div class="row">
		  <div class="col-xs-12 col-sm-12 col-md-8">
		  	<div class="page-header">
			  <h5>Ubah Kategori</h5>
			</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="kk">Kode Kategori</label>
				    <input type="text" class="form-control" id="kk" name="kk" maxlength="6" value="<?php echo $eks->kk; ?>" readonly required>
				  </div>
				  <div class="form-group">
				    <label for="nk">Nama Kategori</label>
				    <input type="text" class="form-control" id="nk" name="nk" value="<?php echo $eks->nk; ?>" required>
				  </div>
				  <button type="submit" class="btn btn-primary">Ubah</button>
				  <button type="button" onclick="location.href='kategori.php'" class="btn btn-success">Kembali</button>
				</form>
			  
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  	<?php include_once 'sidebar.php'; ?>
		  </div>
		</div>
		<?php
include_once 'footer.php';
?>