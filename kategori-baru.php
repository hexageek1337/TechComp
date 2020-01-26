<?php
include_once 'header.php';
include_once 'includes/kategori.inc.php';
$eks = new kategori($db);
if($_POST){
	$eks->kk = $_POST['kk'];
	$eks->nk = $_POST['nk'];
	
	if($eks->insert()){
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Berhasil Tambah Data!</strong> Tambah lagi atau <a href="kategori.php">lihat semua data</a>.
</div>
<?php
	}
	
	else{
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Gagal Tambah Data!</strong> Terjadi kesalahan, coba sekali lagi.
</div>
<?php
	}
}
?>
		<div class="row">
		  <div class="col-xs-12 col-sm-12 col-md-8">
		  	<div class="page-header">
			  <h5>Tambah kategori Preferensi</h5>
			</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="kk">Kode Kategori</label>
				    <input type="text" class="form-control" id="kk" name="kk" maxlength="6" required>
				  </div>
				  <div class="form-group">
				    <label for="nk">Nama Kategori</label>
				    <input type="text" class="form-control" id="nk" name="nk" required>
				  </div>
				  <button type="submit" class="btn btn-primary">Simpan</button>
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