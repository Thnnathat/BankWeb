//logout confirm.
let logout = () => confirm("Do you want to logout?");

function showResult(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (str.length == 0) {
      document.getElementById("table-container").innerHTML = this.responseText;
    } else {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("table-container").innerHTML = ""; //clear dom เดิมก่อนเพิ่มอันใหม่
        document.getElementById("table-container").innerHTML =
          this.responseText;
      }
    }
  };
  xmlhttp.open("GET", "../src/livesearch.php?q=" + str, true);
  xmlhttp.send();
}

function withdraw_check() {
  return confirm("Do you want transfer?");
}
