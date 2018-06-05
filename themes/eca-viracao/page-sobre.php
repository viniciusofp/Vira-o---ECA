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
	<div class="container mt-3 mb-3">
		<div class="row">
			<div class="col-12">
				<div class="divisor"></div>
				<h1>Sobre a ECA</h1>
			</div>
		</div>
	</div>
	<div class="single-featured" style="background-image: url(<?php the_post_thumbnail_url('full');?>)"></div>
	<div class="single-content">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-10 col-lg-9">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
	
	
<?php endwhile; endif ?>
<?php get_footer() ?>