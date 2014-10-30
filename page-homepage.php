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
$imgUrl = NULL;
if (array_key_exists('top-image', $flds)) {
	$topImage = $flds['top-image'];
	if (count($topImage) >= 1) {
		$imgUrl = get_site_url() . $topImage[0];
	}
}
?>
			<div id="front-content">
				<div id="inner-content" class="cf">
					<div id="main" class="m-all cf frontpage"
							role="main" <?php if (!is_null($imgUrl)) echo 'style="background-image: url(' . $imgUrl . ');"'; ?>>
						<div id="top">
							<h1><?php bloginfo( 'description' ); ?></h1>
							<div class="locator">
								<form method="GET" action="#">
									<div class="address-search">
										<input placeholder="Enter an address" type='text'><button class='primary-btn'>Find</button>
									</div>
									<div class="current-location">
										<button class='primary-btn'>Use my current location</button>
									</div>
								</form>
							</div>
							<i id='scroll-down-arrow' class='fa fa-angle-down'></i>
						</div>
					</div>
					<div id="midline" class=="cf">
						<div class="t-1of3 d-1of3 m-all">
							<div class="midline-box">
								<h3>News / Events</h3>
								<?php
								$qry = new WP_Query( array(
									'posts_per_page' => 3,
									'post_type' => 'post'
								) );
								?>
								<ul id="news-items">
									<?php if ( $qry->have_posts() ): while ( $qry->have_posts() ): $qry->the_post(); ?>
									<li>
										<h4><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h4>
										<?php printf( '<time class="updated" datetime="%1$s" pubdate>%2$s</time>', get_the_time('Y-m-j'), get_the_time(get_option('date_format')) ); ?>
										<?php the_excerpt(); ?>
									</li>
									<?php endwhile; endif; ?>
								</ul>
							</div>
						</div>
						<div class="t-1of3 d-1of3 m-all">
							<div class="midline-box">
								<h3>Be Social</h3>
								<p>Follow, Like, Share</p>
								<ul id="social-links">
									<li><a href=""><i class='fa fa-facebook fa-2x'></i></a></li>
									<li><a href=""><i class='fa fa-twitter fa-2x'></i></a></li>
									<li><a href=""><i class='fa fa-youtube fa-2x'></i></a></li>
								</ul>
							</div>
						</div>
						<div class="t-1of3 d-1of3 m-all">
							<div class="midline-box">
								<h3>Contact Us</h3>
								<p>
									Visit the brewery &amp; taproom at<br>
								</p>
								<address>
									1911 Dewdney Ave.<br>
									Regina, SK, S4R 8R2<br>
								</address>
								<p>Drop us a line at<p>
								306-555-5555<br>
								<a href="mailto:info@rebellionbrewing.ca">info@rebellionbrewing.ca</a>
							</div>
						</div>
						<div class='cf'></div>
					</div>
					<?php
					/* the meta tag will only display bios where 'front-page' is checked */
					$brewers = new WP_Query( array(
						'post_type' => 'bio_type',
						'posts_per_page' => 5,
						'meta_key' => 'front_page',
						'meta_value' => 'a:1',
						'meta_compare' => 'LIKE'
					));
					if ( $brewers->have_posts() ):
						$cls = sprintf( 't-1of%1$d d-1of%1$d m-all', $brewers->post_count );
					?>
					<div id="brewers-section" class="cf">
						<h1>The Brewers</h1>
						<?php while ( $brewers->have_posts() ): $brewers->the_post(); ?>
						<div class="<?php echo $cls; ?>">
							<div class='content-box'>
								<?php
									$img_id = get_post_thumbnail_id();
									$img_src = wp_get_attachment_image_src($img_id, 'medium')[0];
								?>
								<h3 style="background-image: url(<?php echo $img_src; ?>);"><?php echo get_the_title(); ?></h3>
								<?php the_content(); ?>
							</div>
						</div>
						<?php endwhile; ?>
						<div class="cf"></div>
					</div>
					<?php endif; ?>
					<div class='beer-culture'>
						<h1>We Support Local Brewers</h1>
						<div class="t-2of3 d-2of3 m-all">
							<div class="content-box">
								<p>We're committed to supporting the local home brew community through various home brew events,
								including tastings, beer competitions, tours, sourcing rare ingredients and more.</p>
								<p>We find the best home brewers in the Regina area and invite them to brew with us, featuring their
								recipes on our taps. We're proud to show off the flavours and talent of Saskatchewan home brewers.</p>
							</div>
						</div>
						<div class="t-1of3 d-1of3 m-all">
							<div class="content-box community-tap">
								<h3>Community Tap</h3>
								<ul>
									<li>Dave Hanna's Imperial Brown Ale</li>
									<li>Rick August's American Pale Ale</li>
								</ul>
							</div>
						</div>
						<div class="cf"></div>
					</div>
				</div>
			</div>
<?php get_footer(); ?>
