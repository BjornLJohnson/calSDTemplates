<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package SimClick
 */


session_start();
wp_enqueue_style('individual', get_stylesheet_directory_uri() . '/calsdtemplates/css/individual.css');

get_header(); 
$c_street = $_SESSION['c_street'];
$c_city = $_SESSION['c_city'];
$c_state = $_SESSION['c_state'];
?>

<?php

function getDrivingDist ($street_address,$city,$state,$c_street,$c_city,$c_state) {
  	$street_address = str_replace(" ", "+", $street_address);
    $city = str_replace(" ", "+", $city);
    $state = str_replace(" ", "+", $state);
    $c_street = str_replace(" ", "+", $c_street);
    $c_city = str_replace(" ", "+", $c_city);
    $c_state = str_replace(" ", "+", $c_state);

	$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$c_street,+$c_city,+$c_state&destinations=$street_address,+$city,+$state&key=[INSERT API KEY HERE]";
	// $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=101+East+21st+Street,+Austin,+TX&destinations=$street_address,+$city,+$state&key=AIzaSyCQWgksFykHO6__c8hYZbz3yFxHTjnNtSI";


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
	curl_close($ch);
	$response_a = json_decode($response, true);
	return $response_a;
}

$address = get_post_meta(get_the_ID(), 'address', true);
$product = get_post_meta(get_the_ID(), 'product', true);
$price = get_post_meta(get_the_ID(), 'price', true);
$quantity = get_post_meta(get_the_ID(), 'quantity', true);
$description = get_post_meta(get_the_ID(), 'description', true);
$phone_number = get_post_meta(get_the_ID(), 'phone_number', true);
$contact_name = get_post_meta(get_the_ID(), 'contact_name', true);
$user_email = get_post_meta(get_the_ID(), 'user_email', true);
$current_user_phone = get_user_meta(get_current_user_id(), 'phone_number', true);
$current_user_name = get_user_meta(get_current_user_id(), 'contact_name', true);

?>

<div class = "row">
	<div class = "column">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class = "featured-image">
				<?php the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); 
				?>
			</div>
		<?php endif; ?>
	 	<div><a href = "listings" class = "button"> See All Listings </a></div>
	</div>

	
	<?php
		while ( have_posts() ) : the_post();
    ?>
		<div class = "column">
			<div class = "listing-info">
				<?php 
					$dist = getDrivingDist($address, $city, $state, $c_street, $c_city, $c_state); 
					$dist_km = $dist['rows'][0]['elements'][0]['distance']['text']; //distance in km
					$dist_m = $dist_km/1.609;
				?> 
				<div class = "distance"><b>Distance Away: </b><?php echo round($dist_m,1)." miles"; ?></div>
				<div class = prod-info>
					<div><b>Product: </b><?php echo $product ?></div>
					<div><b>Price Per Unit: </b><?php echo $price ?></div>
					<div><b>Quantity: </b><?php echo $quantity ?></div>	
				</div>
					<div ><b>Description:</b></div>
					<div class = "description"><?php echo $description ?></div>			
			</div>	<!-- .listing-info -->
		</div> <!-- .column -->
		<div class = "column">
			<div class = "person-info">
				<div style = "text-transform: uppercase; margin-bottom: 10px"> Contact Now</div>
				<div><b>Name: </b><?php echo $contact_name ?></div>
				<div><b>Phone Number: </b><?php echo $phone_number ?></div>
				<div><b>Email: </b><?php echo $user_email ?></div>
				<div><b>Address: </b><?php echo $address ?></div>
				<?php 
					$email_link = "mailto:$user_email?
					&subject=Interested%20in%20your%20$product%20listing&body=Hi%20$contact_name,%0D%0A%0D%0AI%20am%20interested%20in%20obtaining%20the%20$product%20that%20you%20listed%20on%20CALSD%20Marketplace%20at%20calsd.marqui.tech.%0D%0A%20Please%20reply%20if%20you%20want%20to%20connect!%20%0D%0A%0D%0ABest,%0D%0A$current_user_name%0D%0A$current_user_phone"
				?>

				<div><a href = "<?=$email_link?>" target = "_blank"> <?php echo "Click to email ".$contact_name." now!"?> </a>
			</div>
				
		</div><!-- .column -->			    		

	<?php endwhile; ?>
</div> <!-- .row -->
<?php
get_sidebar();
get_footer();