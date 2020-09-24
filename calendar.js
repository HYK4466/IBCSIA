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


document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',

          events: {
            url: "getevent.json",
            method: "POST",
            extraParams: {
              custom_param1: function() {
                getEvent();
              }
            },
            failure: function() {
              console.log("Error getting event data");
            },
            color: "green",
            textColor: "black"
          },

          eventClick: function(info) {
            alert("isclicked");
          }
        });
        calendar.render();
      });
