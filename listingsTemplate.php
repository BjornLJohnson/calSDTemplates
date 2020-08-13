<?php
/* Template Name: ListingsTemplate */

wp_enqueue_style('grid', get_stylesheet_directory_uri() . '/calsdtemplates/css/grid.css');

// add_image_size( 'listing-thumb-size', 100, 100);

// include "pre-header.php";

get_header();

/*
if (mik_theme_option('header_alignment', 'left-align') == 'left-absolute') :
	if (!has_post_thumbnail()) {
		if (has_header_image()) : ?>
			<div class="featured-image inner-header-image">
				<?php the_header_image_tag(); ?>
			</div>
	<?php endif;
	}
endif;

if (has_post_thumbnail()) : ?>
	<div class="featured-image inner-header-image">
		<?php the_post_thumbnail('full', array('alt' => the_title_attribute('echo=0'))); ?>
	</div>
<?php endif; ?>

<div class="single-template-wrapper wrapper page-section">
*/

?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<!-- <h2 class="page-title">Listings Page</h2> -->

			<form class="searchcontainer" action="" method="get">
				Search Keywords:
				<input class="input-field searchbox" type="text" name="search">

				Location:
				<input class="input-field locationbox" type="text" name="location">

				<input id="submit" name="submit" type="submit" value="Search">
			</form>

			<?php

			if (isset($_GET['submit'])) :
				$args = array(
					'posts_per_page' => 100,
					'post_type' => 'listing',
					'post_status' => 'publish',
					's' => $_GET['search']
				);
			else :
				$args = array(
					'posts_per_page' => 100,
					'post_type' => 'listing',
					'post_status' => 'publish'
				);
			endif;

			$count = 1;
			$loop = new WP_Query($args);

			if (!($loop->have_posts())) :
				echo "<h2>No results, displaying all listings</h2>";

				$args = array(
					'posts_per_page' => 100,
					'post_type' => 'listing',
					'post_status' => 'publish'
				);
				$loop = new WP_Query($args);
			endif;

			while ($loop->have_posts()) :

				$loop->the_post();

				$address = get_post_meta(get_the_ID(), 'address', true);
				$price = get_post_meta(get_the_ID(), 'price', true);
				$quantity = get_post_meta(get_the_ID(), 'quantity', true);
				$description = get_post_meta(get_the_ID(), 'description', true);

				$modulus = $count % 3;
				if ($modulus == 1) {
					$class = 'first';
				} elseif ($modulus == 0) {
					$class = 'last';
				} else {
					$class = '';
				}
				$count = $count + 1;
			?>

				<div class="listing <?php echo $class; ?>">
					<?php if (has_post_thumbnail()) : ?>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail(); ?>
						</a>
					<?php endif; ?>
					<h4>
						<a class="listing-title" href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 6); ?></a>
					</h4>
					<div class="listing-meta">Address: <?php echo $address ?></div>
					<div class="listing-meta">Price Per Unit: <?php echo $price ?></div>
					<div class="listing-meta">Quantity: <?php echo $quantity ?></div>
					<p class="listing-description"> <?php echo $description ?></p>
				</div>


			<?php endwhile; // End of the loop.
			?>



		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
<!-- </div> -->
<?php
get_footer();
