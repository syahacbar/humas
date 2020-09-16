<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Buku_tamu Read</h2>
        <table class="table">
	    <tr><td>Tanggal</td><td><?php echo $tanggal; ?></td></tr>
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>Jabatan</td><td><?php echo $jabatan; ?></td></tr>
	    <tr><td>Tujuan</td><td><?php echo $tujuan; ?></td></tr>
	    <tr><td>Pesan Saran</td><td><?php echo $pesan_saran; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('buku_tamu') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>