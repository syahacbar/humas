<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA AGENDA_KEGIATAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Tanggal <?php echo form_error('tanggal') ?></td><td><input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" /></td></tr>
	    <tr><td width='200'>Waktu <?php echo form_error('waktu') ?></td><td><input type="text" class="form-control" name="waktu" id="waktu" placeholder="Waktu" value="<?php echo $waktu; ?>" /></td></tr>
	    <tr><td width='200'>Tempat <?php echo form_error('tempat') ?></td><td><input type="text" class="form-control" name="tempat" id="tempat" placeholder="Tempat" value="<?php echo $tempat; ?>" /></td></tr>
	    
        <tr><td width='200'>Kegiatan <?php echo form_error('kegiatan') ?></td><td> <textarea class="form-control" rows="3" name="kegiatan" id="kegiatan" placeholder="Kegiatan"><?php echo $kegiatan; ?></textarea></td></tr>
	    
        <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td> <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea></td></tr>
	    <tr><td width='200'>Pimpinan Id <?php echo form_error('pimpinan_id') ?></td><td><input type="text" class="form-control" name="pimpinan_id" id="pimpinan_id" placeholder="Pimpinan Id" value="<?php echo $pimpinan_id; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('agenda_kegiatan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>