jQuery(function( $ ){

	$("header .genesis-nav-menu, .nav-primary .genesis-nav-menu").addClass("responsive-menu").before('<div class="responsive-menu-icon"></div>');

	$(".responsive-menu-icon").click(function(){
		$(this).next("header .genesis-nav-menu, .nav-primary .genesis-nav-menu").slideToggle();
	});

	$(window).resize(function(){
		if(window.innerWidth > 600) {
			$("header .genesis-nav-menu, .nav-primary .genesis-nav-menu, nav .sub-menu").removeAttr("style");
			$(".responsive-menu > .menu-item").removeClass("menu-open");
		}
	});

	$(".responsive-menu > .menu-item").click(function(event){
		if (event.target !== this)
		return;
			$(this).find(".sub-menu:first").slideToggle(function() {
			$(this).parent().toggleClass("menu-open");
		});
	});

});

jQuery( function( $ ){
	'use strict';

	var options = {
		'selector' : 'h2',
		'container' : '.entry-content',
	};

	var $toc = $.map( $( '.table-of-contents' ), function(el){
		return new TOC( $(el) );
	});

	function TOC( $el ) {
		var $selectors, $container;

		var render = function( callback ) {
			for( var i = 0; i < $selectors.length; i++ ) {
				// add the id to the actual selector
				var $headline = $( $selectors[i] );
				$headline.attr( 'id', 'toc' + i );
				// Add the table of contents selector
				$el.append( '<li><a href="#toc' + i + '">' + $headline.text() + '</a></li>' );
			}
			callback();
		};

		( function() {
			// Parse options
			options.container = $el.data( 'container' ) || options.container;
			options.container = $el.data( 'container' ) || options.container;
			// Set vars
			$container = $el.parents( options.container );
			$selectors = $container.find( options.selector );
			// Render output
			render( function() {
				// do other stuff;
				$el.find( 'a' ).JumpScroll( {
					scrollSpeed : 'slow',
					topOffset : 100
				}
				);
			});

		})();
	}
});