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
        <h2>Buku_tamu List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Tanggal</th>
		<th>Nama</th>
		<th>Alamat</th>
		<th>Jabatan</th>
		<th>Tujuan</th>
		<th>Pesan Saran</th>
		
            </tr><?php
            foreach ($buku_tamu_data as $buku_tamu)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $buku_tamu->tanggal ?></td>
		      <td><?php echo $buku_tamu->nama ?></td>
		      <td><?php echo $buku_tamu->alamat ?></td>
		      <td><?php echo $buku_tamu->jabatan ?></td>
		      <td><?php echo $buku_tamu->tujuan ?></td>
		      <td><?php echo $buku_tamu->pesan_saran ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>