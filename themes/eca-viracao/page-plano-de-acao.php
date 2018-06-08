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
				<div class="col-12 col-md-10 the-post">


<?php
		$user_info = get_userdata( get_current_user_id() ); 
		if (the_slug_exists($user_info->user_nicename,'planos-de-acao')) :

			$args = array(
				'name' => $user_info->user_nicename,
			  'post_type'   => 'planos-de-acao'
			);
			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) : ?>

				<!-- the loop -->
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
				$content = get_the_content();
				$content = wp_filter_nohtml_kses( $content );
				?>
					 <!-- New Post Form -->
					<div id="postbox">
					<form id="new_post" name="new_post" method="post" action="">
					<p><label for="description">Description</label><br />
					<input class="form-control" id="description" tabindex="3" name="description" cols="50" rows="6" value="<?php echo $content ?>"/>
					</p>
					<p><label for="resposta_1">Voce acha que esse site está dando certo?</label><br />
					<input class="form-control" tabindex="3" name="resposta_1" id="resposta_1" cols="50" rows="6" value="<?php the_field('resposta_1'); ?>"/>

					<p align="right"><button class="mt-3 form-control btn btn-lg btn-outline-primary" type="submit" value="Publish" tabindex="6" id="submit" name="submit">Atualizar</button></p>

					<input type="hidden" name="action" value="new_plano" />
					<?php wp_nonce_field( 'new-post' ); ?>
					</form>
					</div>
					<!--// New Post Form -->
				<?php endwhile; ?>

				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php endif; ?>



		<?php else :?>
			 <!-- New Post Form -->
			<div id="postbox">
			<form id="new_post" name="new_post" method="post" action="">
			<p><label for="title">Title</label><br />
			<input class="form-control" type="text" id="title" value="" tabindex="1" size="20" name="title" />
			</p>
			<p><label for="description">Description</label><br />
			<textarea class="form-control" id="description" tabindex="3" name="description" cols="50" rows="6"></textarea>
			</p>
			<p><label for="resposta_1">Voce acha que esse site está dando certo?</label><br />
			<textarea class="form-control" tabindex="3" name="resposta_1" id="resposta_1" cols="50" rows="6"></textarea>

			<p align="right"><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" /></p>

			<input type="hidden" name="action" value="new_plano" />
			<?php wp_nonce_field( 'new-post' ); ?>
			</form>
			</div>
			<!--// New Post Form -->
		<?php endif;?>




				</div>
			</div>
		</div>
	</div>
<?php endwhile; endif;






?>

<?php get_footer() ?>






?>

<?php get_footer() ?>