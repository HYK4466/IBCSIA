

var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

$.getJSON("sportlist.json", function(data) {
  console.log(data);
  for(i = 0; i < data.sports.length; i++) {
    document.getElementById('sports').innerHTML += "<option value=" + data.sports[i] + ">";
  }

  for (i = 0; i < data.workout.length; i++) {
    document.getElementById('sports').innerHTML += "<option value=" + data.workout[i] + ">";
  }
});
