{{ trans( 'email/bid.new_title' ) }}
{{ PHP_EOL . PHP_EOL }}
{{ trans( 'email/bid.new_body', [ 'amount' => BidHelper::format_amount( $bid->amount ), 'mustache' => $bid->mustache->name, 'total' => BidHelper::format_amount( $bid->contestant->total_raised ) ] ) }}