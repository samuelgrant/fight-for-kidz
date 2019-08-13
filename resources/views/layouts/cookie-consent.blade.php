@if(Cookie::get('cookieconsent') === null)
<div id="cookieConsent" class="fixed-bottom alert alert-cookies alert-dismissible fade show d-none d-md-block" role="alert">
    <img src="/storage/images/f4k_logo_noyear.png" class="float-left d-none d-lg-block" alt="Footer Logo" />
    <button type="button" class="btn btn-primary bg-blue float-right" onclick="acceptCookies();">
            <span aria-hidden="true">Accept</span>
    </button>
    <span>We make use of cookies on this site to provide you with a better browsing experince.</span>
</div>

<script>
    function acceptCookies() {
        $.ajax({
            type: 'post',
            url: '/accept-cookies'
        }).done(() => {
            $("#cookieConsent").remove();
        }).fail((err) => {
            console.error(err.responseText);
        })
    }
</script>
@endif