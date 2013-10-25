@extends( 'layouts.base' )

@section( 'title', trans( 'errors.' . $code . '_title' ) )

@section( 'body' )

  <h1>{{ trans( 'errors.' . $code . '_title' ) }}</h1>
  {{ trans( 'errors.' . $code . '_body' ) }}

@stop