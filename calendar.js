var xhttp2;
var goals;
xhttp2 = new XMLHttpRequest();
xhttp2.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.getElementById('goal').style.textAlign = 'center';
    document.getElementById('goal').innerHTML = "Monthly Goal: " + this.responseText;
 }
};
xhttp2.open("GET", "includes/getGoals.inc.php", true);
xhttp2.send();


var xhttp;
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
              document.getElementById('goal').style.textAlign = 'right';
              document.getElementById('goal').style.marginRight = '140px';

              calendar.render();
              // get data print data: Sports, Day, Start Time, Stop Time, Edit/delete;
              $.getJSON("getevent.json", function(data) {
                  for (i = 0; i < data.length; i++) {
                    if (data[i].start == info.event.startStr) {
                      checkboxstring = "Not Done";
                      detailedInfo =  "Sport: " + data[i].title + "<br>" + "Date: " + data[i].start + "<br>" + "Start Time: " + data[i].sTime + "<br>" + "Stop Time: " + data[i].stTime + "<br>";
                      if (data[i].checkbox == 1) {
                        checkboxstring = "Done";
                      }
                      document.getElementById('details').innerHTML = detailedInfo + "Done: " + checkboxstring + "<br>";
                      document.getElementById('details').innerHTML += "<form class='edit' action='edit.php' method='post'>  <button type='submit' class='btn' name='add'>Edit/Delete</button> </form>";
                      createCookie("sport", data[i].title);
                      createCookie("date", data[i].start);
                      createCookie("sTime", data[i].sTime);
                      createCookie("stTime", data[i].stTime);
                      createCookie("checkbox", data[i].checkbox);
                    }
                  }
              });
          }
        });
        calendar.render();
}

function createCookie(name, value) {
  document.cookie = name + "=" + value +";";
}
