$(document).ready(function () {
    $('.bio-view-button').on('click', function (e) {

      var url = '/contenders/bio/' + $(this).attr('data-contenderId');

      console.log(url);

      $.ajax({
        url: url,
        method: 'get',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        dataType: 'json'
      }).done(function (data) {



        $('#first-name').text(data['contender']['first_name']);
        $('#last-name').text(data['contender']['last_name']);

        // show nickname if one is set
        if (data['contender']['nickname'] != null) {
          $('#nickname').text('\'' + data['contender']['nickname'] + '\'');
        }

        // get video id from donate_url
        if (data['contender']['bio_url'] != null) {
          vidId = getQueryVariable(data['contender']['bio_url'], 'v')
          $('#bio-vid').removeClass('d-none');
          $('#bio-vid').attr('src', 'https://www.youtube-nocookie.com/embed/' + vidId + '?rel=0&modestbranding=1');
        } else {
          $('#bio-vid').addClass('d-none');
        }

        $('#bio-text').text(data['contender']['bio_text']);
        $('#bio-image').attr('src', '/storage/images/contenders/' + data['contender']['id'] + '.png');
        $('#contenderAge').html(data['age']);
        $('#contenderHeight').html(data['contender']['height']);
        $('#contenderWeight').html(data['contender']['weight']);
        $('#contenderReach').html(data['contender']['reach']);


        console.log(data);


      }).fail(function (err) {
        console.log(err);
        $('#dynamic-content').html('<p style="color:black;">Something went wrong. Please try again...</p>');
      });
    });

    $("#bio-modal").on('hidden.bs.modal', function (e) {
      $("#bio-modal iframe").attr("src", "");
    });

  });
