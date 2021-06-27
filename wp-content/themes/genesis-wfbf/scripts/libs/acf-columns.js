( function( $ ) {
	'use strict';
	$.fn.ACFVisualColumns = function( options ) {

		var defaults = {
			layoutSelector : '.layout_select select',
		};

		options = $.extend( {}, defaults, options );

		return $.map( this, function( el ) {
			return new Section( $( el ) );
		});

		/**
		 * Single Page Section
		 */
		function Section( $section ) {

			var getColumns = function() {
				$section.columns = $.map( $section.find( '.values .layout' ), function( column ) {
					return new Column( $( column ) );
				});
				return $section;
			};

			( function() {
				// Add action for when we append new columns
				acf.add_action( 'append', getColumns );
			})();

			return getColumns();
		}

		/**
		 * Single Column
		 */
		function Column( $column ) {

			var $layout, originalClass;

			var init = function() {
				// Get the original class
				originalClass = $column.attr( 'class' );
				// Get the layout selector
				$layout = $column.find( options.layoutSelector );

				if( $layout.length ) {
					// Bind the change event
					$layout.on( 'change', render );
					// Perform initial render
					render();
				}
				// Return the column
				return $column;
			};

			var render = function() {
				$column.attr( 'class', originalClass + ' column ' + $layout.val() );
			};

			return init();
		}
	};

})( jQuery );


