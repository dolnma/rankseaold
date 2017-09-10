   showSmoke();
    var type = "fire";
    function smokeCount(){
   type = "smoke";
}
    function fireCount(){
   type = "fire";
}
    function nadesCount() {
    var s = document.getElementsByName(type).length;	
    return s;
    }
    function nadesWrite() {
    var n = nadesCount();
    return n;
    }
document.getElementById("nadescount").innerHTML = nadesWrite();