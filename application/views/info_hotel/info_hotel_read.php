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
        <h2 style="margin-top:0px">Info_hotel Read</h2>
        <table class="table">
	    <tr><td>Nama Hotel</td><td><?php echo $nama_hotel; ?></td></tr>
	    <tr><td>Jenis Kamar</td><td><?php echo $jenis_kamar; ?></td></tr>
	    <tr><td>Tarif Kamar</td><td><?php echo $tarif_kamar; ?></td></tr>
	    <tr><td>Fasilitas Hotel</td><td><?php echo $fasilitas_hotel; ?></td></tr>
	    <tr><td>Sumber</td><td><?php echo $sumber; ?></td></tr>
	    <tr><td>Pimpinan Id</td><td><?php echo $pimpinan_id; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('info_hotel') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>