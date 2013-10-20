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

  $('#content').on( 'click', 'a.donate-link', function ( e ) {
    var self = $(this);
    e.preventDefault();

    $.get( self.attr( 'href' ), function ( response ) {
      modal.html( response ).modal( modalOpts );
    });
  });

});