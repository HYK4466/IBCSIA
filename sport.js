var spo = [];
var wor = [];

$.getJSON("sportlist.json", function(data) {

  for(i = 0; i < data.sports.length; i++) {
    document.getElementById('search').innerHTML += "<option value=" + data.sports[i] + ">";
    spo[i] = data.sports[i];
  }

  for (i = 0; i < data.workout.length; i++) {
    document.getElementById('search').innerHTML += "<option value=" + data.workout[i] + ">";
    wor[i] = data.workout[i];
  }
});


/*function dropsearch(str) {
  //console.log(str);

  if (str.length == 0) {
    document.getElementById("search").innerHTML = "";
    return;
  }
  else {
    for (i = 0; i < spo.length; i++) {
        if (spo[i].search(str) != -1) {
          console.log(spo[i]);
          document.getElementById('search').innerHTML = "<option value=" + spo[i] + ">";
        }
        else {
          document.getElementById('search').innerHTML = "<option value='No suggestion'>";
        }
    }
  }
}*/
