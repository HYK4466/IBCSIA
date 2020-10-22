cookieInfoArr = document.cookie.split(";");

console.log(cookieInfoArr);

for (i = 0; i < cookieInfoArr.length; i++) {
  cookieAssocArray = cookieInfoArr[i].split("=");
  name = cookieAssocArray[0];
  value = cookieAssocArray[1];

  console.log(name);
  console.log(value);
  switch (name) {
    case "sport":
      document.getElementById("sporttype").value = value;
      break;
    case " date":
      document.getElementById("date").value = value;
      break;
    case " sTime":
      document.getElementById("starttime").value = value;
      break;
    case " stTime":
      document.getElementById("stoptime").value = value;
      break;
    default:
      break;
  }
}
