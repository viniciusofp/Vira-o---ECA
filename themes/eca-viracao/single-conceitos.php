<?php get_header() ?>
<?php if (have_posts()): while(have_posts()) : the_post();
$quiz_url = get_field('quiz')[0]->guid;
$mao_na_massa_url = get_field('mao_na_massa')[0]->guid;
?>
	<div class="single-header">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1>Conceitos</h1>
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
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
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
				<div class="col-12 col-md-8 the-post">
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</div>
				<div class="col-12 col-md-4 col-lg-4 timeline">
					<div class="row">
						<div class="col-12">
							<h3>Linha do Tempo: <?php the_title(); ?></h3>
							<ul>
								<?php
								if( have_rows('linha_do_tempo') ):
								while ( have_rows('linha_do_tempo') ) : the_row();?>
									<li data-trigger="hover" data-toggle="popover"  data-placement="left" data-content="<?php the_sub_field('descricao');?>">
										<div class="title"><?php the_sub_field('titulo');?></div>
										<div class="year"><?php the_sub_field('ano'); ?></div>
									</li>

								<?php
								endwhile;
								else :
								    // no rows found
								endif;
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="conceitos-footer">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6 maonamassa align-self-center">
					<?php 
					$args = array(
						'post_type' => 'page',
						'pagename' => 'mao-na-massa',
					);
					$the_query = new WP_Query( $args ); 
					if ( $the_query->have_posts() ) :?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

						<h1 class="big"><?php the_title(); ?></h1>
						<p><?php the_content(); ?></p>
						<a href="<?php echo $mao_na_massa_url; ?>"><button class="btn btn-lg"><?php the_field('botao'); ?></button></a>

						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
					
				</div>
				<div class="col-md-6 quiz align-self-center">
					<?php 
					$args = array(
						'post_type' => 'page',
						'pagename' => 'quiz',
					);
					$the_query = new WP_Query( $args ); 
					if ( $the_query->have_posts() ) :?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

						<h1 class="big"><?php the_title(); ?></h1>
						<p><?php the_content(); ?></p>
						<a href="<?php echo $quiz_url; ?>"><button class="btn btn-lg"><?php the_field('botao'); ?></button></a>
						

						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	
<?php endwhile; endif ?>
<script>
	var links = jQuery('.conceitos-menu li a');
	for (var i = links.length - 1; i >= 0; i--) {
		var linkHref = jQuery(links[i]).attr('href');
		if (linkHref == window.location.href ) {
			jQuery(links[i]).addClass('active')
		}
	}

	jQuery(function () {
	  jQuery('[data-toggle="popover"]').popover()
	})
</script>
<?php get_footer() ?>