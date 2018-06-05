<?php get_header() ?>
<?php if (have_posts()): while(have_posts()) : the_post(); ?>
	<div class="single-header">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="single-content">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-4">
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</div>
				<div class="col-12 col-md-8">
					<div class="row">
						<?php 
						$the_query = new WP_Query( array(
							'post_type' => 'post',
							'posts_per_page' => 6
						)); ?>
						<?php if ( $the_query->have_posts() ) : ?>
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<div class="col-md-6 col-lg-4">
								<a href="<?php the_permalink(); ?>">
									<div class="rapidinhas-item">
										<?php the_post_thumbnail('thumbnail') ?>
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