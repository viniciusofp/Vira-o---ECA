<?php get_header(); ?>
<?php if (have_posts()): while(have_posts()) : the_post(); ?>
	<div class="single-header">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1>Quiz</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="single-content">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-10 col-lg-6 the-post">
					<div class="divisor"></div>
					<h1 class="big"><?php the_title(); ?></h1>
					<?php the_content(); ?>
					<?php if( have_rows('pergunta') ): while ( have_rows('pergunta') ) : the_row();
					?>
					
					        <h2><?php the_sub_field('enunciado');?></h2>
					        <ul class="quiz-options">
									<?php $loop = 1; if( have_rows('opcao') ): while ( have_rows('opcao') ) : the_row();?>
										<li data-value="<?php the_sub_field('boolean');?>">
											<h6><?php echo $loop; $loop++ ?></h6>
											<?php the_sub_field('resposta');?>
										</li>
									<?php endwhile; else : endif; ?>
					        </ul>
					<?php endwhile; else : endif; ?>
					<button class="btn btn-primary btn-lg d-none" onclick="resultado()">Veja seu resultado no quiz!</button>
					<div class="quiz-resultado"></div>
				</div>
			</div>
		</div>
	</div>
	
	
<?php endwhile; endif ?>
<script>
	var ready = false;
	jQuery('.quiz-options li').click(function() {
		jQuery(this).siblings().removeClass('selecionado');
		jQuery(this).addClass('selecionado');

		var perguntas = jQuery('.quiz-options');
			
		var checked = 0;
		perguntas.each(function(i) {
			var respostas = jQuery(perguntas[i]).children();
			respostas.each(function(i) {
				if(jQuery(respostas[i]).hasClass('selecionado')) {
					checked++
				}
			})
			console.log(checked)
		})
		if (checked == perguntas.length) {
			ready = true;
		}
		if (ready) {
			jQuery('.btn-primary').removeClass('d-none')
		}
	})



	var resultado = function() {
		var certas = 0;
		var perguntas = jQuery('.quiz-options');
		perguntas.each(function(i) {
			var respostas = jQuery(perguntas[i]).children();
			respostas.each(function(i) {
				jQuery(respostas[i]).css('pointer-events', 'none');
				console.log(jQuery(respostas[i]).hasClass('selecionado'))
				if (jQuery(respostas[i]).attr('data-value') == 'true' && jQuery(respostas[i]).hasClass('selecionado')) {
					certas++;
					console.log('Acertou uma!')
				}
				if (jQuery(respostas[i]).attr('data-value') == 'true') {
					jQuery(respostas[i]).addClass('certa');
				} else {
					jQuery(respostas[i]).addClass('errada');
				}
			})
		})
		jQuery('.btn-primary').css('pointer-events', 'none');
		jQuery('.quiz-resultado').append('<p>Você acertou ' + certas + ' de ' + perguntas.length + ' perguntas.</p>')
	}
</script>
<?php get_footer() ?>