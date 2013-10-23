@extends( 'layouts.base' )

@section( 'title', trans( 'contestant.show_title' ) )

@section( 'body' )

  <h1>{{ trans( 'contestant.show_title', [ 'first_name' => $contestant->first_name, 'last_name' => $contestant->last_name ] ) }}</h1>
@if ( $contestant->title )
  <p class="title">{{ $contestant->title }}</p>
@endif

  @include( 'contestant.stats' )

@stop