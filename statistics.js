var xhttp;
 xhttp = new XMLHttpRequest();
 xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
     document.getElementById('information').innerHTML = this.responseText;

   }
 };
 xhttp.open("GET", "includes/sortTable.inc.php", true);
 xhttp.send();
