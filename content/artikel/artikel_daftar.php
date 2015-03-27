<?php
	@session_start();
    $array_hr= array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
    $array_bln = array(1=>"Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","Septemper","Oktober", "November","Desember");
    $hr = $array_hr[date('N')];$bln = $array_bln[date('n')];
    if($_SESSION[ID_LEVEL]==1 || $_SESSION[ID_LEVEL]==2) {
?>
<section class="content-header">
    <h1>
        Daftar Artikel
        <small>Overview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
		<li class="active">Artikel</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-file-o"></i>&nbsp;Daftar Artikel dan Video</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            Daftar artikel dan video kesehatan <b>Sistem Informasi New Comando Fitness Center</b>.
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                          <div class="col-md-10"></div>
                          <div class="col-md-2 pull-right">
                            <a href="index?fold=artikel&page=index" class="btn btn-block btn-primary" data-toggle="tooltip" title="Tambah Artikel"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Artikel</a>
                          </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="artikel" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>ID Artikel</th>
                                        <th>Judul Artikel</th>
                                        <th>Content</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $art = oci_parse($koneksi, "SELECT * FROM ARTIKEL ORDER BY ID_ARTIKEL ASC");
                                    oci_execute($art); $n = 0;
                                    while ($db = oci_fetch_array($art)) {
                                    $n++; $date_post = strtotime($db[DATE_POSTING]);
                                    $hr_post = $array_hr[date('N', $date_post)]; $bln_post = $array_bln[date('n', $date_post)];
                                ?>
                                    <tr>
                                        <td><?php echo $n."."; ?></td>
                                        <td><?php echo $db[ID_ARTIKEL]; ?></td>
                                        <td><?php echo $db[JD_ARTIKEL]; ?></td>
                                        <td><a href="index?fold=artikel&page=view&id=<?php echo $db[ID_ARTIKEL]; ?>">Read More...</a></td>
                                        <td>
                                            <a href="index?fold=artikel&page=artikel_edit&id=<?php echo $db[ID_ARTIKEL]; ?>" data-toggle="tooltip" title="Edit Artikel"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                            <a href="javascript:confirmDelete('index?fold=artikel&page=artikel_hapus&id=<?php echo $db[ID_ARTIKEL]; ?>')" data-toggle="tooltip" title="Hapus Artikel"><i class="fa fa-trash-o"></i></a>
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