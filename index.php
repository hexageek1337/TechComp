<?php
include_once 'header.php';
include_once 'includes/barang.inc.php';
$barang = new barang($db);
include_once 'includes/transaksi.inc.php';
$transaksi = new transaksi($db);
$stmtBarang = $barang->readAll();
$stmtDataTrans = $transaksi->readAll();
// Read Count
$stmtcount = $barang->readCount();
$stmtcountTrans = $transaksi->readCount();
$stmtcountKategori = $barang->readCountKategori();
// Fetch
$rowC = $stmtcount->fetch(PDO::FETCH_ASSOC);
$rowTrans = $stmtcountTrans->fetch(PDO::FETCH_ASSOC);
$rowCK = $stmtcountKategori->fetch(PDO::FETCH_ASSOC);

if (isset($_GET['dashboard'])) {
	if ($_SESSION['role'] != base64_encode('Admin')) { ?>
        <div class="container">
            <div class="text-center">Halaman ini hanya untuk hak akses Admin saja!</div>
        </div>
    <?php } else { ?>
		<div class="row">
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  	<div class="page-header">
			  <h5>Barang</h5>
			</div>
			<div class="panel panel-default">
			  <div class="panel-body" id="panel-value">
			    <?=$rowC['jumlahdata']?> Data Barang
			  </div>
			</div>
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  	<div class="page-header">
			  <h5>Kategori</h5>
			</div>
			<div class="panel panel-default">
			  <div class="panel-body" id="panel-kriteria">
			    <?=$rowCK['jumlahdata']?> Data Kategori Barang
			  </div>
			</div>
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  	<div class="page-header">
			  <h5>Transaksi</h5>
			</div>
			<div class="panel panel-default">
			  <div class="panel-body" id="panel-kandidat">
			    <?=$rowTrans['jumlahdata']?> Data Transaksi
			  </div>
			</div>
		  </div>
		</div>
		<?php }
		} else { ?>
			<div class="row">
				<?php while ($rowBarang = $stmtBarang->fetch(PDO::FETCH_ASSOC)) {
					if($rowBarang['stok_item'] != 0){ ?>
				<div class="col-sm-6 col-md-4">
    				<div class="thumbnail" style="background: #ffffff url(images/back1.jpg) left bottom fixed; border-color: #2c3e50; border-radius: 1.5px;">
      					<img class="img-responsive" src="<?=$config->link()?>/images/barang.jpg" alt="<?=$rowBarang['nama_item']?>" title="<?=$rowBarang['nama_item']?>" width="243" height="200">
      					<div class="caption">
	        				<h2><?=$rowBarang['nama_item']?></h2>
	        				<p>Price : <span class="label label-info"><?=number_format($rowBarang['harga_item'],2,",",".")?></span> | Stok : <span class="label label-info"><?=$rowBarang['stok_item']?></span></p>
	        				<hr class="hr-footer">
	        				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet lacus nec tempus sodales. Nulla hendrerit, erat mattis venenatis feugiat, tortor quam aliquam risus, sagittis volutpat lorem magna at dolor. Etiam eget lectus vitae sapien luctus ultricies.</p>
	        				<p>
	        					<a href="beli.php?kode=<?=base64_encode($rowBarang['kode_item'])?>" class="btn btn-primary" role="button" id="btn-tambah">Buy</a>
	        				</p>
      					</div>
    				</div>
  				</div>
  				<?php }
  				} ?>
			</div>
		<?php } ?>
		<hr class="hr-footer">
		<div class="footer">
			<footer class="text-center">&copy; <?=date("Y")?> <?=$config->title?> <i class="fas fa-heart"></i></footer>
		</div>
		</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/highcharts.js"></script>
	<script src="js/exporting.js"></script>
	</body>
</html>