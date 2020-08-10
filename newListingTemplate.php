<?php
/* Template Name: Add Listing Page */

wp_enqueue_style('newListing', get_stylesheet_directory_uri() . '/calsdtemplates/css/newListing.css');

get_header();

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
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<h2 class="page-title">Add Listing</h2>

			<form action=<?php echo get_theme_file_uri($file = 'calSDTemplates/createListing.php') ?> method="post" enctype="multipart/form-data">
				<div class="input-title">Organization Name:</div>
				<input class="input-field" type="text" name="name"><br>

				<div class="input-title">Address:</div>
				<input class="input-field" type="text" name="address"><br>

				<div class="input-title">Product:</div>
				<input class="input-field" type="text" name="product"><br>

				<div class="input-title">Quantity:</div>
				<input class="input-field" type="text" name="quantity"><br>

				<div class="input-title">Price per Unit:</div>
				<input class="input-field" type="text" name="price"><br>

				<div class="input-title">Description:</div>
				<textarea class="FormElement input-field" name="description" id="term"></textarea><br>

				<div class="input-title">Display Image:</div>
				<input class="input-field" type="file" name="fileToUpload" id="fileToUpload"><br>

				<input id="submit" type="submit">
			</form>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
