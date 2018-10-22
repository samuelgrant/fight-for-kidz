$(document).ready(function(){

    // set select elements to display the correct option
    $('.sponsor-select').each(function(){

        var form = $(this).closest('form');

        $(this).val(form.data('sponsorId'));

    });

    $('.red-select').each(function(){

        var form = $(this).closest('form');

        $(this).val(form.data('redId'));
        return $(this).attr('id');

    });

    $('.blue-select').each(function(){

        var form = $(this).closest('form');

        $(this).val(form.data('blueId'));

    });


    // set on change handlers for all drop downs
    $('.sponsor-select, .red-select, .blue-select').change(function(event){

        var form = $(this).closest('form');

        form.submit();

    });

});