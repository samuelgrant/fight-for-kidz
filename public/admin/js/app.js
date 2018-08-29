$(document).ready(function(){
    $('.nav-tabs').click(function(event){

        var newURLString = window.location.pathname + "?tab=" + event.target.id;

        window.location.href = newURLString;
    })
})