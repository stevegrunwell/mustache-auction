@extends( 'layouts.base' )

@section( 'document-title' )
  <title>{{ trans( 'global.appname' ) . ' | ' . strip_tags( trans( 'global.tagline' ) ) }}</title>
  <meta name="description" content="{{{ trans( 'global.site_description' ) }}}" />
@stop

@section( 'body' )

  <ul id="contestant-list" class="clearfix">
  @foreach ( $contestants as $contestant )

    <li>
      <a href="{{ $contestant->movember_url }}" rel="external"><img src="{{ $contestant->photo }}" alt="{{{ $contestant->name }}}" /></a>
      <h2>{{ $contestant->name }}</h2>
    @if ( $contestant->title )
      <p class="title">{{ $contestant->title }}</p>
    @endif
      <p class="amount">{{ trans( 'contestant.amount_raised', [ 'amount' => BidHelper::format_amount( $contestant->total_raised ) ] ) }}</p>
      <ul class="actions">
        <li>{{ link_to_action( 'ContestantController@show', trans( 'contestant.view_stats_btn' ), [ 'contestant_id' => $contestant->id ], [ 'class' => 'stats-link btn' ] ) }}</a></li>
      @if ( $auction_open )
        <li>{{ link_to_action( 'BidController@create', trans( 'bid.bid_button' ), [ 'contestant_id' => $contestant->id ], [ 'class' => 'donate-link btn' ] ) }}</li>
      @endif
      </ul>
    </li>

  @endforeach
  </ul>

@stop