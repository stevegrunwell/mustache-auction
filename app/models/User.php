<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

  /**
   * Users are never truly deleted
   */
  protected $softDeletes = true;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = array( 'password' );
  
  /**
   * Get the amount this user has bid on a given contestant
   */
  public function totalAmountBidOnContestant( $contestant_id ) {
    return DB::table( 'bids' )
      ->where( 'user_id', '=', $this->id )
      ->where( 'contestant_id', '=', $contestant_id )
      ->sum( 'amount' );
  }

  /**
   * Get the unique identifier for the user.
   *
   * @return mixed
   */
  public function getAuthIdentifier() {
    return $this->getKey();
  }

  /**
   * Get the password for the user.
   *
   * @return string
   */
  public function getAuthPassword() {
    return $this->password;
  }

  public function bids() {
    return $this->hasMany( 'Bid' );
  }

  public function getNameAttribute() {
    return trans( 'user.full_name', array( 'first_name' => $this->first_name, 'last_name' => $this->last_name ) );
  }

  /**
   * Get the e-mail address where password reminders are sent.
   *
   * @return string
   */
  public function getReminderEmail() {
    return $this->email;
  }

  /**
   * Never store plaintext passwords
   * @param str $value The password to be hashed
   */
  public function setPasswordAttribute( $value ) {
    $this->attributes['password'] = Hash::make( $value );
  }

  /**
   * Update the user's last_login value to be right now
   * WARNING: this will save any current changes to the user object!
   */
  public function touchLogin() {
    $this->last_login = date( 'Y-m-d H:i:s' );
    $this->save();
  }

  public static function getValidationRules( $form='update' ) {
    $rules = array(
      'email' => 'required|email|unique:users',
      'first_name' => 'required',
      'last_name' => 'required',
    );

    if ( $form == 'edit' ) {
      $rules = array_merge( $rules, array(
        'email' => sprintf( 'required|email|unique:users,email,%d', Auth::user()->id ),
        'password' => 'confirmed'
      ));

    } elseif ( $form == 'create' ) {
      $rules['password'] = 'required|min:6';
      $rules['accept_terms'] = 'accepted';
    }
    return $rules;
  }

}