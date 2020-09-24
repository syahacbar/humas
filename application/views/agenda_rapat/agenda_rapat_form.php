<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $button ?> DATA AGENDA RAPAT</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            
<table class='table table-bordered'>        

	    <tr><td width='200'>Tanggal Rapat <?php echo form_error('tgl_rapat') ?></td><td><input type="date" class="form-control" name="tgl_rapat" id="tgl_rapat" placeholder="Tgl Rapat" value="<?php echo $tgl_rapat; ?>" /></td></tr>
	    <tr><td width='200'>Tempat <?php echo form_error('tempat') ?></td><td><input type="text" class="form-control" name="tempat" id="tempat" placeholder="Tempat" value="<?php echo $tempat; ?>" /></td></tr>
	    <tr><td width='200'>Pimpinan Rapat <?php echo form_error('pimpinan_rapat') ?></td><td><input type="text" class="form-control ui-autocomplete-input" name="pimpinan_rapat" id="pimpinan_rapat" placeholder="Pimpinan Rapat" value="<?php echo $pimpinan_rapat; ?>" /></td></tr>
	    <tr><td width='200'>Waktu <?php echo form_error('waktu') ?></td><td><input type="text" class="form-control" name="waktu" id="waktu" placeholder="Waktu" value="<?php echo $waktu; ?>" /></td></tr>
	    
        <tr><td width='200'>Agenda Rapat <?php echo form_error('agenda_rapat') ?></td><td> <textarea class="form-control" rows="3" name="agenda_rapat" id="agenda_rapat" placeholder="Agenda Rapat"><?php echo $agenda_rapat; ?></textarea></td></tr>
	    
        <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td> <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea></td></tr>
	    <tr><td width='200'>Lampirkan File <?php echo form_error('lampiran') ?></td>
		<td>
			<div class="form-group col-md-3">
                <label>Denah Ruangan</label>
                <input type="file" name="file1" class="form-control">
				<input type="hidden" name="file1hidden" value="<?php echo $file1; ?>" />
            </div>
			<div class="form-group col-md-3">
                <label>Undangan Rapat</label>
                <input type="file" name="file2" class="form-control">
				<input type="hidden" name="file2hidden" value="<?php echo $file2; ?>" />
            </div>
			<div class="form-group col-md-3">
                <label>Kebutuhan Rapat</label>
                <input type="file" name="file3" class="form-control">
				<input type="hidden" name="file3hidden" value="<?php echo $file3; ?>" />
            </div>
			<div class="form-group col-md-3">
                <label>Notula Rapat</label>
                <input type="file" name="file4" class="form-control">
				<input type="hidden" name="file4hidden" value="<?php echo $file4; ?>" />
            </div>
		</td>
		</tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Simpan</button> 
	    <a href="<?php echo site_url('agenda_rapat') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

<script type="text/javascript">
    $(function() {
        //autocomplete
        $("#pimpinan_rapat").autocomplete({
            source: "<?php echo base_url()?>/agenda_rapat/autocomplate_pimpinan",
            minLength: 1
        });				
    });
</script>