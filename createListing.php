<?php require_once '../../../../wp-load.php'; ?>

<html>
<body>

Welcome <?php echo $_POST["name"]; ?><br>


This is a test

<?php 

$newListing = array(
    'post_name'  => $_POST["name"],
    'post_title' => $_POST["name"],
    'post_type' => 'listing',
    'post_status' => 'publish'
  );


$newListingID = wp_insert_post($newListing);

add_post_meta($newListingID, 'address', $_POST["address"], true);
add_post_meta($newListingID, 'product', $_POST["product"], true);
add_post_meta($newListingID, 'quantity',$_POST["quantity"], true);
add_post_meta($newListingID, 'price', $_POST["price"], true);

?>

Testing

</body>
</html>