<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KIEC</title>

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

    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('<?php echo base_url(); ?>assets/images/logo-kiec.jpg')"></div>
<!--                 <div class="carousel-caption">
                    <h2>KIEC Cilegon</h2>
                </div> -->
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Two');"></div>

            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Three');"></div>
   
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">
        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Sistem Kontrol Dokumen
                </h1>
            </div>
            <?php
                if(isset($_SESSION['hak_akses']) && $_SESSION['hak_akses'] == 'write'|| isset($_SESSION['hak_akses']) && $_SESSION['hak_akses'] == 'admin'){?>  
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4><i class="glyphicon glyphicon-file"></i> Manajemen Dokumen</h4>
                            </div>
                            <div class="panel-body">
                                <p>Memasukkan, mengubah, atau menghapus dokumen.</p>
                                <a href="<?php echo base_url(); echo 'beranda/manajemen_dokumen';?>" class="btn btn-default">Klik disini!</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4><i class="glyphicon glyphicon-check"></i> Berbagi Dokumen</h4>
                            </div>
                            <div class="panel-body">
                                <p>Untuk pengulasan, berbagi, atau pembatalan dokumen yang telah dimasukan.</p>
                                <a href="<?php echo base_url(); echo 'beranda/berbagi';?>" class="btn btn-default">Klik disini!</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4><i class="glyphicon glyphicon-search"></i> Diskusi &amp; Pencarian Dokumen</h4>
                            </div>
                            <div class="panel-body">
                                <p>Mencari Dokumen yang telah dimasukkan.</p><br>
                                <a href="<?php echo base_url(); echo 'beranda/pencarian';?>" class="btn btn-default">Klik disini!</a>
                            </div>
                        </div>
                    </div>
                <?php }
                else if(!isset($_SESSION['username'])){?>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 style="color: red;"><i class="glyphicon glyphicon-file"></i> Manajemen Dokumen</h4>
                            </div>
                            <div class="panel-body">
                                <p>Memasukkan, mengubah, atau menghapus dokumen.</p>
                                <a href="<?php echo base_url(); echo 'beranda/manajemen_dokumen';?>" class="btn btn-default">Klik disini!</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4><i class="glyphicon glyphicon-check"></i> Berbagi Dokumen</h4>
                            </div>
                            <div class="panel-body">
                                <p>Untuk pengulasan, berbagi, atau pembatalan dokumen yang telah dimasukan.</p>
                                <a href="<?php echo base_url(); echo 'beranda/berbagi';?>" class="btn btn-default">Klik disini!</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4><i class="glyphicon glyphicon-search"></i> Diskusi &amp; Pencarian Dokumen</h4>
                            </div>
                            <div class="panel-body">
                                <p>Mencari Dokumen yang telah dimasukkan.</p><br>
                                <a href="<?php echo base_url(); echo 'beranda/pencarian';?>" class="btn btn-default">Klik disini!</a>
                            </div>
                        </div>
                    </div>
                    <?php

                }
                else{?>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4><i class="glyphicon glyphicon-search"></i> Diskusi &amp; Pencarian Dokumen</h4>
                            </div>
                            <div class="panel-body">
                                <p>Mencari Dokumen yang telah dimasukkan.</p><br>
                                <a href="<?php echo base_url(); echo 'beranda/pencarian';?>" class="btn btn-default">Klik disini!</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <div class="col-md-8">
                    <p>Terjadi masalah ?<br>Silahkan hubungi ekstensi 212</p>
                </div>
            </div>
        </div>

        <hr>

        
