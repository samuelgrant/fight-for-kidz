$(document).ready(function(){

    $('#logoInput').change(function(){

        processImage(this)

    });

    $('#charityLogo').change(function(){

        processImage(this)

    });

});

function processImage(input){

    if(input.files && input.files[0]){

        var reader = new FileReader();

        reader.onload = function(e){
            $('#logoPreview').attr('src', e.target.result)
        }

        reader.readAsDataURL(input.files[0]);

    }

}