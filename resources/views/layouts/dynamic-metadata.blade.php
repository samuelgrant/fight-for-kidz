@php
if(Request::is('contact-us') || Request::is('apply-to-fight') || Request::is('event/*')) {
    $meta = App\SiteSetting::getPageMeta(Request::path());
} else {
    $meta = App\SiteSetting::getSiteMeta();
}
@endphp

<title>{{$meta->seo_title ?? 'Fight for Kidz'}}</title>

<!--- SEO: Metadata --->
<meta name="author" content="{{$meta->seo_author}}">
<meta name="description" content="{{$meta->seo_description}}">
<meta name="keywords" content="{{$meta->seo_keywords}}">
<meta name="theme-color" content="{{$meta->seo_theme_color}}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!--- SEO: Open Graph --->
<meta property="og:url" content="{{Request::url()}}">
<meta property="og:title" content="{{$meta->seo_title ?? 'Fight for Kidz'}}">
<meta property="og:description" content="{{$meta->seo_description}}">
<meta property="og:image" content="/storage/images/f4k_logo_noyear.png">
<meta property="og:type" content="website">

<!--- SEO: Twitter --->
<meta name="twitter:card" content="summary">