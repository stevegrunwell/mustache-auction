@if ( Session::has( 'success' ) && Session::get( 'success' ) !== true )
  <div class="flash success">{{ Session::get( 'success' ) }}</div>
@endif

@if ( Session::has( 'message' ) )
  <div class="flash">{{ Session::get( 'message' ) }}</div>
@endif

@if ( Session::has( 'error' ) )
  <div class="flash error">{{ ( Session::get( 'reason' ) ? trans( Session::get( 'reason' ) ) : Session::get( 'error' ) ) }}</div>
@endif