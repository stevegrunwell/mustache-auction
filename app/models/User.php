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
    }
    return $rules;
  }

}