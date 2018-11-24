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

$(document).ready(function () {
  $('.bio-view-button').on('click', function (e) {

    var url = '/contenders/bio/' + $(this).attr('data-contenderId');

    $.ajax({
      url: url,
      method: 'get',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      dataType: 'json'
    }).done(function (data) {
      //Calls the setBioImageBorder Method
      setBioImageBorder(data);

      $('#first-name').text(data['contender']['first_name']);
      $('#last-name').text(data['contender']['last_name']);

      // show nickname if one is set
      if (data['contender']['nickname'] != null) {
        $('#nickname').text('\'' + data['contender']['nickname'] + '\'');
      }

      // get video id from donate_url
      if (data['contender']['bio_url'] != null) {
        vidId = getQueryVariable(data['contender']['bio_url'], 'v')
        $('#bio-vid').removeClass('d-none');
        $('#bio-vid').attr('src', 'https://www.youtube-nocookie.com/embed/' + vidId + '?rel=0&modestbranding=1');
      } else {
        $('#bio-vid').addClass('d-none');
      }

      if(data['contender']['bio_text'] != null){
        $("#bio-label").text("About Me:")
      }
      $('#bio-text').text(data['contender']['bio_text']);

      //checks to see if the image exists and uses it to set the auctionItemImage otherwise sets it to default
      $.get('/storage/images/contenders/' + data['contender']['id'] + '.png')
      .done(function(){
          $("#bio-image").attr('src', '/storage/images/contenders/' + data['contender']['id'] + '.png');
      }).fail(function(){
          $("#bio-image").attr("src", "/storage/images/contenders/0.png");
      }) 

      $('#contenderAge').html(data['age']);
      $('#contenderHeight').html(data['contender']['height']);
      $('#contenderWeight').html(data['contender']['weight']);
      $('#contenderReach').html(data['contender']['reach']);
    }).fail(function (err) {
      $('#dynamic-content').html('<p style="color:black;">Something went wrong. Please try again...</p>');
    });
  });

  $("#bio-modal").on('hidden.bs.modal', function (e) {
    $("#bio-modal iframe").attr("src", "");
  });

});

function setBioImageBorder(data){
  if(data['contender']['team'] == 'red'){
    $("#bio-image").css({"border" : "4px solid red"});
  }else if (data['contender']['team'] == 'blue'){
    $("#bio-image").css({"border" : "4px solid blue"});
  }
}


function auctionItemModal(id){
  $.ajax({
      method: "get",
      headers:  {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: `/a/auction-management/auction/${id}`
  }).done((data) => {
      //Dynamically populate the modal with item info
      $("#auctionItemName").text(data.name);
      $("#auctionItemDescription").text(data.desc);

      //Table text
      if (data.donor != null || data.donor_url != null){
        $("#auctionItemInfo").text("Item Info:")
      }
      if(data.donor != null){
        $("#auctionItemDonorSpan").text(data.donor);
      } else if(data.donor == null){
        $("#auctionTableDonor").remove();
      }

      if(data.donor_url != null){
        $("#auctionItemDonorUrlSpan").text(data.donor_url);
      } else if(data.donor_url == null){
        $("#auctionTableDonorUrl").remove();
      }

      //checks to see if the image exists and uses it to set the auctionItemImage otherwise sets it to default
      $.get("/storage/images/auction/" + data.id + ".png")
      .done(function(){
          $("#auctionItemImage").attr("src", "/storage/images/auction/" + data.id + ".png");
      }).fail(function(){
          $("#auctionItemImage").attr("src", "/storage/images/noImage.png");
      })         

      //Display the modal
      $("#auctionItemModal").modal('show');
  }).fail(function(error) {
      console.log(error);
  });
}

$(document).ready(function(){

  var vh = $(window).height();
  var footerPos = $('#f4k-footer').position()['top'];

  if(vh > footerPos){
    $('#f4k-footer').css('position', 'absolute');
    $('#f4k-footer').css('bottom', '0');
    $('#f4k-footer').css('width', '100%');
  }

})