var xhttp;
 xhttp = new XMLHttpRequest();
 xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {

  }
 };
 xhttp.open("GET", "includes/editSportList.inc.php", true);
 xhttp.send();
 
$.getJSON("sportlist.json", function(data) {
    for(i = 0; i < data.length; i++) {
      document.getElementById('information').innerHTML += "<tr> <td>" + data[i].sport + "</td> </tr>";
    }
});
