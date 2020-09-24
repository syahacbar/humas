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
        <h2 style="margin-top:0px">Agenda_rapat Read</h2>
        <table class="table">
	    <tr><td>Tgl Rapat</td><td><?php echo $tgl_rapat; ?></td></tr>
	    <tr><td>Tempat</td><td><?php echo $tempat; ?></td></tr>
	    <tr><td>Pimpinan Rapat</td><td><?php echo $pimpinan_rapat; ?></td></tr>
	    <tr><td>Waktu</td><td><?php echo $waktu; ?></td></tr>
	    <tr><td>Agenda Rapat</td><td><?php echo $agenda_rapat; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('agenda_rapat') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>