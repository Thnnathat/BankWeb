
//logout confirm.
let logout = () => confirm("Do you want to logout?");
let remove = (this_account) => confirm(`Do you want to remove ${this_account} account?`);

function showResult(str) {
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
    if (str.length==0) {
        document.getElementById("table-container").innerHTML=this.responseText;
    } else {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("table-container").innerHTML="";
            document.getElementById("table-container").innerHTML=this.responseText;
        }
        }
    }
    xmlhttp.open("GET","../src/livesearch.php?q="+str,true);
    xmlhttp.send();
}