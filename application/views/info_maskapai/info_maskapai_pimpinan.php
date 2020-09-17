<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info box-solid">    
                    <div class="box-header">
                        <h3 class="box-title">INFORMASI KEBERANGKATAN <strong><?php echo strtoupper($pimpinan->nama);?></strong></h3>
                    </div>
        
                    <div class="box-body">
                        <div class='row'>
                            <div class='col-md-9'>
                                <div style="padding-bottom: 10px;">
                                    <?php echo anchor(site_url('pimpinan/tambah_keberangkatan/').$pimpinan->id, '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?></div>
                                </div>
                                <div class='col-md-3'>
                                    <form action="<?php echo site_url('info_maskapai'); ?>" class="form-inline" method="get">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                            <span class="input-group-btn">
                                                <?php 
                                                    if ($q <> '')
                                                    {
                                                        ?>
                                                        <a href="<?php echo site_url('info_maskapai'); ?>" class="btn btn-default">Reset</a>
                                                        <?php
                                                    }
                                                ?>
                                                <button class="btn btn-primary" type="submit">Search</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row" style="margin-bottom: 10px">
                                <div class="col-md-4 text-center">
                                    <div style="margin-top: 8px" id="message">
                                        <?php echo $this->session->userdata('message1') <> '' ? $this->session->userdata('message1') : ''; ?>
                                    </div>
                                </div>
                                <div class="col-md-1 text-right">
                                </div>
                                <div class="col-md-3 text-right">                
                                </div>
                            </div>
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <tr>
                                    <th>No</th>
                                    <th>Tgl Penerbangan</th>
                                    <th>Nama Maskapai</th>
                                    <th>Jam Berangkat</th>
                                    <th>Jam Datang</th>
                                    <th>Harga Tiket</th>
                                    <th>Transit</th>
                                    <th>Sumber</th>
                                    <th style="text-align:center">Aksi</th>
                                </tr>
                                    <?php
                                    foreach ($info_keberangkatan_data as $info_keberangkatan)
                                    {
                                        ?>
                                <tr>
                                    <td width="10px"><?php echo ++$start ?></td>
                                    <td><?php echo mediumdate_indo($info_keberangkatan->tgl_penerbangan) ?></td>
                                    <td><?php echo $info_keberangkatan->nama_maskapai ?></td>
                                    <td><?php echo $info_keberangkatan->jam_berangkat ?></td>
                                    <td><?php echo $info_keberangkatan->jam_datang ?></td>
                                    <td><?php echo rupiah($info_keberangkatan->harga_tiket) ?></td>
                                    <td><?php echo $info_keberangkatan->transit ?></td>
                                    <td><?php echo $info_keberangkatan->sumber ?></td>
                                    <td style="text-align:center" width="200px">
                                        <?php 
                                        echo anchor(site_url('pimpinan/update_keberangkatan/'.$pimpinan->id.'/'.$info_keberangkatan->id),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                                        echo '  '; 
                                        echo anchor(site_url('pimpinan/delete_keberangkatan_action/'.$pimpinan->id.'/'.$info_keberangkatan->id),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                                        ?>
                                    </td>
		                        </tr>
                                <?php } ?>
                            </table>
                            <div class="row">
                                <div class="col-md-6"> </div>
                                <div class="col-md-6 text-right">
                                    <?php echo $pagination ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary box-solid">    
                    <div class="box-header">
                        <h3 class="box-title">INFORMASI KEPULANGAN <strong><?php echo strtoupper($pimpinan->nama);?></strong></h3>
                    </div>
        
                    <div class="box-body">
                        <div class='row'>
                            <div class='col-md-9'>
                                <div style="padding-bottom: 10px;">
                                    <?php echo anchor(site_url('pimpinan/tambah_kepulangan/').$pimpinan->id, '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?></div>
                                </div>
                                <div class='col-md-3'>
                                    <form action="<?php echo site_url('info_maskapai'); ?>" class="form-inline" method="get">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                            <span class="input-group-btn">
                                                <?php 
                                                    if ($q <> '')
                                                    {
                                                        ?>
                                                        <a href="<?php echo site_url('info_maskapai'); ?>" class="btn btn-default">Reset</a>
                                                        <?php
                                                    }
                                                ?>
                                                <button class="btn btn-primary" type="submit">Search</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row" style="margin-bottom: 10px">
                                <div class="col-md-4 text-center">
                                    <div style="margin-top: 8px" id="message">
                                        <?php echo $this->session->userdata('message2') <> '' ? $this->session->userdata('message2') : ''; ?>
                                    </div>
                                </div>
                                <div class="col-md-1 text-right">
                                </div>
                                <div class="col-md-3 text-right">                
                                </div>
                            </div>
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <tr>
                                    <th>No</th>
                                    <th>Tgl Penerbangan</th>
                                    <th>Nama Maskapai</th>
                                    <th>Jam Berangkat</th>
                                    <th>Jam Datang</th>
                                    <th>Harga Tiket</th>
                                    <th>Transit</th>
                                    <th>Sumber</th>
                                    <th style="text-align:center">Aksi</th>
                                </tr>
                                    <?php
                                    foreach ($info_kepulangan_data as $info_kepulangan)
                                    {
                                        ?>
                                <tr>
                                    <td width="10px"><?php echo ++$start ?></td>
                                    <td><?php echo mediumdate_indo($info_kepulangan->tgl_penerbangan) ?></td>
                                    <td><?php echo $info_kepulangan->nama_maskapai ?></td>
                                    <td><?php echo $info_kepulangan->jam_berangkat ?></td>
                                    <td><?php echo $info_kepulangan->jam_datang ?></td>
                                    <td><?php echo rupiah($info_kepulangan->harga_tiket) ?></td>
                                    <td><?php echo $info_kepulangan->transit ?></td>
                                    <td><?php echo $info_kepulangan->sumber ?></td>
                                    <td style="text-align:center" width="200px">
                                        <?php 
                                        echo anchor(site_url('pimpinan/update_kepulangan/'.$pimpinan->id.'/'.$info_kepulangan->id),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                                        echo '  '; 
                                        echo anchor(site_url('pimpinan/delete_kepulangan_action/'.$pimpinan->id.'/'.$info_kepulangan->id),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                                        ?>
                                    </td>
		                        </tr>
                                <?php } ?>
                            </table>
                            <div class="row">
                                <div class="col-md-6"> </div>
                                <div class="col-md-6 text-right">
                                    <?php echo $pagination ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </section>
</div>