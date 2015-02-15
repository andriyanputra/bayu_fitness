<?php
	@session_start();
    if($_SESSION[ID_LEVEL] == 1 || $_SESSION[ID_LEVEL] == 2){
?>
<section class="content-header">
    <h1>
        Pemberitahuan
        <small>Overview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
		<li class="active">Pemberitahuan</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-warning"></i>&nbsp;<?php echo $emp_[0]+$mem_[0]; ?> Pemberitahuan</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                          <table id="notif" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Keterangan</th>
                                        <th>Waktu</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($p = oci_fetch_array($isi_p)){ ?>
                                        <tr>
                                            <td><?php echo $p[0]; ?></td>
                                            <td><?php echo $p[1]; ?></td>
                                        <?php if($p[2] == 1){ ?>
                                            <td>Telah terjadi penambahan data pegawai.</td>
                                        <?php }else{ ?>
                                            <td>Telah terjadi perubahan data pegawai.</td>
                                        <?php } ?>
                                            <td>Pukul <?php echo $p[4]; ?></td>
                                            <td align="center">
                                                <a href='index?fold=user&page=user_profile&id=<?php echo $p[0]; ?>' data-toggle='tooltip' title='Lihat Pemberitahuan'><i class='fa fa-camera-retro'></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php while($m = oci_fetch_array($isi_m)){ ?>
                                        <tr>
                                            <td><?php echo $m[0]; ?></td>
                                            <td><?php echo $m[1]; ?></td>
                                        <?php if($m[2] == 1){ ?>
                                            <td>Telah terjadi penambahan data member.</td>
                                        <?php }else{ ?>
                                            <td>Telah terjadi perubahan data member.</td>
                                        <?php } ?>
                                            <td>Pukul <?php echo $m[4]; ?></td>
                                            <td align="center">
                                                <a href='index?fold=ang&page=anggota_profile&id=<?php echo $m[0]; ?>' data-toggle='tooltip' title='Lihat Pemberitahuan'><i class='fa fa-camera-retro'></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                          </table>
                      </div>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <div class="text-right">
                        <!--<input type="submit" name="simpan" class="btn btn-primary" value="Submit" />-->
                    </div>
                </div>
            </div><!-- /.box -->
        </div>
    </div>
</section>
<?php
    }else{
        ?>
          <script type="text/javascript">
            setTimeout(function() {
                swal({
                      title:"Oopss!",
                      text: "Restricted Page !",
                      type: "warning",
                      showCancelButton: false
                }, function(){
                    window.history.back();
                })
            }, 200);
          </script>
        <?php
    }
?>