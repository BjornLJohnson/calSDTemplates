<?php
/* Template Name: ListingsTemplate */

get_header();

if ( mik_theme_option( 'header_alignment', 'left-align' ) == 'left-absolute' ) :
	if ( ! has_post_thumbnail() ) {
		if ( has_header_image() ) : ?>
			<div class="featured-image inner-header-image">
				<?php the_header_image_tag(); ?>
			</div>
		<?php endif;
	}
endif;

if ( has_post_thumbnail() ) : ?>
	<div class="featured-image inner-header-image">
		<?php the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	</div>
<?php endif; ?>

<div class="single-template-wrapper wrapper page-section">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<h2>Listings Page</h2>
			<?php
			$args = array(
				'post_type' => 'listing',
				'post_status' => 'publish'
			);
			$loop = new WP_Query($args);
			while ( $loop->have_posts() ) : $loop->the_post();

			//the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' ); 
?>

			$id = get_the_ID();
			<h2><?php the_title(); ?></h2>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>

			<?php endwhile; // End of the loop.?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
