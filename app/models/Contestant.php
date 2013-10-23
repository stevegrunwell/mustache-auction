<?php

class Contestant extends Eloquent {

  protected $softDeletes = true;

  protected $table = 'contestants';

  public function bids() {
    return $this->hasMany( 'Bid' );
  }

  public function getMustachesAttribute() {
    $bids = array();
    $totals = array();
    $grand_total = 0;
    $mustaches = array();

    foreach ( $this->bids as $bid ) {
      $bids[ $bid->mustache_id ][] = $bid;
      $totals[ $bid->mustache_id ][] = $bid->amount;
      $grand_total += $bid->amount;
    }

    foreach ( Mustache::all() as $mustache ) {
      $total = ( isset( $totals[ $mustache->id ] ) ? array_sum( $totals[ $mustache->id ] ) : 0 );
      $mustaches[ $mustache->id ] = array(
        'name' => $mustache->name,
        'image' => $mustache->image,
        'total' => $total,
        'percentage' => ( $grand_total > 0 ? ( $total / $grand_total ) : 0 ),
        'bids' => ( isset( $bids[ $mustache->id ] ) ? $bids[ $mustache->id ] : array() )
      );
    }

    return $mustaches;
  }

  public function getNameAttribute() {
    return trans( 'contestant.name_format', array( 'first_name' => $this->first_name, 'last_name' => $this->last_name ) );
  }

  public function getTotalRaisedAttribute() {
    return DB::table( 'bids' )->where( 'contestant_id', $this->id )->sum( 'amount' );
  }

  /**
   * Return all mustache styles in an array ( id => name )
   * @param bool $with_empty Include a "Select..."-type option at the beginning?
   * @return array
   */
  public static function getContestantsAsArray( $with_empty = false ) {
    $contestants = array();
    if ( $with_empty ) {
      $contestants[0] = trans( 'contestant.empty_select_option' );
    }
    foreach ( Contestant::all() as $contestant ) {
      $contestants[ $contestant->id ] = $contestant->name;
    }
    return $contestants;
  }

}