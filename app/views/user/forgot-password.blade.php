@extends( 'layouts.base' )

@section( 'title', trans( 'user.forgot_password_title' ) )

@section( 'body' )

  @if ( Session::has( 'success' ) )

    <h1>{{ trans( 'user.forgot_password_title' ) }}</h1>
    <p>{{ trans( 'user.forgot_password_email_sent', [ 'email' => Session::get( 'email' ) ] ) }}</p>

  @else

    {{ Form::open( [ 'action' => 'UserController@forgotPassword' ] ) }}

      <h1>{{ trans( 'user.forgot_password_title' ) }}</h1>
      <p>{{ trans( 'user.forgot_password_body' ) }}</p>

      @include( 'messages.errors' )

      <ul class="form-list">
        <li>
          {{ Form::label( 'email', trans( 'user.email' ), [ 'class' => 'required' ] ) }}
          {{ Form::email( 'email', $email ) }}
        </li>
      </ul>

      <p class="form-submit">{{ Form::submit( trans( 'user.forgot_password_btn' ) ) }}</p>

    {{ Form::close() }}

  @endif

@stop