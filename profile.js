var xhttp2;
var goals;
xhttp2 = new XMLHttpRequest();
xhttp2.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.getElementById('profile').innerHTML = this.responseText;

 }
};
xhttp2.open("GET", "includes/getProfile.inc.php", true);
xhttp2.send();
