<?php

return array(

  /*
    Since there is neither a privacy policy nor terms and conditions baked into the app defining absolute URLs
    here will add the links to #footer-nav instead
  */
  'privacy_policy_url' => false,
  'terms_url' => false,

  /*
    Enable Google Analytics tracking by putting the profile ID and tracking domain here:
  */
  'ga_profile_id' => false,
  'ga_tracking_domain' => false,

  /**
   * Set the expiration time for the auction - this will most likely be sometime at the end of the first week
   * of Movember (much later than that and there won't be time to grow!).
   *
   * Should be either a boolean false or a string that can be evaluated by Carbon
   */
  'auction_ends_at' => false,

);
