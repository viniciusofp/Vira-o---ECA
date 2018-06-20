<?php
/**
 * ECA - Viração functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ECA_-_Viração
 */

if ( ! function_exists( 'eca_viracao_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function eca_viracao_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ECA - Viração, use a find and replace
		 * to change 'eca-viracao' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'eca-viracao', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'eca-viracao' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'eca_viracao_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'eca_viracao_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function eca_viracao_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'eca_viracao_content_width', 640 );
}
add_action( 'after_setup_theme', 'eca_viracao_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function eca_viracao_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'eca-viracao' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'eca-viracao' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Social Media Footer', 'eca-viracao' ),
		'id'            => 'social-footer',
		'description'   => esc_html__( 'Add widgets here.', 'eca-viracao' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Contact Footer', 'eca-viracao' ),
		'id'            => 'contato-footer',
		'description'   => esc_html__( 'Add widgets here.', 'eca-viracao' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Créditos Footer', 'eca-viracao' ),
		'id'            => 'creditos-footer',
		'description'   => esc_html__( 'Add widgets here.', 'eca-viracao' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
}
add_action( 'widgets_init', 'eca_viracao_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function eca_viracao_scripts() {
	wp_enqueue_style( 'eca-viracao-fontawesome', "https://use.fontawesome.com/releases/v5.0.13/css/all.css" );

	wp_enqueue_style( 'eca-viracao-style', get_stylesheet_uri() );

	wp_enqueue_script( 'eca-viracao-jquery', 'https://code.jquery.com/jquery-3.3.1.min.js' );

	// wp_enqueue_script( 'eca-viracao-popover', get_template_directory_uri() . '/js/popover.js', array(), '20151215', true );

	wp_enqueue_script( 'eca-viracao-bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), '20151215', true );

	wp_enqueue_script( 'eca-viracao-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'eca_viracao_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Bootstrap Navwalker
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';


// Custom Post Types

function create_post_types() {
  register_post_type( 'video-aulas',
    array(
      'labels' => array(
        'name' => __( 'Vídeo Aulas' ),
        'singular_name' => __( 'Vídeo Aula' )
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true,
      'menu_position' => 5,
      'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
      'menu_icon' => "dashicons-format-video"
    )
  );
  register_post_type( 'mao-na-massa',
    array(
      'labels' => array(
        'name' => __( 'Mão na Massa' ),
        'singular_name' => __( 'Mão na Massa' )
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true,
      'menu_position' => 5,
      'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
      'menu_icon' => "dashicons-admin-tools"
    )
  );
  register_post_type( 'quiz',
    array(
      'labels' => array(
        'name' => __( 'Quiz' ),
        'singular_name' => __( 'Quiz' )
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true,
      'menu_position' => 5,
      'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
      'menu_icon' => "dashicons-admin-tools"
    )
  );
  register_post_type( 'conceitos',
    array(
      'labels' => array(
        'name' => __( 'Conceitos' ),
        'singular_name' => __( 'Conceito' )
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true,
      'menu_position' => 5,
      'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
      'menu_icon' => "dashicons-welcome-learn-more"
    )
  );
  register_post_type( 'planos-de-acao',
    array(
      'labels' => array(
        'name' => __( 'Planos de Ação' ),
        'singular_name' => __( 'Plano de Ação' )
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true,
      'menu_position' => 5,
      'supports' => array('title', 'custom-fields'),
      'menu_icon' => "dashicons-welcome-learn-more"
    )
  );
  register_post_type( 'mapeamentos',
    array(
      'labels' => array(
        'name' => __( 'Mapeamentos' ),
        'singular_name' => __( 'Mapeamento' )
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true,
      'menu_position' => 5,
      'supports' => array('title', 'custom-fields'),
      'menu_icon' => "dashicons-welcome-learn-more"
    )
  );
}
add_action( 'init', 'create_post_types' );
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['video-aulas']->labels;
    $labels->name = 'Vídeo Aulas';
    $labels->singular_name = 'Vídeo Aula';
    $labels->add_new = 'Adicionar Vídeo Aula';
    $labels->add_new_item = 'Adicionar Vídeo Aula';
    $labels->edit_item = 'Editar Vídeo Aula';
    $labels->new_item = 'Vídeo Aula';
    $labels->view_item = 'Ver Vídeo Aulas';
    $labels->search_items = 'Buscar Vídeo Aulas';
    $labels->not_found = 'Não foram encontradas Vídeo Aulas';
    $labels->not_found_in_trash = 'Não foram encontradas Vídeo Aulas na Lixeira';
    $labels->all_items = 'Todas Vídeo Aulas';
    $labels->menu_name = 'Vídeo Aulas';
    $labels->name_admin_bar = 'Vídeo Aula';
}
function revcon_change_conceito_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['conceitos']->labels;
    $labels->name = 'Conceitos';
    $labels->singular_name = 'Conceito';
    $labels->add_new = 'Adicionar Conceito';
    $labels->add_new_item = 'Adicionar Conceito';
    $labels->edit_item = 'Editar Conceito';
    $labels->new_item = 'Conceito';
    $labels->view_item = 'Ver Conceitos';
    $labels->search_items = 'Buscar Conceitos';
    $labels->not_found = 'Não foram encontrados Conceitos';
    $labels->not_found_in_trash = 'Não foram encontrados Conceitos na Lixeira';
    $labels->all_items = 'Todos Conceitos';
    $labels->menu_name = 'Conceitos';
    $labels->name_admin_bar = 'Conceito';
}
add_action( 'init', 'revcon_change_post_object' );
add_action( 'init', 'revcon_change_conceito_object' );


// Custom experpt length
function custom_short_excerpt($excerpt){
	$limit = 100;

	if (strlen($excerpt) > $limit) {
		return substr($excerpt, 0, strpos($excerpt, ' ', $limit)) . ' (...)';
	}

	return $excerpt;
}

add_filter('the_excerpt', 'custom_short_excerpt');

// Pagination

function pagination($pages = '', $range = 2) {
	$showitems = ($range * 2)+1;
	global $paged;
	if(empty($paged)) $paged = 1;
	if($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages) {
			$pages = 1;
		}
	}
	if(1 != $pages) {
		echo "<div class=\"pagination\">";
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><i class='fas fa-angle-double-left'></i></a>";
		if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><i class='fas fa-angle-left'></i></a>";
		for ($i=1; $i <= $pages; $i++) {
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
				echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
			}
		}
		if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\"><i class='fas fa-angle-right'></i></a>";
		if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'><i class='fas fa-angle-double-right'></i></a>";
		echo "</div>\n";
	}
}

// Function to check if exists a post with certain slug
function the_slug_exists($post_name, $post_type) {
    global $wpdb;
    if($wpdb->get_row("SELECT post_name FROM wp_posts WHERE post_name = '" . $post_name . "' AND post_type = '" . $post_type . "'", 'ARRAY_A')) {
        return true;
    } else {
        return false;
    }
}

// New Plano de Ação process POST

require get_template_directory() . '/inc/plano-process.php';
require get_template_directory() . '/inc/social-media-widget.php';








