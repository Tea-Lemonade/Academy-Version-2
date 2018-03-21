<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Academies_V2
 */

?>

	</div><!-- #content -->
</div><!-- #page -->
	<footer id="colophon" class="site-footer" role="contentinfo">
    <section class="container">
      <div class="site-info">
        <a href= "<?php the_field('footer_image_link', 'option');?>" ><img src="<?php the_field('footer_image', 'option') ?>"  /></a>
        <section class="address">
          <?php the_field('footer_address', 'option'); ?>
        </section>
        <?php get_field(‘social-media-links’, ’42’); ?>
        <?php if(get_field('social_media', 'option')): ?>
          <section class="social-media">	
            <?php while(has_sub_field('social_media', 'option')): ?>
                <a href="<?php the_sub_field('site_link', 'option'); ?>"  target="_blank" class="<?php the_sub_field('site', 'option'); ?> sm"><?php the_sub_field('site', 'option'); ?></a>
            <?php endwhile; ?>
            <h6>Follow Us:</h6>
           </section> 
        <?php endif; ?>
        <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
       <p class="copyright">
        &copy;<?php echo date("Y");  ?> <?php the_field('copyright', 'option'); ?> 
         </p>
      </div><!-- .site-info -->
     
		</section>
  </footer><!-- #colophon -->


<?php wp_footer(); ?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/tinysort/2.2.2/tinysort.js' type="text/javascript"></script>
<script>
	jQuery(document).ready(function(){
  	tinysort('.event',{attr:'data-date'});  
    jQuery('.event:nth-child(2), .event:nth-child(3), .event:nth-child(4), .event:nth-child(5)').css('display', 'block');
  });
</script>

<script type=text/javascript>  
            jQuery(document).ready(function(){
var slider = jQuery('.royalSlider').data('royalSlider');
slider.ev.on('rsAfterSlideChange', function() { 
    if(slider.currSlideId === 0) {
        slider.stopAutoPlay();
    }
});
});
jQuery(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    jQuery(this).ekkoLightbox();
});
				</script>

</body>
</html>
