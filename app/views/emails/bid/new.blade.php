@extends( 'layouts.email' )

@section( 'body' )

  <h1>{{ trans( 'email/bid.new_title' ) }}</h1>
  <p>{{ trans( 'email/bid.new_body', [ 'amount' => BidHelper::format_amount( $bid->amount ), 'mustache' => $bid->mustache->name, 'total' => BidHelper::format_amount( $bid->contestant->total_raised ) ] ) }}</p>

@stop