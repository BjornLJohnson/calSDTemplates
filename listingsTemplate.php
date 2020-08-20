<?php
/* Template Name: ListingsTemplate */
session_start();
wp_enqueue_style('listings', get_stylesheet_directory_uri() . '/calsdtemplates/css/listings.css');

get_header();

?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<form class="searchcontainer" action="" method="get">
				<div id="keywordcontainer">
					<div>Search Keywords:</div>
					<input class="input-field searchbox" type="text" name="search">
				</div>

				<div id="locationcontainer">
					<div>Location:</div>
					<input id="locationbox" class="input-field" type="text" name="location">
				</div>

				<div id="categorycontainer">
					<span id="catlabel">Category:</span>
					<input type="checkbox" name="category[]" value="fruits">
					<label for="fruit">Fruits</label>

					<input type="checkbox" name="category[]" value="vegetables">
					<label for="vegetable">Vegetables</label>

					<input type="checkbox" name="category[]" value="meats">
					<label for="meat">Meats</label>

					<input type="checkbox" name="category[]" value="dairy">
					<label for="dairy">Dairy</label>

					<input type="checkbox" name="category[]" value="grains-beans-nuts">
					<label for="nuts">Nuts, Beans, Grains</label>
				</div>

				<div id="tagcontainer">
					<span id="taglabel">Tags:</span>
					<input type="checkbox" name="tag[]" value="organic">
					<label for="organic">Organic</label>

					<input type="checkbox" name="tag[]" value="non-gmo">
					<label for="non-gmo">Non-GMO</label>

					<input type="checkbox" name="tag[]" value="family">
					<label for="family">Family-Owned</label>
				</div>

				<input id="submit" name="submit" type="submit" value="Search">

				<button class="back-button">
					<a href="listings">Back to All Listings</a>
				</button>
			</form>

			<?php

			if (isset($_GET['submit'])) :

				$args = array(
					'posts_per_page' => 100,
					'post_type' => 'listing',
					'post_status' => 'publish',
					's' => $_GET['search']
				);

				if(isset($_GET['location'])) :
					$_SESSION['location'] = $_GET['location'];
				endif;

				if(isset($_GET['category'])) :
					$categories = "";
					$catArray = $_GET['category'];
					foreach ($catArray as $catItem){ 
						$categories = $categories . $catItem . ",";
					}
					$args['category_name'] = $categories;
				endif;

				if(isset($_GET['tags'])) :
					$tags = "";
					$tagArray = $_GET['tags'];
					foreach ($tagArray as $tag){ 
						$tags = $tags . $tag . ",";
					}
					$args['tag'] = $tags;
				endif;

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

				$product = get_post_meta(get_the_ID(), 'product', true);
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
					<h4 class="listing-title">
						<a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 6); ?></a>
					</h4>
					<div class="listing-meta">Product: <?php echo $product ?></div>
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
