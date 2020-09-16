<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">KELOLA DATA USER</h3>
                    </div>
                    <form action="<?php echo $action1; ?>" method="post" enctype="multipart/form-data">

                        <table class='table table-bordered>'        

                               <tr><td width='200'>Nama Lengkap <?php echo form_error('full_name') ?></td><td><input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" value="<?php echo $full_name; ?>" /></td></tr>
                            <tr><td width='200'>Email <?php echo form_error('email') ?></td><td>

                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" /></td></tr>

                            <?php
                            if ($this->uri->segment(2) == 'create') {
                                ?>

                                <tr><td width='200'>Password <?php echo form_error('password') ?></td><td><input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" /></td></tr>
                                <?php
                            }
                            ?>


                            <tr><td width='200'>Level User <?php echo form_error('id_user_level') ?></td><td>
                                    <?php echo cmb_dinamis('id_user_level', 'tbl_user_level', 'nama_level', 'id_user_level', $id_user_level,'DESC') ?>
                                    <!--<input type="text" class="form-control" name="id_user_level" id="id_user_level" placeholder="Id User Level" value="<?php echo $id_user_level; ?>" />--></td></tr>
                            <tr><td width='200'>Status Aktif <?php echo form_error('is_aktif') ?></td><td>
                                    <?php echo form_dropdown('is_aktif', array('y' => 'AKTIF', 'n' => 'TIDAK AKTIF'), $is_aktif, array('class' => 'form-control')); ?>
                                    <!--<input type="text" class="form-control" name="is_aktif" id="is_aktif" placeholder="Is Aktif" value="<?php echo $is_aktif; ?>" />--></td></tr>
                            <tr><td width='200'>Foto Profile <?php echo form_error('images') ?></td><td> <input type="file" name="images"></td></tr>
                            <tr><td></td><td><input type="hidden" name="id_users" value="<?php echo $id_users; ?>" /> 
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                                    <a href="<?php echo site_url('user') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                        </table>
                    </form>        
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">PROFIL LEMBAGA/INSTANSI/PERUSAHAAN</h3>
                    </div>
                    <form action="<?php echo $action2; ?>" method="post" enctype="multipart/form-data">

                        <table class='table table-bordered>'        

                               <tr><td width='200'>Nama Instansi <?php echo form_error('nama_instansi') ?></td><td><input type="text" class="form-control" name="nama_instansi" id="nama_instansi" placeholder="Nama Lembaga" value="<?php echo $nama_instansi; ?>" /></td></tr>
                               <tr><td width='200'>Alamat <?php echo form_error('alamat_instansi') ?></td><td><input type="text" class="form-control" name="alamat_instansi" id="alamat_instansi" placeholder="Alamat" value="<?php echo $alamat_instansi; ?>" /></td></tr>
                               <tr><td width='200'>Telp/Fax <?php echo form_error('notelp_instansi') ?></td><td><input type="text" class="form-control" name="notelp_instansi" id="notelp_instansi" placeholder="Telp/Fax" value="<?php echo $notelp_instansi; ?>" /></td></tr>
                                <tr><td width='200'>Email <?php echo form_error('email_instansi') ?></td><td><input type="text" class="form-control" name="email_instansi" id="email_instansi" placeholder="Email Instansi" value="<?php echo $email_instansi; ?>" /></td></tr>
                                <tr><td width='200'>Website <?php echo form_error('website_instansi') ?></td><td><input type="text" class="form-control" name="website_instansi" id="website_instansi" placeholder="Website Instansi" value="<?php echo $website_instansi; ?>" /></td></tr>
                            <tr><td width='200'>Logo <?php echo form_error('logo_instansi') ?></td><td> <input type="file" name="logo_instansi"></td></tr>
                            <tr><td></td><td><input type="hidden" name="id_users" value="<?php echo $id_users; ?>" /> 
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                                    <a href="<?php echo site_url('user') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                        </table>
                    </form>         
                </div>
            </div>
        </div>
    </section>
</div>