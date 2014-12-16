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
      	src="https://maps.googleapis.com/maps/api/js?libraries=geometry&key=AIzaSyDMLZOSsRy4Or2dxcz1Mco-FMCSkap2BHI">
			</script>
			<script type='text/javascript'>
				function defaultGeoLocation() {
					// LatLng of the brewery
					var lat = <?php echo get_theme_mod( 'lat', 0); ?>,
							lng = <?php echo get_theme_mod( 'long', 0); ?>;
					return new google.maps.LatLng(lat, lng);
				}
				function initMap() {
					var qry = <?php echo ($_GET['location']) ? '"' . htmlspecialchars($_GET['location']) . '"' : 'null'; ?>;
					var loc = defaultGeoLocation();
					var mapOptions = {
						center: loc,
						zoom: 14
					};
					var map = new google.maps.Map(document.getElementById('location-map'), mapOptions);
					if (qry == null) {
						if (navigator.geolocation) {
							navigator.geolocation.getCurrentPosition(function(position) {
								loc = new google.maps.LatLng(position.coords.latitude,
																						 position.coords.longitude);
								finishInitMap(loc);
							});
						}
					} else {
						var geocoder = new google.maps.Geocoder();
						geocoder.geocode({'address': qry}, function(results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
								loc = results[0].geometry.location;
								finishInitMap(loc);
							}
						});
					}
					function finishInitMap(center) {
						var locations = [], infoContents = {}, tmpPos, tmpDist, tmpMarker,
								infoWindow = new google.maps.InfoWindow(),
								icon = '<?php echo get_template_directory_uri(); ?>/favicon-32x32.png',
								stripSpaceRegex = /\+/g;
						// You are here marker
						tmpMarker = new google.maps.Marker({
							position: center,
							map: map,
							title: 'Your current location'
						});
						// Add the brewery to the map
						tmpPos = defaultGeoLocation();
						tmpDist = google.maps.geometry.spherical.computeDistanceBetween(center, tmpPos);
						locations.push({position: tmpPos, distance: tmpDist});
						tmpMarker = new google.maps.Marker({
							position: tmpPos,
							map: map,
							animation: google.maps.Animation.DROP,
							icon: '<?php echo get_template_directory_uri() . "/library/images/big-logo.png"; ?>',
							title: '<?php echo get_bloginfo( 'name' ); ?>'
						});
						infoContents[tmpPos] = {
							title: '<?php echo urlencode( get_bloginfo( 'name' ) ); ?>',
							content: '<?php echo urlencode( get_theme_mod( 'physical_address', '' ) ); ?>',
							marker: tmpMarker
						};
						google.maps.event.addListener(tmpMarker, 'click', function(evt) {
							var pl = infoContents[evt.latLng];
							infoWindow.setContent('<h4>' +
							decodeURIComponent(pl.title).replace(stripSpaceRegex, ' ') +
							'</h4> ' +
							decodeURIComponent(pl.content).replace(stripSpaceRegex, ' '));
							infoWindow.setPosition(evt.latLng);
							infoWindow.open(map, pl.marker);
						});
						<?php $args = array( 'post_type' => 'location_type', 'nopaging' => true );
						$loop = new WP_Query( $args );
						if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
							$loc = get_field( 'location' );
							?>
							tmpPos = new google.maps.LatLng(<?php echo $loc['lat'] . ', '. $loc['lng']; ?>);
							tmpDist = google.maps.geometry.spherical.computeDistanceBetween(center, tmpPos);
							locations.push({position: tmpPos, distance: tmpDist});
							tmpMarker = new google.maps.Marker({
								position: tmpPos,
								map: map,
								animation: google.maps.Animation.DROP,
								icon: icon,
								title: '<?php echo get_the_title(); ?>'
							});
							infoContents[tmpPos] = {
								title: '<?php echo urlencode( get_the_title() ); ?>',
								content: '<?php echo urlencode( get_the_content() ); ?>',
								marker: tmpMarker
							};
							google.maps.event.addListener(tmpMarker, 'click', function(evt) {
								var pl = infoContents[evt.latLng];
								infoWindow.setContent('<h4>' +
									decodeURIComponent(pl.title).replace(stripSpaceRegex, ' ') +
									'</h4> ' +
									decodeURIComponent(pl.content).replace(stripSpaceRegex, ' '));
								infoWindow.setPosition(evt.latLng);
								infoWindow.open(map, pl.marker);
							});
						<?php
						endwhile; endif; ?>
						locations.sort(function(a,b) {
							return a.distance - b.distance;
						});
						var max = Math.min(locations.length, 5) - 1;
						var mapBounds = new google.maps.LatLngBounds();
						mapBounds.extend(center);
						for (var i = 0; i < max; i++) {
							mapBounds.extend(locations[i].position);
						}
						map.panTo(center);
						map.fitBounds(mapBounds);
					}
				}
				function delayInit() {
					window.setTimeout(function() {
						var topOffset = (jQuery('body').hasClass('admin-bar')) ? 32 : 0;
						topOffset += jQuery('.header').height();
						var windowHeight = jQuery(window).height() - topOffset;
						jQuery('#main').height(windowHeight);
						initMap();
					}, 100);
				}
				google.maps.event.addDomListener(window, 'load', delayInit);
			</script>
<?php get_footer(); ?>
