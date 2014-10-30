<?php
/*
 Template Name: Locations
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="m-all map-container cf" role="main">
							<div id="location-map"></div>

						</div>

				</div>

			</div>
			<script type="text/javascript"
      	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMLZOSsRy4Or2dxcz1Mco-FMCSkap2BHI">
			</script>
			<script type='text/javascript'>

				function initMap() {
					var mapOptions = {
						center: { lat: 50.4547, lng: -104.6067},
						zoom: 14
					};
					var map = new google.maps.Map(document.getElementById('location-map'), mapOptions);
					<?php $args = array( 'post_type' => 'location_type', 'nopaging' => true );
					$loop = new WP_Query( $args );
					if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
						$loc = get_field( 'location' );
						?>
						new google.maps.Marker({
							position: new google.maps.LatLng(<?php echo $loc['lat'] . ', '. $loc['lng']; ?>),
							map: map,
							title: '<?php echo get_the_title(); ?>'
						});
					<?php
					endwhile; endif; ?>
				}
				google.maps.event.addDomListener(window, 'load', initMap);


			</script>
<?php get_footer(); ?>
