<?php
/*
Template Name: Homepage template
* @package Academies_V1
*/


get_header();
$_SESSION['home'] = '';
if(is_front_page()){
	$_SESSION['home'] = 'true';
}
else{
  $_SESSION['home'] = 'false';
  }
?>

	<div id="primary" class="content-area homeprimary">
		<main id="main" class="site-main" role="main">
      
      
      <?php if(get_field ('homepage_button_text')): ?>
	<a class="navigation-button-link" href="<?php echo get_field ('homepage_button_link'); ?>"> <?php echo get_field ('homepage_button_text'); ?>
	  </a>   <?php endif; ?> 
      <div class="clear"></div>
      
      <section class="buttons-half">
        <?php if(get_field('detail_buttons_top')): ?>
            <?php while(has_sub_field('detail_buttons_top')): ?>
               <a href="<?php the_sub_field('button_link'); ?>" <?php if (get_sub_field('open_new')) { ?>  target="_blank" <?php } ?>> <?php the_sub_field('button_text'); ?></a>
            <?php endwhile; ?>
        <?php endif; ?>
      </section>  
      <section class="buttons-third">
        <?php if(get_field('detail_buttons_bottom')): ?>
            <?php while(has_sub_field('detail_buttons_bottom')): ?>
               <a href="<?php the_sub_field('button_link'); ?>" <?php if (get_sub_field('open_new')) { ?>  target="_blank" <?php } ?>> <?php the_sub_field('button_text'); ?></a>
            <?php endwhile; ?>
        <?php endif; ?>
      </section>
	
		<?php $page = get_query_var('page_id'); while ( have_posts() ) : the_post(); ?>

      <div class="clear"></div>
      <div id="slider1" class="news">
         <h3><a href="/category/homepage-news/">News</a></h3>
					<?php $query = new WP_Query( array( 'category_name' => 'homepage-news', 'order' => 'DEC','posts_per_page' => 6 ) ); $i = 0;
					if ( $query->have_posts() ) : ?>
        <a class="buttons prev" href="#">&#60;</a>
		<div class="viewport">
			<ul class="overview">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>	
						<li><article class="entry">
             <a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?></a>
             <span class="date"><?php the_time('F j, Y' ) ?></span> 
						 <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
             <?php $count=strlen (get_the_excerpt());echo
            substr(get_the_excerpt(), 0,110); if ($count >110) {echo '...';}
       ?> 
						</article></li>
					<?php $i++; endwhile; wp_reset_postdata(); ?>
        </ul></div><a class="buttons next" href="#">&#62;</a>
				<?php endif; ?>
      </div>
             
    <?php  endwhile; 
	if($i < 2){ ?>
		<style>
			.news article { width:494px; } 
			#slider1 .overview li { width: 494px; }
			#slider1 .buttons { display:none }
		</style>
<?php	} ?>
    
<?php get_footer(); ?>