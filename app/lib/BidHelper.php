<?php

class BidHelper {

  /**
   * Draw a bar graph for a mustache
   * @param float $percentage
   * @return str
   */
  public static function bar_graph( $percentage, $amount=0 ) {
    return sprintf( '<div class="bar-graph"><span style="max-height: %f%%;" title="%s">%s</span></div>',
      $percentage * 100,
      ( $amount ? self::format_amount( $amount ) : '' ),
      self::format_percentage( $percentage )
    );
  }

  /**
   * Take a float, format it according to the localization (products.price_format), round it to
   * two digits, and return it as a string
   * @param float $amount The amount to format
   * @return str
   */
  public static function format_amount( $amount ) {
    $amount = preg_replace( '/\.00$/', '', number_format( $amount, 2 ) );
    return trans( 'bid.amount_format', array( 'amount' => $amount ) );
  }

  /**
   * Format a percentage
   */
  public static function format_percentage( $percentage ) {
    $percentage = preg_replace( '/\.00$/', '', number_format( $percentage * 100, 2 ) );
    return trans( 'bid.percentage_format', array( 'percentage' => $percentage ) );
  }

}