<?php if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_plano") {

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