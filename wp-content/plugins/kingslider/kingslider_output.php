<?php
global $post;
$custom = get_post_custom($atts['id']);
$autoplay = $custom['autoplay'][0];
$lastslide = $custom['lastslide'][0];
$slide = get_post( $atts['id'] ); 
$count = 0;
$content = '<div class="my-slider" id="my-slider-'.$atts['id'].'"><ul>';

if( have_rows('slide', $atts['id']) ):

 	// loop through the rows of data
    while ( have_rows('slide', $atts['id']) ) : the_row();

        // display a sub field value
        $image = get_sub_field('image');
		$content .= "<li><div class='king-slider-image' style='background-image:url(".$image['url'].")'>".get_sub_field('description')."</div></li>";
	  $count++;
    endwhile;

else :

    // no rows found

endif;
$finalCount = $count - 1;
$content .= '</ul>
</div>
<script>$autoplay = "'.$autoplay.'"; $slidesCount = '.$finalCount.'; $lastslide = "'.$lastslide.'"; $finalCount = "'.$finalCount.'";</script>';
if($finalCount == 0){  }

if(function_exists('myscript2') == FALSE){
function myscript2() {
?>
<script type="text/javascript">
jQuery(document).ready(function() {
      if($autoplay == 'checked'){
        $auto = true;
      }
      else {
        $auto = false;
      }
      if($finalCount == 0){ 
	$prev = ""; $next = "";
      }
      else {
	$prev = '<a class="unslider-arrow prev"><i class="fa fa-caret-square-o-left"></i></a>';
	$next = '<a class="unslider-arrow next"><i class="fa fa-caret-square-o-right"></i></a>'
	}
      if($lastslide == 'checked'){
        $laststop = true;
      }
      else {
        $laststop = false;
      }
			var unslider = jQuery('.my-slider').unslider({
      autoplay: $auto,
      delay: 5000,
			animation: 'fade',
      arrows: {
        prev: $prev,
        next: $next,
      },
      });
      data = unslider.data('unslider');
      
      unslider.on('unslider.change', function(event, index, slide) {
        if($laststop == true){
        if(index == $slidesCount) { console.log('last'); data.stop(); } }
			});

var slides = jQuery('.my-slider'),
    i = 0;

slides
.on('swipeleft', function(e) {
    data.prev();
})
.on('swiperight', function(e) {
    data.next();
})
.on('movestart', function(e) {
    if ((e.distX > e.distY && e.distX < -e.distY) ||
    (e.distX < e.distY && e.distX > -e.distY)) {
        e.preventDefault();
        }
});
		});
</script>
<?php
}}
add_action('wp_footer', 'myscript2', 300); 
?>