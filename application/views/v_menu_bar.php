<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); echo 'beranda';?>">Krakatau Industrial Estate Cilegon</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        if(isset($_SESSION['hak_akses']) && $_SESSION['hak_akses'] == 'read'){?>
                            <li>
                                <a href="<?php echo base_url(); echo 'beranda/pencarian';?>">Pencarian</a>
                            </li>
                            <?php
                        }
                        else{?>
                            <li>
                                <a href="<?php echo base_url(); echo 'beranda/manajemen_dokumen';?>">Manajemen Dokumen</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); echo 'beranda/berbagi';?>">Berbagi</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); echo 'beranda/pencarian';?>">Pencarian</a>
                            </li>
                            <?php

                        }

                    if($sesi){
                        echo '<li class="dropdown current-user">';
                            echo '<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">';
                                echo '<span class="username">'. $username .'</span>';
                                echo '<i class="clip-chevron-down"></i>';
                            echo '</a>';
                                echo '<ul class="dropdown-menu">';
                                    echo '<li>';
                                        echo '<a href="';echo base_url(); echo 'beranda/profil">Profil</a>';
                                    echo '</li>'; 
                                    echo '<li>';
                                        echo '<a href="';echo base_url(); echo 'login/logout">Keluar</a>';
                                    echo '</li>'; 
                                echo '</ul>';
                        echo '</li>';
                    }
                    else {
                        echo '<li>';
                            echo '<a href="'.base_url().'login'.'">Masuk</a>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>