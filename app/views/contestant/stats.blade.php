<div class="contestant-stats">
@if ( $contestant->total_raised )

  <ul>
  @foreach ( $contestant->mustaches as $mustache )

    <li style="width: {{ 100 / count( $contestant->mustaches ) }}%;">
      {{ BidHelper::bar_graph( $mustache['percentage'], $mustache['total'] ) }}
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
        <th class="amount">{{ trans( 'mustache.table_header_amount' ) }}</th>
        <th class="percentage">{{ trans( 'mustache.table_header_percentage' ) }}</th>
      </tr>
    </thead>
    <tbody>
    @foreach ( $contestant->mustaches as $mustache )

      <tr>
        <td><img src="{{ $mustache['image'] }}" alt="" /> {{ $mustache['name'] }}</td>
        <td class="amount">{{ BidHelper::format_amount( $mustache['total'] ) }}</td>
        <td class="percentage">{{ BidHelper::format_percentage( $mustache['percentage'] ) }}</td>
      </tr>

    @endforeach
    </tbody>
  </table>
</div><!-- .amounts -->

@else

<p class="empty-data">{{ trans( 'contestant.no_bids', [ 'contestant' => $contestant->first_name, 'link' => action( 'BidController@create', [ 'contestant_id' => $contestant->id ] ) ] ) }}</p>

@endif