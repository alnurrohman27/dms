// Get the modal
var modal_revisi = document.getElementById('myModal_revisi');
var modal_edisi = document.getElementById('myModal_edisi');

// Get the button that opens the modal
var btn_revisi = document.getElementById("myBtn_revisi");
var btn_edisi = document.getElementById('myBtn_edisi');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn_revisi.onclick = function() {
    modal_revisi.style.display = "block";
}

btn_edisi.onclick = function() {
    modal_edisi.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal_revisi.style.display = "none";
}

document.getElementById("btn_edisi_close").onclick = function() {
    modal_edisi.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal_revisi) {
        modal_revisi.style.display = "none";
    }
    else if (event.target == modal_edisi){
    	modal_edisi.style.display = "none";
    }
}