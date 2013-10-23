<?php

class ContestantController extends BaseController {
  
  public function show( $id ) {
    $contestant = Contestant::find( $id );
    return View::make( ( Request::ajax() ? 'contestant.stats-ajax' : 'contestant.show' ) )->with( 'contestant', $contestant );
  }
  
}