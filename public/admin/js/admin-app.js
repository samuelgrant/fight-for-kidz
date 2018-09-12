// adds the tab value to the URL and refreshes page
$(document).ready(function(){
    $('.nav-tabs').click(function(event){
        var newURLString = window.location.pathname + "?tab=" + event.target.id;

        window.history.replaceState(null, null, newURLString);
    })
})


// Processes the image preview for group icon uploads.

$(document).ready(function(){
    $('input:file').change(function(){
        processImage(this);
    })

    $
});

function processImage(input){
    if(input.files && input.files[0]){
        var fr = new FileReader();
        fr.onload = function(e){
            $('#imgPreview').attr('src', e.target.result);
        }

        fr.readAsDataURL(input.files[0]);
    }
}

function resetImagePre(){

    // Set preview image back to placeholder.
    $('#imgPreview').attr('src', 'https://via.placeholder.com/80x100');

    // Set file input to null if it isn't already.
    if($('input:file').prop('value') != null){        
        $('input:file').prop('value', null); // = null;
    }

    // Set this hidden checkbox to true. This tells the controller that 
    // the user has clicked 'Remove Image' and therefore to set the 
    // group icon to default.
    $('#removeImageCheckbox').prop('checked', true);  
}

/* Data Tables */
$(document).ready(function() {
    $('#subscribers-dtable').DataTable({
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
          null,
          { "orderable": false, "searchable": false },
          { "orderable": false, "searchable": false }
        ]
      });
});

// Count the number of selected datatable rows on a page, and display the result
// on the remove contacts modal.
function countSelected() {

    var count = $('.dtable-remove-checkbox:checkbox:checked').length;

    console.log(count);

    if(count == 0){
        $('#removeCount').text('Oops! You have not selected any group members.');
        return;
    }   

    $('#removeCount').text('You have selected ' + count + ' contact(s) for deletion.');
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
    var checkboxes = $('.dtable-remove-checkbox:checkbox:checked');
    var table = $('#subscribers-dtable').DataTable();

    checkboxes.each(function () {

        var rowId = $(this).prop('id');        

        $.ajax({
            type: 'DELETE',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/a/group-management/' + groupID + '/' + rowId
        }).done(function (data) {
            console.log(data);
            table.row( $(this).parents('tr')[0]).remove().draw();
        }).fail(function (err) {
            console.error(err);
        });
    });
}