<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>KIEC - Sistem Manajemen Dokumen</title>

    <?php
        $this->load->view('v_header');
    ?>

  </head>

  <body>

    
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
<div class="pen-title">
  <h1>KIEC - Sistem Manajemen Dokumen</h1>
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
    <div class="tooltip">Daftar</div>
  </div>
  <div class="form">
    <h2>Masuk ke Akun</h2>
    <form action="login/login_validation" method="POST">
      <input name="username" type="text" placeholder="Username"/>
      <input name="password" type="password" placeholder="Password"/>
      <button>Masuk</button>
    </form>
  </div>
<!--   <div class="form">
    <h2>Buat Akun</h2>
    <form action="login/sign_up" method="POST">
      <input name="username" type="text" placeholder="Username"/>
      <input name="nama" type="text" placeholder="Nama Lengkap"/>
      <input name="password" type="password" placeholder="Password"/>
      <input name="email" type="email" placeholder="Email Address"/>
      <button>Register</button>
    </form>
  </div> -->
</div>

<?php
  $this->load->view('v_footer');
?>


    
    
    
  </body>
</html>
