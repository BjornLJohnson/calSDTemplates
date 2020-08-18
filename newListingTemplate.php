<?php
/* Template Name: Add Listing Page */

wp_enqueue_style('newListing', get_stylesheet_directory_uri() . '/calsdtemplates/css/newListing.css');

get_header();

?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<h2 class="page-title">Add Listing</h2>

			<form action=<?php echo get_theme_file_uri($file = 'calsdtemplates/createListing.php') ?> method="post" enctype="multipart/form-data">
				<div class="input-title">Organization Name:</div>
				<input class="input-field" type="text" name="name"><br>

				<div class="input-title">Address:</div>
				<input class="input-field" type="text" name="address"><br>

				<div class="input-title">Product:</div>
				<input class="input-field" type="text" name="product"><br>

				<div class="input-title">Product Category:</div>
				<div id="categorysubcontainer">
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

				<div class="input-title">Quantity:</div>
				<input class="input-field" type="text" name="quantity"><br>

				<div class="input-title">Price per Unit:</div>
				<input class="input-field" type="text" name="price"><br>

				<div class="input-title">Description:</div>
				<textarea class="FormElement input-field" name="description" id="term"></textarea>

				<div class="input-title">Display Image:</div>
				<input class="input-field" type="file" name="thumbnail" id="fileToUpload"><br>

				<input id="submit" type="submit">
			</form>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
<!-- </div> -->
<?php
get_footer();
