<p>
	<label for="<?php echo $this->get_field_name( 'title' ); ?>">Title</label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
</p>

<p class="description">
	Default social network links are set in <a href="<?php echo admin_url( '/customize.php?autofocus[section]=mdm_wp_cornerstone_social' ); ?>">customizer</a>.
</p>

<?php foreach( \Mdm\Wp\Cornerstone\Social::get_network_list() as $key => $network ) : ?>
<!-- 	<p>
		<label for="<?php echo $this->get_field_name( $key ); ?>"><?php echo ucwords( $key ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" value="<?php echo esc_url_raw( $instance[$key] ); ?>">
	</p> -->
<?php endforeach ?>