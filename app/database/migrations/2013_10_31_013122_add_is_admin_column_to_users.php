<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsAdminColumnToUsers extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('users', function(Blueprint $table)
    {
      $table->boolean( 'is_admin' )->after( 'accept_terms' )->default( false );
      $table->index( 'is_admin' );
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('users', function(Blueprint $table)
    {
      $table->dropColumn( 'is_admin' );
      $table->dropIndex( 'is_admin' );
    });
  }

}