@extends( 'layouts.base' )

@section( 'title', trans( 'global.appname' ) )

@section( 'body' )

  <ul id="contestant-list" class="clearfix">
  @foreach ( $contestants as $contestant )

    <li>
      <h2>{{ $contestant->name }}</h2>
      <p class="amount">{{ trans( 'contestant.amount_raised', [ 'amount' => BidHelper::format_amount( $contestant->total_raised ) ] ) }}</p>
      <div class="amounts">
      @if ( $contestant->total_raised )

        <ul>
        @foreach ( $contestant->mustaches as $mustache )

          <li>
            {{ BidHelper::bar_graph( $mustache['percentage'] ) }}
            <p>
              <img src="{{ $mustache['image'] }}" alt="{{ $mustache['name'] }}" title="{{ $mustache['name'] }}" />
              <span class="percentage">{{ BidHelper::format_percentage( $mustache['percentage'] ) }}</span>
            </p>
            </p>
          </li>

        @endforeach
        </ul>

        <table>
          <thead>
            <tr>
              <th>{{ trans( 'mustache.table_header_mustache' ) }}</th>
              <th>{{ trans( 'mustache.table_header_amount' ) }}</th>
              <th>{{ trans( 'mustache.table_header_percentage' ) }}</th>
            </tr>
          </thead>
          <tbody>
          @foreach ( $contestant->mustaches as $mustache )

            <tr>
              <td><img src="{{ $mustache['image'] }}" alt="" /> {{ $mustache['name'] }}</td>
              <td>{{ BidHelper::format_amount( $mustache['total'] ) }}</td>
              <td>{{ BidHelper::format_percentage( $mustache['percentage'] ) }}</td>
            </tr>

          @endforeach
          </tbody>
        </table>
        {{ link_to_action( 'BidController@create', trans( 'bid.bid_button' ), [ 'contestant_id' => $contestant->id ], [ 'class' => 'btn' ] ) }}
      </div><!-- .amounts -->

    @else

      <p class="empty-data">{{ trans( 'contestant.no_bids', [ 'contestant' => $contestant->first_name, 'link' => action( 'BidController@create', [ 'contestant_id' => $contestant->id ] ) ] ) }}</p>

    @endif
    </li>

  @endforeach
  </ul>

@stop