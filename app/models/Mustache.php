<?php

class Mustache extends Eloquent {

  protected $softDeletes = true;

  protected $table = 'mustaches';

  /**
   * Return all mustache styles in an array ( id => name )
   * @param bool $with_empty Include a "Select..."-type option at the beginning?
   * @return array
   */
  public static function getMustachesAsArray( $with_empty=false ) {
    $mustaches = array();
    if ( $with_empty ) {
      $mustaches[0] = trans( 'mustache.empty_select_option' );
    }
    foreach ( Mustache::all() as $mustache ) {
      $mustaches[ $mustache->id ] = $mustache->name;
    }
    return $mustaches;
  }

}