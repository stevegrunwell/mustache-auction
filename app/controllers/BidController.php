<?php

class BidController extends BaseController {

  public function create() {
    $contestant = Contestant::find( Input::get( 'contestant_id' ) );
    if ( ! Auth::check() ) {
      return View::make( ( Request::ajax() ? 'user.login-ajax' : 'user.create' ) );
    }
    return View::make( ( Request::ajax() ? 'bid.create-ajax' : 'bid.create' ) )->with( 'contestant', $contestant );
  }

  public function store() {
    $input = Input::get();
    if ( isset( $input['amount'] ) ) {
      $input['amount'] = floatval( preg_replace( '/[^0-9\.]/', '', $input['amount'] ) );
    }
    $validation = Validator::make( $input, Bid::getValidationRules( 'create' ) );
    if ( $validation->fails() ) {
      return Redirect::back()->withErrors( $validation )->withInput();
    }

    // Build the Bid object
    $bid = new Bid;
    $bid->user_id = Auth::user()->id;
    $bid->contestant_id = $input['contestant_id'];
    $bid->mustache_id = $input['mustache_id'];
    $bid->amount = $input['amount'];

    if ( $bid->save() ) {
      $bid->sendNotificationEmail();
      return Redirect::to( '/' )->with( 'success', trans( 'bid.msg_bid_successfully' ) );
    } else {
      return Redirect::back()->with( 'error', trans( 'bid.msg_bid_error' ) );
    }
  }

}