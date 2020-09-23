function getEvent() {
  var xhttp;
   xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       console.log(xhttp.responseText);
     }
   };
   xhttp.open("GET", "includes/getCalEv.inc.php", true);
   xhttp.send();

}
