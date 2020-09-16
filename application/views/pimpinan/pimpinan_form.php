<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $button;?> DATA PIMPINAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>        

	    <tr><td width='200'>Nama <?php echo form_error('nama') ?></td><td><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" /></td></tr>
	    <tr><td width='200'>Jenis Kelamin <?php echo form_error('jenkel') ?></td>
			<td> 
				<select name="jenkel" class="form-control">
					<option value="Laki-laki">Laki-laki</option>
					<option value="Perempuan">Perempuan</option>
				</select>
			</td>
		</tr>
	    <tr><td width='200'>Tgl Keberangkatan <?php echo form_error('tgl_keberangkatan') ?></td><td><input type="date" class="form-control" name="tgl_keberangkatan" id="tgl_keberangkatan" placeholder="Tgl Keberangkatan" value="<?php echo $tgl_keberangkatan; ?>" /></td></tr>
	    <tr><td width='200'>Rute Keberangkatan <?php echo form_error('rute_keberangkatan') ?></td><td><input type="text" class="form-control" name="rute_keberangkatan" id="rute_keberangkatan" placeholder="Rute Keberangkatan" value="<?php echo $rute_keberangkatan; ?>" /></td></tr>
	    <tr><td width='200'>Tgl Kepulangan <?php echo form_error('tgl_kepulangan') ?></td><td><input type="date" class="form-control" name="tgl_kepulangan" id="tgl_kepulangan" placeholder="Tgl Kepulangan" value="<?php echo $tgl_kepulangan; ?>" /></td></tr>
	    <tr><td width='200'>Rute Kepulangan <?php echo form_error('rute_kepulangan') ?></td><td><input type="text" class="form-control" name="rute_kepulangan" id="rute_kepulangan" placeholder="Rute Kepulangan" value="<?php echo $rute_kepulangan; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Simpan</button> 
	    <a href="<?php echo site_url('pimpinan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>