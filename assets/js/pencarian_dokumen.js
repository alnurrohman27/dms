var table_komentar;
function pencarian_ajax() {
    if(window.XMLHttpRequest) {
        return new XMLHttpRequest();
    }
 
    if(window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
 
    return null;
}

function setPath(url, id) {
    myAjax = pencarian_ajax();
    myAjax.onreadystatechange = tampil;
    //console.log("Okaay");
    myAjax.open("GET", "setKomentar/?doc="+url+"&id="+id, true);
    myAjax.send(null);
}

function tampil() {
    if(myAjax.readyState == 4) {
        //document.innerHTML(myAjax.responseText);
        $("#tampil").html(myAjax.responseText);
        daftar_dokumen();
        document.getElementById("myBtn").click();   
    }
}

function inputKomentar() {
    var id = document.getElementById("id_file").value;
    var komentar = document.getElementById("komentar").value;
    okay_ajax = pencarian_ajax();
    okay_ajax.onreadystatechange = setKomentar;
    okay_ajax.open("GET", "../dokumen/setKomentar/?id="+id+"&komentar="+komentar, true);
    okay_ajax.send(null);
};

function setKomentar() {
    if(okay_ajax.readyState == 4) {
        var object = JSON.parse(okay_ajax.responseText);
        table_komentar.row.add( [object.nama,object.jabatan,object.komentar,object.tanggal] ).draw();
    }
}

$(document).ready(function() {
    var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
       "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
    var d = new Date();
    var day = d.getDate();
    var month = monthNames[d.getMonth()];
    var year = d.getFullYear();
        
    var tanggal = day+' '+month+' '+year;
    $('#pencarian').DataTable({
        dom: 'Bfrtip',
        "aoColumnDefs": [
          { "bSortable": false, "aTargets": [ 7 ] },
          { "bSearchable ": false, "aTargets": [ 7 ] }
        ],
        buttons: [ 
            {
                extend: 'copyHtml5',
                title:  'Daftar Dokumen',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }  
            },
            {
                extend: 'excelHtml5',
                title:  'Daftar Dokumen',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }   
            },
            {
                extend: 'csvHtml5',
                title:  'Daftar Dokumen',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }   
            },
            {
                extend: 'pdfHtml5',
                title:  'Daftar Dokumen',
                download: 'open',
                message: function(){
                    return 'List dokumen terbaru tanggal '+tanggal;
                },
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }  
            }
        ],
    	"language": {
            "url"           : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json"
        }
    });  
    $('#rekaman').DataTable({
        dom: 'Bfrtip',
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 7 ] },
            { "bSearchable ": false, "aTargets": [ 7 ] }
        ],
        buttons: [ 
            {
                extend: 'copyHtml5',
                title:  'Rekaman Dokumen',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }   
            },
            {
                extend: 'excelHtml5',
                title:  'Rekaman Dokumen',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }   
            },
            {
                extend: 'csvHtml5',
                title:  'Rekaman Dokumen',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }   
            },
            {
                extend: 'pdfHtml5',
                title:  'Rekaman Dokumen',
                download: 'open',
                message: function(){
                    return 'List rekaman dokumen tanggal '+tanggal;
                },
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }   
            }
        ],
    	"language": {
            "url"           : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json"
        }
    });
} );


function daftar_dokumen(){
    table_komentar = $('#daftar_komentar').DataTable({
        dom: 'rtip',
        "language": {
            "url"           : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json"
        },
        "order": [[ 3, "desc" ]]
    });        
}
