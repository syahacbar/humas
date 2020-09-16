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
        <h2 style="margin-top:0px">Info_keberangkatan Read</h2>
        <table class="table">
	    <tr><td>Tgl Penerbangan</td><td><?php echo $tgl_penerbangan; ?></td></tr>
	    <tr><td>Nama Maskapai</td><td><?php echo $nama_maskapai; ?></td></tr>
	    <tr><td>Jam Berangkat</td><td><?php echo $jam_berangkat; ?></td></tr>
	    <tr><td>Jam Datang</td><td><?php echo $jam_datang; ?></td></tr>
	    <tr><td>Harga Tiket</td><td><?php echo $harga_tiket; ?></td></tr>
	    <tr><td>Transit</td><td><?php echo $transit; ?></td></tr>
	    <tr><td>Sumber</td><td><?php echo $sumber; ?></td></tr>
	    <tr><td>Pimpinan Id</td><td><?php echo $pimpinan_id; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('info_keberangkatan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>