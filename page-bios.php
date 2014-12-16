<?php
/*
 Template Name: Bios
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

						<div id="main" class="m-all cf" role="main">

							<?php $args = array(
								'post_type' => 'bio_type',
								'posts_per_page' => 20,
								'order' => 'ASC' 
							);
							$loop = new WP_Query( $args );
							if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h2 class="page-title"><?php the_title(); ?></h2>

								</header>

								<section class="entry-content cf" itemprop="articleBody">
									<?php
										// the content (pretty self explanatory huh)
										the_content();
									?>
								</section>

							</article>

							<?php endwhile; endif; ?>

						</div>

				</div>

			</div>


<?php get_footer(); ?>
