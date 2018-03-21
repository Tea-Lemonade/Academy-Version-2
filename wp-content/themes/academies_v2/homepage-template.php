<?php
/*
Template Name: Homepage template
* @package Academies_V2
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
	
		<?php $page = get_query_var('page_id'); while ( have_posts() ) : the_post(); ?>

      <div class="clear"></div>
      <section class="news">
         <h3><a href="/category/homepage-news/">News</a></h3>
					<?php $query = new WP_Query( array( 'category_name' => 'homepage-news', 'order' => 'DEC','posts_per_page' => 4 ) );
					if ( $query->have_posts() ) : ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>	
						<article class="entry">
             <a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?></a>
             <span class="date"><?php the_time('F j, Y' ) ?></span> 
						 <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
             <?php $count=strlen (get_the_excerpt());echo
            substr(get_the_excerpt(), 0,150); if ($count >150) {echo '...';}
       ?> 
						</article>
					<?php endwhile; wp_reset_postdata(); ?>
				<?php endif; ?>
		<div class="more"><a href="/category/homepage-news/">More &raquo;</a></div>
      </section>
     
      <section class="buttons">
        <?php if(get_field('detail_buttons')): ?>
            <?php while(has_sub_field('detail_buttons')): ?>
               <a href="<?php the_sub_field('button_link'); ?>" <?php if (get_sub_field('open_new')) { ?>  target="_blank" <?php } ?>> <?php the_sub_field('button_text'); ?></a>
            <?php endwhile; ?>
        <?php endif; ?>
      </section>  
      
              
    <?php endwhile;  ?>

 

    
<?php get_footer(); ?>