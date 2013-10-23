@extends( 'layouts.base' )

@section( 'title', trans( 'contestant.show_title', [ 'first_name' => $contestant->first_name, 'last_name' => $contestant->last_name ] ) )

@section( 'body' )

  <h1>{{ trans( 'contestant.show_title', [ 'first_name' => $contestant->first_name, 'last_name' => $contestant->last_name ] ) }}</h1>
@if ( $contestant->title )
  <p class="title">{{ $contestant->title }}</p>
@endif

  <p>{{ link_to_action( 'BidController@create', trans( 'bid.bid_button' ), [ 'contestant_id' => $contestant->id ], [ 'class' => 'donate-link btn' ] ) }}</p>

  <h2>{{ trans( 'contestant.stats_title_short', [ 'first_name' => $contestant->first_name ] ) }}</h2>
  @include( 'contestant.stats' )

@stop