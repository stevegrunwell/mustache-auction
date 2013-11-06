<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailColumnToContestants extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('contestants', function(Blueprint $table)
    {
      $table->string( 'email' )->after( 'title' )->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('contestants', function(Blueprint $table)
    {
      $table->dropColumn( 'email' );
    });
  }

}