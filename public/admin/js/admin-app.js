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
    $('#imgPreview').attr('src', 'https://via.placeholder.com/100x80');
    $('input:file') = null;
}