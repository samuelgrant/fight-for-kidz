$(document).ready(function(){
    $('.nav-tabs').click(function(event){
        // alert("I am an alert box!"); //Test Purposes
        var newURLString = window.location.pathname + "?tab=" + event.target.id;

        window.location.href = newURLString;
    })
})