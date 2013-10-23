/**
 * Application scripting
 */
/*global jQuery: true */
/*jslint white: true */
/*jshint browser: true, jquery: true */

jQuery( function ( $ ) {
  "use strict";

  var modal = $('<div id="modal" class="modal" />'),
  modalOpts = {
    closeText: '&times;'
  };

  // Append an empty #modal container to the body
  $('body').append( modal );

  // Donation and statistics links
  $('#content').on( 'click', 'a.donate-link, a.stats-link', function ( e ) {
    if ( $(window).width() >= 480 ) {
      e.preventDefault();

      $.get( $(this).attr( 'href' ), function ( response ) {
        modal.html( response ).modal( modalOpts );
      });
    }
  });

  // .mustache-list links
  $('body').on( 'click', '.mustache-list a', function ( e ) {
    var self = $(this);
    e.preventDefault();
    $('body').find( '.mustache-list a.active' ).removeClass( 'active' );
    $('#mustache_id').find( 'option[value="' + self.data( 'mustache-id' ) + '"]' ).attr( 'selected', 'selected' );
    self.addClass( 'active' );
  });

});