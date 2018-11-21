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

$("document").ready(function(){
  $('.slick-sponsors').slick({
    speed: 10000,
    autoplay: true,
    autoplaySpeed: 0,
    cssEase: 'linear',
    slidesToShow: 1,
    slidesToScroll: 1,
    variableWidth: true,
    arrows: false,
    draggable: false,
    pauseOnHover: false,
    touchMove: false
  });
});

/* Facebook */
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

/* Smooth Scroll */
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top - 100
      }, 800, function(){
  
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});


// returns URL query string with the given name - used with contender bio videos
function getQueryVariable(url, variable)
{   
      var query = url.split("?")[1];
      
      var vars = query.split("&");
      for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if(pair[0] == variable){return pair[1];}
      }
      return(false);
}

function auctionItemModal(id){
  $.ajax({
      method: "get",
      headers:  {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: `/a/auction-management/auction/${id}`
<<<<<<< HEAD
  }).done((data) => {
=======
  }).done(function(data)  {
>>>>>>> feature-auction-management
      //Dynamically populate the modal with item info
      $("#auctionItemName").val(data.name);
      $("#auctionItemDescription").val(data.desc);
      $("#auctionItemDonor").val(data.donor);
      $("#auctionItemDonorUrl").val(data.donor_url);
      $("#auctionItemImage").attr("src", "/storage/images/auction/" + data.id + ".png");        

      //Display the modal
      $("#auctionItemModal").modal('show');
  }).fail(function(error) {
      console.log(error);
  });
}