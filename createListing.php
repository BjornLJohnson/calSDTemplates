<?php require_once '../../../../wp-load.php'; ?>

<html>
<body>

  <h2 class="thanks">Thank you for your post!</h2>

  <div class="thankMSG"> Your listing should now be visible on the listings page</div>

  <a href="<?php echo get_page_link( get_page_by_title("Listings")->ID ); ?>">Listings Page</a>

  
  <?php
  $newListing = array(
    'post_name'  => $_POST["name"],
    'post_title' => $_POST["name"],
    'post_type' => 'listing',
    'post_status' => 'publish',
    'post_author' => get_current_user_id()
  );

  if(isset($_POST['category'])) :
    $catIDArray = array();
    $catArray = $_POST['category'];
    foreach ($catArray as $catItem){ 
      array_push($catIDArray, get_cat_ID($catItem));
    }
    $newListing['post_category'] = $catIDArray;
  endif;

  if(isset($_POST['tag'])) :
    $newListing['tags_input'] = $_POST['tag'];
  endif;

  $newListingID = wp_insert_post($newListing);

  add_post_meta($newListingID, 'address', $_POST["address"], true);
  add_post_meta($newListingID, 'product', $_POST["product"], true);
  add_post_meta($newListingID, 'quantity', $_POST["quantity"], true);
  add_post_meta($newListingID, 'price', $_POST["price"], true);
  add_post_meta($newListingID, 'description', $_POST["description"], true);

  $uploaddir = wp_upload_dir();
  $file = $_FILES['thumbnail'];
  $uploadfile = $uploaddir['path'] . '/' . basename( $file['name'] );

  move_uploaded_file( $file['tmp_name'] , $uploadfile );
  $filename = basename( $uploadfile );

  $wp_filetype = wp_check_filetype(basename($filename), null );

  $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
      'post_content' => '',
      'post_status' => 'inherit'
  );
  $attach_id = wp_insert_attachment( $attachment, $uploadfile );

  set_post_thumbnail( $newListingID, $attach_id );
  ?>

</body>

</html>