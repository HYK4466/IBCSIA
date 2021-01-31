sessionStorage.clear();

var xhttp2;
var goals;
xhttp2 = new XMLHttpRequest();
xhttp2.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.getElementById('goal').style.textAlign = 'center';
    //document.getElementById('goal').innerHTML = "Monthly Goal: " + this.responseText;
 }
};
xhttp2.open("GET", "includes/getGoals.inc.php", true);
xhttp2.send();


var xhttp3;
xhttp3 = new XMLHttpRequest();
xhttp3.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    run();
  }
};
xhttp3.open("GET", "includes/getCalEv.inc.php", true);
xhttp3.send();


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
              document.getElementById('tdetails').style.marginLeft = '65%';
              document.getElementById('tdetails').style.marginTop = '50px';
              document.getElementById('tdetails').style.width = "500px";
              document.getElementById('details').style.marginRight = '20%';

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
                      document.getElementById('tdetails').innerHTML = "<tbody> <tr> <th scope='row'> Sports </th> <td>" + data[i].title + " </td> </tr> <tr> <th scope='row'> Date </th> <td>" + data[i].start + "</td> </tr> <tr> <th> Start Time </th> <td>" + data[i].sTime + "</td> </tr> <tr> <th> Stop Time </th> <td>" + data[i].stTime + " </td> </tr> <tr> <th> Done </th> <td>" + checkboxstring + "</tr> </tbody>"
                      document.getElementById('details').innerHTML = "<form class='edit' action='edit.php' method='post'>  <button type='submit' class='btn btn-primary' name='add'>Edit/Delete</button> </form>";
                      sessionStorage.setItem("sport", data[i].title);
                      sessionStorage.setItem("date", data[i].start);
                      sessionStorage.setItem("sTime", data[i].sTime);
                      sessionStorage.setItem("stTime", data[i].stTime);
                      sessionStorage.setItem("checkbox", data[i].checkbox);
                    }
                  }
              });
          }
        });
        calendar.render();
}
