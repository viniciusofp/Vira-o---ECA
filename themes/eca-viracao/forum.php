<?php get_header(); ?>
<?php if (have_posts()): while(have_posts()) : the_post(); ?>
	<div class="single-content forum">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-9 the-post">

					<a href="<?php echo home_url('/?page_id=11') ?>">
						<div class="novo-topico">Criar novo tópico</div>
					</a>
						
					<h1><?php the_title(); ?></h1>
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