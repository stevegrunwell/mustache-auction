<header role="masthead">
  <a href="{{ action( 'HomeController@index' ) }}" id="site-logo"><img src="{{ asset( 'img/logo.png' ) }}" alt="{{ trans( 'global.appname' ) }}" /></a>
  <nav id="user-nav">
    <ul>
    @if ( Auth::check() )
      <li class="welcome">{{ trans( 'user.hello_firstname', [ 'first_name' => Auth::user()->first_name ] ) }}</li>
      <li>{{ link_to_action( 'UserController@edit', trans( 'user.navigation_profile' ) ) }}</li>
      <li>{{ link_to_action( 'UserController@logout', trans( 'user.navigation_logout' ) ) }}</li>
    @else
      <li>{{ link_to_action( 'UserController@create', trans( 'user.navigation_signup_login' ) ) }}</li>
    @endif
    </ul>
  </nav>
</header>