<?php
/**
 * post-process.php
 * make sure to include post-process.php in your functions.php. Use this in functions.php:
 *
 * get_template_part('post-process');
 *
 */
function do_insert() {	
	if( 'POST' == $_SERVER['REQUEST_METHOD'] 
		&& !empty( $_POST['action'] ) 
		&& $_POST['action'] == 'new_plano' ) { // Check what the post type is here instead
		
   // Do some minor form validation to make sure there is content
    if (isset ($_POST['title'])) {
        $title =  $_POST['title'];
    } else {
        echo 'Please enter a game  title';
    }
    if (isset ($_POST['description'])) {
        $description = $_POST['description'];
    } else {
        echo 'Please enter the content';
    }
    $tags = $_POST['post_tags'];

    // Add the content of the form to $post as an array
    $new_post = array(
        'post_title'    => $title,
        'post_content'  => $description,
        'tags_input'    => array($tags),
        'post_status'   => 'publish',           // Choose: publish, preview, future, draft, etc.
        'post_type' => $_POST['post_type']  // Use a custom post type if you want to
    );
    //save the new post and return its ID
    $pid = wp_insert_post($new_post); 
		//insert custom fields
		update_post_meta($pid,'resposta-1',$_POST['resposta-1']);
	} // end IF
}
do_insert();
wp_redirect( home_url() );
?>