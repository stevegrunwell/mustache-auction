<?php

class Contestant extends Eloquent {

  protected $softDeletes = true;

  protected $table = 'contestants';

  public function bids() {
    return $this->hasMany( 'Bid' );
  }

  /**
   * Return bids grouped by the User who made them
   */
  public function getBiddersAttribute() {
    $contestant_id = $this->id;
    return User::join( 'bids', 'bids.user_id', '=', 'users.id' )
      ->select( 'users.*' )
      ->where( 'bids.contestant_id', '=', $this->id )
      ->with( array( 'bids' => function ( $query ) use ( $contestant_id ) {
        return $query->where( 'contestant_id', '=', $contestant_id );
      } ) )
      ->groupBy( 'users.id' )
      ->get();
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

  public function getPhotoAttribute() {
    $default = asset( 'img/avatar-default.jpg' );
    return ( $this->attributes['photo'] ? $this->attributes['photo'] : $default );
  }

  public function getTotalRaisedAttribute() {
    return DB::table( 'bids' )->where( 'contestant_id', $this->id )->sum( 'amount' );
  }

  public function getTwitterUrlAttribute() {
    return ( $this->attributes['twitter_handle'] ? sprintf( 'https://twitter.com/%s', $this->twitter_handle ) : '' );
  }

  public function getWinningMustacheAttribute() {
    return Mustache::select( DB::raw( 'mustaches.*, SUM(bids.amount) as total' ) )
      ->join( 'bids', 'bids.mustache_id', '=', 'mustaches.id' )
      ->where( 'bids.contestant_id', '=', $this->id )
      ->groupBy( 'mustaches.id' )
      ->orderBy( 'total', 'desc' )
      ->first();
  }

  public function sendTotalsEmail() {
    if ( $this->contestant->email ) {
      Mail::send( array( 'emails.reports.contestant_totals', 'emails.reports.contestant_totals_plain' ), array( 'contestant' => $this ), function ( $message ) {
        $message->to( $this->email, $this->name );
        $message->subject( trans( 'email/reports.contestant_totals_subject' ) );
      });
    }
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