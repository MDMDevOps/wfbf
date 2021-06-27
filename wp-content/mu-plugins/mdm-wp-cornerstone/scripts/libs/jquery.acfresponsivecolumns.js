( function( $ ) {
	'use strict';
	$.fn.AcfResponsiveColumns = function( options ) {

		var $self = this, $columns;

		console.log( $self );

		var defaults = {
			layoutSelector : '.layout_select select',
		};

		options = $.extend( {}, defaults, options );

		var _init = function() {
			return $.map( $self.find( '.values .layout' ), function( column ) {
				return new ACF_Column( $( column ) );
			});
		};
		// Add action to do mapping on append
		acf.add_action( 'append', _init );
		// Do initial init
		return _init();

		function ACF_Column( $column ) {
			var $select, layouts;

			var _render = function() {
				for( var i = 0; i < layouts.length; i++ ) {
					if( $select.val() === layouts[i] ) {
						$column.addClass( layouts[i] );
					} else {
						$column.removeClass( layouts[i] );
					}
				}
			};

			( function() {
				// Find the select element
				$select = $column.find( options.layoutSelector );
				// Get all layouts directly from the select element
				layouts = $.map( $select.find( 'option' ), function( option ){
					return option.value;
				});
				// Bind our events
				if( $select.length ) {
					$select.on( 'change', _render );
				}
				// And finally, do our initial rendering of the column classes
				_render();
			})();

			return $column;
		}
	};

})( jQuery );