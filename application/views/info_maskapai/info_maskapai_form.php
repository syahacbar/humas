<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA INFO_KEBERANGKATAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>        

	    <tr><td width='200'>Tgl Penerbangan <?php echo form_error('tgl_penerbangan') ?></td><td><input type="text" class="form-control" name="tgl_penerbangan" id="tgl_penerbangan" placeholder="Tgl Penerbangan" value="<?php echo $tgl_penerbangan; ?>" /></td></tr>
	    <tr><td width='200'>Nama Maskapai <?php echo form_error('nama_maskapai') ?></td><td><input type="text" class="form-control" name="nama_maskapai" id="nama_maskapai" placeholder="Nama Maskapai" value="<?php echo $nama_maskapai; ?>" /></td></tr>
	    <tr><td width='200'>Jam Berangkat <?php echo form_error('jam_berangkat') ?></td><td><input type="text" class="form-control" name="jam_berangkat" id="jam_berangkat" placeholder="Jam Berangkat" value="<?php echo $jam_berangkat; ?>" /></td></tr>
	    <tr><td width='200'>Jam Datang <?php echo form_error('jam_datang') ?></td><td><input type="text" class="form-control" name="jam_datang" id="jam_datang" placeholder="Jam Datang" value="<?php echo $jam_datang; ?>" /></td></tr>
	    <tr><td width='200'>Harga Tiket <?php echo form_error('harga_tiket') ?></td><td><input type="text" class="form-control" name="harga_tiket" id="harga_tiket" placeholder="Harga Tiket" value="<?php echo $harga_tiket; ?>" /></td></tr>
	    <tr><td width='200'>Transit <?php echo form_error('transit') ?></td><td><input type="text" class="form-control" name="transit" id="transit" placeholder="Transit" value="<?php echo $transit; ?>" /></td></tr>
	    <tr><td width='200'>Sumber <?php echo form_error('sumber') ?></td><td><input type="text" class="form-control" name="sumber" id="sumber" placeholder="Sumber" value="<?php echo $sumber; ?>" /></td></tr>
	    <tr><td width='200'>Pimpinan Id <?php echo form_error('pimpinan_id') ?></td><td><input type="text" class="form-control" name="pimpinan_id" id="pimpinan_id" placeholder="Pimpinan Id" value="<?php echo $pimpinan_id; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('info_keberangkatan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>