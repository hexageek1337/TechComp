<?php
include_once 'header.php';
include_once 'includes/barang.inc.php';
$eks = new barang($db);
$dataKategori = $eks->readAllKategori();
if($_POST){
	$eks->ki = $_POST['ki'];
	$eks->kk = $_POST['kk'];
	$eks->ni = $_POST['ni'];
	$eks->hi = $_POST['hi'];
	$eks->si = $_POST['si'];
	
	if($eks->insert()){
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Berhasil Tambah Data!</strong> Tambah lagi atau <a href="barang.php">lihat semua data</a>.
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
			  <h5>Tambah barang Preferensi</h5>
			</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="ki">Kode Barang</label>
				    <input type="text" class="form-control" id="ki" name="ki" maxlength="6" required>
				  </div>
				  <div class="form-group">
				    <label for="ni">Nama Barang</label>
				    <input type="text" class="form-control" id="ni" name="ni" required>
				  </div>
				  <div class="form-group">
				    <select name="kk" required>
				    	<option value="" selected>-- Pilih Kategori --</option>
				    	<?php while ($raaw = $dataKategori->fetch(PDO::FETCH_ASSOC)) { ?>
				    		<option value="<?=$raaw['kode_kategoriitem']?>"><?=$raaw['nama_kategoriitem']?></option>
				    	<?php } ?>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="hi">Harga Barang</label>
				    <input type="number" class="form-control" id="hi" name="hi" required>
				  </div>
				  <div class="form-group">
				    <label for="si">Stok Barang</label>
				    <input type="text" class="form-control" id="si" name="si" required>
				  </div>
				  <button type="submit" class="btn btn-primary">Simpan</button>
				  <button type="button" onclick="location.href='barang.php'" class="btn btn-success">Kembali</button>
				</form>
			  
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  	<?php include_once 'sidebar.php'; ?>
		  </div>
		</div>
		<?php
include_once 'footer.php';
?>