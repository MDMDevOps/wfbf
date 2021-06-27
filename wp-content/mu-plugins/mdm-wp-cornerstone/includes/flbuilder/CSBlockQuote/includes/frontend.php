<figure class="cs-blockquote-container blockquote">
	<blockquote class="cs-blockquote">
		<?php echo $settings->quote; ?>
	</blockquote>

	<?php if ( !empty( $settings->cite ) ) : ?>

		<figcaption>

			<span class="cite"><?php echo $settings->cite; ?></span>

		</figcaption>

	<?php endif; ?>

</figure>