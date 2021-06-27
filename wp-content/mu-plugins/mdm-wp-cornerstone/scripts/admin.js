//Document ready function
jQuery( function( $ ) {
	'use strict';
	// $( '.acf-field[data-name="page_section"]' ).AcfResponsiveColumns();
	// console.log(acf);
	var $self, $columns, options = {};

	$self = $( '.acf-field[data-name="page_section"]' ).first();

	options = {
		layoutSelector : '.layout_select select'
	};
	var _init = function() {
		return $.map( $self.find( '.values .layout' ), function( column ) {
			return new ACF_Column( $( column ) );
		});
	};

	if( $self.length ) {
		// Add action to do mapping on append
		acf.add_action( 'append', _init );
		// Do initial init
		_init();
	}

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
});