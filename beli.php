<?php
include_once 'header.php';
$today = date("Ymd");
$id = isset($_GET['kode']) ? base64_decode($_GET['kode']) : die('ERROR: missing ID.');

include_once 'includes/barang.inc.php';
$eks = new barang($db);
include_once 'includes/transaksi.inc.php';
$pro = new transaksi($db);

$pro->ki = addslashes($id);
$pro->ip = intval($_SESSION['id_pengguna']);

$eks->ki = addslashes($id);
$eks->readOne();

if($_POST){
	$a = $pro->readMaxTrans($today);
	$data = $a->fetch(PDO::FETCH_ASSOC);
	// cari id transaksi terakhir yang berawalan tanggal hari ini
	$lastNoTransaksi = $data['last'];

	// baca nomor urut transaksi dari id transaksi terakhir
	$lastNoUrut = substr($lastNoTransaksi, 8, 4);

	// nomor urut ditambah 1
	$nextNoUrut = $lastNoUrut + 1;

	// membuat format nomor transaksi berikutnya
	$nextNoTransaksi = $today.sprintf('%04s', $nextNoUrut);

	$pro->itrans = $nextNoTransaksi;
	$pro->jt = $_POST['jt'];
	$pro->totaltrans = $_POST['totaltrans'];
	$pro->tgltrans = date("Y-m-d h:i:s");

	$stoksaatini = (intval($eks->si) - $_POST['jt']);
	//print($stoksaatini);
		
	if($pro->penguranganStok($stoksaatini) AND $pro->insert()){
		echo "<script>alert('Berhasil Transaksi!')</script>";
		echo "<script>location.href='index.php'</script>";
	} else {
?>
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Gagal Transaksi!</strong> Terjadi kesalahan, coba sekali lagi.
	</div>
	<?php
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
				    <input type="text" class="form-control" id="ni" name="ni" value="<?php echo $eks->ni; ?>" readonly>
				  </div>
				  <div class="form-group">
				    <label for="hi">Harga Barang</label>
				    <input type="number" class="form-control" id="hi" name="hi" value="<?php echo $eks->hi; ?>" readonly>
				  </div>
				  <div class="form-group">
				    <label for="si">Stok Barang</label>
				    <input type="text" class="form-control" id="si" name="si" value="<?php echo $eks->si; ?>" readonly>
				  </div>
				  <br>
				  <br>
				  <div class="form-group">
				    <label for="jt">Jumlah Beli</label>
				    <input type="number" class="form-control" id="jt" name="jt" max="<?php echo $eks->si; ?>" placeholder="Masukan jumlah beli Anda ..." required>
				  </div>
				  <div class="form-group">
				    <label for="totaltrans">Total Harga</label>
				    <input type="number" class="form-control" id="totaltrans" name="totaltrans" readonly required>
				  </div>
				  <button type="submit" class="btn btn-primary">Bayar</button>
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