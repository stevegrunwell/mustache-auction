<h2>{{ trans( 'contestant.stats_title', [ 'first_name' => $contestant->first_name, 'last_name' => $contestant->last_name ] ) }}</h2>
@include( 'contestant.stats' )