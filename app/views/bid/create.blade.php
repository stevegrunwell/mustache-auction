@extends( 'layouts.base' )

@section( 'title', trans( 'bid.create_form_title' ) )

@section( 'body' )

  <h1>{{ ( $contestant ? trans( 'bid.create_form_title_with_name', [ 'contestant' => $contestant->first_name ] ) : trans( 'bid.create_form_title' ) ) }}</h1>
  {{ Form::open( [ 'action' => 'BidController@create' ] ) }}

    @include( 'messages.errors' )

    <ul class="form-list">
      <li{{ ( $contestant ? ' style="display: none;"' : '' ) }}>
        {{ Form::label( 'contestant_id', trans( 'bid.contestant_id' ), [ 'class' => 'required' ] ) }}
        {{ Form::select( 'contestant_id', Contestant::getContestantsAsArray( true ), $contestant->id ) }}
      </li>
      <li>
        {{ Form::label( 'mustache_id', trans( 'bid.mustache_id' ), [ 'class' => 'required' ] ) }}
        {{ Form::select( 'mustache_id', Mustache::getMustachesAsArray( true ) ) }}
      </li>
      <li>
        {{ Form::label( 'amount', trans( 'bid.amount' ), [ 'class' => 'required' ] ) }}
        {{ Form::text( 'amount' ) }}
      </li>
    </ul>

    <p class="form-submit">{{ Form::submit( trans( 'bid.create_form_submit' ) ) }}</p>

  {{ Form::close() }}

@stop