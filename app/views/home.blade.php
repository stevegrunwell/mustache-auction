@extends( 'layouts.base' )

@section( 'document-title' )
  <title>{{ trans( 'global.appname' ) . ' | ' . strip_tags( trans( 'global.tagline' ) ) }}</title>
  <meta name="description" content="{{{ trans( 'global.site_description' ) }}}" />
@stop

@section( 'body' )

  @if ( ! Auth::check() )
    <h2>{{ trans( 'static/home.title' ) }}</h2>
    {{ trans( 'static/home.content', [ 'login_link' => action( 'UserController@create' ) ] ) }}
    @if ( $ends_at = Auction::closesAt() )
      {{ trans( 'static/home.ends_at', [ 'ends_at' => Auction::closesAt() ] ) }}
    @endif
  @endif

  <h2>{{ trans( 'contestant.list_title' ) }}</h2>
  <ul id="contestant-list" class="clearfix">
  @foreach ( $contestants as $contestant )

    <li>
      <a href="{{ $contestant->movember_url }}" rel="external"><img src="{{ $contestant->photo }}" alt="{{{ $contestant->name }}}" /></a>
      <h3>{{ $contestant->name }}</h3>
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