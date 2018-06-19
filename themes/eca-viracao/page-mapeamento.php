<?php
/* Template Name: Mapeamento */
get_header();?>
<?php if (have_posts()): while(have_posts()) : the_post(); 
$user_info = get_userdata( get_current_user_id() );
$theID = get_the_ID();
$thisPost = $post;?>
	<div class="single-header header-foto" style="background-image: url(<?php echo the_post_thumbnail_url('full'); ?>)">
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
				<div class="col-12 col-md-12 col-lg-10 col-xl-8 the-post">
				<!-- MAPEAMENTO CONTENT -->
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
				<!-- MENU -->
					<ul class="list-inline conceitos-menu">
						<?php 
						$args = array(
							'order' => 'ASC',
							'post_type' => 'page',
							'post_name__in' => array('identidade', 'relacao-com-o-territorio', 'participacao-politica', 'direitos'),
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


				<?php if (the_slug_exists($user_info->user_nicename,'mapeamentos')):
					$args = array(
						'name' => $user_info->user_nicename,
					  'post_type'   => 'mapeamentos',
					  'posts_per_page' => 1
					);
					$the_query = new WP_Query( $args );
					if ( $the_query->have_posts() ) :
					while ( $the_query->have_posts() ) : $the_query->the_post(); 
					$i = 1;
					?>
					<form id="new_post" name="new_post" method="post" action="">
						<?php if( have_rows('perguntas', $theID) ):
											$perguntaCount = 1;
											?>
						<?php while( have_rows('perguntas', $theID) ): the_row(); 
							// vars
							$pergunta = get_sub_field('pergunta');
							$explicacao = get_sub_field('explicacao');
							$respostaName = $thisPost->post_name . '_resposta_' . $perguntaCount;
							$perguntaName = $thisPost->post_name . '_pergunta_' . $perguntaCount;
							$value = get_field($thisPost->post_name . '_resposta_'.$i);
							?>
							<h3 class="mt-5"><?php echo $perguntaCount; ?>. <?php echo $pergunta; ?></h3>
							<p><?php echo $explicacao; ?></p>
							<textarea class="form-control mt-3" id="<?php echo $respostaName ?>" name="<?php echo $respostaName ?>" id="" cols="30" rows="10"><?php echo $value; ?></textarea>
							<input type="hidden" name="<?php echo $perguntaName ?>" value="<?php echo $pergunta; ?>" />
							<?php $perguntaCount++; $i++ ?>
						<?php endwhile;endif;?>

					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
					<?php endif; ?>
						<p><button class="mt-4 btn btn-primary" type="submit" value="Publish" tabindex="6" id="submit" name="submit">Atualizar</button></p>
						<input type="hidden" name="loops" value="<?php echo $perguntaCount ?>" />
						<input type="hidden" name="action" value="new_<?php echo $thisPost->post_name;?>" />
							<?php wp_nonce_field( 'new-post' ); ?>
					</form>
				<?php else: ?>

							<form id="new_post" name="new_post" method="post" action="">

								<?php if( have_rows('perguntas') ):
								$perguntaCount = 1;
								?>
								<?php while( have_rows('perguntas') ): the_row(); 
									// vars
									$pergunta = get_sub_field('pergunta');
									$explicacao = get_sub_field('explicacao');
									$respostaName = $thisPost->post_name . 'resposta_' . $perguntaCount;
									$perguntaName = $thisPost->post_name . 'pergunta_' . $perguntaCount;
									?>
									<h3 class="mt-5"><?php echo $perguntaCount; ?>. <?php echo $pergunta; ?></h3>
									<p><?php echo $explicacao; ?></p>
									<textarea class="form-control mt-3" name="<?php echo $respostaName ?>" id="" cols="30" rows="10"></textarea>
									<input type="hidden" name="<?php echo $perguntaName ?>" value="<?php echo $pergunta; ?>" />
									<?php $perguntaCount++; $i++ ?>
								<?php endwhile; endif; ?>

								<p align="right"><button class="mt-3 form-control btn btn-lg btn-outline-primary" type="submit" value="Publish" tabindex="6" id="submit" name="submit">Enviar</button></p>
								<input type="hidden" name="loops" value="<?php echo $perguntaCount ?>" />
								<input type="hidden" name="action" value="new_plano" />
								<?php wp_nonce_field( 'new-post' ); ?>

							</form>

				<?php endif ?>
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
</script>
<?php get_footer() ?>