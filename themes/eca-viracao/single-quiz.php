<?php get_header(); ?>
<?php if (have_posts()): while(have_posts()) : the_post(); ?>
	<div class="single-header header-foto" style="background-image: url(<?php echo the_post_thumbnail_url('full'); ?>)">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1>Quiz</h1>
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
				<div class="col-12 col-md-10 col-lg-6 the-post">
					<a href="#" onclick="window.history.back()"><i class="fa fa-arrow-left mr-2"></i>Voltar</a>
					<div class="divisor"></div>
					<h1 class="big d-none"><?php the_title(); ?></h1>
					<?php the_content(); ?>
					<?php $loop = 1; if( have_rows('pergunta') ): while ( have_rows('pergunta') ) : the_row();
					?>
		        <h2 class="question"><?php echo $loop; $loop++ ?>. <small><?php the_sub_field('enunciado');?></small></h2>
		        <ul class="quiz-options">
						<?php 
						$letters = array('A','B','C','D','E','F','G');
						$counter = 0;
						if( have_rows('opcao') ): while ( have_rows('opcao') ) : the_row();?>
							<li data-value="<?php the_sub_field('boolean');?>">
								<h6><?php echo $letters[$counter]; $counter++ ?></h6>
								<?php the_sub_field('resposta');?>
							</li>
						<?php endwhile; else : endif; ?>
		        </ul>
		        <div class="resposta_correta d-none">
		        	<?php the_sub_field('resposta_correta');?>
		        </div>
					<?php endwhile; else : endif; ?>
					<button class="btn btn-primary btn-lg d-none" onclick="resultado()">Veja seu resultado no quiz!</button>
					<div class="quiz-resultado d-none">
						<div class="resultado1 d-none">
							<h2 class="resultadoLabel"><?php echo get_field_object('resultado1')[ 'label'] ?></h2>
							<p><?php the_field('resultado1'); ?></p>
						</div>
						<div class="resultado2 d-none">
							<h2 class="resultadoLabel"><?php echo get_field_object('resultado2')[ 'label'] ?></h2>
							<p><?php the_field('resultado2'); ?></p>
						</div>
						<div class="resultado3 d-none">
							<h2 class="resultadoLabel"><?php echo get_field_object('resultado3')[ 'label'] ?></h2>
							<p><?php the_field('resultado3'); ?></p>
						</div>
					</div>
	
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

	// var scrollToBottom = function() {
	// 	jQuery("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
	// }
	// var ready = false;

	// jQuery('.quiz-options li').click(function() {
	// 	jQuery(this).siblings().removeClass('selecionado');
	// 	jQuery(this).addClass('selecionado');

	// 	var perguntas = jQuery('.quiz-options');
			
	// 	var checked = 0;
	// 	perguntas.each(function(i) {
	// 		var respostas = jQuery(perguntas[i]).children();
	// 		respostas.each(function(i) {
	// 			if(jQuery(respostas[i]).hasClass('selecionado')) {
	// 				checked++
	// 			}
	// 		})
	// 		console.log(checked)
	// 	})
	// 	if (checked == perguntas.length) {
	// 		ready = true;
	// 	}
	// 	if (ready) {
	// 		jQuery('.btn-primary').removeClass('d-none');
	// 		scrollToBottom();
	// 	}
	// })



	// var resultado = function() {
	// 	var certas = 0;
	// 	var perguntas = jQuery('.quiz-options');
	// 	perguntas.each(function(i) {
	// 		var respostas = jQuery(perguntas[i]).children();
	// 		respostas.each(function(i) {
	// 			jQuery(respostas[i]).css('pointer-events', 'none');
	// 			console.log(jQuery(respostas[i]).hasClass('selecionado'))
	// 			if (jQuery(respostas[i]).attr('data-value') == 'true' && jQuery(respostas[i]).hasClass('selecionado')) {
	// 				certas++;
	// 				console.log('Acertou uma!')
	// 			}
	// 			if (jQuery(respostas[i]).attr('data-value') == 'true') {
	// 				jQuery(respostas[i]).addClass('certa');
	// 			} else {
	// 				jQuery(respostas[i]).addClass('errada');
	// 			}
	// 		})
	// 	})
	// 	jQuery('.btn-primary').css('pointer-events', 'none');
	// 	jQuery('.quiz-resultado').empty().append('<p>Você acertou ' + certas + ' de ' + perguntas.length + ' perguntas.</p>');
	// 		scrollToBottom();
	// 	jQuery('.certa h6').empty().append('<i class="fas fa-check"></i>');
	// 	jQuery('.errada h6').empty().append('<i class="fas fa-times"></i>');
	// }



	jQuery('.quiz-options li').click(function() {
		jQuery(this).addClass('selecionado');
		jQuery(this).closest('.quiz-options').next().removeClass('d-none');
		jQuery(this).closest('.quiz-options').css('pointer-events', 'none');
		var opcoes = jQuery(this).closest('.quiz-options').children();

		opcoes.each(function(i) {
			if (jQuery(opcoes[i]).attr('data-value') == 'true') {
				jQuery(opcoes[i]).addClass('certa')
				jQuery(opcoes[i]).children('h6').empty().append('<i class="fas fa-check"></i>');
			} else {
				jQuery(opcoes[i]).addClass('errada')
				jQuery(opcoes[i]).children('h6').empty().append('<i class="fas fa-times"></i>');
			}
		})



		var perguntas = jQuery('.quiz-options');	
		var checked = 0;
		var certas = 0;
		perguntas.each(function(i) {
			var respostas = jQuery(perguntas[i]).children();
			respostas.each(function(i) {
				if(jQuery(respostas[i]).hasClass('selecionado')) {
					checked++
				}
				if(jQuery(respostas[i]).hasClass('selecionado') && jQuery(respostas[i]).attr('data-value') == 'true') {
					certas++
				}
			})
		})
		if (checked == perguntas.length) {
			ready = true;
			jQuery('.quiz-resultado').removeClass('d-none')
			var answer = '<p class="lead">Você acertou <b>' + certas + '</b> de <b>' + perguntas.length + '</b> perguntas.</p>';
			jQuery('.quiz-resultado').prepend(answer);
			if (certas < 4) {
				jQuery('.resultado1').removeClass('d-none');
			} else if (certas < 8) {
				jQuery('.resultado2').removeClass('d-none');
			} else {
				jQuery('.resultado3').removeClass('d-none');
			}
			
		}



	})
</script>
<?php get_footer() ?>