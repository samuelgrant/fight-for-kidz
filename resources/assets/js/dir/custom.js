function showExperience() {
    document.getElementById('exeperience').style.display = 'block';
}

function hideExperience() {
    document.getElementById('exeperience').style.display = 'none';
}

function showCriminal() {
    document.getElementById('criminal').style.display = 'block';
}

function hideCriminal() {
    document.getElementById('criminal').style.display = 'none';
}

function showOther() {
    document.getElementById('otherCheck').checked ? document.getElementById('other').style.display = 'block' : document.getElementById('other').style.display = 'none';
}

function showHand() {
    document.getElementById('hand').style.display = 'block';
}

function hideHand() {
    document.getElementById('hand').style.display = 'none';
}

function showInjury() {
    document.getElementById('injury').style.display = 'block';
}

function hideInjury() {
    document.getElementById('injury').style.display = 'none';
}

function showMeds() {
    document.getElementById('meds').style.display = 'block';
}

function hideMeds() {
    document.getElementById('meds').style.display = 'none';
}

function showReason() {
    document.getElementById('reason').style.display = 'block';
}

function hideReason() {
    document.getElementById('reason').style.display = 'none';
}

function showConcussed() {
    document.getElementById('concussed').style.display = 'block';
}

function hideConcussed() {
    document.getElementById('concussed').style.display = 'none';
}

$("document").ready(function() {
    $('.slick-sponsors').slick({
        speed: 10000,
        autoplay: true,
        autoplaySpeed: 0,
        cssEase: 'linear',
        slidesToShow: 1,
        slidesToScroll: 1,
        variableWidth: true,
        arrows: false,
        draggable: false,
        pauseOnHover: false,
        touchMove: false
    });
});

/* Facebook */
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;

    js = d.createElement(s);
    js.id = id;
    js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.1';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

/* Smooth Scroll */
$(document).ready(function() {
    // Add smooth scrolling to all links
    $("a").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top - 100
            }, 800, function() {});
        } // End if
    });
});


// returns youtube video id using the full length URL query string with the given variable - used with contender bio and fight videos
function getQueryVariableFullLength(url, variable) {
    var query = url.split("?")[1];

    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) {
            return pair[1];
        }
    }
    return (false);
}

// returns youtube video id using the shortened UQL query string - used with contender bio and fight videos
function getQueryVariableShortened(url) {

    return url.split("/")[3];
}

$(document).ready(function() {
    $('.bio-view-button').on('click', function(e) {

        var url = '/contenders/bio/' + $(this).attr('data-contenderId');

        $.ajax({
            url: url,
            method: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json'
        }).done(function(data) {
            //Calls the setBioImageBorder Method
            setBioImageBorder(data);

            $('#first-name').text(data.first_name);
            $('#last-name').text(data.last_name);

            // show nickname if one is set
            if (data.nickname != null) {
                $('#nickname').text('\'' + data.nickname + '\'');
            }

            // get video id from donate_url
            if (data.bio_url != null) {

                if (data.bio_url.indexOf("=") > -1) {
                    vidId = getQueryVariableFullLength(data.bio_url, 'v');
                } else if (data.bio_url.indexOf("u.b") > -1) {
                    vidId = getQueryVariableShortened(data.bio_url);
                }

                $('#bio-vid').removeClass('d-none');
                $('#bio-vid').attr('src', 'https://www.youtube-nocookie.com/embed/' + vidId + '?rel=0&modestbranding=1');
            } else {
                $('#bio-vid').addClass('d-none');
            }

            if (data.bio_text != null) {
                $("#bio-label").text("About Me:")
            }
            $('#bio-text').text(data.bio_text);

            //checks to see if the image exists and uses it to set the contender image otherwise sets it to default
            $.get('/storage/images/contenders/' + data.id + '.png')
                .done(function() {
                    $("#bio-image").attr('src', '/storage/images/contenders/' + data.id + '.png');
                }).fail(function() {
                    $("#bio-image").attr("src", "/storage/images/contenders/0.png");
                })

            //checks to see if the image exists and uses it to set the sponsor image otherwise sets it to default
            if (data.sponsor_id != null) {
                $("#bio-sponsor-div").removeClass('d-none');
                $.get('/storage/images/sponsors/' + data.sponsor_id + '.png').done(function() {
                    $("#bio-sponsor").attr('src', '/storage/images/sponsors/' + data.sponsor_id + '.png');
                }).fail(function() {
                    $("#bio-sponsor").attr("src", "/storage/images/sponsors/0.png");
                })
            } else if (data.sponsor_id == null) {
                $("#bio-sponsor-div").addClass('d-none');
            }
            if (data.sponsor_url != null) {
                $("#sponsorLink").attr('href', data.sponsor_url);
            }
            $('#contenderAge').html(data.age);
            $('#contenderHeight').html(data.height);
            $('#contenderWeight').html(data.weight);
            $('#contenderReach').html(data.reach);
        }).fail(function(err) {
            console.error(`Error getting bout information in the custom/bio-view-button method: ${err}`);
            $('.dynamic-content').html('<p class="my-auto" style="color:white; text-align: center;"><i class="fa fa-exclamation-triangle"></i>&nbsp;Something went wrong. ' +
                'Please try again...</p> <div class="modal-footer contender-modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></div>');
        });
    });

    $("#bio-modal").on('hidden.bs.modal', function(e) {
        $("#bio-modal iframe").attr("src", "");
    });
});

function setBioImageBorder(data) {
    if (data.team == 'red') {
        $("#bio-image").css({
            "border": "4px solid red"
        });
    } else if (data.team == 'blue') {
        $("#bio-image").css({
            "border": "4px solid blue"
        });
    }
}

function auctionItemModal(id) {
    $.ajax({
        method: "get",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `/auction/${id}`
    }).done((data) => {
        //Dynamically populate the modal with item info
        $("#auctionItemName").text(data.name);
        $("#auctionItemDescription").text(data.desc);

        //Table text
        if (data.donor != null || data.donor_url != null) {
            $("#auctionItemInfo").text("Item Info:")
        }

        if (data.donor != null) {
            $("#auctionItemDonorSpan").text(data.donor);
        } else if (data.donor == null) {
            $("#auctionTableDonor").remove();
        }

        if (data.donor_url != null) {
            $("#auctionItemDonorUrlSpan").text(data.donor_url);
        } else if (data.donor_url == null) {
            $("#auctionTableDonorUrl").remove();
        }

        //checks to see if the image exists and uses it to set the auctionItemImage otherwise sets it to default
        $.get("/storage/images/auction/" + data.id + ".png").done(function() {
            $("#auctionItemImage").attr("src", "/storage/images/auction/" + data.id + ".png");
        }).fail(function() {
            $("#auctionItemImage").attr("src", "/storage/images/auction/0.png");
        });

        //Display the modal
        $("#auctionItemModal").modal('show');
    }).fail(function(err) {
        console.error(`Error getting auction information in the custom/auctionItemModal method: ${err}`);
    });
}

//gets information to dynamically populate fight modal
$(document).ready(function() {
    $('.fight-view-btn').on('click', function(e) {

        var url = '/bout/watch-fight/' + $(this).data('boutId');

        $.ajax({
            url: url,
            method: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json'
        }).done(function(data) {

            $('#blue-corner').text(data['blue_contender']);
            $('#red-corner').text(data['red_contender']);

            // get video id from video_url  
            if (data['video_URL'] != null) {
                if (data['video_URL'].indexOf("=") > -1) {
                    vidId = getQueryVariableFullLength(data['video_URL'], 'v');
                } else if (data['video_URL'].indexOf("u.b") > -1) {
                    vidId = getQueryVariableShortened(data['video_URL']);
                }

                $('#fight-vid').removeClass('d-none');
                $('#fight-vid').attr('src', 'https://www.youtube-nocookie.com/embed/' + vidId + '?rel=0&modestbranding=1');
            } else {
                $('#fight-vid').addClass('d-none');
            }
        }).fail(function(err) {
            console.error(`Error getting bout and contender info in the custom/fight-view-btn method: ${err}`);
            $('.dynamic-content').html('<p class="my-auto" style="color:white; text-align: center;"><i class="fa fa-exclamation-triangle"></i>&nbsp;Something went wrong. ' +
                'Please try again...</p> <div class="modal-footer contender-modal-footer"><button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button></div>');
        });
    });

    $("#fight-video-modal").on('hidden.bs.modal', function(e) {
        $("#fight-video-modal iframe").attr("src", "");
    });
});