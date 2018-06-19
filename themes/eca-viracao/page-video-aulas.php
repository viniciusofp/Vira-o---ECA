<?php get_header();
$video = the_field('video') ?>
						
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
	<div class="single-content container">
		<div id="video-aulas-slide" class="carousel slide">
  		<div class="carousel-inner">
		  	<?php
				$counter = 0;
				$class = '';
				$args = array(
					'post_type' => 'video-aulas',
				  'posts_per_page' => -1
				);

				$the_query = new WP_Query( $args ); 

				if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
					if ($counter == 0) {
						$class = 'active';
					} else {
						$class = '';
					} $counter++;?>
			    <div class="carousel-item <?php echo $class;?>">
			    	<div class="row">
				    	<div class="col-md-4">
								<h1><?php the_title(); ?></h1>
								<?php the_content(); ?>
							</div>
							<div class="col-md-8">
								<div class="embed-container">
									<?php the_field('video'); ?>
								</div>
							</div>
			    	</div>
			    </div>
						
					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>
				<?php endif; ?>	

		  </div>
		</div>

		<div class="row mt-4">
			<div class="col-12">
				<div class="divisor mb-4"></div>
			</div>
				<?php
				$i = 0;
				$args = array(
					'post_type' => 'video-aulas',
				  'posts_per_page' => -1
				);
				$the_query = new WP_Query( $args ); 
				if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post();?>

			    	<div class="col-4 col-sm-4 col-md-3 col-lg-2">
			    		<div class="video-aula-thumb" data-target="#video-aulas-slide" data-slide-to="<?php echo $i; ?>"><?php the_post_thumbnail('thumbnail'); ?></div>
			    	</div>

						
					<?php $i++; endwhile; ?>

					<?php wp_reset_postdata(); ?>
				<?php endif; ?>	
		</div>
		
  	<div class="row">
  		<div class="col-12">
  			<?php 
				$content = '[Fancy_Facebook_Comments]';
				echo apply_filters('the_content', $content); ?>
  		</div>
  	</div>
	</div>
	
<?php endwhile; endif ?>
<?php get_footer() ?>