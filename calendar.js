  var xhttp;
  var arr;
   xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       run();
    }
   };
   xhttp.open("GET", "includes/getCalEv.inc.php", true);
   xhttp.send();



document.addEventListener('DOMContentLoaded', function(){});

function run() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',

          events: {
            url: "getevent.json",
            failure: function() {
              console.log("Error getting event data");
            },
            color: "green",
            textColor: "black"
          },

          eventClick: function(info) {
              console.log(info);
              document.getElementById('calendar').style.width = "50%";
              document.getElementById('calendar').style.cssFloat = 'left';
              document.getElementById('details').style.cssFloat = 'right';
              calendar.render();
              // get data print data: Sports, Day, Start Time, Stop Time, Edit/delete;
              $.getJSON("getevent.json", function(data) {
                  for (i = 0; i < data.length; i++) {
                    if (data[i].start == info.event.startStr) {
                      detailedInfo =  "Sport: " + data[i].title + "<br>" + "Start Time: " + data[i].start + "<br>" + "Stop Time: " + data[i].stop + "<br>";
                      document.getElementById('details').innerHTML = detailedInfo;
                    }
                  }
              });
          }
        });
        calendar.render();
}
