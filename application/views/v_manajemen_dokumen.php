<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dokumen Masuk - KIEC</title>

    <?php
        $this->load->view('v_header');
    ?>
</head>

<body>

    <!-- Navigation -->
    <?php
        $this->load->view('v_menu_bar');
    ?>
    <!-- End of Navigation -->

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sistem Kontrol Dokumen
                    <small> Manajemen Dokumen</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="../beranda"><i class="glyphicon glyphicon-home"> Beranda</i></a>
                    </li>
                    <li class="active">Manajemen Dokumen</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <!-- /.row -->

        <!-- Service Panels -->
        <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
        <form name="revisiDocument" method="POST" id="revisiDocument" required>
        </form> 

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">            
                    <div class="panel-body">
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5><b>Mengunggah Dokumen</b></h5>
                                </div>
                                <div class="panel-body">
                                <!--Mulai Isi Form-->
                                    <form name="inputDocument" action="../dokumen/insertDokumen" method="POST" id="inputDocument" enctype="multipart/form-data" required>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Kategori Dokumen:</label>
                                                <select onchange="kirimKategori()" class="kategori_dokumen form-control" id="kategori_dokumen" name="kategori_dokumen" style="width: 100%;" required>
                                                    <option value="">Pilih Kategori Dokumen</option>
                                                <?php 
                                                    foreach ($kategori_dokumen as $row) {
                                                        echo '<option value="'.$row["id_kategori_dokumen"].'">'.$row["id_kategori_dokumen"].' - ';
                                                        echo $row['nama_kategori_dokumen'];
                                                        echo '</option>';
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls" style="display: none;" id="context_diagram">
                                                <label>Kode Context Diagram:</label>
                                                <select class="kode_context form-control" name="yyy" id="kode_context" style="width: 100%;">
                                                    <option value="">Pilih Kode Context Diagram (YYY)</option>
                                                 <?php 
                                                    foreach ($context as $row) {
                                                        echo '<option value="'.$row["id_context"].'">'.$row["id_context"].' - ';
                                                        echo $row['nama_context'];
                                                        echo '</option>';
                                                    }
                                                ?>    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls" style="display: none;" id="prosedur_dokumen">
                                                <label>Kode Prosedur Dokumen:</label>
                                                <input class="form-control" style="width: 100%;" type="text" id="nn" name="nn" placeholder="Contoh = 01 (NN)" minLength="2" maxLength="2" />
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls" style="display: none;" id="judul_dokumen">
                                                <label>Judul Dokumen:</label>
                                                <input class="form-control" style="width: 100%;" type="text" id="nd" name="nd" placeholder="Contoh = 01 (ND)" minLength="2" maxLength="2" />
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls" style="display: none;" id="lokasi">
                                                <label>Lokasi:</label><br>
                                                <select class="lokasi form-control" id="ll" name="ll" style="width: 100%;">
                                                <option value="">Pilih Lokasi (LL)</option>
                                                <?php 
                                                    foreach ($lokasi as $row) {
                                                        echo '<option value="'.$row["id_lokasi"].'">'.$row["id_lokasi"].' - ';
                                                        echo $row['nama_lokasi'];
                                                        echo '</option>';
                                                    }
                                                ?>   
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="control-group form-group">
                                            <div class="controls" style="display: none;" id="no_urut">
                                                <label>Nomor Urut:</label><br>
                                                <input class="form-control" style="width: 100%;" type="text" id="dd" name="dd" placeholder="Contoh = 01 (DD)" minLength="2" maxLength="2" />
                                            </div>
                                        </div>                                       
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Nama Dokumen:</label>
                                                <input placeholder="Contoh: Laporan Keuangan" type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" required>
                                                <p class="help-block"></p>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Dokumen:</label>
                                                <input type="file" class="form-control" id="file_dokumen" name="file_dokumen" required>
                                            </div>
                                        </div>
                                        <div id="progress" class="progress" style="display: none;">
                                            <div id="upload_progress" class="progress-bar progress-bar-striped active" role="progressbar"
                                              aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                
                                            </div>
                                        </div>

                                        <div id="success"></div>
                                        <button id="btn" type="submit" class="btn btn-primary">Kirim Dokumen</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5><b>Daftar Dokumen</b></h5>
                                </div>
                                <div class="panel-body">
                                    <table id="dokumenmasuk" class="display" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No. Dokumen</th>
                                                <th>Nama Dokumen</th>
                                                <th>Edisi</th>
                                                <th>Revisi</th>
                                                <th>Tanggal Rilis</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No. Dokumen</th>
                                                <th>Nama Dokumen</th>
                                                <th>Edisi</th>
                                                <th>Revisi</th>
                                                <th>Tanggal Rilis</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <button style="display: none;" id="myBtn_revisi"></button>
        <!-- The Modal -->
        <div id="myModal_revisi" class="modal">

          <!-- Modal content -->
          <div class="modal-content" style="width: 30%;">
            <div class="modal-header text-center">
              <span class="close" id="btn_close">×</span>
              <h2>Revisi</h2>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Unggah Revisi</h3>
                    </div>
                    <div class="col-md-12 text-center">
                        <form name="inputRevisi" id="inputRevisi" method="POST" enctype="multipart/form-data" required>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label>Halaman Revisi:</label>
                                    <select class="halaman form-control" style="width: 100%;" name="hal[]" multiple="multiple" placholder="Pilih Halaman" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label>Keterangan Revisi:</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan" maxLength="10000" rows="5" cols="100" required></textarea> 
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label>File Dokumen:</label>
                                    <input type="file" class="form-control" name="file_revisi" id="file_revisi" required>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <input style="display: none;" name="id_edisi" id="id_edisi">
                            <div id="revisi_p" class="progress" style="display: none;">
                                <div id="revisi_progress" class="progress-bar progress-bar-striped active" role="progressbar"
                                  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                    
                                </div>
                            </div>
                            <div id="success"></div>
                            <button id="submit_revisi" type="submit" class="btn btn-primary">Perbaharui</button>
                        </form>
                    </div>
                </div>
            </div>
          </div>

        </div>

        <button style="display: none;" id="myBtn_edisi"></button>

        <div id="myModal_edisi" class="modal">

          <!-- Modal content -->
          <div class="modal-content" style="width: 30%;">
            <div class="modal-header text-center">
              <span class="close" id="btn_edisi_close">×</span>
              <h2>Edisi</h2>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Unggah Edisi</h3>
                    </div>
                    <div class="col-md-12 text-center">
                        <form name="inputEdisi" id="inputEdisi" method="POST" enctype="multipart/form-data" required>
                            <div id="div_keterangan" class="control-group form-group">
                                
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label>Keterangan Edisi Terbaru:</label>
                                    <textarea class="form-control" name="keterangan_baru" id="keterangan_baru" maxLength="10000" rows="5" cols="100" required></textarea> 
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label>File Dokumen:</label>
                                    <input type="file" class="form-control" name="file_revisi" id="file_revisi" required>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div id="edisi_p" class="progress" style="display: none;">
                                <div id="edisi_progress" class="progress-bar progress-bar-striped active" role="progressbar"
                                  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                    
                                </div>
                            </div>
                            <div id="success"></div>
                            <button id="submit_edisi" type="submit" class="btn btn-primary">Perbaharui</button>
                        </form>
                    </div>
                </div>
            </div>
          </div>

        </div>


        <hr>
