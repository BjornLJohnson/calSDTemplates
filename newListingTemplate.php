<?php
/* Template Name: Add Listing Page */

wp_enqueue_style('grid', get_stylesheet_directory_uri() . '/calsdtemplates/css/grid.css');

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

			<h2>Add Listing</h2>

			<form action=<?php echo get_theme_file_uri( $file = 'calSDTemplates/createListing.php' )?> method="post" enctype="multipart/form-data">
				Organization Name: <input type="text" name="name"><br>
				Address: <input type="text" name="address"><br>
				Product: <input type="text" name="product"><br>
				Quantity: <input type="text" name="quantity"><br>
				Price Per Unit: <input type="text" name="price"><br>
				Choose a Thumbnail Image: <input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit">
			</form>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
