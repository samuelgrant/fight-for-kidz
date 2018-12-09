// adds the tab value to the URL and refreshes page
$(document).ready(function () {
    $('.nav-tabs-persistent').click(function (event) {
        var newURLString = window.location.pathname + "?tab=" + event.target.id;

        window.history.replaceState(null, null, newURLString);
    })
});


// Processes the image preview for group icon uploads.

$(document).ready(function () {
    $('#groupImage').change(function () {
        processImage(this);
    })

    $('#mainPagePhoto').change(function(){
        processImage(this);
    })

    $('#itemImage').change(function(){
        processImage(this);
    })
});

// Populates the other settings modal when user clicks edit 
function setSettingsModal(merch, about){

    resetFile('/storage/images/mainPagePhoto.jpg');

    $('#displayMerchCheckbox').prop('checked', merch);
    $('#aboutUsText').text(about);

}

function processImage(input) {
    if (input.files && input.files[0]) {
        var fr = new FileReader();
        fr.onload = function (e) {
            $('#imgPreview').attr('src', e.target.result);
        }

        fr.readAsDataURL(input.files[0]);
    }
}

// set file input back to null if user cancels the update 
function resetFile(defaultImagePath){

    // set preview back to current
    $('#imgPreview').prop('src', defaultImagePath);

    // set input to null
    $('input:file').prop('value', null);    
    
}

function resetImagePre() {

    // Set preview image back to placeholder.
    $('#imgPreview').attr('src', 'https://via.placeholder.com/80x100');

    // Set file input to null if it isn't already.
    if ($('input:file').prop('value') != null) {
        $('input:file').prop('value', null); // = null;
    }

    // Set this hidden checkbox to true. This tells the controller that 
    // the user has clicked 'Remove Image' and therefore to set the 
    // group icon to default.
    $('#removeImageCheckbox').prop('checked', true);
}

/* Data Tables */
$(document).ready(function() {
    $("#event-dtable").DataTable({
        "columns": [
            {"visible": false, "type": "num"},
            null,
            {"orderData": 0}, // this column will sort using the invisible columns data
            null,
            null,
            { "orderable": false, "searchable": false },
            { "orderable": false, "searchable": false },
            { "orderable": false, "searchable": false }
            ]
    });

    $("#eventDeleted-dtable").DataTable({
        "columns": [
            null,
            null,
            null,
            null,
            null,
            { "orderable": false, "searchable": false },
            { "orderable": false, "searchable": false }
        ]
    });
    
    $('#group-dtable').DataTable({
        "columns": [
            { "orderable": false, "searchable": false },
            null,
            null,
            null,
        ],
        'iDisplayLength' : 100
    });

    $('#system-group-dtable').DataTable({
        "columns": [
            { "orderable": false, "searchable": false },
            null,
            {"orderable" : false},
            {"orderable" : false},
            {"orderable" : false},
            {"orderable" : false},
        ],
        'iDisplayLength' : 100
    });

    $('#user-dtable').DataTable({
        "columns": [
            null,
            null,
            null,
            null,
            { "orderable": false, "searchable": false },
            { "orderable": false, "searchable": false }
        ]
    });
    $('#userDeleted-dtable').DataTable({
        "columns": [
            null,
            null,
            null,
            { "orderable": false, "searchable": false }
        ]
    });

    $('#applicant-dtable').DataTable({
        "columns":[
            { "orderable": false, "searchable": false},
            { "orderable": false, "searchable": true},
            null,
            {"searchable": false},
            {"searchable": false},
            {"searchable": false},
            {"searchable": false},
            {"searchable": false},
            { "orderable": false, "searchable": false },
            { "orderable": false, "searchable": false }
        ],
        'iDisplayLength' : 100
    })

    $('#auction-dtable').DataTable({
        "columns":[
            null,
            { "orderable": false, "searchable": true },
            { "orderable": false, "searchable": false },
            { "orderable": false, "searchable": false },
            { "orderable": false, "searchable": false },
            { "orderable": false, "searchable": false },
            { "orderable": false, "searchable": false }
        ]
    })

    $('#auctionDeleted-dtable').DataTable({
        "columns":[
            null,
            { "orderable": false, "searchable": true},
            { "orderable": false, "searchable": false},
            { "orderable": false, "searchable": false},
            { "orderable": false, "searchable": false},
            { "orderable": false, "searchable": false}
        ]
    })

    $('#event-sponsor-dtable').DataTable({           
        "columns" : [
            null,
            { "orderable": false, "searchable": false },
            { "orderable": false, "searchable": false },
        ],
        'iDisplayLength' : 25
    });

    $('#sponsor-dtable').DataTable({           
        "columns" : [
            null,
            { "orderable": false, "searchable": false },
            null,
            { "orderable": false, "searchable": false },
            { "orderable": false, "searchable": false },
        ],
        'iDisplayLength' : 25
    });

    $('#merchandise-dtable').DataTable({
        "columns":[
            null,
            { "orderable": false, "searchable": true },
            { "orderable": false, "searchable": true },
            { "orderable": false, "searchable": false },
            { "orderable": false, "searchable": false },
            { "orderable": false, "searchable": false },
            { "orderable": false, "searchable": false },
            { "orderable": false, "searchable": false }
        ]
    })

    $('#merchandiseDeleted-dtable').DataTable({
        "columns":[
            null,
            { "orderable": false, "searchable": true },
            { "orderable": false, "searchable": true },
            { "orderable": false, "searchable": false },
            { "orderable": false, "searchable": false }
        ]
    })
});

// Count the number of selected datatable rows on a page, and display the result
// on the remove contacts modal.

// ** No longer used for applicants **
function countSelected(mode) {

    var dtable;
    var modal;

    if(mode == 'groups'){
        dtable = $('#group-dtable');
        modal = $('#removeFromGroupModal');
    } else if(mode == 'applicants'){
        dtable = $('#applicant-dtable');
        modal = $('#editTeamModal');
    }

    var selected = dtable.find('.dtable-checkbox:checkbox:checked');
    var count = selected.length;

    if (count == 0) {
        modal.find('#modal-message').text('Oops! You have not selected anything.');
        return;
    }

    if(mode == 'groups'){
        modal.find('#modal-message').text('You have selected ' + count + ' contact(s) for deletion.')
    } else if(mode == 'applicants'){
        modal.find('#modal-message').text('You have selected ' + count + ' applicants.')
    }
}

/**
 * jQuery selects all checked datatable boxes and iterates through them.
 * For each checkbox, the code sends an ajax delete request to the appropriate
 * route. It includes the CSRF token otherwise a 419 error is returned.
 * 
 * When the ajax request is finished, successfully, the associated row on the 
 * datatable is removed, without having to reload the page.  
 * 
 * @param groupID 
 */
function removeSelectedFromGroup(groupID) {
    var checkboxes = $('.member-remove-checkbox:checkbox:checked');
    var table = $('#group-dtable').DataTable();

    checkboxes.each(function () {

        var rowId = $(this).prop('id');

        $.ajax({
            type: 'DELETE',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/a/group-management/' + groupID + '/' + rowId
        }).done(function (data) {
            console.log(data);
            table.row($('*[id="' + rowId + '"').parents('tr')[0]).remove().draw();
        }).fail(function (err) {
            console.error(err);
        });
    });
}

/**
 * This method adds all selected group members to another group selected by the 
 * user.
 * 
 * Mode should be either 'customGroups' or 'systemGroups' as a string
 * 
 * @param groupID
 */
function copySelectedToGroup(mode) {

    if(mode == 'customGroups'){
        var contacts = $('#group-dtable').find('.dtable-checkbox:checkbox:checked');
    } else if(mode == 'systemGroups'){
        var contacts = $('#system-group-dtable').find('.dtable-checkbox:checkbox:checked');
    } else {
        console.log('Error. Group copy mode invalid');
        return;
    }

    var toGroupId = $('#groupDropdown').val();

    // for each selected contact, add to group
    contacts.each(function() {

        var type = $(this).data('memberType');
        var memberId = $(this).data("memberId");

        //make ajax request to copy member to another group
        $.ajax({
            type: 'PUT',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/a/group-management/' + toGroupId + '/' + type + '/' + memberId 
        }).done(function (data){
            console.log(data);
        }).fail(function(err){
            console.error(err);
        });

    });

    // show success alert
    alert = $('#manualAlert');
    alert.removeClass('d-none');    
    $('#messageText').text('Successfully copied ' + contacts.length + ' contacts.');

    // untick all checkboxes
    $('#dtable-select-all').prop('checked', false);
    contacts.each(function(){
        $(this).prop('checked', false);
    });
}

/**
 * This function adds selected applicants for an event to 
 * a team for that event.
 */
function addSelectedToTeam(team){
    
    var selected = $('#applicant-dtable').find('.dtable-checkbox:checkbox:checked');

    selected.each(function(){

        var appId = $(this).data('applicantId');
        
        // ajax call to add to team
        $.ajax({
            type: 'PUT',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/a/event-management/team/add',
            data: {'applicantId' : appId, 'team' : team}, 
        }).done(function(){
            location.reload();
        }).fail(function(error){
            console.log(error);
        });

    });

}

/**
 * This function adds selected applicants for an event to 
 * a team for that event.
 */
function removeSelectedFromTeam(){
    
    
    var selected = $('#applicant-dtable').find('.dtable-checkbox:checkbox:checked');

    selected.each(function(){

        var appId = $(this).data('applicantId');
        
        removeApplicantFromTeam(appId);

    });

}

function removeApplicantFromTeam(applicantId){

    // ajax call to remove from team
    $.ajax({
        type: 'DELETE',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/a/event-management/team/remove/',
        data: {'applicantId' : applicantId}, 
    }).done(function(){
        location.reload();
    }).fail(function(error){
        console.log(error);
    });
}

// When the user ticks/unticks the 'select all' checkbox, tick or untick all visible 
// datatable items
$('body').on('change', '#dtable-select-all', function () {
    var rows, checked;
    rows = $('#group-dtable').find('tbody tr');
    checked = $(this).prop('checked');
    $.each(rows, function () {
        var checkbox = $($(this).find('td').eq(0)).find('input').prop('checked', checked);
    });

    rows = $('#system-group-dtable').find('tbody tr');
    checked = $(this).prop('checked');
    $.each(rows, function () {
        var checkbox = $($(this).find('td').eq(0)).find('input').prop('checked', checked);
    });
});

// Uncheck 'select all' checkbox when row checkboxes are clicked or columns sorted.
$('.dtable-control').on('click', function () {
    $('#dtable-select-all').prop('checked', false);

    // if the dtable control isn't a checkbox, then it must be a column header, and the 
    // rows will be reshuffled. Therefore all checkboxes should become unchecked.
    if (!$(this).hasClass('dtable-remove-checkbox')) {
        var checkboxes = $('.dtable-remove-checkbox:checkbox:checked');
        checkboxes.each(function () {
            $(this).prop('checked', false);
        });
    }
});

function editContactModal(id){

    $.ajax({
        method : "GET",
        url : '/a/group-management/contacts/' + id
    }).done(function(data){

        form = $('#editContactForm');
        deleteForm = $('#contactDeleteForm');

        deleteForm.attr('action', deleteForm.data('action') + '/' + id);
        form.attr('action', form.data('action') + '/' + id);

        $('#contactName').val(data.name);
        $('#contactPhone').val(data.phone);
        $('#contactEmail').val(data.email);

        $('#editContactModal').modal('show');

    }).fail(function(error){
        console.log(error);
    })

}

function confirmAction(){
    $('#buttonConfirmContact').removeClass('d-none');
    $('#buttonDeleteContact').addClass('d-none');
}

function actionConfirmed(){
    deleteForm = $('#contactDeleteForm');
    deleteForm.submit();
}

function applicantManagementModal(id){
    
    $.ajax({
        method: "get",
        headers:  {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/a/event-management/applicants/' + id
    }).done(function(data){
        var dob = new Date(data.dob);
        // Dynamically populate modal

        // General Tab
        $("#appFirstName").val(data.first_name);            $("#appLastName").val(data.last_name);
        $("#appFightName").val(data.preferred_nickame);     $("#appAge").val(calculate_age(dob));
        $("#appDob").val(dob.toLocaleDateString("en-US"));

        // Set Photo
        var img = $('#appPhoto');
        img.attr('src', img.data('route') + data.id + '.png'); // appends id.png to end of supplied route

        // Set Gender 
        if(if_male = 0) {
            $("#appGender").val("Male");
        }else if(if_male = 1) {
            $("#appGender").val("Female");
        }
        
        $("#appEmail").val(data.email);                     $("#appPhone").val(data.phone);
        $("#appMobile").val(data.mobile);                   $("#appAddress1").val(data.address_1);
        $("#appAddress2").val(data.address_2);              $("#appSuburb").val(data.suburb);
        $("#appCity").val(data.city);                       $("#appPostCode").val(data.postcode);

        // Pesonal Tab
        $("#appHeight").val(data.height + "cm");            $("#appWeightC").val(data.current_weight + "kg");
        $("#appWeightE").val(data.expected_weight + "kg");  
        $('#fitnessLevel').text('This applicant rates their fitness at ' + data.fitness_rating + ' out of 5');
        $("#dominantHand").text("This applicant is " + (data.right_handed ? 'right' : 'left') + "-handed");
        $("#appBoxingExperience").text(data.boxing_exp);
        $("#appSportingExperience").text(data.sporting_exp);
        $('#hobbies').text(data.hobbies);

        //Emergency Tab
        $("#appEmergencyFirstName").val(data.emergency_first_name);             $("#appEmergencyLastName").val(data.emergency_last_name);
        $("#appEmergencyRelationship").val(data.emergency_relationship);        $("#appEmergencyPhone").val(data.emergency_phone);                     
        $("#appEmergencyMobile").val(data.emergency_mobile);                    $("#appEmergencyEmail").val(data.emergency_email);                   

        // Medical Tab 1
        $("#appHeartDisease").val(data.heart_disease ? 'Yes' : 'No');                          $("#appBreathlessness").val(data.breathlessness ? 'Yes' : 'No');
        $("#appEpilepsy").val(data.epilepsy ? 'Yes' : 'No');                                   $("#appHeartAttack").val(data.heart_attack ? 'Yes' : 'No');
        $("#appStroke").val(data.stroke ? 'Yes' : 'No');                                       $("#appHeartSurgery").val(data.heart_surgery ? 'Yes' : 'No');
        $("#appRespiratoryProblems").val(data.respiratory_problems ? 'Yes' : 'No');            $("#appCancer").val(data.cancer ? 'Yes' : 'No');
        $("#appIrregularHeatbeat").val(data.irregular_heartbeat ? 'Yes' : 'No');               $("#appSmoking").val(data.smoking ? 'Yes' : 'No');
        $("#appJointProblems").val(data.joint_pain_problems ? 'Yes' : 'No');                   $("#appChestPain").val(data.chest_pain_discomfort ? 'Yes' : 'No');
        $("#appHypertension").val(data.hypertension ? 'Yes' : 'No');                           $("#appSurgery").val(data.surgery ? 'Yes' : 'No');
        $("#appDizzinessFainting").val(data.dizziness_fainting ? 'Yes' : 'No');                $("#appCholesterol").val(data.high_cholesterol ? 'Yes' : 'No');

        $("#appOther").text(data.other);

        // Medical Tab 2
        $("#appHeartCondtion").val(data.heart_condition ? 'Yes' : 'No');                       $("#appPhysicalChestPain").val(data.chest_pain_activity ? 'Yes' : 'No');
        $("#appRecentChestPain").val(data.chest_pain_recent ? 'Yes' : 'No');                   $("#appPassedOut").val(data.lost_consciousness ? 'Yes' : 'No');
        $("#appBoneJointProblems").val(data.bone_joint_problems ? 'Yes' : 'No');               $("#appMedicationBloodHeart").val(data.recommended_medication ? 'Yes' : 'No');
        $("#appKnockedOut").val(data.concussed_knocked_out ? 'Yes' : 'No');                    $("#appReason").val(data.other_reasons ? 'Yes' : 'No');

        $("#appReason").val(data.other_reasons);
        $("#appHandInjuries").val(data.hand_injuries);
        $("#appPreviousCurrentInjuries").val(data.previous_current_injuries);
        $("#appCurrentMedicaton").val(data.current_medication);

        // Additional Tab
        $("#appOccupation").val(data.occupation);                               $("#appEmployer").val(data.employer);
        $("#appConvictionDetails").text(data.conviction_details);

        // Set Consent
        if(consent_to_test = 0){
            $("#appConsent").val("Yes");
        }else if(consent_to_test = 1){
            $("#appConsent").val("Yes");
        }

        // Set Sponsor
        if(can_secure_sponsor = 0){
            $("#appSponsor").val("Yes");
        }else if(consent_to_test = 1){
            $("#appSponsor").val("Yes");
        }

        //Custom Tab
        $('#custom_1').val(data.custom_one);
        $('#custom_2').val(data.custom_two);
        $('#custom_3').val(data.custom_three);
        $('#custom_4').val(data.custom_four);
        $('#custom_5').val(data.custom_five);


        $("#applicantMoreInfoModal").modal('show');
    }).fail(function(error) {
        console.log(error);
    });
}

function auctionCreateModal(){
    //Set modal for creating auction item
    //$("#auctionForm").attr("action", "/");
    $('#hiddenMethod').val('POST');
    $("#auctionModalTitle").text("Create Auction Item");
    $("#auctionModalButton").text("Confirm");

    //Set all text fields to empty
    $("#auctionName").val("");
    $("#auctionDescription").val("");
    $("#auctionDonor").val("");
    $("#auctionDonorUrl").val("");
    $("#imgPreview").attr("src", '');

    //Display the modal
    $("#createEditAuctionItemModal").modal('show');
}

function auctionEditModal(id){
    $.ajax({
        method: "get",
        headers:  {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `/a/auction-management/auction/${id}`
    }).done((data) => {
        //Set modal for editing
        $("#auctionForm").attr("action", "http://f4k.localhost/a/auction-management/update/" + id);
        $("#auctionModalTitle").text("Edit Auction Item");
        $("#auctionModalButton").text("Save");
        $("#hiddenMethod").val("PUT");

        //Dynamically populate the modal with item info
        $("#auctionName").val(data.name);
        $("#auctionDescription").val(data.desc);
        $("#auctionDonor").val(data.donor);
        $("#auctionDonorUrl").val(data.donor_url);

        //checks to see if the image exists and sets the imgPreview otherwise sets it to default
        $.get("/storage/images/auction/" + data.id + ".png")
        .done(function(){
            $("#imgPreview").attr("src", "/storage/images/auction/" + data.id + ".png");
        }).fail(function(){
            $("#imgPreview").attr("src", "/storage/images/noImage.png");
        })                

        //Display the modal
        $("#createEditAuctionItemModal").modal('show');
    }).fail((error) => {
        console.log(error);
    });
}

function calculate_age (data) {
    var now = new Date();
    var age = now - data;
    age = Math.floor(age/1000/60/60/24/365);
    return age;
};

// Application delete script
$(document).ready(function(){

    $('#deleteAppBtn').on('click', function(){

        $(this).addClass('d-none');
        $(this).removeClass('d-inline');
        $('#confirmDeleteAppBtn').addClass('d-inline');

    });   

});

function confirmApplicantDelete(app){

    $('#deleteAppBtn').addClass('d-inline');
    $('#confirmDeleteAppBtn').removeClass('d-inline');

    modal = $('#confirmDeleteApplicantModal');
    form = $('#confirmDeleteApplicantForm');
    title = $('#deleteAppName');
    title.text('Remove: ' + app.first_name + " " + app.last_name);

    form.prop('action', form.data('action') + '/' + app.id);

    modal.modal('show');
}

// Custom mail functions
$(document).ready(function(){

    $('#mailPreviewBtn').on('click', function(){

        message = CKEDITOR.instances['messageText'].getData();
        action = $(this).data('url');
        
        // ajax call to add to team
        $.ajax({
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: action,
            data: {'messageText' : message}, 
        }).done(function(data){
            // open a new tab/window and write the returned html to it
            var win = window.open();
            win.document.write(data);
        }).fail(function(error){
            console.log(error);
        });

        
    });

    $('#sendBtn').on('click', function(){

        // hide self and preview buttons
        $('#mailPreviewBtn').addClass('d-none');
        $('#promptText').addClass('d-none');
        $(this).addClass('d-none');
        $(this).removeClass('d-inline');

        // show confirm and abort buttons
        $('#confirmSendBtn').removeClass('d-none');
        $('#abortSendBtn').removeClass('d-none');

    });

    $('#abortSendBtn').on('click', function(){

        // show send and preview buttons
        $('#mailPreviewBtn').removeClass('d-none');
        $('#sendBtn').removeClass('d-none');
        $('#sendBtn').addClass('d-inline');
        $('#promptText').removeClass('d-none');

        // hide confirm and abort buttons
        $('#confirmSendBtn').addClass('d-none');
        $(this).addClass('d-none');

    });


    $('#multipleGroupSelect').change(function(){

        console.log($(this).val().length);

        // this is important as the fSelect doesn't seem to support straightforward
        // front end validation. So this hidden checkbox (actually not hidden, but transparent)
        // will enable the validation instead. It ticks when groups are selected, and unticks
        // when none are selected.
        if($(this).val().length != 0){
            $('#hiddenCheck').prop('checked', true);
            $('#hiddenCheck')[0].oninput();
        } else{
            $('#hiddenCheck').prop('checked', false);
        }

    })

})
//Sets the modal for creating merchandise item and then displays it
function merchandiseCreateModal(){
    //$("#auctionForm").attr("action", "/");
    $('#hiddenMethod').val('POST');
    $("#merchandiseModalTitle").text("Create Merchandise Item");
    $("#merchandiseModalButton").text("Confirm");

    //Set all text fields to empty
    $("#merchandiseName").val("");
    $("#merchandiseTagline").val("");
    $("#merchandiseDescription").val("");
    $("#merchandisePrice").val("");
    $("#imgPreview").attr("src", '');

    //Display the modal
    $("#createEditMerchandiseItemModal").modal('show');
}

////Sets the modal for editing merchandise item dynamically populates the fields and then displays it
function merchandiseEditModal(id){
    $.ajax({
        method: "get",
        headers:  {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `/a/merchandise-management/merchandise/${id}`
    }).done((data) => {
        //Set modal for editing
        $("#merchandiseForm").attr("action", "http://f4k.localhost/a/merchandise-management/update/" + id);
        $("#merchandiseModalTitle").text("Edit Merchandise Item");
        $("#merchandiseModalButton").text("Save");
        $("#hiddenMethod").val("PUT");

        //Dynamically populate the modal with item info
        $("#merchandiseName").val(data.name);
        $("#merchandiseTagline").val(data.tagline);
        $("#merchandiseDescription").val(data.desc);
        $("#merchandisePrice").val(data.price);
        
        //checks to see if the image exists and sets the imgPreview otherwise sets it to default
        $.get("/storage/images/merchandise/" + data.id + ".png")
        .done(function(){
            $("#imgPreview").attr("src", "/storage/images/merchandise/" + data.id + ".png");
        }).fail(function(){
            $("#imgPreview").attr("src", "/storage/images/noImage.png");
        })       

        //Display the modal
        $("#createEditMerchandiseItemModal").modal('show');
    }).fail((error) => {
        console.log(error);
    });
}

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

// File upload functions
function fileUpdateModal(id){

    

    form = $('#fileUpdateForm');
    modal = $('#updateModal');

    url = "/a/dashboard/uploads/" + id;

    form.prop('action', form.data('action') + '/' + id);

    $.ajax({
        method : 'GET',
        url : url,
    }).done(function(data){
        console.log(data.display_location);
        $('#updateDisplaySelect').val(data.display_location);
        modal.modal('show');

    }).fail(function(error){
        console.log(error);
    })

}

// below works for both file uploads on dashboard and emails
$(document).ready(function(){
    $('#fileUpload').change(function(e){
        var clearBtn = $('#clearAttachmentsBtn');
        
        var fileCount = e.target.files.length;
        console.log(fileCount);

        fileNamesString = '';

        for(i = 0; i < fileCount; i++){
            fileNamesString += ((i > 0 ? ', ' : '') + e.target.files[i].name);
            console.log(fileNamesString);
        }

        if(fileNamesString != ''){  
            $('#fileName').removeClass('d-none');
            $('#fileName').text(fileNamesString);
        } else{
            $('#fileName').addClass('d-none');
        }

        if(fileCount > 0){
            clearBtn.removeClass('d-none');
        }else{
            clearBtn.addClass('d-none');
        }
    });    
});

$('#clearAttachmentsBtn').on('click', function(e){
    // to reset the input, we wrap it with a temp form, 
    // reset that form, then unwrap it. This is because the only 
    // way to change or clear a file input is by form reset. For security reasons.
    // https://www.gyrocode.com/articles/how-to-reset-file-input-with-javascript/

    var $file = $('#fileUpload').first();

    $file.wrap('<form>').closest('form').get(0).reset();
    $file.unwrap();

    console.log($('#fileUpload')[0].files.length);

    $file.change();

});


