<!-- Footer -->
        <div class="navbar navbar-inverse navbar-fixed-bottom" style="background-color: #101010">
			<div class="container">
		    	<p class="navbar-text pull-left">&#169; Copyright &copy; II 2016</p>
		                
		    </div>      
		</div>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/select/1.1.0/js/dataTables.select.min.js" type="text/javascript"></script>
    <script>


    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        // No. 1
        $('#pencarian').dataTable();
        $('#dokumenmasuk tfoot th').each( function () {
            var title = $(this).text();
            var inp   = '<input type="text" class="form-control" placeholder="Cari '+ title +'" />';
            $(this).html(inp);
        } );
     
        // DataTable
        // No. 2
        var table = $('#dokumenmasuk').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "language": {
                            "url"           : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
                            "sEmptyTable"   : "Tidak ada data di database",
                            "sSearch"       : "Cari:"
                        },
                        "ajax": {
                            "url": "<?php echo base_url('beranda/datatables_dokumen');?>",
                            "type": "POST"
                        }
                    });
        
        // Apply the search
        // No. 3
        table.columns().every( function () {
            var that = this;
     
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );

        // Apply Insert Data
        // No. 4
        var counter = 1;
        $('#tambahDokumen').on( 'click', function () {
            table.row.add( [
                counter +'.1',
                'Adian',
                'Latifa',
                counter +'.4',
                counter +'.5'
            ] ).draw( false );
     
            counter++;
        } );
        $('#tambahDokumen').click();
    } );
    </script>
</body>

</html>