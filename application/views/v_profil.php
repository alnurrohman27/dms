<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Profil Pengguna - KIEC</title>

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
                    <small> Profil Pengguna</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="../beranda"><i class="glyphicon glyphicon-home"> Beranda</i></a>
                    </li>
                    <li class="active">Profil Pengguna</li>
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
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5><b>Profil</b></h5>
                                </div>
                                <div class="panel-body">
                                <!--Mulai Isi Form-->
                                    <form name="inputProfil" action="../beranda/ubah_profil" method="POST" id="inputProfil" required>
                                        <div class="control-group form-group">
                                            <div class="controls" id="username">
                                                <label>Username:</label><br>
                                                <?php
                                                    echo '<input class="form-control" style="width: 100%;" type="text" id="username" name="username" value="'.$_SESSION['username'].'" minLength="5" maxLength="20" readonly />';
                                                ?>
                                            </div>
                                        </div>                                       
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Nama:</label>
                                                <?php
                                                    echo '<input class="form-control" style="width: 100%;" type="text" id="name" name="name" value="'.$_SESSION['nama'].'" maxLength="100" required />';
                                                ?>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Email:</label>
                                                <?php
                                                    echo '<input class="form-control" style="width: 100%;" type="email" id="email" name="email" value="'.$_SESSION['email'].'" minLength="2" maxLength="100" />';
                                                ?>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Jabatan:</label>
                                                <?php
                                                    echo '<input class="form-control" style="width: 100%;" type="text" value="'.$_SESSION['jabatan'].'" readonly />';
                                                ?>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Hak Akses:</label>
                                                <?php
                                                    echo '<input class="form-control" style="width: 100%;" type="text" value="'.$_SESSION['hak_akses'].'" readonly />';
                                                ?>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Password Lama:</label>
                                                
                                                    <input class="form-control" style="width: 100%;" name="old_password" type="password" minLength="5" maxLength="50" required="" />
                                                
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Password Baru:</label>
                                                    <input class="form-control" style="width: 100%;" name="new_password" type="password" minLength="5" maxLength="50" required="" /> 
                                            </div>
                                        </div>

                                        <div id="success"></div>
                                        <button id="btn" type="submit" class="btn btn-primary">Ubah</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <hr>
