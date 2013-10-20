@extends( 'layouts.base' )

{{---
  A generic, static page. Create a translation file in static, then pass the file name to this view as $page

  Example:
  Create app/lang/{lang}/static/mypage.php, providing at least 'title' and 'content' values
  In your controller, return View::make( 'front.static' )->with( 'page', 'mypage' );
---}}

@section( 'title', trans( 'static/' . $page . '.title', ( isset( $placeholders ) ? $placeholders : array() ) ) )

@section( 'body-class', 'page-' . $page )

@section( 'body' )

  <h1>{{ trans( 'static/' . $page . '.title', ( isset( $placeholders ) ? $placeholders : array() ) ) }}</h1>
  {{ trans( 'static/' . $page . '.content', ( isset( $placeholders ) ? $placeholders : array() ) ) }}

@stop