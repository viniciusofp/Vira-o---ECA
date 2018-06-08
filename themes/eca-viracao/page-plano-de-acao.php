<?php get_header();
$user_info = get_userdata( get_current_user_id() );
?>
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
				<div class="col-12 col-md-10 the-post">
					<?php the_content(); ?>
					<form id="new_post" name="new_post" method="post" action="">
						<?php if (the_slug_exists($user_info->user_nicename,'planos-de-acao')):
							$args = array(
								'name' => $user_info->user_nicename,
							  'post_type'   => 'planos-de-acao'
							);
							$the_query = new WP_Query( $args );
							if ( $the_query->have_posts() ) :
							while ( $the_query->have_posts() ) : $the_query->the_post(); 
							$i = 1;
							?>

								<?php if( have_rows('perguntas', 27) ):
													$perguntaCount = 1;
													?>
								<?php while( have_rows('perguntas', 27) ): the_row(); 
									// vars
									$pergunta = get_sub_field('pergunta');
									$explicacao = get_sub_field('explicacao');
									$respostaName = 'resposta_' . $perguntaCount;
									$perguntaName = 'pergunta_' . $perguntaCount;
									$value = get_field('resposta_'.$i);
									?>
									<h3 class="mt-5"><?php echo $perguntaCount; ?>. <?php echo $pergunta; ?></h3>
									<p><?php echo $explicacao; ?></p>
									<textarea class="form-control mt-3" name="<?php echo $respostaName ?>" id="" cols="30" rows="10"><?php echo $value; ?></textarea>
									<input type="hidden" name="<?php echo $perguntaName ?>" value="<?php echo $pergunta; ?>" />
									<?php $perguntaCount++; $i++ ?>
								<?php endwhile;endif;?>
		
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
							<?php endif; ?>

							<p align="right"><button class="mt-3 form-control btn btn-lg btn-outline-primary" type="submit" value="Publish" tabindex="6" id="submit" name="submit">Atualizar</button></p>
							<input type="hidden" name="loops" value="<?php echo $perguntaCount ?>" />
							<input type="hidden" name="action" value="new_plano" />
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
									$respostaName = 'resposta_' . $perguntaCount;
									$perguntaName = 'pergunta_' . $perguntaCount;
									?>
									<h3 class="mt-5"><?php echo $perguntaCount; ?>. <?php echo $pergunta; ?></h3>
									<p><?php echo $explicacao; ?></p>
									<textarea class="form-control mt-3" name="<?php echo $respostaName ?>" id="" cols="30" rows="10" value="<?php echo get_field('resposta_'.$i); ?>"></textarea>
									<input type="hidden" name="<?php echo $perguntaName ?>" value="<?php echo $pergunta; ?>" />
									<?php $perguntaCount++; $i++ ?>
								<?php endwhile; endif; ?>

								<p align="right"><button class="mt-3 form-control btn btn-lg btn-outline-primary" type="submit" value="Publish" tabindex="6" id="submit" name="submit">Atualizar</button></p>
								<input type="hidden" name="loops" value="<?php echo $perguntaCount ?>" />
								<input type="hidden" name="action" value="new_plano" />
								<?php wp_nonce_field( 'new-post' ); ?>

							</form>

					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
<?php endwhile; endif;?>

<?php get_footer() ?>

