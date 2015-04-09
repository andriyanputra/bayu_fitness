<?php 
	@session_start();
	$array_hr= array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
    $array_bln = array(1=>"Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","Septemper","Oktober", "November","Desember");
    if($_SESSION[ID_LEVEL]==1) { 
?>
<section class="content-header">
    <h1>
        Daftar Event
        <small>Overview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
		<li class="active">Event</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-file-o"></i>&nbsp;Daftar Event</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            Daftar event <b>Sistem Informasi New Comando Gym Center</b>.
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                          <div class="col-md-10"></div>
                          <div class="col-md-2 pull-right">
                            <a href="index?fold=event&page=index" class="btn btn-block btn-primary" data-toggle="tooltip" title="Tambah Event"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Event</a>
                          </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="event" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>ID Event</th>
                                        <th>Judul Event</th>
                                        <th>Tgl Mulai</th>
                                        <th>Tgl Selesai</th>
                                        <th>Foto Event</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $art = oci_parse($koneksi, "SELECT * FROM EVENT ORDER BY ID_EVENT ASC");
                                    oci_execute($art); $n = 0;
                                    while ($db = oci_fetch_array($art)) {
                                    $n++; $date_mulai = strtotime($db[TGL_MULAI]); $date_selesai = strtotime($db[TGL_SELESAI]);
                                    $hr_mulai = $array_hr[date('N', $date_mulai)]; $bln_mulai = $array_bln[date('n', $date_mulai)];
                                    $hr_selesai = $array_hr[date('N', $date_selesai)]; $bln_selesai = $array_bln[date('n', $date_selesai)];
                                ?>
                                    <tr>
                                        <td><?php echo $n."."; ?></td>
                                        <td><?php echo $db[ID_EVENT]; ?></td>
                                        <td><?php echo $db[NM_EVENT]; ?></td>
                                        <td><?php echo $hr_mulai.", ".date('d', $date_mulai)." ".$bln_mulai." ".date('Y', $date_mulai); ?></td>
                                        <td><?php echo $hr_selesai.", ".date('d', $date_selesai)." ".$bln_selesai." ".date('Y', $date_selesai); ?></td>
                                        <td>
                                          <?php if(!empty($db[FOTO_EVENT])){ ?>
                                            <a href="../assets/img/event/<?php echo $db[FOTO_EVENT]; ?>" class="lihat" title="<?php echo $db[NM_EVENT]; ?>"><i class="fa fa-picture-o"></i></a>
                                          <?php }else{ ?>
                                            <a href="../assets/img/barang/empty.gif" class="lihat" title="<?php echo $db[NM_EVENT]; ?>"><i class="fa fa-picture-o"></i></a>
                                          <?php } ?>
                                        </td>
                                        <td>
                                            <a href="index?fold=event&page=event_edit&id=<?php echo $db[ID_EVENT]; ?>" data-toggle="tooltip" title="Edit Event"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                            <a href="javascript:confirmDelete('index?fold=event&page=event_hapus&id=<?php echo $db[ID_EVENT]; ?>')" data-toggle="tooltip" title="Hapus Event"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                <?php 
                                    }
                                ?>
                                <script type="text/javascript">
                                    function confirmDelete(delUrl) {
                                        setTimeout(function() {
                                            swal({
                                                title: "Apakah Anda yakin?",
                                                text: "Anda tidak akan bisa mengembalikan data yang telah terhapus!",
                                                type: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#DD6B55",
                                                confirmButtonText: "Yes, delete it!"
                                            },
                                            function(){
                                                document.location = delUrl;
                                            });
                                        }, 200);
                                    }
                                </script>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- /.box-body -->
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