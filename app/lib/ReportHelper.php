<?php

use Carbon\Carbon;

class ReportHelper {

  /**
   * Generate a 'report generated %time% string to pass to reports
   * @return str
   */
  public static function generatedAt() {
    $now = Carbon::now()->format( trans( 'reports.report_generated_timestamp' ) );
    return sprintf( '<p class="report-generated-timestamp">%s</p>',
      trans( 'reports.report_generated', array( 'timestamp' => $now ) )
    );
  }

}