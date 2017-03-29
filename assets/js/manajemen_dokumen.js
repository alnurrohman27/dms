//Select2 Dropdown with Search Box
$(".kategori_dokumen").select2({})
$(".kode_context").select2({})
$(".prosedur_dokumen").select2({})
$(".lokasi").select2({})
$(".halaman").select2({placeholder:"Pilih Halaman", allowClear: true})

function kirimKategori(){
    /* Mengambil nilai yang terdapat pada input text dengan id text */
    var text = document.getElementById("kategori_dokumen").value;
    if(text == "SP"){
        console.log(text);
        document.getElementById("context_diagram").style.display = '';
        document.getElementById("kode_context").required = true;
        document.getElementById("prosedur_dokumen").style.display = '';
        document.getElementById("nn").required = true;
        document.getElementById("judul_dokumen").style.display = 'none';
        document.getElementById("nd").required = false;
        document.getElementById("lokasi").style.display = 'none';
        document.getElementById("ll").required = false;
        document.getElementById("no_urut").style.display = 'none';
        document.getElementById("dd").required = false;
    }
    else if(text == "WI" || text == "SOP"){
        console.log(text);
        document.getElementById("context_diagram").style.display = '';
        document.getElementById("kode_context").required = true;
        document.getElementById("prosedur_dokumen").style.display = '';
        document.getElementById("nn").required = true;
        document.getElementById("judul_dokumen").style.display = '';
        document.getElementById("nd").required = true;
        document.getElementById("lokasi").style.display = '';
        document.getElementById("ll").required = true;
        document.getElementById("no_urut").style.display = 'none';
        document.getElementById("dd").required = false;
    }
    else if(text == "SD"){
        console.log(text);
        document.getElementById("context_diagram").style.display = '';
        document.getElementById("kode_context").required = true;
        document.getElementById("prosedur_dokumen").style.display = '';
        document.getElementById("nn").required = true;
        document.getElementById("judul_dokumen").style.display = '';
        document.getElementById("nd").required = true;
        document.getElementById("lokasi").style.display = '';
        document.getElementById("ll").required = true;
        document.getElementById("no_urut").style.display = '';
        document.getElementById("dd").required = true;
    }
    else{
        console.log(text);
        document.getElementById("context_diagram").style.display = 'none';
        document.getElementById("kode_context").required = false;
        document.getElementById("prosedur_dokumen").style.display = 'none';
        document.getElementById("nn").required = false;
        document.getElementById("judul_dokumen").style.display = 'none';
        document.getElementById("nd").required = false;
        document.getElementById("lokasi").style.display = 'none';
        document.getElementById("ll").required = false;
        document.getElementById("no_urut").style.display = 'none';
        document.getElementById("dd").required = false;
    }
}

var editor; // use a global for the submit and return data rendering in the examples
var table_manajemen_dokumen;
//Insert Dokumen Ajax

$(document).ready(function (e) {
    $("#inputDocument").on('submit',(function(e) {
        e.preventDefault();
        document.getElementById("upload_progress").style.width = "0%";
        document.getElementById("progress").style.display = "";
        $.ajax({
            url: "../dokumen/insertDokumen",
            type: "POST",
            xhr: function() {
                var xhr = $.ajaxSettings.xhr();
                xhr.upload.onprogress = function(e) {
                    var percent = Math.floor(e.loaded / e.total *100) + '%';
                    console.log(percent);
                    document.getElementById("upload_progress").style.width = percent;
                    $("#upload_progress").html(percent); 

                };
                return xhr;
            },
            data:  new FormData(this),
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                if(data != "Data berhasil dimasukkan"){
                    alert(data);
                }
                else{
                    $("#kategori_dokumen").val(null).trigger("change"); 
                    $("#kode_context").val(null).trigger("change");
                    $("#nn").val(null).trigger("change"); 
                    $("#nd").val(null).trigger("change");
                    $("#ll").val(null).trigger("change"); 
                    $("#dd").val(null).trigger("change"); 
                    alert(data);
                    document.getElementById("inputDocument").reset();  
                    table_manajemen_dokumen.ajax.reload();
                }
                setTimeout(function(){ document.getElementById("progress").style.display = "none"; }, 500);
                
            }         
       });
    }));
    $("#inputRevisi").submit(function(e) {
        e.preventDefault();
        document.getElementById("revisi_progress").style.width = "0%";
        document.getElementById("revisi_p").style.display = "";
        $.ajax({
            url: "../dokumen/setRevisi",
            type: "POST",
            xhr: function() {
                var xhr = $.ajaxSettings.xhr();
                xhr.upload.onprogress = function(e) {
                    var percent = Math.floor(e.loaded / e.total *100) + '%';
                    console.log(percent);
                    document.getElementById("revisi_progress").style.width = percent;
                    $("#revisi_progress").html(percent); 

                };
                return xhr;
            },
            data:  new FormData(this),
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                if(data != "Revisi berhasil dimasukkan"){
                    alert(data);
                    setTimeout(function(){ document.getElementById("revisi_p").style.display = "none"; }, 500);
                }
                else{
                    $("#file_revisi").val(null).trigger("change"); 
                    alert(data);
                    table_manajemen_dokumen.ajax.reload();
                    setTimeout(function(){ document.getElementById("revisi_p").style.display = "none"; document.getElementById("btn_close").click(); }, 500);
                }

                
            }         
       });
    });

    $("#inputEdisi").submit(function(e) {
        e.preventDefault();
        document.getElementById("edisi_progress").style.width = "0%";
        document.getElementById("edisi_p").style.display = "";
        $.ajax({
            url: "../dokumen/setEdisi",
            type: "POST",
            xhr: function() {
                var xhr = $.ajaxSettings.xhr();
                xhr.upload.onprogress = function(e) {
                    var percent = Math.floor(e.loaded / e.total *100) + '%';
                    console.log(percent);
                    document.getElementById("edisi_progress").style.width = percent;
                    $("#edisi_progress").html(percent); 

                };
                return xhr;
            },
            data:  new FormData(this),
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                if(data != "Edisi berhasil dimasukkan"){
                    alert(data);
                    setTimeout(function(){ document.getElementById("edisi_p").style.display = "none"; }, 1500);
                }
                else{
                    $("#file_edisi").val(null).trigger("change"); 
                    alert(data);
                    table_manajemen_dokumen.ajax.reload();
                    setTimeout(function(){ document.getElementById("edisi_p").style.display = "none"; document.getElementById("btn_close").click(); }, 500);
                }

                
            }         
       });
    });
});



function revisi_ajax() {
    if(window.XMLHttpRequest) {
        return new XMLHttpRequest();
    }
 
    if(window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
 
    return null;
}

function revisi(text){
    console.log(text);
    /* Mengirim nilai ke proses.php dengan metode get */
    /* Dan memeriksa hasil nilai balik pada fungsi prosesKirim */
    myAjax = revisi_ajax();
    myAjax.onreadystatechange = tampilkan_revisi;
    myAjax.open("GET", "../beranda/update_document/?id="+text, true);
    myAjax.send(null);

}

function tampilkan_revisi() {
    if(myAjax.readyState == 4) {
        //document.innerHTML(myAjax.responseText);
        document.getElementById("id_edisi").value = myAjax.responseText;
        //$("#inputRevisi").html(myAjax.responseText);
        document.getElementById("myBtn_revisi").click();   
    }
}

function edisi(text){
    console.log(text);
    /* Mengirim nilai ke proses.php dengan metode get */
    /* Dan memeriksa hasil nilai balik pada fungsi prosesKirim */
    myAjax = revisi_ajax();
    myAjax.onreadystatechange = tampilkan_edisi;
    myAjax.open("GET", "../beranda/update_edition/?id="+text, true);
    myAjax.send(null);

}

function tampilkan_edisi() {
    if(myAjax.readyState == 4) {
        //document.innerHTML(myAjax.responseText);
        $("#div_keterangan").html(myAjax.responseText);
        //$("#inputRevisi").html(myAjax.responseText);
        document.getElementById("myBtn_edisi").click();   
    }
}

$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax: "../datatable/manajemen_dokumen",
        table: "#dokumenmasuk",
    } );

    $('#dokumenmasuk').on( 'click', 'a.hapus', function (e) {
        editor
            .title( 'Hapus Dokumen' )
            .message( 'Apakah anda yakin akan menghapus dokumen ini?' )
            .buttons( { "label": "Hapus", "fn": function () { editor.submit() } } )
            .remove( $(this).closest('tr') );
    } );
    
    table_manajemen_dokumen = $('#dokumenmasuk').DataTable( {
        dom: "Bfrtip",
        ajax: {
            url: "../dokumen/manajemen_dokumen",
            type: "POST"
        },
        "language": {
            "url"           : "../assets/js/indonesian.json"
        },
        // serverSide: true,
        columns: [
            { data: "dokumen.nomor_dokumen" },
            { data: "dokumen.nama_dokumen" },
            { "width": "10%", data: "edisi.no_edisi" },
            { "width": "10%", data: "revisi.no_revisi" },
            { data: "revisi.tanggal_rilis" },
            {
                data: null,
                "render": function ( data, type, full, row ) {
                    var path = '<button style="color: black;" onclick="edisi('+data["dokumen"]["id_dokumen"]+')">Edisi</button>&nbsp;<button style="color: black;" onclick="revisi('+data["edisi"]["id_edisi"]+')">Revisi</button>&nbsp;<a href="#" class="hapus" style="color: black;"><button>Hapus</button></a>';
                    return path;
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