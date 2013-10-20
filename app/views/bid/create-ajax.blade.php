<h2>{{ ( $contestant ? trans( 'bid.create_form_title_with_name', [ 'contestant' => $contestant->first_name ] ) : trans( 'bid.create_form_title' ) ) }}</h2>
@include( 'bid.create-form' )