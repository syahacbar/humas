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
        <h2 style="margin-top:0px">Pimpinan Read</h2>
        <table class="table">
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Tgl Keberangkatan</td><td><?php echo $tgl_keberangkatan; ?></td></tr>
	    <tr><td>Rute Keberangkatan</td><td><?php echo $rute_keberangkatan; ?></td></tr>
	    <tr><td>Tgl Kepulangan</td><td><?php echo $tgl_kepulangan; ?></td></tr>
	    <tr><td>Rute Kepulangan</td><td><?php echo $rute_kepulangan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pimpinan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>