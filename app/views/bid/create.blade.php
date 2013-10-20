@extends( 'layouts.base' )

@section( 'title', trans( 'bid.create_form_title' ) )

@section( 'body' )

  <h1>{{ ( $contestant ? trans( 'bid.create_form_title_with_name', [ 'contestant' => $contestant->first_name ] ) : trans( 'bid.create_form_title' ) ) }}</h1>
  @include( 'bid.create-form' )

@stop