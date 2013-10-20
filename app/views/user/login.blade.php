@extends( 'layouts.base' )

@section( 'title', trans( 'user.login_form_title' ) )

@section( 'body' )

  <h1>{{ trans( 'user.login_form_title' ) }}</h1>

  @include( 'user.login-form' )

@stop