
function autofill() {
  var xhttp;
   xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       document.getElementById('exInputs').innerHTML = this.responseText;
     }
   };
   xhttp.open("GET", "includes/getFrequent.inc.php", true);
   xhttp.send();

}
