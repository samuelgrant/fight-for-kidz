function showExperience(){
  document.getElementById('exeperience').style.display ='block';
}
function hideExperience(){
  document.getElementById('exeperience').style.display ='none';
}  
function showCriminal(){
  document.getElementById('criminal').style.display = 'block';
}
function hideCriminal(){
  document.getElementById('criminal').style.display ='none';
}
function showOther(){
  document.getElementById('otherCheck').checked ? document.getElementById('other').style.display = 'block' : document.getElementById('other').style.display = 'none';
}
function showHand(){
  document.getElementById('hand').style.display = 'block';
}
function hideHand(){
  document.getElementById('hand').style.display ='none';
}
function showInjury(){
  document.getElementById('injury').style.display = 'block';
}
function hideInjury(){
  document.getElementById('injury').style.display ='none';
}
function showMeds(){
  document.getElementById('meds').style.display = 'block';
}
function hideMeds(){
  document.getElementById('meds').style.display ='none';
}
function showReason(){
  document.getElementById('reason').style.display = 'block';
}
function hideReason(){
  document.getElementById('reason').style.display ='none';
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

//Application form wizard
$(document).ready(function() {
  $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
  var $total = navigation.find('li').length;
  var $current = index+1;
  var $percent = ($current/$total) * 100;
  $('#rootwizard .progress-bar').css({width:$percent+'%'});
  }});
});

$(document).ready(function() {
  var $validator = $("#application-form").validate({
    rules: {
      //Contact
      first_name: {
        required: true,
        minlength: 3,
        maxlength: 30
      },
      last_name: {
        required: true,
        minlength: 3,
        maxlength: 30
      },
      address_1:{
        required: true,
        minlength: 3,
        maxlength: 191
      },
      address_2:{
        required: false,
        minlength: 3,
        maxlength: 191
      },
      suburb:{
        required: true,
        minlength: 3,
        maxlength: 191
      },
      city:{
        required: true,
        minlength: 3,
        maxlength: 191
      },
      post_code:{
        required: true,
        maxlength: 10,
      },
      email:{
        required: true,
        email: true,
        minlength: 3,
        maxlength: 191
      },
      phone:{
        required: true,
        minlength: 3,
        maxlength: 30
      },
      mobile:{
        required: false,
        minlength: 3,
        maxlength: 30
      },

      //Personal
      dob:{
        required: true,
        date: true
      },
      height:{
        required: true,
        number: true,
        range: [1,300],
      },
      current_weight:{
        required: true,
        number: true,
        range: [1,300],
      },
      expected_weight:{
        required: false,
        number: true,
        range: [1,300],
      },
      occupation:{
        required: true,
        minlength: 3,
        maxlength: 191
      },
      employer:{
        required: false,
        minlength: 3,
        maxlength: 191
      },
      gender:{
        required: true
      },
      hand:{
        required: true
      },
      nickname:{
        required: false,
        minlength: 3,
        maxlength: 191
      },
      sponsorRadio:{
        required: true
      },
      
      //Picture validation to go here

      //Emergency
      emergency_first:{
        required: true,
        minlength: 3,
        maxlength: 30
      },
      emergency_last:{
        required: true,
        minlength: 3,
        maxlength: 30
      },
      emergency_relationship:{
        required: true,
        minlength: 3,
        maxlength: 30
      },
      emergency_email:{
        required: true,
        email: true,
        minlength: 3,
        maxlength: 191
      },
      emergency_phone:{
        required: true,
        minlength: 3,
        maxlength: 30
      },
      emergecy_mobile:{
        required: false,
        minlength: 3,
        maxlength: 191
      },

      //Sporting
      fitness_rating:{
        required: true
      },
      expRadio:{
        required: true
      },
      //Makes fighting experience required if expRadio is yes
      fighting_experience:{
        required: $("#expRadio").val() == "yes"
      },
      sporting_experience:{
        required: true
      },
      hobbies:{
        required: true
      },
      handRadio:{
        required: true
      },
      injuryRadio:{
        required: true
      },
      medsRadio:{
        required: true
      },
      
      //Medical 1
      //Dont need to validate checkboxes
      //Makes other details required if expRadio is yes
      other_details:{
        required: $("#other").val() == "yes"
      },
      
      //Medical 2
      heartRadio:{
        required: true
      },
      activityRadio:{
        required: true
      },
      monthRadio:{
        required: true
      },
      consciousnessRadio:{
        required: true
      },
      boneRadio:{
        required: true
      },
      bloodRadio:{
        required: true
      },
      concussedRadio:{
        required: true
      },
      reasonsRadio:{
        required: true
      },
      reason_details:{
        required: $("#reasonsRadio").val() == "yes"//change this and all others as need to give all yes radios an id and test for checked not val
      },

      //Additional
      //Custom Question Validation to go here

      convictedRadio:{
        required: true
      },
      conviction_details:{
        required: $("#")
      },
      drugRadio:{
        required: true,
      },

      //Submit
      declCheckbox:{
        required: true
      }
    },
    messages: {
      //Contact
      first_name:{
        reequired: "Please enter your firstname",
        minlength: "Your name needs to be greater than 2 characters",
        maxlength: "Your name needs to be less than 31 characters"
      },
      last_name: {
        required: "Please enter your firstname",
        minlength: "Your name needs to be greater than 2 characters",
        maxlength: "Your name needs to be less than 31 characters"
      },
      address_1:{
        required: "Please enter you address",
        minlength: "Your address needs to be greater than 2 charcters",
        maxlength: "The address you entered is too long"
      },
      address_2:{
        minlength: "Your address needs to be greater than 2 charcters",
        maxlength: "The address you entered is too long"
      },
      suburb:{
        required: "Please enter your suburb",
        minlength: "Your suburb needs to be greater than 2 charcters",
        maxlength: "The suburb you entered is too long"
      },
      city:{
        required: "Please enter your city",
        minlength: "Your city needs to be greater than 2 charcters",
        maxlength: "The city you entered is too long"
      },
      post_code:{
        required: "Please enter your post code",
        maxlength: "The post code you entered is too long"
      },
      email:{
        required: "Please enter your email address",
        email: "You must enter an email",
        minlength: "Your email needs to be greater than 2 charcters",
        maxlength: "The email you entered is too long"
      },
      phone:{
        required: "Please enter your phone number",
        minlength: "Your phone number needs to be greater than 2 charcters",
        maxlength: "The phone number you entered is too long"
      },
      mobile:{
        minlength: "Your cell phone number needs to be greater than 2 charcters",
        maxlength: "The cell phone number you entered is too long"
      },

      //Personal
      dob:{
        required: "please enter your birthdate",
      },
      height:{
        required:"Please enter your height",
        number: "Your height must be a number",
        range: "Your height is outside of the accepted range"
      },
      current_weight:{
        required: "Please enter your current weight",
        number: "Your current weight must be a number",
        range: "Your current weight is outside of the accepted range"
      },
      expected_weight:{
        number: "Your expected weight must be a number",
        range: "Your expected weight is outside of the accepted range"
      },
      occupation:{
        required: "Please enter your occupation",
        minlength: "Your occupation needs to be greater than 2 charcters",
        maxlength: "The occupation you entered is too long"
      },
      employer:{
        minlength: "Your employer needs to be greater than 2 charcters",
        maxlength: "The employer you entered is too long"
      },
      gender:{
        required: "Please choose your gender"
      },
      hand:{
        required: "Please choose your dominant hand"
      },
      nickname:{
        minlength: "Your fight name needs to be greater than 2 charcters",
        maxlength: "The fight name you entered is too long"
      },
      sponsorRadio:{
        required: "Are you able to secure your own sponsor?"
      },
      
      //Picture messages to go here

      //Emergency
      emergency_first:{
        required: "Please enter your emergency contact's firstname",
        minlength: "Your emergency contact's firstname needs to be greater than 2 characters",
        maxlength: "Your emergency contact's firstname needs to be less than 31 characters"
      },
      emergency_last:{
        required: "Please enter your emergency contact's last name",
        minlength: "Your emergency contact's lastname needs to be greater than 2 characters",
        maxlength: "Your emergency contact's last name needs to be less than 31 characters"
      },
      emergency_relationship:{
        required: "What is your emergency contacts realtionship to you?",
        minlength: "Your emergency contact's relationship needs to be greater than 2 characters",
        maxlength: "Your emergency contact's relationship needs to be less than 31 characters"
      },
      emergency_email:{
        required: "Please enter your emergency contact's email address",
        email: "Your must enter an email",
        minlength: "Your emergency contact's email needs to be greater than 2 charcters",
        maxlength: "The emergency contact's email you entered is too long"
      },
      emergency_phone:{
        required: "Please enter your emergency contact's phone number",
        minlength: "Your emergency contact's phone number needs to be greater than 2 characters",
        maxlength: "The emergency contact's phone number you entered is too long"
      },
      emergecy_mobile:{
        minlength: "Your emergency contact's mobile phone number needs to be greater than 2 characters",
        maxlength: "The emergency contact's mobile phone number you entered is too long"
      },
    }
  });

    $('#rootwizard').bootstrapWizard({
      'onNext': function(tab, navigation, index) {
        var $valid = $("#application-form").valid();
        if(!$valid) {
          console.log("test");
          $validator.focusInvalid();
          return false;
        }
      }
    });
});