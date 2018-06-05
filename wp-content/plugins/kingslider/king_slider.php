<?php
/**
 * Plugin Name: King Slider
 * Description: This plugin adds a custom slider to the website.
 * Version: 1.5.3
 * Author: Adam Vauthier - 345 Design
 * Author URI: http://345design.com
 */

require 'plugin-updates/plugin-update-checker.php';
$MyUpdateChecker = PucFactory::buildUpdateChecker(
    'http://beta.stpiusv-queens.org/wp-content/plugins/king-slider.json',
    __FILE__,
    'king-slider'
);


//Custom Post Type
add_action( 'init', 'codex_king_slider_init' );

function codex_king_slider_init() {
	$labels = array(
		'name'               => _x( 'King Sliders', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'King Slider', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'King Sliders', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'King Slider', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'King Slider', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New King Slider', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New King Slider', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit King Slider', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View King Slider', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All King Sliders', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search King Sliders', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent King Sliders:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No King Sliders found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No King Sliders found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
    'menu_icon'          => 'dashicons-images-alt',
		'rewrite'            => array( 'slug' => 'King Slider' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'King Slider', $args );
}

function kingslider_shortcode_func( $atts ) {
	$atts = shortcode_atts( array(
		'id' => 'no id',
	), $atts, 'kingslider' );
  
	include 'kingslider_output.php';
  return $content;

}
add_shortcode( 'kingslider', 'kingslider_shortcode_func' );


add_action("admin_init", "admin_init");
 
function admin_init(){
  add_meta_box("show_nav", "Navigation", "show_nav", "kingslider", "side", "low");
  add_meta_box("shortcode_view", "Shortcode", "shortcode_view", "kingslider", "side", "low");
  add_meta_box("autoplay", "Autoplay", "autoplay", "kingslider", "side", "low");
  add_meta_box("lastslide", "Lastslide", "lastslide", "kingslider", "side", "low");
}

 
function show_nav(){
  global $post;
  $custom = get_post_custom($post->ID);
  $show_nav = $custom["show_nav"][0];
  ?>
  <label>Show Navigation:</label>
  <input type="checkbox" name="show_nav" value="checked" <?php echo $show_nav; ?> />
  <?php
}

function autoplay(){
  global $post;
  $custom = get_post_custom($post->ID);
  $autoplay = $custom["autoplay"][0];
  ?>
  <label>Auto Play Slider:</label>
  <input type="checkbox" name="autoplay" value="checked" <?php echo $autoplay; ?> />
  <?php
}
function lastslide(){
  global $post;
  $custom = get_post_custom($post->ID);
  $autoplay = $custom["lastslide"][0];
  ?>
  <label>Stop on Last Slide:</label>
  <input type="checkbox" name="lastslide" value="checked" <?php echo $autoplay; ?> />
  <?php
}

add_action("admin_init", "admin_init");
 
function shortcode_view(){
  global $post;
  ?>
  <label>Shortcode:</label>
  [kingslider id="<?php echo $post->ID; ?>"]
  <?php
}

add_action('save_post', 'save_details');

function save_details(){
  global $post;
  update_post_meta($post->ID, "show_nav", $_POST["show_nav"]);
  update_post_meta($post->ID, "autoplay", $_POST["autoplay"]);
  update_post_meta($post->ID, "lastslide", $_POST["lastslide"]);
}

add_action( 'wp_enqueue_scripts', 'kingslider_assets_header' );

function kingslider_assets_header() {
	wp_enqueue_style( 'kingslider-css', '/wp-content/plugins/kingslider/css/kingslider.css' );
	wp_enqueue_style( 'kingslider-dots-css', '/wp-content/plugins/kingslider/css/kingslider-dots.css' );
}

add_action( 'wp_footer', 'kingslider_assets_footer' );

function kingslider_assets_footer() {
	wp_enqueue_script('velocity','//cdn.jsdelivr.net/velocity/1.2.3/velocity.min.js', 'jquery', '1.0', true );
  wp_enqueue_script('slider-move', '/wp-content/plugins/kingslider/js/jquery.event.move.js', '1.0', true);
  wp_enqueue_script('slider-swipe', '/wp-content/plugins/kingslider/js/jquery.event.swipe.js', '1.0', true);
  	wp_enqueue_script('kingslider-js', '/wp-content/plugins/kingslider/js/kingslider.js', 'jquery', '1.0', true );
}

//Slider Fields
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_kingslider',
		'title' => 'Kingslider',
		'fields' => array (
			array (
				'key' => 'field_56aaf55570066',
				'label' => 'Slide',
				'name' => 'slide',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_56aaf55f70067',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_56aaf56a70068',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_56aaf69770069',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_56aaf6bb7006a',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'return_format' => 'array',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Slide',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'kingslider',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'revisions',
				7 => 'slug',
				8 => 'author',
				9 => 'format',
				10 => 'featured_image',
				11 => 'categories',
				12 => 'tags',
				13 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}
