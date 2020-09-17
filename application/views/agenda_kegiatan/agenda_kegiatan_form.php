<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $button;?> AGENDA KEGIATAN <strong><?php echo strtoupper($pimpinandata->nama);?></strong></h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>        

	    <tr><td width='200'>Tanggal <?php echo form_error('tanggal') ?></td><td><input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" /></td></tr>
	    <tr><td width='200'>Waktu <?php echo form_error('waktu') ?></td><td><input type="text" class="form-control" name="waktu" id="waktu" placeholder="Waktu" value="<?php echo $waktu; ?>" /></td></tr>
	    <tr><td width='200'>Tempat <?php echo form_error('tempat') ?></td><td><input type="text" class="form-control" name="tempat" id="tempat" placeholder="Tempat" value="<?php echo $tempat; ?>" /></td></tr>
	    
        <tr><td width='200'>Kegiatan <?php echo form_error('kegiatan') ?></td><td> <textarea class="form-control" rows="3" name="kegiatan" id="kegiatan" placeholder="Kegiatan"><?php echo $kegiatan; ?></textarea></td></tr>
	    
        <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td> <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> <input type="hidden" name="pimpinan_id" value="<?php echo $pimpinan_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Simpan </button> 
	    <a href="<?php echo site_url('agenda_kegiatan/pimpinan/').$pimpinandata->id ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

<script type="text/javascript">
    $(function() {
        //autocomplete
        $("#pimpinan_id").autocomplete({
            source: "<?php echo base_url()?>/agenda_kegiatan/autocomplate_pimpinan",
            minLength: 1
        });				
    });
</script>