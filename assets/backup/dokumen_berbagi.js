$(document).ready(function() {
        editor = new $.fn.dataTable.Editor( {
            "ajax": "../datatable/berbagi_dokumen",
            "table": "#dokumenberbagi",
            "fields": [ {
                    "label": "Nomor Dokumen:",
                    "name": "berbagi.id_berkas",
                    "type": "select",
                    "placeholder": "Nomor Berkas"
                }, {
                    "label": "Tujuan:",
                    "name": "berbagi.tujuan",
                    "type": "select",
                    "placeholder": "Ditujukan"
                },  {
                    "label": "berbagi",
                    "name": "berbagi.status",
                    "type": "hidden",
                    "def": "Belum disetujui"
                }

            ],
            i18n: {
                create: {
                    button: "Buat",
                    title:  "Tambah Dokumen",
                    submit: "Buat"
                },
                edit: {
                    button: "Ubah",
                    title:  "Ubah Dokumen",
                    submit: "Ubah"
                },
                remove: {
                    button: "Hapus",
                    title:  "Hapus Dokumen",
                    submit: "Hapus",
                    confirm: {
                        _: "Apakah anda yakin akan menghapus %d dokumen ini?",
                        1: "Apakah anda yakin akan menghapus 1 dokumen ini?"
                    }
                },
                error: {
                    system: "Sistem eror. Silahkan menghubungi admin."
                },
                datetime: {
                    previous: 'Sebelumnya',
                    next:     'Selanjutnya',
                    months:   [ 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember' ],
                    weekdays: [ 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ]
                }
            }
        } );

        $('#dokumenberbagi').on( 'click', 'a.remove', function (e) {
            editor
                .title( 'Hapus Dokumen' )
                .message( 'Apakah anda yakin akan menghapus dokumen ini?' )
                .buttons( { "label": "Hapus", "fn": function () { editor.submit() } } )
                .remove( $(this).closest('tr') );
        } );

        $('#dokumenberbagi').on( 'click', 'a.setuju', function (e, dt, node, config) {
            editor
                .title( 'Menyetujui Dokumen' )
                .buttons( { "label": "Setuju", "fn": function () { editor.submit() } } )
                .edit( table_dokumen_berbagi.row( { selected: true } ).index(), false )
                .set( 'berbagi.status', 'Setuju' )
                .submit();
        } );

        $('#dokumenberbagi').on( 'click', 'a.kembalikan', function (e, dt, node, config) {
            editor
                .title( 'Mengembalikan' )
                .buttons( { "label": "Kembalikan", "fn": function () { editor.submit() } } )
                .edit( table_dokumen_berbagi.row( { selected: true } ).index(), false )
                .set( 'berbagi.status', 'Kembalikan' )
                .submit();
        } );
     
        table_dokumen_berbagi = $('#dokumenberbagi').DataTable( {
            dom: "Bfrtip",
            ajax: {
                url: "../datatable/berbagi_dokumen",
                type: "POST"
            },
            "language": {
                "url"           : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json"
            },
            serverSide: true,
            columns: [

                { data: "berkas.nomor_berkas" },
                { data: "berkas.nama_berkas" },
                { data: "user.nama" },
                { data: "berkas.no_revisi" },
                { data: "berkas.tanggal_rilis" },
                {
                    data: null,
                    "render": function ( data, type, full, row ) {
                        //if( data['berbagi']['tujuan'] != data['logon']['username'] ){
                            return '<a href="#" class="remove" style="color: black;"><button>Hapus</button></a>';
                    },
                    "bSearchable": false
                }
            ],
            select: true,
            buttons: [
                { text: 'Tambah', extend: "create",   editor: editor },
                { text: 'Refresh', action: function ( e, dt, node, config ) { dt.ajax.reload();}}
            ],
            "createdRow": function( row, data, dataIndex ) {
                if ( data['berbagi']['status']=="Belum disetujui" ) { 
                    $('td', row).eq(5).addClass('yellow');       
                    
                }
                else if( data['berbagi']['status']=="Kembalikan" ) {
                    $('td', row).eq(5).addClass('red');
                }
                else{
                    $('td', row).eq(5).addClass('green');   
                }
               
            }

        } );
    } );