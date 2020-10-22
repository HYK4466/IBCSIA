
$.getJSON("getevent.json", function(data) {

  for(i = 0; i < data.length; i++) {
    document.getElementById('datedropdown').innerHTML += "<option value=" + data[i].start + ">";

  }});
