<footer>
  <nav id="footer-nav">
    <ul>
      <li>{{ link_to_action( 'HomeController@showAbout', trans( 'global.nav_about' ) ) }}</li>
    @if ( $privacy_policy = Config::get( 'mustache.privacy_policy_url' ) )
      <li><a href="{{ $privacy_policy }}" rel="external">{{ trans( 'global.nav_privacy_policy' ) }}</a></li>
    @endif
    @if ( $terms = Config::get( 'mustache.terms_url' ) )
      <li><a href="{{ $terms }}" rel="external">{{ trans( 'global.nav_terms' ) }}</a></li>
    @endif
    </ul>
  </nav>
</footer>