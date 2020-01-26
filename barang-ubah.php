<?php
include_once 'header.php';
$id = isset($_GET['id']) ? base64_decode($_GET['id']) : die('ERROR: missing ID.');

include_once 'includes/barang.inc.php';
$eks = new barang($db);
$dataKategori = $eks->readAllKategori();

$eks->ki = addslashes($id);

$eks->readOne();

if($_POST){

	if (empty($_POST['kk'])) { ?>
		<div class="alert alert-danger alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong>Gagal Ubah Data!</strong> Harap memilih kategori terlebih dahulu.
		</div>
	<?php } else {
		$eks->kk = $_POST['kk'];
		$eks->ni = $_POST['ni'];
		$eks->hi = $_POST['hi'];
		$eks->si = $_POST['si'];
		
		if($eks->update()){
			echo "<script>location.href='barang.php'</script>";
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
			  <h5>Ubah Barang</h5>
			</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="ki">Kode Barang</label>
				    <input type="text" class="form-control" id="ki" name="ki" maxlength="6" value="<?php echo $eks->ki; ?>" readonly>
				  </div>
				  <div class="form-group">
				    <label for="ni">Nama Barang</label>
				    <input type="text" class="form-control" id="ni" name="ni" value="<?php echo $eks->ni; ?>">
				  </div>
				  <div class="form-group">
				    <select name="kk">
				    	<option value="" selected>-- Pilih Kategori --</option>
				    	<?php while ($raaw = $dataKategori->fetch(PDO::FETCH_ASSOC)) { ?>
				    		<option value="<?=$raaw['kode_kategoriitem']?>"><?=$raaw['nama_kategoriitem']?></option>
				    	<?php } ?>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="hi">Harga Barang</label>
				    <input type="number" class="form-control" id="hi" name="hi" value="<?php echo $eks->hi; ?>">
				  </div>
				  <div class="form-group">
				    <label for="si">Stok Barang</label>
				    <input type="text" class="form-control" id="si" name="si" value="<?php echo $eks->si; ?>">
				  </div>
				  <button type="submit" class="btn btn-primary">Ubah</button>
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