<?php
/**
 * @package academies_v1
 */
 $date = date_create_from_format('d-m-Y', get_field('event_start_date')); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-date="<?php echo $date->format('Ymd'); ?>">
	<header class="entry-header">
		<?php if( $_SESSION['home'] == "true" ){echo '<a href="/events/">';}  the_title( sprintf( '<h2 class="event-entry-title">', esc_url( get_permalink() ) ), '</h2>' ); ?></a>
	</header><!-- .entry-header -->

	<?php 
	if( get_field( 'event_start_date' ) ): ?>
	
		<div class="event-date-circle">
			
			
			<?php echo $date->format('M<\b\r>j') ; ?>
			
			<?php if( get_field( 'event_end_date' ) ): ?>
				<?php $date = date_create_from_format('d-m-Y', get_field('event_end_date'));
				echo '- '.$date->format('j'); ?>
			<?php endif; ?>
           
		</div><!-- event-date-circle -->
	
	<?php endif; ?>

	<div class="entry-content">
	<!-- ------- GET THE DATE --------- -->
                            	

		<?php
			/* translators: %s: Name of current post */
			the_content();
			if(get_the_content() == ""){
        echo '<p> &nbsp;<p>';
        }
		?>
		
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'meet-me' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	
</article><!-- #post-## -->