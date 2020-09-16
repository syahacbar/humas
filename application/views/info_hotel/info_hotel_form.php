<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $button;?> INFORMASI HOTEL</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>        

	    <tr><td width='200'>Nama Hotel <?php echo form_error('nama_hotel') ?></td><td><input type="text" class="form-control" name="nama_hotel" id="nama_hotel" placeholder="Nama Hotel" value="<?php echo $nama_hotel; ?>" /></td></tr>
	    <tr><td width='200'>Jenis Kamar <?php echo form_error('jenis_kamar') ?></td><td><input type="text" class="form-control" name="jenis_kamar" id="jenis_kamar" placeholder="Jenis Kamar" value="<?php echo $jenis_kamar; ?>" /></td></tr>
	    <tr><td width='200'>Tarif Kamar <?php echo form_error('tarif_kamar') ?></td>
			<td>
			<div class="input-group">
                <span class="input-group-addon">Rp.</span>
                <input name="tarif_kamar" id="tarif_kamar" type="text" class="form-control" placeholder="Tarif Kamar" value="<?php echo $tarif_kamar;?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                <span class="input-group-addon">,00</span>
              </div>
			</td>
		</tr>
	    
        <tr><td width='200'>Fasilitas Hotel <?php echo form_error('fasilitas_hotel') ?></td><td> <textarea class="form-control" rows="3" name="fasilitas_hotel" id="fasilitas_hotel" placeholder="Fasilitas Hotel"><?php echo $fasilitas_hotel; ?></textarea></td></tr>
	    <tr><td width='200'>Sumber <?php echo form_error('sumber') ?></td><td><input type="text" class="form-control" name="sumber" id="sumber" placeholder="Sumber" value="<?php echo $sumber; ?>" /></td></tr>
	    <tr><td width='200'>Nama Pimpinan <?php echo form_error('pimpinan_id') ?></td><td><input type="text" id="pimpinan_id" name="pimpinan_id" class="form-control ui-autocomplete-input" value="<?php echo $pimpinan_id; ?>" placeholder="Masukan Nama Pimpinan ..."></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Simpan</button> 
	    <a href="<?php echo site_url('info_hotel') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
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
            source: "<?php echo base_url()?>/info_hotel/autocomplate_pimpinan",
            minLength: 1
        });				
    });
</script>