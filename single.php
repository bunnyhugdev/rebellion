<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<div id="main" class="m-all t-2of3 d-5of7 cf" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h2 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h2>

									<p class="byline vcard">
										<?php printf( __( '<time class="updated" datetime="%1$s" pubdate>%2$s</time>', 'rebelliontheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')) ); ?>
									</p>

								</header>

								<section class="entry-content cf" itemprop="articleBody">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'large' );
									}
									?>
									<?php the_content(); ?>
								</section>

							</article>

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'rebelliontheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'rebelliontheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'rebelliontheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>

					</div>

					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
