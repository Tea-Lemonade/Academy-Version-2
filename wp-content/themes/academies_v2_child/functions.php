<?php
/**
 * Academies_V2 Child functions and definitions
 *
 * @package Academies_V2
 */
function theme_enqueue_styles() {
	wp_dequeue_style('academies_v2-style-css');
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css','',null );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

// Include the Google Analytics Tracking Code (ga.js)
// @ https://developers.google.com/analytics/devguides/collection/gajs/
function google_analytics_tracking_code(){ 
?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45642331-10', 'auto');
  ga('send', 'pageview');

</script>

<?php }

// include GA tracking code before the closing head tag
add_action('wp_head', 'google_analytics_tracking_code');

function parish_scripts() {
 
wp_enqueue_style( 'child-style', '/wp-content/themes/academies_v2_child/style.css' );
}
add_action( 'wp_enqueue_scripts', 'parish_scripts' );

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();
	
}