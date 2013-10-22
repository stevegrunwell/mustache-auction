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
      'name' => 'The Chevron',
      'description' => '',
      'image' => 'chevron.png'
    ));
    Mustache::create( array(
      'name' => 'The English',
      'description' => '',
      'image' => 'english.png'
    ));
    Mustache::create( array(
      'name' => 'The Fu Manchu',
      'description' => '',
      'image' => 'fumanchu.png'
    ));
    Mustache::create( array(
      'name' => 'The Handlebar',
      'description' => '',
      'image' => 'handlebar.png'
    ));
    Mustache::create( array(
      'name' => 'The Horseshoe',
      'description' => '',
      'image' => 'horseshoe.png'
    ));
    Mustache::create( array(
      'name' => 'The Pencil',
      'description' => '',
      'image' => 'pencil.png'
    ));
    Mustache::create( array(
      'name' => 'The Walrus',
      'description' => '',
      'image' => 'walrus.png'
    ));
  }

}