$(".nomor_dokumen").select2({placeholder:"Pilih Dokumen"});
$(".tujuan").select2({placeholder:"Pilih Departemen Tujuan", allowClear: true})

function berbagi_ajax() {
    if(window.XMLHttpRequest) {
        return new XMLHttpRequest();
    }
 
    if(window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
 
    return null;
}

function getDestination(){
    var text = document.getElementById("no_dokumen").value;
    if(text > 0){
        console.log(text);
        /* Mengirim nilai ke proses.php dengan metode get */
        /* Dan memeriksa hasil nilai balik pada fungsi prosesKirim */
        myAjax = berbagi_ajax();
        myAjax.onreadystatechange = setDestination;
        myAjax.open("GET", "../select2/getDestination/?id="+text, true);
        myAjax.send(null);
    }
    else
    {
        $("#tujuan").html('<option value="" selected="selected">Pilih Departemen Tujuan</option>');
    }

}

function setDestination(){
    if(myAjax.readyState == 4) {
        //document.innerHTML(myAjax.responseText);
        $("#tujuan").html(myAjax.responseText);
    }
}


$(document).ready(function (e) {
    $("#inputBerbagi").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url: "../dokumen/berbagiDokumen",
            type: "POST",
            data:  new FormData(this),
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                if(data != "Dokumen berhasil dibagikan"){
                    alert(data);
                }
                else{
                    alert(data);
                    table_dokumen_berbagi.ajax.reload();  
                }
                $("#no_dokumen").val(null).trigger("change"); 
                $("#tujuan").val(null).trigger("change"); 
            }         
       });
    }));
});

$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        "ajax": "../datatable/berbagi_dokumen",
        "table": "#dokumenberbagi"
    } );

    $('#dokumenberbagi').on( 'click', 'a.remove', function (e) {
        editor
            .title( 'Hapus Dokumen' )
            .message( 'Apakah anda yakin akan menghapus dokumen ini?' )
            .buttons( { "label": "Hapus", "fn": function () { editor.submit() } } )
            .remove( $(this).closest('tr') );
    } );

    table_dokumen_berbagi = $('#dokumenberbagi').DataTable( {
        dom: "Bfrtip",
        ajax: {
            url: "../datatable/berbagi_dokumen",
            type: "POST"
        },
        "language": {
            "url"           : "../assets/js/indonesian.json"
            // select: {
            //     rows: {
            //         _: "%d dokumen dipilih",
            //         0: "Klik dokumen untuk memilih"
            //     }
            // }
        },
        serverSide: true,
        columns: [
            { data: "dokumen.nomor_dokumen" },
            { data: "dokumen.nama_dokumen" },
            { "width": "20%", data: "jabatan.nama_jabatan" },
            {
                data: null,
                "render": function ( data, type, full, row ) {
                    //if( data['berbagi']['tujuan'] != data['logon']['username'] ){
                        return '<a href="#" class="remove" style="color: black;"><button>Hapus</button></a>';
                },
                "bSearchable": false,
                "bSortable": false
            }
        ],
        buttons: [
            { text: 'Refresh', action: function ( e, dt, node, config ) { dt.ajax.reload();}}
        ]

    } );
} );