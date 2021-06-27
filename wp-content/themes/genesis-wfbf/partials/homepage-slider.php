<div id="hero">

	<?php do_action( 'safe_put_revslider', 'homepage' ); ?>

	<?php if( has_nav_menu( 'slider_nav' ) ) : ?>
		<nav id="icon-navigation-home" class="navigation-menu">
			<?php wp_nav_menu( array( 'theme_location' => 'slider_nav', 'container_class' => 'wrap' ) ); ?>
		</nav>
	<?php endif; ?>

</div>