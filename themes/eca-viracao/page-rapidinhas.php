<?php get_header() ?>
<?php if (have_posts()): while(have_posts()) : the_post(); ?>
	<div class="single-header header-foto" style="background-image: url(<?php echo the_post_thumbnail_url('full'); ?>)">
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
				<div class="col-12 col-md-3 d-none">
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</div>
				<div class="col-12 col-md-12">
					<div class="row">
						<?php 
						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$args = array(
							'post_type' => 'post',
						  'posts_per_page' => 6,
						  'paged'          => $paged
						);

						$the_query = new WP_Query( $args ); 

						if ( $the_query->have_posts() ) : ?>
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<div class="col-6 col-lg-4">
									<div class="rapidinhas-item">
										<a href="<?php the_permalink(); ?>">
										<?php if (has_post_thumbnail()): ?>
										<?php the_post_thumbnail('thumbnail') ?>	
										<?php else : ?>
											<div class="text-center" style="padding: 56px 15px; background: #ddd">
												<?php the_custom_logo(); ?>
											</div>
											
										<?php endif; ?>
										
										<div class="meta">
											<h2><?php the_title(); ?></h2>
											<?php the_excerpt(); ?>
										</div>
										</a>
									</div>
							</div>
							<?php endwhile; ?>

							<?php wp_reset_postdata(); ?>

							<!-- pagination here -->
							<?php if (function_exists("pagination")) {
				        pagination($the_query->max_num_pages);
				      } ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
<?php endwhile; endif ?>
<?php get_footer() ?>