<?php
include_once 'header.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != base64_encode('Admin')) { ?>
        <div class="container">
            <div class="text-center">Halaman ini hanya untuk hak akses Admin saja!</div>
        </div>
    <?php } else {
include_once 'includes/barang.inc.php';
$pro = new barang($db);
$stmt = $pro->readAll();
?>
	<div class="row">
		<div class="col-md-6 text-left">
			<h3>Data Barang</h3>
		</div>
		<div class="col-md-6 text-right">
			<button onclick="location.href='barang-baru.php'" class="btn btn-primary" id="btn-tambah">Tambah Data</button>
		</div>
	</div>
	<br/>

	<table width="100%" class="table table-striped table-bordered" id="tabeldata">
        <thead>
            <tr>
                <th width="30px">No</th>
                <th>Kode</th>
                <th>Nama </th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th width="100px" id="bg-hasil">Aksi</th>
            </tr>
        </thead>
        <tbody>
<?php
$no=1;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $row['kode_item'] ?></td>
                <td><?php echo $row['nama_item'] ?></td>
                <td><span class="label label-info"><?php echo $row['nama_kategoriitem'] ?></span></td>
                <td><?php echo $row['harga_item'] ?></td>
                <td><?php echo $row['stok_item'] ?></td>
                <td class="text-center">
					<a href="barang-ubah.php?id=<?php echo base64_encode($row['kode_item']) ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
					<a href="barang-hapus.php?id=<?php echo base64_encode($row['kode_item']) ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
			    </td>
            </tr>
<?php
}
?>
        </tbody>
    </table>
<?php
include_once 'footer.php';
    }
}
?>