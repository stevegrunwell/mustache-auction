<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMustachesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('mustaches', function(Blueprint $table)
    {
      $table->increments( 'id' );
      $table->string( 'name' );
      $table->text( 'description' );
      $table->string( 'image' );
      $table->timestamps();
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
    Schema::drop( 'mustaches' );
  }

}
