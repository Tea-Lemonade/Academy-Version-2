<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package academies_V1
 */

get_header(); 

?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <div class="events-list">	
    
             
                <?php query_posts( array( 'post_type' => 'event', 'showposts' => -1) ); if ( have_posts() ) : ?>
                
        
                    <header class="page-header">
                        <h1 class="page-title">Event Listings</h1>
                    </header><!-- .page-header -->
                    <div id="events">
                        <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>
            			
                            <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
								$startdate= get_field ('event_start_date'); 
								$startdate = strtotime($startdate);
								$startdate = strtotime ( '+1 day' , $startdate );
								$enddate= get_field ('event_end_date');
								$enddate = strtotime($enddate);									
										if(get_field ('event_end_date')) { 
                      
                       //echo strtotime("now");
                      if($enddate >= strtotime("now")) {
								get_template_part( 'template-parts/content-single-event', get_post_format() );
								      }}
										else{if($startdate >= strtotime("now")) {
                      get_template_part( 'template-parts/content-single-event', get_post_format() );}}
                            ?>
            											
                        <?php endwhile; ?>
                        
                        <?php the_posts_navigation(); ?>
                <?php else : ?>
        
                    <?php get_template_part( 'template-parts/content', 'none' ); ?>
        
                <?php endif; ?>
                
                
           </div> </div><!-- end events-list -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
