<?php
/**
 * Template part for displaying single posts.
 *
 * @package Academies_V1
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
    <?php if ( function_exists('yoast_breadcrumb') ) 
{yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php academies_v1_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php academies_v1_entry_footer(); ?>
    		<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'academies_v1' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '<span class="arrows">&laquo;</span> <span>Previous:</span> %title', TRUE );
				next_post_link( '<div class="nav-next court">%link</div>', '<span class="arrows">Next:</span> %title <span>&raquo;</span>', TRUE );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

