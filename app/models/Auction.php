<?php

use Carbon\Carbon;

class Auction extends Eloquent {

  /**
   * Get the date/time the auction closes
   */
  public static function closesAt() {
    if ( $end_date = Config::get( 'mustache.auction_ends_at' ) ) {
      $dt = new Carbon( $end_date );
      return $dt->format( trans( 'auction.closes_at_format' ) );
    }
    return '';
  }

  /**
   * Is the auction open?
   * @return bool
   */
  public static function isOpen() {
    if ( $end_date = Config::get( 'mustache.auction_ends_at' ) ) {
      return ( Carbon::now()->lt( new Carbon( $end_date ) ) );
    }
    return true;
  }

}