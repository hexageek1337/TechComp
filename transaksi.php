<?php
include_once 'header.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != base64_encode('Admin')) { ?>
        <div class="container">
            <div class="text-center">Halaman ini hanya untuk hak akses Admin saja!</div>
        </div>
    <?php } else {
include_once 'includes/transaksi.inc.php';
$pro = new transaksi($db);
$stmt = $pro->readAll();
?>
	<div class="row">
		<div class="col-md-6 text-left">
			<h3>Data Transaksi</h3>
		</div>
	</div>
	<br/>

	<table width="100%" class="table table-striped table-bordered" id="tabeldata">
        <thead>
            <tr>
                <th width="30px">No</th>
                <th>Kode Transaksi</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th>Pembeli</th>
            </tr>
        </thead>
        <tbody>
<?php
$no=1;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $row['id_transaksi'] ?></td>
                <td><?php echo $row['nama_item'] ?></td>
                <td><?php echo $row['jumlah_transaksi'] ?></td>
                <td><?php echo $row['total_transaksi'] ?></td>
                <td><?php echo $row['tgl_transaksi'] ?></td>
                <td><span class="label label-info"><?php echo $row['pembeli'] ?></span></td>
            </tr>
<?php
}
?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="7" style="text-align:right">Total Pendapatan :</th>
            </tr>
        </tfoot>
    </table>
<?php
include_once 'footer.php';
    }
}
?>