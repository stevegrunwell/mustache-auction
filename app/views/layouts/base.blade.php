<!DOCTYPE html>
<!--[if IE 8]><html class="no-js ie8" lang="{{ Config::get('app.locale') }}"><![endif]-->
<!--[if (gte IE 9) | !(IE)]><!--><html class="no-js" lang="{{ Config::get('app.locale') }}"><!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
@section( 'document-title' )
<title>@yield( 'title' ) . ' | ' . trans( 'global.appname' )</title>
@show
<link href="{{ asset( 'css/app.css' ) }}" type="text/css" rel="stylesheet" media="all" />
<script src="{{ asset( 'js/modernizr.min.js' ) }}"></script>
@if ( $ga_profile = Config::get( 'mustache.ga_profile_id' ) )
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '{{ $ga_profile }}', '{{ Config::get( 'mustache.ga_tracking_domain' ) }}');
  ga('send', 'pageview');
</script>
@endif
</head>
<body>
  <div id="wrapper">
    @include( 'layouts.header' )
    <div id="content" role="main">
      @include( 'messages.flash' )
      @yield( 'body' )
    </div><!-- #content -->
  </div><!-- #wrapper -->

  @include( 'layouts.footer' )
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="{{ asset( 'js/jquery.modal.min.js?v=0.5.4' ) }}"></script>
<script src="{{ asset( 'js/application.js' ) }}"></script>
</body>
</html>