<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Academies_V1
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php if(wp_get_post_parent_id(get_the_ID ()) != false){
					$parent = wp_get_post_parent_id(get_the_ID ());
					if( get_page_template_slug( $parent ) == "page-classroom.php") {
						echo '<a href="/" >Home</a> > <a href="/class-pages/">Classrooms</a> > <a href="'.get_permalink($parent).'">'.get_the_title($parent).'</a> > '.get_the_title();
					}
				      }
				?>
				<?php if( is_page_template( 'page-classroom.php' ) && wp_get_post_parent_id(get_the_ID ()) == false ) { echo '<a href="/" >Home</a> > <a href="/class-pages/">Classrooms</a> > '.get_the_title(); } ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'academies_v1' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'academies_v1' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

