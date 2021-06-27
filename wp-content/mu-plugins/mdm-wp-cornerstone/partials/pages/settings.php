<div class="wrap">
		<form method="post" action="options.php">
		    <?php wp_nonce_field( 'update-options' ); ?>
		    <?php settings_fields( self::$name ); ?>
		    <?php do_settings_sections( self::$name ); ?>
		    <?php submit_button(); ?>
		</form>
</div>