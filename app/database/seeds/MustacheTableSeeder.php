<?php

class MustacheTableSeeder extends Seeder
{

  public function run()
  {
    DB::table( 'mustaches' )->delete();
    Mustache::create( array(
      'name' => "Mo' Bro's choice",
      'description' => "Let the Mo' Bro decide what kind of mo' will adorn his face for the month of November.",
      'image' => 'growers-choice.png'
    ));
    Mustache::create( array(
      'name' => 'The Handlebar',
      'image' => 'handlebar.png'
    ));
    Mustache::create( array(
      'name' => 'The Fu-man Chu',
      'image' => 'fumanchu.png'
    ));
  }

}