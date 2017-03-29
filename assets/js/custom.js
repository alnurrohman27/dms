var editor; // use a global for the submit and return data rendering in the examples
 
$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        "ajax": "<?php echo base_url('ajax/dokumen_masuk');?>",
        "table": "#dokumenmasuk",
        "fields": [ {
                "label": "No. Berkas:",
                "name": "no_berkas"
            }, {
                "label": "Nama Berkas:",
                "name": "nama_berkas"
            }, {
                "label": "Pembuat:",
                "name": "pembuat"
            }, {
                "label": "No. Revisi:",
                "name": "no_revisi"
            }, {
		"label": "Status:",
                "name": "status"
	    }
        ]
    } );
 
    $('#dokumenmasuk').DataTable( {
        dom: "Bfrtip",
        ajax: {
            url: "<?php echo base_url('ajax/dokumen_masuk');?>",
            type: "POST"
        },
        serverSide: true,
        columns: [
            { data: "no_berkas" },
            { data: "nama_berkas" },
            { data: "pembuat" },
            { data: "no_revisi" },
            { data: "status" },
        ],
        select: true,
        buttons: [
            { extend: "create", editor: editor },
            { extend: "edit",   editor: editor },
            { extend: "remove", editor: editor }
        ]
    } );
} );