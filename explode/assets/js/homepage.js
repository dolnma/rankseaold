document.addEventListener("DOMContentLoaded", function(event) {
    console.log("DOM fully loaded and parsed");
    Scollanimate();
});


function Scollanimate(){
    var children = document.getElementsByClassName("maps")[0].childNodes;
    children.forEach(function(item){
        item.addEventListener("click",function(){
            var front= item.getAttribute("src").substring(19, 50).slice(0,-4);
            window.location = "http://localhost:8080/" + front;
        });

        });

    var container = $('body');
    var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);

    console.log(w,h);

    switch (getParameterByName("scroll")){
        case "maps":
            var scrollTo = $('#maps');
            //$(container).scrollTop(0);
            container.animate({
                // scrollTop: scrollTo.position().top - container.position().top + container.scrollTop() - 75
                scrollTop: scrollTo.position().top - 75
            });
            break;
        case "contact":
            var scrollTo = $('#contact');
            //$(container).scrollTop(0);
            container.animate({
                // scrollTop: scrollTo.position().top - container.position().top + container.scrollTop() - 75
                scrollTop: scrollTo.position().top - 75
            });
            break;
    }


    //ADD MOBILE DISABLED HERE TO PREVENT PROBLEMS.

    document.getElementsByClassName("navigation")[0].getElementsByTagName("li")[0].addEventListener("click",function(){
        var scrollTo = $('#home');
        //$(container).scrollTop(0);
        container.animate({
            // scrollTop: scrollTo.position().top - container.position().top + container.scrollTop() - 75
            scrollTop: scrollTo.position().top - 75
        });

    });

    document.getElementsByClassName("navigation")[0].getElementsByTagName("li")[1].addEventListener("click",function(){
        var scrollTo = $('#maps');
       //$(container).scrollTop(0);
        container.animate({
           // scrollTop: scrollTo.position().top - container.position().top + container.scrollTop() - 75
            scrollTop: scrollTo.position().top - 75
        });

    });

    document.getElementsByClassName("navigation")[0].getElementsByTagName("li")[2].addEventListener("click",function(){
        var scrollTo = $('#contact');
        //$(container).scrollTop(0);
        container.animate({
            // scrollTop: scrollTo.position().top - container.position().top + container.scrollTop() - 75
            scrollTop: scrollTo.position().top - 75
        });

    });
}


function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}