/**
 * This script adds the jquery effects to the Altitude Pro Theme.
 *
 * @package Altitude\JS
 * @author StudioPress
 * @license GPL-2.0+
 */
jQuery(function( $ ){
	if( $( document ).scrollTop() > 0 ){
		$( '.site-header' ).addClass( 'sticky-header' );
	}
	// Add opacity class to site header.
	$( document ).on('scroll', function(){
		if ( $( document ).scrollTop() > 0 ){
			$( '.site-header' ).addClass( 'sticky-header' );
		} else {
			$( '.site-header' ).removeClass( 'sticky-header' );
		}
	});
	jQuery(".nospace").keydown(function(event) {if (event.keyCode == 32) {event.preventDefault();} });
	jQuery(".onlynumber").keydown(function (e) {
	    if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || (e.keyCode >= 35 && e.keyCode <= 40)) {
	             return;
	    }
	    // Ensure that it is a number and stop the keypress
	    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {e.preventDefault(); }
	});
	jQuery(".postcode").keypress( function(e) {if(jQuery(this).val().length >= 4) {jQuery(this).val(jQuery(this).val().slice(0, 4)); return false; } });
	jQuery(".phonenumber").keypress( function(e) {
		if(jQuery(this).val().length >= 12) {jQuery(this).val(jQuery(this).val().slice(0, 12)); return false; }
	});
});