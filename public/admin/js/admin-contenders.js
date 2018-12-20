function editContenderModal(contenderID){

    $.ajax({
        method: "get",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/a/event-management/contenders/' + contenderID
    }).done(function(data){

        var form = $('#editContenderForm');
        form.attr('action', form.data('action') + contenderID);

        $('#contenderLastName').val(data.last_name);
        $('#contenderFirstName').val(data.first_name)
        $('#contenderNickname').val(data.nickname);
        $('#contenderSponsor').val(data.sponsor_id);
        $('#contenderHeight').val(data.height);
        $('#contenderWeight').val(data.weight);
        $('#contenderReach').val(data.reach);
        $('#contenderDonateUrl').val(data.donate_url);
        $('#contenderBioUrl').val(data.bio_url);
        $('#contenderBio').val(data.bio_text);


        $('#editContenderModal').modal('show');

    }).fail(function(err){
        console.error(`Error getting bout information in the admin-contenders/editContenderModal method: ${err}`);
    });
}