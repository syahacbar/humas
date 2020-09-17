<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $button; ?> INFORMASI KEBERANGKATAN <strong><?php echo strtoupper($pimpinan->nama);?></strong></h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>        

	    <tr><td width='200'>Tgl Penerbangan <?php echo form_error('tgl_penerbangan') ?></td><td><input type="date" class="form-control" name="tgl_penerbangan" id="tgl_penerbangan" placeholder="Tgl Penerbangan" value="<?php echo $tgl_penerbangan; ?>" /></td></tr>
	    <tr><td width='200'>Nama Maskapai <?php echo form_error('nama_maskapai') ?></td><td><input type="text" class="form-control" name="nama_maskapai" id="nama_maskapai" placeholder="Nama Maskapai" value="<?php echo $nama_maskapai; ?>" /></td></tr>
	    <tr><td width='200'>Jam Berangkat <?php echo form_error('jam_berangkat') ?></td><td><input type="text" class="form-control" name="jam_berangkat" id="jam_berangkat" placeholder="Jam Berangkat" value="<?php echo $jam_berangkat; ?>" /></td></tr>
	    <tr><td width='200'>Jam Datang <?php echo form_error('jam_datang') ?></td><td><input type="text" class="form-control" name="jam_datang" id="jam_datang" placeholder="Jam Datang" value="<?php echo $jam_datang; ?>" /></td></tr>
	    <tr><td width='200'>Harga Tiket <?php echo form_error('harga_tiket') ?></td>
			<td>
			<div class="input-group">
                <span class="input-group-addon">Rp.</span>
                <input name="harga_tiket" id="harga_tiket" type="text" class="form-control" placeholder="Harga Tiket" value="<?php echo $harga_tiket;?>">
                <span class="input-group-addon">,00</span>
              </div>
			</td>
		</tr>
	    <tr><td width='200'>Transit <?php echo form_error('transit') ?></td><td><input type="text" class="form-control" name="transit" id="transit" placeholder="Transit" value="<?php echo $transit; ?>" /></td></tr>
	    <tr><td width='200'>Sumber <?php echo form_error('sumber') ?></td><td><input type="text" class="form-control" name="sumber" id="sumber" placeholder="Sumber" value="<?php echo $sumber; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> <input type="hidden" name="pimpinan_id" value="<?php echo intval($this->uri->segment(3)); ?>" />
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Simpan</button> 
	    <a href="<?php echo site_url('info_maskapai/pimpinan/').intval($this->uri->segment(3)) ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>