<?php
/* Template Name: GridTemplate */

wp_enqueue_style('grid', get_stylesheet_directory_uri().'/calsdtemplates/css/grid.css');

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
				'posts_per_page' => 100,
				'post_type' => 'listing',
				'post_status' => 'publish'
			);


			$loop = new WP_Query($args);
			while ( $loop->have_posts() ) : $loop->the_post();

			//the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' ); 

			$address = get_post_meta(get_the_ID(), 'address', true);
			$price = get_post_meta(get_the_ID(), 'price', true);
			$quantity = get_post_meta(get_the_ID(), 'quantity', true);
			$modulus = $count % 5;
			if ( $modulus == 1 ) {
				$class = 'first';
			} elseif ( $modulus == 0 ) {
				$class = 'last';
			}

			?>


			<div class="jmogrid-item <?php echo $class; ?>">
				<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('jmogrid'); ?>
					</a>
				<?php endif; ?>
	    <h4>
	      <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 6); ?></a>
	    </h4>
	      <div class="jmogrid-meta">Address: <?php echo $address ?></div>
	      <div class="jmogrid-meta">Price Per Unit: <?php echo $price ?></div>
	      <div class="jmogrid-meta">Quantity: <?php echo $quantity ?></div>
	  </div>


			<?php endwhile; // End of the loop.?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
