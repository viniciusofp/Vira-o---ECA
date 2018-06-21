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
	<div class="conceitos-menu">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<ul class="list-inline">
						<?php 
							$args = array(
								'post_type' => 'conceitos',
							  'posts_per_page' => -1,
							);

							$the_query = new WP_Query( $args ); 

							if ( $the_query->have_posts() ) : ?>
								<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
								<li class="list-inline-item">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</li>
								<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
							<?php endif; ?>
					</ul>
				</div>			
			</div>
	
		</div>
	</div>
	<div class="single-content">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-10 the-post">
					<a href="#" onclick="window.history.back()"><i class="fa fa-arrow-left mr-2"></i>Voltar</a>
					<div class="divisor"></div>
					<h1 class="big d-none"><?php the_title(); ?></h1>
					<div class="mb-1">

					</div>
					<?php the_post_thumbnail(); ?>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
	
	
<?php endwhile; endif ?>
<script>
	var links = jQuery('.conceitos-menu li a');
	for (var i = links.length - 1; i >= 0; i--) {
		var linkTitle = jQuery(links[i]).html();
		if (linkTitle == jQuery('h1.big').html() ) {
			jQuery(links[i]).addClass('active')
		}
	}
</script>
<?php get_footer() ?>