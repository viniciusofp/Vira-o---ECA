<?php get_header(); ?>
<?php if (have_posts()): while(have_posts()) : the_post(); ?>
	<div class="single-header header-foto" style="background-image: url(<?php echo the_post_thumbnail_url('full'); ?>)">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1>Mão na Massa</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="single-content">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-10 the-post">
					<div class="divisor"></div>
					<h1 class="big"><?php the_title(); ?></h1>
					<div class="mb-1">
						<small><?php the_date(); ?></small>
					</div>
					<?php the_post_thumbnail(); ?>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
	
	
<?php endwhile; endif ?>
<?php get_footer() ?>