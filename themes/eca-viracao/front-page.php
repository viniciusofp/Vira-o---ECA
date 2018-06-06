<?php get_header() ?>
<?php if (have_posts()): while(have_posts()) : the_post(); ?>

<div class="single-header">
		<div id="home-rapidinhas-slide" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
		  	<?php
				$counter = 0;
				$class = '';
				$args = array(
					'post_type' => 'post',
				  'posts_per_page' => 6
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
						<div class="container-fluid">
				    	<div class="shadow"></div>
				    	<div class="bg" style="background-image: url(<?php the_post_thumbnail_url('large'); ?>);"></div>
				    	<div class="row justify-content-center" style="height: 420px">
								<div class="col-11 col-sm-10 col-lg-8 align-self-center">
									<div class="">
										<h1><?php the_title(); ?></h1>
									</div>
									
								</div>
				    	</div>
				    </div>
					</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>	
			  <a class="carousel-control-prev" href="#home-rapidinhas-slide" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#home-rapidinhas-slide" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
		  </div>
		</div>
</div>

	<h1><?php the_title(); ?></h1>
	<?php the_content(); ?>
<?php endwhile; endif ?>
<?php get_footer() ?>