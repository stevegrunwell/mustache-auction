@extends( 'layouts.base' )

@section( 'title', trans( 'global.appname' ) )

@section( 'body' )

  <ul id="contestant-list" class="clearfix">
  @foreach ( $contestants as $contestant )

    <li>
      <h2>{{ $contestant->name }}</h2>
    @if ( $contestant->title )
      <p class="title">{{ $contestant->title }}</p>
    @endif
      <p class="amount">{{ trans( 'contestant.amount_raised', [ 'amount' => BidHelper::format_amount( $contestant->total_raised ) ] ) }}</p>
      <ul class="actions">
        <li>{{ link_to_action( 'ContestantController@show', trans( 'contestant.view_stats_btn' ), [ 'contestant_id' => $contestant->id ], [ 'class' => 'stats-link btn' ] ) }}</a></li>
        <li>{{ link_to_action( 'BidController@create', trans( 'bid.bid_button' ), [ 'contestant_id' => $contestant->id ], [ 'class' => 'donate-link btn' ] ) }}</li>
      </ul>
    </li>

  @endforeach
  </ul>

@stop