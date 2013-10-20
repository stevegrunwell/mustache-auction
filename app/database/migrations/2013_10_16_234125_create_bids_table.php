<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('bids', function(Blueprint $table)
    {
      $table->increments( 'id' );
      $table->integer( 'user_id' )->unsigned();
      $table->integer( 'contestant_id' )->unsigned();
      $table->integer( 'mustache_id' )->unsigned();
      $table->decimal( 'amount', 12, 2 )->unsigned();
      $table->timestamps();
      $table->softDeletes();

      $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
      $table->foreign( 'contestant_id' )->references( 'id' )->on( 'contestants' );
      $table->foreign( 'mustache_id' )->references( 'id' )->on( 'mustaches' );
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('bids');
  }

}
