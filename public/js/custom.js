function showexperience(){
    document.getElementById('exeperience').style.display ='block';
  }
function hideExperience(){
    document.getElementById('exeperience').style.display ='none';
}  
  function showcriminal(){
    document.getElementById('criminal').style.display = 'block';
  }
  function hidecriminal(){
    document.getElementById('criminal').style.display ='none';
}  

// Closes the session flash generated by a new subscriber after 2 seconds
$("document").ready(function(){
  setTimeout(function(){
    $("div.alert").remove();
  }, 5000 ); // 5 secs
});
$("document").ready(function(){
  $('.your-class').slick({
    speed: 4000,
    autoplay: true,
    autoplaySpeed: 0,
    cssEase: 'linear',
    slidesToShow: 1,
    slidesToScroll: 1,
    variableWidth: true,
    arrows: false
  });
});
