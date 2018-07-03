<?php get_header(); ?>
<?php if (have_posts()): while(have_posts()) : the_post(); ?>
	<?php if (has_post_thumbnail()): ?>
	<div class="single-header header-foto" style="background-image: url(<?php echo the_post_thumbnail_url('full'); ?>)">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1>Rapidinhas</h1>
				</div>
			</div>
		</div>
	</div>
	<?php else: ?>
	<div class="single-header">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1>Rapidinhas</h1>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="single-content">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-8 the-post">
					<div class="divisor"></div>
					<h1><?php the_title(); ?></h1>
					<div class="mb-4">
						<small><?php the_date(); ?></small>
					</div>
					<?php the_content(); ?>
					<?php 
					$content = '[Fancy_Facebook_Comments]';
					echo apply_filters('the_content', $content); ?>
				</div>
				<div class="col-12 col-md-4 col-lg-3 offset-lg-1 ">
					<div class="row">
						<div class="col-12 mt-4">
							<h1>+ Rapidinhas</h1>
						</div>
						<?php 
						$args = array(
							'post_type' => 'post',
						  'posts_per_page' => 3,
						);

						$the_query = new WP_Query( $args ); 

						if ( $the_query->have_posts() ) : ?>
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<div class="col-12">
								<a href="<?php the_permalink(); ?>">
									<div class="rapidinhas-item">
										<?php if (has_post_thumbnail()): ?>
										<?php the_post_thumbnail('thumbnail') ?>	
										<?php else : ?>
											<div class="text-center" style="padding: 56px 15px; background: #ddd">
												<?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' ); ?>
											</div>
											
										<?php endif; ?>
										<div class="meta">
											<h2><?php the_title(); ?></h2>
											<?php the_excerpt(); ?>
										</div>
									</div>
								</a>
							</div>
							<?php endwhile; ?>

							<?php wp_reset_postdata(); ?>

						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
<?php endwhile; endif ?>
<?php get_footer() ?>