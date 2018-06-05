<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Academies_V1
 */


?>

<div id="secondary" class="widget-area" role="complementary">
	
    <?php while ( have_posts() ) : the_post(); ?>
      <section class="class-side-nav">
        <?php if(get_field('secondary_buttons')): ?>
            <?php while(has_sub_field('secondary_buttons')): ?>
               <a href="<?php the_sub_field('button_link'); ?>" <?php if (get_sub_field('open_new')) { ?>  target="_blank" <?php } ?>><?php the_sub_field('button_text'); ?></a>
            <?php endwhile; ?>
        <?php endif; ?>
      </section> 
    <?php endwhile; wp_reset_query(); ?>

  
  
  <section class="buttons">
    
    <?php 
$homepageID = get_option('page_on_front');
if(get_field('detail_buttons_top',$homepageID)): ?>
        <?php while(has_sub_field('detail_buttons_top',$homepageID)): ?>
           <a href="<?php the_sub_field('button_link', $homepageID); ?>" <?php if (get_sub_field('open_new',$homepageID)) { ?>  target="_blank" <?php } ?>> <?php the_sub_field('button_text',$homepageID); ?></a>
        <?php endwhile; ?>
    <?php endif; ?>

<?php if(get_field('detail_buttons_bottom',$homepageID)): ?>
        <?php while(has_sub_field('detail_buttons_bottom',$homepageID)): ?>
           <a href="<?php the_sub_field('button_link', $homepageID); ?>" <?php if (get_sub_field('open_new',$homepageID)) { ?>  target="_blank" <?php } ?>> <?php the_sub_field('button_text',$homepageID); ?></a>
        <?php endwhile; ?>
    <?php endif; ?>
  </section>  

</div><!-- #secondary -->
