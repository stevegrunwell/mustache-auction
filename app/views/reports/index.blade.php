@extends( 'layouts.base' )

@section( 'title', trans( 'reports.index_title' ) )

@section( 'body' )

  <h1>{{ trans( 'reports.index_title' ) }}</h1>

  <h2>{{ trans( 'reports.contestant_totals' ) }}</h2>
  <ul class="report-list">
  @foreach ( Contestant::all() as $contestant )
    <li>{{ link_to_action( 'ReportController@contestantTotals', $contestant->name, [ 'contestant_id' => $contestant->id ] ) }}</li>
  @endforeach
  </ul>

@stop