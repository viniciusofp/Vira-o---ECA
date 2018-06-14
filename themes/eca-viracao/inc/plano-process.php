<?php

// Planos de Ação
function my_acf_add_local_field($slug, $label) {
	acf_add_local_field(array(
		'key' => $slug,
		'label' => $label,
		'name' => $slug,
		'type' => 'textarea',
		'parent' => 'group_5b19af6a9cd9e',
	));
}


function my_acf_add_local_field_groups() {

	$i = 1;
	if( have_rows('perguntas', 27) ):
	while( have_rows('perguntas', 27) ): the_row();
		$respostaKey = 'resposta_'. $i;
		$label = get_sub_field('pergunta');
		acf_add_local_field(array(
			'key' => $respostaKey,
			'label' => $label,
			'name' => $respostaKey,
			'type' => 'textarea',
			'parent' => 'group_5b19af6a9cd9e',
		));
		$i++;
	endwhile; endif;
	
}
add_action('acf/init', 'my_acf_add_local_field_groups');

// IDENTIDADE
function my_acf_add_local_field_mapeamento($slug, $label) {
	acf_add_local_field(array(
		'key' => $slug,
		'label' => $label,
		'name' => $slug,
		'type' => 'textarea',
		'parent' => 'group_5b228220b71e4',
	));
}


function my_acf_add_local_field_groups_id() {

	$i = 1;
	if( have_rows('perguntas', 151) ):
	while( have_rows('perguntas', 151) ): the_row();
		$respostaKey = 'identidade_resposta_'. $i;
		$label = get_sub_field('pergunta');
		$label = 'Identidade - ' . $label;
		acf_add_local_field(array(
			'key' => $respostaKey,
			'label' => $label,
			'name' => $respostaKey,
			'type' => 'textarea',
			'parent' => 'group_5b228220b71e4',
		));
		$i++;
	endwhile; endif;
	
}
add_action('acf/init', 'my_acf_add_local_field_groups_id');

// RELAÇÃO COM O TERRITÓRIO


function my_acf_add_local_field_groups_territorio() {

	$i = 1;
	if( have_rows('perguntas', 171) ):
	while( have_rows('perguntas', 171) ): the_row();
		$respostaKey = 'relacao-com-o-territorio_resposta_'. $i;
		$label = get_sub_field('pergunta');
		$label = 'Relação com o Território - ' . $label;
		acf_add_local_field(array(
			'key' => $respostaKey,
			'label' => $label,
			'name' => $respostaKey,
			'type' => 'textarea',
			'parent' => 'group_5b228220b71e4',
		));
		$i++;
	endwhile; endif;
	
}
add_action('acf/init', 'my_acf_add_local_field_groups_territorio');


// Direitos
function my_acf_add_local_field_groups_direitos() {

	$i = 1;
	if( have_rows('perguntas', 174) ):
	while( have_rows('perguntas', 174) ): the_row();
		$respostaKey = 'direitos_resposta_'. $i;
		$label = get_sub_field('pergunta');
		$label = 'Direitos - ' . $label;
		acf_add_local_field(array(
			'key' => $respostaKey,
			'label' => $label,
			'name' => $respostaKey,
			'type' => 'textarea',
			'parent' => 'group_5b228220b71e4',
		));
		$i++;
	endwhile; endif;
	
}
add_action('acf/init', 'my_acf_add_local_field_groups_direitos');

// Direitos
function my_acf_add_local_field_groups_participacao() {

	$i = 1;
	if( have_rows('perguntas', 177) ):
	while( have_rows('perguntas', 177) ): the_row();
		$respostaKey = 'participacao-politica_resposta_'. $i;
		$label = get_sub_field('pergunta');
		$label = 'Participação Política - ' . $label;
		acf_add_local_field(array(
			'key' => $respostaKey,
			'label' => $label,
			'name' => $respostaKey,
			'type' => 'textarea',
			'parent' => 'group_5b228220b71e4',
		));
		$i++;
	endwhile; endif;
	
}
add_action('acf/init', 'my_acf_add_local_field_groups_participacao');



if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_plano") {

		$user_info = get_userdata( get_current_user_id() ); 
    // Add the content of the form to $post as an array
    $new_post = array(
        'post_title'    => $user_info->user_nicename,
        'post_content'  => $description,
        'post_status'   => 'publish',
        'post_type' => 'planos-de-acao'
    );

		if (the_slug_exists($user_info->user_nicename,'planos-de-acao')) :

			$args = array(
			  'name'        => $user_info->user_nicename,
			  'post_type'   => 'planos-de-acao',
			  'post_status' => 'publish',
			  'numberposts' => 1
			);
			$my_posts = get_posts($args);
			if( $my_posts ) :
			      $new_post = array(
			      		'ID' => $my_posts[0]->ID,
				        'post_title'    => $user_info->user_nicename,
				        'post_content'  => $description,
				        'post_status'   => 'publish',
				        'post_type' => 'planos-de-acao'
				    );
			endif;

			$action = 'atualizou';
		  //save the new post and return its ID
		  $pid = wp_update_post($new_post); 

		else :
			$action = 'criou';
		  $pid = wp_insert_post($new_post); 

		endif;
		
		for ($i=1; $i <= $_POST['loops']; $i++) {
			$slug = 'resposta_' . $i;
			$perguntaName = 'pergunta_' . $i;
			$label = $_POST[$perguntaName];
			$value = $_POST[$slug];
			my_acf_add_local_field($slug, $label);
			update_field($slug,$value,$pid);
		}

		$plano_link = get_the_permalink($pid);
		$subject = 'ECA: ' . $user_info->user_nicename . ' ' . $action . ' um Plano de Ação';
		$message = $user_info->first_name . $user_info->last_name . '(' . $user_info->user_email . ') ' . $action . ' um Plano de Ação no site da Escola de Cidadania para Adolescentes. Veja em: ' . $plano_link;

		// wp_mail( 'viniciusofp@gmail.com', $subject, $message );
    // wp_redirect(home_url());
}






//IDENTIDATE

if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_identidade") {

		$user_info = get_userdata( get_current_user_id() ); 
    // Add the content of the form to $post as an array
    $new_post = array(
        'post_title'    => $user_info->user_nicename,
        'post_status'   => 'publish',
        'post_type' => 'mapeamentos',
        'post_content'  => 'ola',
    );

		if (the_slug_exists($user_info->user_nicename,'mapeamentos')) :

			$args = array(
			  'name'        => $user_info->user_nicename,
			  'post_type'   => 'mapeamentos',
			  'post_status' => 'publish',
			  'numberposts' => 1
			);
			$my_posts = get_posts($args);
			if( $my_posts ) :
			      $new_post = array(
			      		'ID' => $my_posts[0]->ID,
				        'post_title'    => $user_info->user_nicename,
				        'post_status'   => 'publish',
				        'post_type' => 'mapeamentos',
				        'post_content'  => 'ola',
				    );
			endif;

			$action = 'atualizou';
		  //save the new post and return its ID
		  $pid = wp_update_post($new_post); 

		else :
			$action = 'criou';
		  $pid = wp_insert_post($new_post);
		endif;
		
		for ($i=1; $i <= $_POST['loops']; $i++) {
			$slug = 'identidade_resposta_' . $i;
			$perguntaName = 'identidade_pergunta_' . $i;
			$label = $_POST[$perguntaName];
			$value = $_POST[$slug];
			my_acf_add_local_field_mapeamento($slug, $label);
			update_field($slug,$value,$pid);
		}

		$plano_link = get_the_permalink($pid);
		$subject = 'ECA: ' . $user_info->user_nicename . ' ' . $action . ' um Plano de Ação';
		$message = $user_info->first_name . $user_info->last_name . '(' . $user_info->user_email . ') ' . $action . ' um Plano de Ação no site da Escola de Cidadania para Adolescentes. Veja em: ' . $plano_link;

		// wp_mail( 'viniciusofp@gmail.com', $subject, $message );
    wp_redirect(home_url('/?page_id=171'));
}

// RELAÇÃO COM O TERRITÓRIO

if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_relacao-com-o-territorio") {

		$user_info = get_userdata( get_current_user_id() ); 
    // Add the content of the form to $post as an array
    $new_post = array(
        'post_title'    => $user_info->user_nicename,
        'post_status'   => 'publish',
        'post_type' => 'mapeamentos',
        'post_content'  => 'ola',
    );

		if (the_slug_exists($user_info->user_nicename,'mapeamentos')) :

			$args = array(
			  'name'        => $user_info->user_nicename,
			  'post_type'   => 'mapeamentos',
			  'post_status' => 'publish',
			  'numberposts' => 1
			);
			$my_posts = get_posts($args);
			if( $my_posts ) :
			      $new_post = array(
			      		'ID' => $my_posts[0]->ID,
				        'post_title'    => $user_info->user_nicename,
				        'post_status'   => 'publish',
				        'post_type' => 'mapeamentos',
				        'post_content'  => 'ola',
				    );
			endif;

			$action = 'atualizou';
		  //save the new post and return its ID
		  $pid = wp_update_post($new_post); 

		else :
			$action = 'criou';
		  $pid = wp_insert_post($new_post);
		endif;
		
		for ($i=1; $i <= $_POST['loops']; $i++) {
			$slug = 'relacao-com-o-territorio_resposta_' . $i;
			$perguntaName = 'relacao-com-o-territorio_pergunta_' . $i;
			$label = $_POST[$perguntaName];
			$value = $_POST[$slug];
			my_acf_add_local_field_mapeamento($slug, $label);
			update_field($slug,$value,$pid);
		}

		$plano_link = get_the_permalink($pid);
		$subject = 'ECA: ' . $user_info->user_nicename . ' ' . $action . ' um Plano de Ação';
		$message = $user_info->first_name . $user_info->last_name . '(' . $user_info->user_email . ') ' . $action . ' um Plano de Ação no site da Escola de Cidadania para Adolescentes. Veja em: ' . $plano_link;

		// wp_mail( 'viniciusofp@gmail.com', $subject, $message );
    wp_redirect(home_url('/?page_id=174'));
}

// DIREITOS

if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_direitos") {

		$user_info = get_userdata( get_current_user_id() ); 
    // Add the content of the form to $post as an array
    $new_post = array(
        'post_title'    => $user_info->user_nicename,
        'post_status'   => 'publish',
        'post_type' => 'mapeamentos',
        'post_content'  => 'ola',
    );

		if (the_slug_exists($user_info->user_nicename,'mapeamentos')) :

			$args = array(
			  'name'        => $user_info->user_nicename,
			  'post_type'   => 'mapeamentos',
			  'post_status' => 'publish',
			  'numberposts' => 1
			);
			$my_posts = get_posts($args);
			if( $my_posts ) :
			      $new_post = array(
			      		'ID' => $my_posts[0]->ID,
				        'post_title'    => $user_info->user_nicename,
				        'post_status'   => 'publish',
				        'post_type' => 'mapeamentos',
				        'post_content'  => 'ola',
				    );
			endif;

			$action = 'atualizou';
		  //save the new post and return its ID
		  $pid = wp_update_post($new_post); 

		else :
			$action = 'criou';
		  $pid = wp_insert_post($new_post);
		endif;
		
		for ($i=1; $i <= $_POST['loops']; $i++) {
			$slug = 'direitos_resposta_' . $i;
			$perguntaName = 'direitos_pergunta_' . $i;
			$label = $_POST[$perguntaName];
			$value = $_POST[$slug];
			my_acf_add_local_field_mapeamento($slug, $label);
			update_field($slug,$value,$pid);
		}

		$plano_link = get_the_permalink($pid);
		$subject = 'ECA: ' . $user_info->user_nicename . ' ' . $action . ' um Plano de Ação';
		$message = $user_info->first_name . $user_info->last_name . '(' . $user_info->user_email . ') ' . $action . ' um Plano de Ação no site da Escola de Cidadania para Adolescentes. Veja em: ' . $plano_link;

		// wp_mail( 'viniciusofp@gmail.com', $subject, $message );
    wp_redirect(home_url('/?page_id=177'));
}

// PARTICIPAÇÃO POLÍTICA

if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_participacao-politica") {

		$user_info = get_userdata( get_current_user_id() ); 
    // Add the content of the form to $post as an array
    $new_post = array(
        'post_title'    => $user_info->user_nicename,
        'post_status'   => 'publish',
        'post_type' => 'mapeamentos',
        'post_content'  => 'ola',
    );

		if (the_slug_exists($user_info->user_nicename,'mapeamentos')) :

			$args = array(
			  'name'        => $user_info->user_nicename,
			  'post_type'   => 'mapeamentos',
			  'post_status' => 'publish',
			  'numberposts' => 1
			);
			$my_posts = get_posts($args);
			if( $my_posts ) :
			      $new_post = array(
			      		'ID' => $my_posts[0]->ID,
				        'post_title'    => $user_info->user_nicename,
				        'post_status'   => 'publish',
				        'post_type' => 'mapeamentos',
				        'post_content'  => 'ola',
				    );
			endif;

			$action = 'atualizou';
		  //save the new post and return its ID
		  $pid = wp_update_post($new_post); 

		else :
			$action = 'criou';
		  $pid = wp_insert_post($new_post);
		endif;
		
		for ($i=1; $i <= $_POST['loops']; $i++) {
			$slug = 'participacao-politica_resposta_' . $i;
			$perguntaName = 'participacao-politica_pergunta_' . $i;
			$label = $_POST[$perguntaName];
			$value = $_POST[$slug];
			my_acf_add_local_field_mapeamento($slug, $label);
			update_field($slug,$value,$pid);
		}

		$plano_link = get_the_permalink($pid);
		$subject = 'ECA: ' . $user_info->user_nicename . ' ' . $action . ' um Plano de Ação';
		$message = $user_info->first_name . $user_info->last_name . '(' . $user_info->user_email . ') ' . $action . ' um Plano de Ação no site da Escola de Cidadania para Adolescentes. Veja em: ' . $plano_link;

		// wp_mail( 'viniciusofp@gmail.com', $subject, $message );
    wp_redirect(home_url('/?page_id=151'));
}