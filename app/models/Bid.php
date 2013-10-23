<?php

use Carbon\Carbon;

class Bid extends Eloquent {

  protected $softDeletes = true;

  protected $table = 'bids';

  public function contestant() {
    return $this->belongsTo( 'contestant' );
  }

  public function getCreatedAtAttribute() {
    $date = new Carbon( $this->attributes['created_at'] );
    return $date->format( trans( 'bid.date_format' ) );
  }

  public function getCreatedAtTimestampAttribute() {
    $date = new Carbon( $this->attributes['created_at'] );
    return $date->toISO8601String();
  }

  public function getMustacheAttribute() {
    return Mustache::find( $this->attributes['mustache_id'] );
  }

  public function user() {
    return $this->belongsTo( 'user' );
  }

  public static function getValidationRules( $form='edit' ) {
    return array(
      'contestant_id' => 'required|exists:contestants,id',
      'mustache_id' => 'required|exists:mustaches,id',
      'amount' => 'required|numeric|min:0.01'
    );
  }
}