<?php
/**
 * @package academies_V1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="event-entry-title">', esc_url( get_permalink() ) ), '</h2>' ); ?>
	</header><!-- .entry-header -->

	<?php $date = DateTime::createFromFormat('mdY', get_field('event_start_date'));
	if( get_field( 'event_start_date' ) ): ?>
	
		<div class="event-date-circle">
			
			
			<?php echo $date->format('M<\b\r>j') ; ?>
			
			<?php if( get_field( 'event_end_date' ) ): ?>
				<?php $date = DateTime::createFromFormat('mdY', get_field('event_end_date'));
				echo '- '.$date->format('j'); ?>
			<?php endif; ?>
            
		</div><!-- event-date-circle -->
	
	<?php endif; ?>

	<div class="entry-content">
	<!-- ------- GET THE DATE --------- -->
                            	

		<?php
			/* translators: %s: Name of current post */
			echo get_the_excerpt();
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'meet-me' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	
</article><!-- #post-## -->