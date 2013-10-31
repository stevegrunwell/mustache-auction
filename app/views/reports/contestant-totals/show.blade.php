@extends( 'layouts.base' )

@section( 'title', trans( 'reports.contestant_totals_title', [ 'first_name' => $contestant->first_name, 'last_name' => $contestant->last_name ] ) )

@section( 'body' )

  <h1>{{ trans( 'reports.contestant_totals_title', [ 'first_name' => $contestant->first_name, 'last_name' => $contestant->last_name ] ) }}</h1>
  {{ ReportHelper::generatedAt() }}

  @if ( $contestant->total_raised )


    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>{{ trans( 'reports.contestant_totals_bid_name' ) }}</th>
            <th>{{ trans( 'reports.contestant_totals_bid_email' ) }}</th>
            <th class="amount">{{ trans( 'reports.contestant_totals_bid_amount' ) }}</th>
          </tr>
        </thead>

        <tfoot>
          <tr class="totals">
            <td colspan="2">{{ trans( 'reports.contestant_totals_total' ) }}</td>
            <td class="amount">{{ BidHelper::format_amount( $contestant->total_raised, false ) }}</td>
        </tfoot>

        <tbody>
        @foreach ( $contestant->bidders as $user )

          <tr>
            <td>
              {{ $user->name }}
              <div class="table-wrap">
                <table class="bids">
                  <thead>
                    <tr>
                      <th>{{ trans( 'reports.contestant_totals_pledge_date' ) }}</th>
                      <th class="amount">{{ trans( 'reports.contestant_totals_pledge_amount' ) }}</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach ( $user->bids as $bid )
                    <tr>
                      <td>{{ $bid->date }}</td>
                      <td class="amount">{{ BidHelper::format_amount( $bid->amount, false ) }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </td>
            <td><a href="mailto:{{{ $user->email }}}">{{ $user->email }}</a></td>
            <td class="amount">{{ BidHelper::format_amount( $user->totalAmountBidOnContestant( $contestant->id ), false ) }}</td>
          </tr>

        @endforeach
        </tbody>
      </table>
    </div>

  @else

    <p class="empty-data">{{ trans( 'reports.contestant_totals_empty_data', [ 'first_name' => $contestant->first_name ] ) }}</p>

  @endif

@stop