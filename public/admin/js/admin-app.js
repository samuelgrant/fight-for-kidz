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

    $('#removeImageCheckbox').prop('checked', true);
    console.log($('#removeImageCheckbox').prop('checked'));    
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