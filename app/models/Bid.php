<?php

use Carbon\Carbon;

class Bid extends Eloquent {

  protected $softDeletes = true;

  protected $table = 'bids';

  public function contestant() {
    return $this->belongsTo( 'Contestant' );
  }

  public function getCreatedAtAttribute() {
    $date = new Carbon( $this->attributes['created_at'] );
    return $date->format( trans( 'bid.date_format' ) );
  }

  public function getCreatedAtTimestampAttribute() {
    $date = new Carbon( $this->attributes['created_at'] );
    return $date->toISO8601String();
  }

  public function getDateAttribute() {
    $date = new Carbon( $this->attributes['created_at'] );
    return $date->format( trans( 'bid.date_format_with_time' ) );
  }

  public function getMustacheAttribute() {
    return Mustache::find( $this->attributes['mustache_id'] );
  }

  public function sendNotificationEmail() {
    if ( $this->contestant->email ) {
      Mail::send( array( 'emails.bid.new', 'emails.bid.new_plain' ), array( 'bid' => $this ), function ( $message ) {
        if ( $from_email = Config::get( 'mustache.alerts_email_address', false ) ) {
          $message->from( $from_email, Config::get( 'mustache.alerts_email_name', trans( 'global.appname' ) ) );
        }
        $message->to( $this->contestant->email, $this->contestant->name );
        $message->subject( trans( 'email/bid.new_subject' ) );
      });
    }
  }

  public function user() {
    return $this->belongsTo( 'User' );
  }

  public static function getValidationRules( $form='edit' ) {
    return array(
      'contestant_id' => 'required|exists:contestants,id',
      'mustache_id' => 'required|exists:mustaches,id',
      'amount' => 'required|numeric|min:0.01'
    );
  }
}