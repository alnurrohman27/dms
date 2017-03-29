<!-- Footer -->
        <div class="navbar navbar-inverse navbar-fixed-bottom" style="background-color: #101010">
			<div class="container">
		    	<p class="navbar-text pull-left">&copy; KP ITS&trade;  2016</p>
		                
		    </div>      
		</div>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.select.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.editor.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/pdfmake.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jszip.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/vfs_fonts.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/responsive.bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.dropdown.js" type="text/javascript"></script>

    <!-- Script untuk pengolahan dokumen -->
    <?php
        if(isset($menu)){
            if($menu == 'manajemen_dokumen') {
                echo '<script src="'.base_url().'assets/js/manajemen_dokumen.js" type="text/javascript"></script>';
                echo '<script src="'.base_url().'assets/js/modal_manajemen_dokumen.js" type="text/javascript"></script>';
            }
            else if($menu == 'berbagi_dokumen') {
                echo '<script src="'.base_url().'assets/js/dokumen_berbagi.js" type="text/javascript"></script>';
            }
            else if($menu == 'pencarian'){
                echo '<script src="'.base_url().'assets/js/pencarian_dokumen.js" type="text/javascript"></script>';
                echo '<script src="'.base_url().'assets/js/modal.js" type="text/javascript"></script>';
            }
            else if($menu == 'profil'){
                echo '<script src="'.base_url().'assets/js/profil.js" type="text/javascript"></script>';
            }
        }
  
    ?>




    <script type="text/javascript">



    // Toggle Function
    $('.toggle').click(function(){
      // Switches the Icon
      $(this).children('i').toggleClass('fa-pencil');
      // Switches the forms  
      $('.form').animate({
        height: "toggle",
        'padding-top': 'toggle',
        'padding-bottom': 'toggle',
        opacity: "toggle"
      }, "slow");
    });
    </script>
</body>

</html>