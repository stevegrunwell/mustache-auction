<?php

class BidController extends BaseController {

  public function create() {
    $contestant = Contestant::find( Input::get( 'contestant_id' ) );
    return View::make( ( Request::ajax() ? 'bid.create-ajax' : 'bid.create' ) )->with( 'contestant', $contestant );
  }

  public function store() {
    $validation = Validator::make( Input::get(), Bid::getValidationRules( 'create' ) );
    if ( $validation->fails() ) {
      return Redirect::back()->withErrors( $validation )->withInput();
    }

    // Build the Bid object
    $bid = new Bid;
    $bid->user_id = Auth::user()->id;
    $bid->contestant_id = Input::get( 'contestant_id' );
    $bid->mustache_id = Input::get( 'mustache_id' );
    $bid->amount = Input::get( 'amount' );

    if ( $bid->save() ) {
      return Redirect::to( '/' )->with( 'success', trans( 'bid.msg_bid_successfully' ) );
    } else {
      return Redirect::back()->with( 'error', trans( 'bid.msg_bid_error' ) );
    }
  }

}