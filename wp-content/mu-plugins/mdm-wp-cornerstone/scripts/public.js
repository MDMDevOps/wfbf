jQuery( function( $ ) {
	'use strict';
	// Instantiate our jumpscroll class
	$('.jumpscroll').JumpScroll();
	// Instantiate our scroll toggle class
	$('.scrolltoggle').ScrollToggle();
	// Show/hide application
	var $button, $application;

	var showOnlineApplication = function( event ) {
		event.preventDefault();
		if( $application.length ) {
			$application.toggle( 400 );
		}
	};

	( function() {
		$button = $( '#showonlineapplication' );
		$application = $( '#onlineapplication' );
		// Bind event
		if( $button.length ) {
			$button.on( 'click', showOnlineApplication );
		}
	})();
});