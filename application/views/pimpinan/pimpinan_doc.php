<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Pimpinan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama</th>
		<th>Tgl Keberangkatan</th>
		<th>Rute Keberangkatan</th>
		<th>Tgl Kepulangan</th>
		<th>Rute Kepulangan</th>
		
            </tr><?php
            foreach ($pimpinan_data as $pimpinan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $pimpinan->nama ?></td>
		      <td><?php echo $pimpinan->tgl_keberangkatan ?></td>
		      <td><?php echo $pimpinan->rute_keberangkatan ?></td>
		      <td><?php echo $pimpinan->tgl_kepulangan ?></td>
		      <td><?php echo $pimpinan->rute_kepulangan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>