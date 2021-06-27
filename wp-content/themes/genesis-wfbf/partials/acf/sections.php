<section <?php echo $attr['id'] . $attr['class'] . $attr['style']; ?>>
	<div class="sub_section_block_container <?php echo $attr['wrapper'] ?>">
		<div class="row-container">
			<?php if( have_rows('section_block') ) : while( have_rows('section_block') ): the_row(); ?>
				<?php do_action( 'acf_page_section', array( 'field' => 'section_block' ) ); ?>
			<?php endwhile; endif;  ?>
		</div>
	</div>
</section>
