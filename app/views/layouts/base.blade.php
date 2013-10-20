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