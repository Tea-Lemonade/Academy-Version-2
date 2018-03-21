<?php
/**
Template Name: Classroom
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Academies_V1
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'template-parts/content', 'page' ); ?>
      
         		<?php if (get_field('blog_category')) {?>
            <?php $category = get_field('blog_category'); ?>
            <?php query_posts(array('category_name' => $category->slug, 'posts_per_page' => 4)); while ( have_posts() ) : the_post(); ?>
          <article class="class-blog-list">
            <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
            <date>Posted on <?php the_date(); ?></date>
            <?php the_content();?>
	
          </article>
      <?php endwhile; wp_reset_query(); ?>
      
      
 			<a href="/category/<?php echo $category->slug; ?>" class="read-more">Read all posts in <?php echo $category->name; ?> &rsaquo;</a>
      
      		<?php } ?>

			<?php endwhile; // End of the loop. ?>



		</main><!-- #main -->
      
    
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>