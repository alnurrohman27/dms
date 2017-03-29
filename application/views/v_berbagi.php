<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Distribusi Dokumen - KIEC</title>

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
                    <small> Distribusi Dokumen </small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="../beranda">Beranda</a>
                    </li>
                    <li class="active">Distribusi Dokumen</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <!-- /.row -->

        <!-- Service Panels -->
        <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default"> 
                    <div class="panel-body">
                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5><b>Daftar Dokumen yang Terdistribusi</b></h5>
                                </div>
                                <div class="panel-body">
                                    <table id="dokumenberbagi" class="display" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No. Dokumen</th>
                                                <th>Nama Dokumen</th>
                                                <th>Tujuan</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No. Dokumen</th>
                                                <th>Nama Dokumen</th>
                                                <th>Tujuan</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5><b>Mendistribusikan Dokumen</b></h5>
                                </div>
                                <div class="panel-body">
                                <!--Mulai Isi Form-->
                                    <form name="inputBerbagi" id="inputBerbagi" action="../dokumen/berbagiDokumen" method="POST" required>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Nomor Dokumen:</label>
                                                <select onchange="getDestination()" style="width: 100%;" class="nomor_dokumen form-control" id="no_dokumen" name="no_dokumen" required>
                                                <option value="" selected="selected">Pilih Dokumen</option>
                                                <?php 
                                                    foreach ($dokumen as $row) {
                                                        echo '<option value="'.$row["id_dokumen"].'">'.$row["nomor_dokumen"].' ';
                                                        echo $row['nama_dokumen'];
                                                        echo '</option>';
                                                    }
                                                ?>
                                                </select>
                                                <p class="help-block"></p>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Tujuan Dokumen:</label>
                                                <select class="tujuan form-control" style="width: 100%;" id="tujuan" name="tujuan[]" placeholder="Pilih Departemen Tujuan" multiple="multiple" required>
                                                </select>
                                                <p class="help-block"></p>
                                            </div>
                                        </div>

                                        <div id="success"></div>
                                        <button type="submit" class="btn btn-primary">Bagikan Dokumen</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <hr>
