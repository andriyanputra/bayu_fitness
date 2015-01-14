<?php
	include "../config/koneksi.php"; 
	@session_start();
?>
<section class="content-header">
    <h1>
        Data Supplier
        <small>Overview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
		<li class="active">Data Supplier</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Tambah Data Supplier</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-2">
                                <div class="form-group">
                                <label for="">Kode Supplier:</label>
                                    <input type="text" class="form-control" name="kd_supplier" id="kode_supplier" readonly="readonly">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Nama Supplier:</label>
                                    <input type="text" class="form-control" name="nm_supplier" id="text" placeholder="Nama Supplier">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="">No. Telp/HP:</label>
                                    <input type="text" class="form-control" name="no_telp" id="text" placeholder="Nomor Telepon/HP">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="">Fax:</label>
                                    <input type="text" class="form-control" name="no_fax" id="text" placeholder="Nomor Fax">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Alamat:</label>
                                    <textarea class="form-control" rows="3" name="almt_supplier" id="alamat_supplier" placeholder="Alamat Supplier"></textarea>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Email Address:</label>
                                    <input type="email" class="form-control" id="email" name="email_supplier" placeholder="Email Address">
                                </div>    
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Daftar Supplier</h3>                                    
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="data_supplier" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Supplier</th>
                                <th>Nama Supplier</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Misc</td>
                                <td>Lynx</td>
                                <td>Text only</td>
                                <td>-</td>
                                <td>X</td>
                            </tr>
                            <tr>
                                <td>Misc</td>
                                <td>IE Mobile</td>
                                <td>Windows Mobile 6</td>
                                <td>-</td>
                                <td>C</td>
                            </tr>
                            <tr>
                                <td>Misc</td>
                                <td>PSP browser</td>
                                <td>PSP</td>
                                <td>-</td>
                                <td>C</td>
                            </tr>
                            <tr>
                                <td>Other browsers</td>
                                <td>All others</td>
                                <td>-</td>
                                <td>-</td>
                                <td>U</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th>Engine version</th>
                                <th>CSS grade</th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>
