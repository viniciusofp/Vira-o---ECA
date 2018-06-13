<?php get_header(); ?>
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
				<div class="col-12 col-md-9 the-post">
					<?php the_content(); ?>
				</div>
				<div class="col-12 col-md-3 the-post">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; endif ?>

<?php get_footer() ?>