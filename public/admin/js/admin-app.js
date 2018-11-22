// adds the tab value to the URL and refreshes page
$(document).ready(function () {
    $('.nav-tabs').click(function (event) {
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
            { "orderable": false, "searchable": false }
        ],
        'iDisplayLength' : 100
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
        url : `/a/group-management/contacts/${id}`
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
        url: `/a/event-management/applicants/${id}`
    }).done((data) => {
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

        // Physical Tab
        $("#appHeight").val(data.height + "cm");           $("#appWeightC").val(data.current_weight + "kg");
        $("#appWeightE").val(data.expected_weight + "kg");  $("#appSportingExperience").text(data.sporting_exp);
        $('#fitnessLevel').text('This applicant rates their fitness at ' + data.fitness_rating + ' out of 5');
        $("#appBoxingExperience").text(data.boxing_exp);
        $('#hobbies').text(data.hobbies);

        // Additional Tab
        $("#appOccupation").val(data.occupation);           $("#appEmployer").val(data.employer);
        $("appConvictionDetails").text(data.conviction_details);

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


        $("#applicantMoreInfoModal").modal('show');
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

$(document).ready(function(){
    $('#fileUpload').change(function(e){
        var filename = e.target.files[0].name;
        $('#fileName').text(filename);
    });
});


