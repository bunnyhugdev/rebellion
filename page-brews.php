<?php
/*
 Template Name: Brews
 *
*/
$stat_keys = array(
	'food_pairing' => 'Food Pairing',
	'og' => 'OG',
	'ibu' => 'IBU',
	'abv' => 'ABV',
	'srm' => 'SRM',
	'malts' => 'Malts',
	'hops' => 'Hops',
	'other_ingredients' => 'Other Ingredients'
);
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="m-all cf" role="main">

							<?php
							$args = array( 'post_type' => 'brew_type', 'posts_per_page' => 20 );
							$loop = new WP_Query( $args );
							if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h2 class="page-title"><?php the_title(); ?></h2>

								</header>

								<section class="entry-content cf" itemprop="articleBody">
									<?php
										if ( has_post_thumbnail() ) {
											?>
									<div class="entry-feature-img t-1of4 d-1of4 m-all">
									<?php
											the_post_thumbnail( 'medium' );
									?>
									</div>
									<?php
											$cnt_width = 't-3of4 d-3of4 m-all';
										} else {
											$cnt_width = 'm-all';
										}
										// the content (pretty self explanatory huh)
										echo '<div class="' . $cnt_width . '">';
										the_content();
										$stats = get_post_custom();

										foreach ( $stats as $key => $val ) {
											if ( in_array( $key, array_keys( $stat_keys ) ) ) {
												if ( count( $val ) > 0 ) {
													$v = trim( join( '', $val ) );
													if ( strlen( $v ) > 0 ) {
														echo '<div class="beer-stat"><div class="beer-stat-label t-1of4 d-1of4 m-all">' . $stat_keys[$key];
														echo '</div><div class="t-3of4 d-3of4 mall">' . join(', ', $val) . '</div>';
														echo '<div class="cf"></div></div>';
													}
												}
											}
										}
									?>
									</div>
								</section>

								<div class="cf"></div>
								<footer class="article-footer">

								</footer>

							</article>

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry cf">
											<header class="article-header">
												<h1><?php _e( 'No Brews!', 'rebelliontheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'There doesn\'t seem to be any brews entered into the website.', 'rebelliontheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page-brews.php template.', 'rebelliontheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>
				</div>

			</div>


<?php get_footer(); ?>
