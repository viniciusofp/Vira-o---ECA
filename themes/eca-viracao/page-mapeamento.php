<?php
/* Template Name: Mapeamento */
get_header(); ?>
<?php if (have_posts()): while(have_posts()) : the_post(); ?>
	<div class="single-header">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1>Mapeamento</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="single-content">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-12 col-lg-8 the-post">
					<?php 
					$args = array(
						'post_type' => 'page',
						'pagename' => 'mapeamento',
					);
					$the_query = new WP_Query( $args ); 
					if ( $the_query->have_posts() ) :?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<?php the_content(); ?>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>

				<ul class="list-inline conceitos-menu">
					<?php 
					$args = array(
						'post_type' => 'page',
						'post_name__in' => array('mapeamento', 'identidade'),
					);

					$the_query = new WP_Query( $args ); 

					if ( $the_query->have_posts() ) : ?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<li class="list-inline-item">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</li>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</ul>





					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; endif ?>

<?php get_footer() ?>