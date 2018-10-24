$(document).ready(function(){

    $('.boutMgmt-card').each(function(){

        resetForm($(this).find('form'));

    })


    // set on change handlers for all drop downs - this simply adds a 'Save Changes' button to the form
    $('.sponsor-select, .red-select, .blue-select, .winner-select, .winner-select').change(function(event){

        var form = $(this).closest('form');
        var btnDiv = form.find('#bout-buttons');
        var btnSave = form.find('#save-button')
        var btnCancel = form.find('#cancel-button');

        // make button visible with slide animation - if they are not already visible.
        if(btnDiv.is(':hidden')){
            btnDiv.slideDown();
        }        

        btnSave.on('click', function(){
            form.submit();
        });

        btnCancel.on('click', function(){
            resetForm(form);
        });
    });

});

function resetForm(form){

    sponsor = form.find('.sponsor-select');
    red = form.find('.red-select');
    blue = form.find('.blue-select');
    victor = form.find('.winner-select');


    sponsor.val(form.data('sponsorId'));
    red.val(form.data('redId'));
    blue.val(form.data('blueId'));
    victor.val(form.data('winnerId'));
}