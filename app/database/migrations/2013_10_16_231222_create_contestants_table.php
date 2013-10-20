<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestantsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('contestants', function(Blueprint $table)
    {
      $table->increments( 'id' );
      $table->string( 'first_name' );
      $table->string( 'last_name' );
      $table->string( 'title' );
      $table->text( 'bio' )->nullable();
      $table->string( 'photo' )->nullable();
      $table->string( 'twitter_url' )->nullable();
      $table->string( 'movember_url' )->nullable();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop( 'contestants' );
  }

}
