<?php
/*
 Template Name: Home Page
 *
 * This is the template for the main homepage. It's mostly a static page.
*/
?>

<?php get_header(); ?>
<?php
$flds = get_post_custom();
$topImgUrl = NULL;
$brewersImgUrl = NULL;
if (array_key_exists('top-image', $flds)) {
	$topImage = $flds['top-image'];
	if (count($topImage) >= 1) {
		$topImgUrl = get_site_url() . $topImage[0];
	}
}
if (array_key_exists('brewers-image', $flds)) {
	$brewersImage = $flds['brewers-image'];
	if (count($brewersImage) >= 1) {
		$brewersImgUrl = get_site_url() . $brewersImage[0];
	}
}

?>
			<div id="front-content">
				<div id="inner-content" class="cf">
					<div id="main" class="m-all cf frontpage"
							role="main" <?php if (!is_null($topImgUrl)) echo 'style="background-image: url(' . $topImgUrl . ');"'; ?>>
						<div id="top">
							<h1><?php bloginfo( 'description' ); ?></h1>
							<div class="locator">
								<form method="GET" action="<?php echo get_site_url() . '/locations/';?>">
									<div class="address-search">
										<input name="location" placeholder="Enter an address" type='text'><button class='primary-btn'>Find</button>
									</div>
									<div class="current-location">
										<button type="button" class='primary-btn'>Use my current location</button>
									</div>
								</form>
							</div>
							<i id='scroll-down-arrow' class='fa fa-angle-down'></i>
						</div>
					</div>
					<?php get_sidebar( 'midline' ); ?>					
					<?php get_sidebar( 'bottom' ); ?>
				</div>
			</div>
			<script type='text/javascript'>
				jQuery('.current-location button').click(function() {
					window.location = '<?php echo get_site_url() . '/locations/'; ?>';
				});
			</script>
<?php get_footer(); ?>
