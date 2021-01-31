var xhttp;
 xhttp = new XMLHttpRequest();
 xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {

  }
 };
 xhttp.open("GET", "includes/editSportList.inc.php", true);
 xhttp.send();
