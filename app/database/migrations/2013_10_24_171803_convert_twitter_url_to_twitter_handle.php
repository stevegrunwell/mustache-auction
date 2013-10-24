<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConvertTwitterUrlToTwitterHandle extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contestants', function(Blueprint $table)
		{
			$table->renameColumn( 'twitter_url', 'twitter_handle' );
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
			$table->renameColumn( 'twitter_handle', 'twitter_url' );
		});
	}

}