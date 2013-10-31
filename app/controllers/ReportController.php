<?php

class ReportController extends BaseController {
  
  public function index() {
    return View::make( 'reports.index' );
  }

  public function contestantTotals( $id ) {
    return View::make( 'reports/contestant-totals.show' )->with( 'contestant', Contestant::find( $id ) );
  }

}