<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pencarian Dokumen - KIEC</title>

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
                    <small> Pencarian Dokumen</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="../">Beranda</a>
                    </li>
                    <li class="active">Pencarian Dokumen</li>
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
                    <div class="panel-heading">
                        <h4> Daftar Dokumen</h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Dokumen Terbaru</h4>
                                </div>
                                <div class="panel-body">
                                    <table id="pencarian" class="display" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No. Dokumen</th>
                                                <th>Kategori Dokumen</th>
                                                <th>Kode Context</th>
                                                <th>Nama Dokumen</th>
                                                <th>Edisi</th>
                                                <th>Revisi</th>
                                                <th>Tanggal Rilis</th>
                                                <th>Dokumen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $url = '<?php echo base_url();?>ViewerJS/#.';
                                                for ($j=0;$j<$i;$j++) { 
                                                    $setPath = "setPath('".$path[$j]."', '".$id_file[$j]."')";
                                                    echo '<tr>';
                                                        echo '<td>'.$no_dokumen[$j].'</td>';
                                                        echo '<td>'.$id_kategori_dokumen[$j].'</td>';
                                                        echo '<td>'.$kode_context[$j].'</td>';
                                                        echo '<td>'.$nama[$j].'</td>';
                                                        echo '<td>'.$no_edisi[$j].'</td>';
                                                        echo '<td>'.$no_revisi[$j].'</td>';
                                                        echo '<td>'.$tanggal_rilis[$j].'</td>';
                                                        echo '<td><button onclick="'.$setPath.'">Tampil</button></td>';
                                                    echo '</tr>';
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No. Dokumen</th>
                                                <th>Kategori Dokumen</th>
                                                <th>Kode Context</th>
                                                <th>Nama Dokumen</th>
                                                <th>Edisi</th>
                                                <th>Revisi</th>
                                                <th>Tanggal Rilis</th>
                                                <th>Dokumen</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" <?php if($_SESSION['hak_akses'] == "read"){echo 'style="display:none;"';}?>>
                            <div class="panel panel-default">            
                                <div class="panel-heading">
                                    <h4> Riwayat Dokumen </h4>
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <table id="rekaman" class="display" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No. Dokumen</th>
                                                    <th>Kategori Dokumen</th>
                                                    <th>Kode Context</th>
                                                    <th>Nama Dokumen</th>
                                                    <th>Edisi</th>
                                                    <th>Revisi</th>
                                                    <th>Tanggal Rilis</th>
                                                    <th>Dokumen</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $url = '<?php echo base_url();?>ViewerJS/#.';
                                                    for ($y=0;$y<$x;$y++) { 
                                                        $setPath = "setPath('".$rev_path[$y]."', '".$rev_id_file[$y]."')";
                                                        echo '<tr>';
                                                            echo '<td>'.$rev_no_dokumen[$y].'</td>';
                                                            echo '<td>'.$rev_id_kategori_dokumen[$y].'</td>';
                                                            echo '<td>'.$rev_kode_context[$y].'</td>';
                                                            echo '<td>'.$rev_nama[$y].'</td>';
                                                            echo '<td>'.$rev_no_edisi[$y].'</td>';
                                                            echo '<td>'.$rev_no_revisi[$y].'</td>';
                                                            echo '<td>'.$rev_tanggal_rilis[$y].'</td>';
                                                            echo '<td><button onclick="'.$setPath.'">Tampil</button></td>';
                                                        echo '</tr>';
                                                    }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No. Dokumen</th>
                                                    <th>Kategori Dokumen</th>
                                                    <th>Kode Context</th>
                                                    <th>Nama Dokumen</th>
                                                    <th>Edisi</th>
                                                    <th>Revisi</th>
                                                    <th>Tanggal Rilis</th>
                                                    <th>Dokumen</th>
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
    </div>
    <button style="display: none;" id="myBtn"></button>
    <!-- The Modal -->
    <div id="myModal" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <div class="modal-header">
          <span class="close" id="btn_close">×</span>
          <h2>File Dokumen</h2>
        </div>
        <div class="modal-body" id="tampil">   
        </div>
      </div>

    </div>

        <hr>

