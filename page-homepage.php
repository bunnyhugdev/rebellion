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
$bottomImgUrl = NULL;
if (array_key_exists('top-image', $flds)) {
	$topImage = $flds['top-image'];
	if (count($topImage) >= 1) {
		$topImgUrl = get_site_url() . $topImage[0];
	}
}
if (array_key_exists('bottom-sidebar-image', $flds)) {
	$bottomImage = $flds['bottom-sidebar-image'];
	if (count($bottomImage) >= 1) {
		$bottomImgUrl = get_site_url() . $bottomImage[0];
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
									<div class="current-location">
										<button type="button" class='primary-btn'>Find a Rebellion Near Me</button>
									</div>
									<div class="address-search">
										<p>&mdash; OR &mdash;<br>
										Enter an address to find the nearest Rebellion.</p>
										<input name="location" placeholder="Enter an address" type='text'><button class='primary-btn'>Search</button>
									</div>
								</form>
							</div>
							<i id='scroll-down-arrow' class='fa fa-angle-down'></i>
						</div>
					</div>
					<?php get_sidebar( 'midline' ); ?>
					<?php
					$qry = new WP_Query( array(
						'posts_per_page' => 1,
						'post_type' => 'post',
						'category_name' => 'feature_event'
					) );
					if ( $qry->have_posts() ): while ( $qry->have_posts() ): $qry->the_post(); ?>
					<div class="m-all cf featured-event">
						<header class="article-header">

							<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>

						</header>
						<section class="entry-content cf" itemprop="articleBody">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'full' );
							}
							?>
							<?php the_excerpt(); ?>
						</section>
					</div>
					<?php endwhile; endif; ?>
					<?php if ( is_active_sidebar( 'sidebar-bottom' ) ) : ?>
					<div class='beer-culture' <?php if (!is_null($bottomImgUrl)) echo 'style="background-image: url(' . $bottomImgUrl . ');"'; ?>>
						<h1>We Support Local Brewers</h1>
						<?php dynamic_sidebar( 'sidebar-bottom' ); ?>
						<div class="cf"></div>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<script type='text/javascript'>
				jQuery('.current-location button').click(function() {
					window.location = '<?php echo get_site_url() . '/locations/'; ?>';
				});
			</script>
<?php get_footer(); ?>
