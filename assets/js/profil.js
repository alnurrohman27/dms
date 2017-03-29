$(document).ready(function (e) {
    $("#inputProfil").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url: "../beranda/ubah_profil",
            type: "POST",
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
                    alert(data);
                }
            }         
       });
    }));

});