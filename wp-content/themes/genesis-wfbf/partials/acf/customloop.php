<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title" itemprop="name"><?php the_title(); ?></h1>
	</header>
	<div class="entry-content" itemprop="text">
		<?php the_content(); ?>
	</div>
</article>