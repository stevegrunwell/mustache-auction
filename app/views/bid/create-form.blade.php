@if ( Auction::isOpen() )

  {{ Form::open( [ 'action' => 'BidController@create' ] ) }}

    @include( 'messages.errors' )

    <ul class="mustache-list clearfix">
    @foreach ( Mustache::all() as $mustache )

      <li>
        <a href="#" data-mustache-id="{{ $mustache->id }}" role="button">
          <img src="{{ $mustache->image }}" alt="" />
          {{ $mustache->name }}
        </a>
      </li>

    @endforeach
    </ul>

    <ul class="form-list">
      <li{{ ( $contestant ? ' style="display: none;"' : '' ) }}>
        {{ Form::label( 'contestant_id', trans( 'bid.contestant_id' ), [ 'class' => 'required' ] ) }}
        {{ Form::select( 'contestant_id', Contestant::getContestantsAsArray( true ), $contestant->id ) }}
      </li>
      <li class="mustache-id">
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

@else

  <p>{{ trans( 'auction.msg_auction_closed' ) }}</p>

@endif