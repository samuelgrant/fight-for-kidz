$(document).ready(function(){

    $('#logoInput').change(function(){
        previewLogo(this)
    });

    $('#charityLogo').change(function(){
        previewLogo(this)
    });

});

function previewLogo(input){

    if(input.files && input.files[0]){

        var reader = new FileReader();

        reader.onload = function(e){
            $('#logoPreview').attr('src', e.target.result)
        }

        reader.readAsDataURL(input.files[0]);

    }

}