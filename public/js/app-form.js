//Application form wizard
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
            
            //Medical 1
            //Dont need to validate checkboxes
            other_details:{
              required: $("#other").val() == "yes"
            },
            handRadio:{
              required: true
            },
            hand_details:{
              required: $("#handRadio").val() == 'yes'
            },
            injuryRadio:{
              required: true
            },
            injury_details:{
              required: $("#injuryRadio").val() == 'yes'
            },
            medsRadio:{
              required: true
            },
            meds_details:{
              required: $("#medsRadio").val() == 'yes'
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
              required: $("#reasonsRadio").val() == "yes"
            },
      
            //Additional
            //Custom Question Validation to go here
      
            convictedRadio:{
              required: true
            },
            conviction_details:{
              required: $("#convictedRadio").val() =='true'
            },
            drugRadio:{
              required: true
            },
      
            //Submit
            declCheckbox:{
              required: true
            }
          },
      
          messages: {
            //Contact
            first_name:{
              required: "Please enter your firstname",
              minlength: "Your name needs to be greater than 2 characters",
              maxlength: "Your name needs to be less than 31 characters"
            },
            last_name: {
              required: "Please enter your last name",
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
      
            //Sporting
            fitness_rating:{
              required: "Please choose your fitness level"
            },
            expRadio:{
              required: "Have you had previous experience in boxing/kickboxing/martial arts?"
            },
            //Makes fighting experience required if expRadio is yes
            fighting_experience:{
              required: "Please describe your boxing/kickboxing/martial arts experience"
            },
            sporting_experience:{
              required: "Please describe your sporting experience"
            },
            hobbies:{
              required: "Please describe your hobbies"
            },
            
            //Medical 1
            //Dont need to validate checkboxes
            other_details:{
              required: "Please elaborate about your other medical history"
            },
            handRadio:{
              required: "Have you ever had any hand injuries?"
            },
            hand_details:{
              required: "Please explain your hand injuries"
            },
            injuryRadio:{
              required: "Have you ever had any injuries (expecially head injuries)?"
            },
            injury_details:{
              required: "Please explain your previous injuries"
            },
            medsRadio:{
              required: "Are you currently taking any medications?"
            },
            meds_details:{
              required: "Please list medication as well as the reasons for taking..."
            },
            
            //Medical 2
            heartRadio:{
              required: "Has a physician ever said that you have a heart condition and recommended only medically supervised activity?"
            },
            activityRadio:{
              required: "Have you have chest pain that’s brought on by physical activity?"
            },
            monthRadio:{
              required: "Have you developed chest pain in the past month?"
            },
            consciousnessRadio:{
              required: "Have you on one or more occasions lost consciousness or fallen over as a result of dizziness?"
            },
            boneRadio:{
              required: "Do you have a bone or joint problem that could be aggravated by the proposed physical activity?"
            },
            bloodRadio:{
              required: "Has a physician ever recommended medication for your blood pressure or a heart condition?"
            },
            concussedRadio:{
              required: "Have you ever been knocked out or concussed?"
            },
            reasonsRadio:{
              required: "Are you aware, through your own experience or a physician’s advice, of any other reason that would prohibit you from exercising without medical supervision?"
            },
            reason_details:{
              required: "Please explain why you think that you should not be exercising"
            },
      
            //Additional
            //Custom Question Validation to go here
      
            convictedRadio:{
              required: "Do you have any criminal convictions or are facing charges?"
            },
            conviction_details:{
              required: "Please about your covictions/charges"
            },
            drugRadio:{
              required: "do you consent to taking a drug screening test?"
            },
      
            //Submit
            declCheckbox:{
              required: "Please declare that you have provided true and accurate information"
            }
          }
        });
    
    $('#rootwizard').bootstrapWizard({onTabShow: function(navigation, index) {
      var $total = navigation.find('li').length;
      var $current = index+1;
      var $percent = ($current/$total) * 100;
      $('#rootwizard .progress-bar').css({width:$percent+'%'});
    },
    'onNext': function(tab, navigation, index){
      var $valid = $("#application-form").valid();
      if(!$valid) {
        $validator.focusInvalid();
        return false;
      }
    }
    });
  });