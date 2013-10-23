@extends( 'layouts.base' )

@section( 'title', trans( 'user.edit_form_title' ) )

@section( 'body' )

  <div class="col">
    <h1>{{ trans( 'user.edit_form_title' ) }}</h1>
    {{ Form::model( $user, [ 'action' => 'UserController@update', 'method' => 'put' ] ) }}

      @include( 'messages.errors' )

      <ul class="form-list">
        <li>
          {{ Form::label( 'first_name', trans( 'user.first_name' ), [ 'class' => 'required' ] ) }}
          {{ Form::text( 'first_name' ) }}
        </li>
        <li>
          {{ Form::label( 'last_name', trans( 'user.last_name' ), [ 'class' => 'required' ] ) }}
          {{ Form::text( 'last_name' ) }}
        </li>
        <li>
          {{ Form::label( 'email', trans( 'user.email' ), [ 'class' => 'required' ] ) }}
          {{ Form::email( 'email' ) }}
        </li>
      </ul>

      <fieldset class="change-password">
        <h2>{{ trans( 'user.change_password_title' ) }}</h2>
        <p>{{ trans( 'user.change_password_body' ) }}</p>
        <ul class="form-list">
          <li>
            {{ Form::label( 'password', trans( 'user.new_password' ) ) }}
            {{ Form::password( 'password' ) }}
          </li>
          <li>
            {{ Form::label( 'password_confirmation', trans( 'user.confirm_password' ) ) }}
            {{ Form::password( 'password_confirmation' ) }}
          </li>
        </ul>
      </fieldset>

      <p class="form-submit">{{ Form::submit( trans( 'user.edit_form_submit' ) ) }}</p>

    {{ Form::close() }}
  </div><!-- .col -->

  <div id="bidding-history" class="col">
    <h2>{{ trans( 'bid.history_title' ) }}</h2>
  @if ( $user->bids )
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>{{ trans( 'bid.table_date' ) }}</th>
            <th>{{ trans( 'bid.table_amount' ) }}</th>
            <th>{{ trans( 'bid.table_contestant' ) }}</th>
            <th>{{ trans( 'bid.table_mustache' ) }}</th>
          </tr>
        </thead>
        <tbody>
        @foreach ( $user->bids as $bid )

          <tr>
            <td><time title="{{ $bid->created_at_timestamp }}">{{ $bid->created_at }}</time></td>
            <td>{{ BidHelper::format_amount( $bid->amount ) }}</td>
            <td><a href="{{ $bid->contestant->movember_url }}" rel="external">{{ $bid->contestant->name }}</a></td>
            <td>{{ $bid->mustache->name }}</td>
          </tr>

        @endforeach
        </tbody>
      </table>
    </div>
  @else
    <p class="empty-data">{{ trans( 'user.no_bids' ) }}</p>
  @endif

  </div><!-- .col -->

@stop