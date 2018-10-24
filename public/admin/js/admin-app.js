// adds the tab value to the URL and refreshes page
$(document).ready(function () {
    $('.nav-tabs').click(function (event) {
        var newURLString = window.location.pathname + "?tab=" + event.target.id;

        window.history.replaceState(null, null, newURLString);
    })
})


// Processes the image preview for group icon uploads.

$(document).ready(function () {
    $('input:file').change(function () {
        processImage(this);
    })

    $
});

function processImage(input) {
    if (input.files && input.files[0]) {
        var fr = new FileReader();
        fr.onload = function (e) {
            $('#imgPreview').attr('src', e.target.result);
        }

        fr.readAsDataURL(input.files[0]);
    }
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
            null
        ]
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
        ]
    })
});

// Count the number of selected datatable rows on a page, and display the result
// on the remove contacts modal.
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
 * @param groupID
 */
function copySelectedToGroup() {

    var contacts = $('#group-dtable').find('.dtable-checkbox:checkbox:checked');
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

}

/**
 * This function adds selected applicants for an event to 
 * a team for that event.
 */
function addSelectedToTeam(eventId){
    
    var team = $('#team-select').val();

    var selected = $('#applicant-dtable').find('.dtable-checkbox:checkbox:checked');

    selected.each(function(){

        var appId = $(this).data('applicantId');
        
        // ajax call to add to team
        $.ajax({
            type: 'PUT',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/a/event-management/' + 'team/' + eventId,
            data: {'applicantId' : appId, 'team' : team}, 
        }).done(function(){
            location.reload();
        }).fail(function(error){
            console.log(error);
        });

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
