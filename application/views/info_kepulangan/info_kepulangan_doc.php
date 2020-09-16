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
        <h2>Info_kepulangan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Tlg Penerbangan</th>
		<th>Nama Maskapai</th>
		<th>Jam Berangkat</th>
		<th>Jam Datang</th>
		<th>Harga Tiket</th>
		<th>Transit</th>
		<th>Sumber</th>
		<th>Pimpinan Id</th>
		
            </tr><?php
            foreach ($info_kepulangan_data as $info_kepulangan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $info_kepulangan->tlg_penerbangan ?></td>
		      <td><?php echo $info_kepulangan->nama_maskapai ?></td>
		      <td><?php echo $info_kepulangan->jam_berangkat ?></td>
		      <td><?php echo $info_kepulangan->jam_datang ?></td>
		      <td><?php echo $info_kepulangan->harga_tiket ?></td>
		      <td><?php echo $info_kepulangan->transit ?></td>
		      <td><?php echo $info_kepulangan->sumber ?></td>
		      <td><?php echo $info_kepulangan->pimpinan_id ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>