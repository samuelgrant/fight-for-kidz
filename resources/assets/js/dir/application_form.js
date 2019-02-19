//Application form wizard
$(document).ready(function() {

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0}');

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
			phone_1:{
				required: true,
				number:true,
				minlength: 3,
				maxlength: 12
			},
			phone_2:{
				required: false,
				number: true, 
				minlength: 3,
				maxlength: 12
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
			photo:{
				required: true,
				extension: "jpg|jpeg|png",
				filesize : 2097152
			},

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
			emergency_phone_1:{
				required: true,
				minlength: 3,
				maxlength: 30
			},
			emergecy_phone_2:{
				required: false,
				minlength: 3,
				maxlength: 30
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
				required: $("#expRadio").val() == "yes",
				minlength: 3   
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
				required: $("#other:checked"),
				minlength: 3   
			},
			handRadio:{
				required: true
			},
			hand_details:{
				required: $("#handRadio").val() == 'yes',
				minlength: 3   
			},
			injuryRadio:{
				required: true
			},
			injury_details:{
				required: $("#injuryRadio").val() == 'yes',
				minlength: 3   
			},
			medsRadio:{
				required: true
			},
			meds_details:{
				required: $("#medsRadio").val() == 'yes',
				minlength: 3
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
			concussed_details:{
				required: $("#concussedRadio").val() == "yes",
				minlength: 3
			},
			reason_details:{
				required: $("#reasonsRadio").val() == "yes",
				minlength: 3   
			},

			//Additional      
			convictedRadio:{
				required: true
			},
			conviction_details:{
				required: $("#convictedRadio").val() =='yes',
				minlength: 3   
			},
			drugRadio:{
				required: true
			},

			//Custom Questions
			custom_1:{ 
				required: $("#custom_1").prop("required")
			},
			custom_2:{ 
				required: $("#custom_2").prop("required")
			},
			custom_3:{ 
				required: $("#custom_3").prop("required")
			},
			custom_4:{ 
				required: $("#custom_4").prop("required")
			},
			custom_5:{ 
				required: $("#custom_5").prop("required")
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
			phone_1:{
				required: "Please enter your phone number",
				number : "Please enter only numbers in this field",
				minlength: "Your phone number needs to be greater than 2 charcters",
				maxlength: "The phone number you entered is too long"
			},
			phone_2:{
				number : "Please enter only numbers in this field",
				minlength: "Your phone number needs to be greater than 2 charcters",
				maxlength: "The phone number you entered is too long"
			},

			//Personal
			dob:{
				required: "Please enter your birthdate",
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
				required: "Please choose an option"
			},
			photo:{
				required: "Please upload an image of yourself",
				extension: "Incorrect extension must be either jpg, jpeg or png",
				filesize: "Image must be less than 2MB"
			},

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
			emergency_phone_1:{
				required: "Please enter your emergency contact's phone number",
				minlength: "Your emergency contact's phone number needs to be greater than 2 characters",
				maxlength: "The emergency contact's phone number you entered is too long"
			},
			emergecy_phone_2:{
				minlength: "Your emergency contact's phone number needs to be greater than 2 characters",
				maxlength: "The emergency contact's phone number you entered is too long"
			},

			//Sporting
			fitness_rating:{
				required: "Please choose your fitness level"
			},
			expRadio:{
				required: "Please choose an option"
			},
			//Makes fighting experience required if expRadio is yes
			fighting_experience:{
				required: "Please describe your boxing/kickboxing/martial arts experience",
				minlength: "Your answer needs to be greater than 2 characters"
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
				required: "Please elaborate about your other medical history",
				minlength: "Your answer needs to be greater than 2 characters"
			},
			handRadio:{
				required: "Please choose an option"
			},
			hand_details:{
				required: "Please explain your hand injuries",
				minlength: "Your answer needs to be greater than 2 characters"
			},
			injuryRadio:{
				required: "Please choose an option"
			},
			injury_details:{
				required: "Please explain your previous injuries",
				minlength: "Your answer needs to be greater than 2 characters"
			},
			medsRadio:{
				required: "Please choose an option"
			},
			meds_details:{
				required: "Please list medication as well as the reasons for taking...",
				minlength: "Your answer needs to be greater than 2 characters"
			},

			//Medical 2
			heartRadio:{
				required: "Please choose an option"
			},
			activityRadio:{
				required: "Please choose an option"
			},
			monthRadio:{
				required: "Please choose an option"
			},
			consciousnessRadio:{
				required: "Please choose an option"
			},
			boneRadio:{
				required: "Please choose an option"
			},
			bloodRadio:{
				required: "Please choose an option"
			},
			concussedRadio:{
				required: "Please choose an option"
			},
			concussed_details:{
				required: "Please explain about your loss of consciousness",
				minlength: "Your answer needs to be greater than 2 characters"
			},
			reasonsRadio:{
				required: "Please choose an option"
			},
			reason_details:{
				required: "Please explain why you think that you should not be exercising",
				minlength: "Your answer needs to be greater than 2 characters"
			},

			//Additional      
			convictedRadio:{
				required: "Please choose an option"
			},
			conviction_details:{
				required: "Please explain your covictions/charges",
				minlength: "Your answer needs to be greater than 2 characters"
			},
			drugRadio:{
				required: "Please choose an option"
			},

			//Custom Questions
			custom_1:{
				required: "Please answer this question"
			},
			custom_2:{
				required: "Please answer this question"
			},
			custom_3:{
				required: "Please answer this question"
			},
			custom_4:{
				required: "Please answer this question"
			},
			custom_5:{
				required: "Please answer this question"
			},

			//Submit
			declCheckbox:{
				required: "Please acknowledge"
			}
		}
	});

	/** if validation passes allow next/previous buttons **/
	$('#rootwizard').bootstrapWizard({
		//These fuctions fires when the next vbutton is clicked
		'onNext': function(tab, navigation, index){

		var $valid = $("#application-form").valid();
			if(!$valid) {
				$validator.focusInvalid();
				return false;
			} else {
				//shows previous button on tab change if tab index is one but only if validator passes
				if (index == 1){
					$("#liPrevious").removeClass("d-none");
					$("#liPrevious").addClass("d-inline-block");

					$("#wizardBtnPrevious").removeClass("d-none");
				}

				//hides the next btn on tab index 7 but only if the validator passes
				if(index == 7){
					$("#liNext").removeClass("d-inline-block");
					$("#liNext").addClass("d-none");
					$("#wizardBtnNext").addClass("d-none");
				}
			}
		},
		//These functions fires when the previous button is clicked
		'onPrevious': function(tab, navigation, index){
			//shows the previous btn on tab index 0
			if(index == 0){
				$("#liPrevious").removeClass("d-inline-block");
				$("#liPrevious").addClass("d-none");
				$("#wizardBtnPrevious").addClass("d-none");
			}
			
			//shows the next btn on tab index 6
			if (index == 6) {
				$("#liNext").removeClass("d-none")
				$("#liNext").addClass("d-inline-block");
				$("#wizardBtnNext").removeClass("d-none");
			}   
		}
	});
});

/** Show/Hide buttons **/
function canSubmit(){
	if(document.getElementById('guidelinesCheckbox').checked){
		$("#appSubmitBtn").removeClass('d-none');
	}else{
		$("#appSubmitBtn").addClass('d-none');
	}
}

/** Disable Enter to submit **/
$(document).ready(function(){
	$('form input').keydown(function (e) {
		if (e.keyCode == 13) {
			var inputs = $(this).parents("form").eq(0).find(":input");
			if (inputs[inputs.index(this) + 1] != null) {                    
				inputs[inputs.index(this) + 1].focus();
			}
			e.preventDefault();
			return false;
		}
	});
});