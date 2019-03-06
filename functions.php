<?php

function customt_script_enqueue() {

    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'google_fonts', 'https://fonts.googleapis.com/css?family=Abel', false );
    wp_enqueue_style( 'fontawesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('customtstyle', get_template_directory_uri() . '/css/customt.css', array(), '1.0.0', 'all');
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array( 'jquery' ) );

}
add_action('wp_enqueue_scripts', 'customt_script_enqueue');

/**
 * Load scripts and style sheet for settings page
 */
function load_admin_scripts() {

    // WordPress library
    wp_enqueue_media();
    wp_enqueue_script('customtjs', get_template_directory_uri() . '/js/customt.js', array( 'jquery' ), '1.0.0', true);

}
add_action( 'admin_enqueue_scripts', 'load_admin_scripts' );

function customt_theme_setup() {
    //Support Menu Creation
    add_theme_support('menus');

    //Registering Navigation Menus
    register_nav_menu('primary', 'Primary Header Navigation');
    register_nav_menu('secondary', 'Footer Navigation');
    load_theme_textdomain( 'customtheme', get_template_directory() . '/languages' );
}
add_action('init', 'customt_theme_setup');

add_theme_support('custom-background');
add_theme_support( 'post-thumbnails' );

function custom_acf_settings_localization($localization){
  return true;
}
add_filter('acf/settings/l10n', 'custom_acf_settings_localization');

function custom_acf_settings_textdomain($domain){
  return 'customtheme';
}
add_filter('acf/settings/l10n_textdomain', 'custom_acf_settings_textdomain');

function create_project_posttype() {

    if(get_locale() == 'es_AR') {
        $menu_title = 'Proyectos';
    } else {
        $menu_title = 'Projects';
    }
  register_post_type( 'project',
    array(
      'labels' => array(
        'name' => __( $menu_title ),
        'singular_name' => __( 'Project' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'projects'),
      'taxonomies' => array( 'technology' ),
    )
  );
}
add_action( 'init', 'create_project_posttype' );

function create_cv_posttype() {
  register_post_type( 'curriculum',
    array(
      'labels' => array(
        'name' => __( 'Curriculums' ),
        'singular_name' => __( 'Curriculum' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'curriculums'),
    )
  );
}
add_action( 'init', 'create_cv_posttype' );


function footer_page_create() {
    function my_footer_page_display() {
        if (isset($_POST['email_text'])) {
            $email_value = $_POST['email_text'];
            update_option('email_text', $email_value);
        }
        $email_value = get_option('email_text', 'example@gmail.com');

        if (isset($_POST['phone_number'])) {
            $phone_value = $_POST['phone_number'];
            update_option('phone_number', $phone_value);
        }
        $phone_value = get_option('phone_number', '11 4182 1726');

        if (isset($_POST['cv_url'])) {
            $cv_value = $_POST['cv_url'];
            update_option('cv_url', $cv_value);
        }
        $cv_value = get_option('cv_url', 'Curriculum URL');

        include 'footer-form.php';
    }
    $page_title = __('My Footer Admin Page', 'customtheme');
    $menu_title = __('Footer Settings', 'customtheme');
    $capability = 'edit_posts';
    $menu_slug = 'footer_page';
    $function = 'my_footer_page_display';
    $icon_url = '';
    $position = 32;
    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}
add_action('admin_menu', 'footer_page_create');



function header_page_create() {
    function my_header_page_display() {
        if (isset($_POST['name_text'])) {
            $name_value = $_POST['name_text'];
            update_option('name_text', $name_value);
        }
        $name_value = get_option('name_text', 'John Doe');

        if (isset($_POST['image_url'])) {
            $img_value = $_POST['image_url'];
            update_option('image_url', $img_value);
        }
        $img_value = get_option('image_url', 'Image URL');



        include 'header-form.php';
    }
    $page_title = 'My Header Admin Page';
    $menu_title = __('Header Settings', 'customtheme');
    $capability = 'edit_posts';
    $menu_slug = 'header_page';
    $function = 'my_header_page_display';
    $icon_url = '';
    $position = 30;
    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}
add_action('admin_menu', 'header_page_create');

function techno_init() {

    $labels = array(
    'name' => __( 'Technologies', 'customtheme' ),
    'singular_name' => __( 'Technology', 'customtheme' ),
    'search_items' =>  __( 'Search Technologies', 'customtheme' ),
    'popular_items' => __( 'Popular Technologies', 'customtheme' ),
    'all_items' => __( 'All Technologies', 'customtheme' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Technology', 'customtheme' ),
    'update_item' => __( 'Update Technology', 'customtheme' ),
    'add_new_item' => __( 'Add New Technology', 'customtheme' ),
    'new_item_name' => __( 'New Technology Name', 'customtheme' ),
    'separate_items_with_commas' => __( 'Separate technologies with commas', 'customtheme' ),
    'add_or_remove_items' => __( 'Add or remove technologies', 'customtheme' ),
    'choose_from_most_used' => __( 'Choose from the most used technologies', 'customtheme' ),
    'menu_name' => __( 'Technologies', 'customtheme' ),
  );
	// Create a new taxonomy
	register_taxonomy('technology','project', array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'technology' ),
  )
	);
}
add_action( 'init', 'techno_init' );







if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5bfbfde62e0cf',
	'title' => __('Project Field Group', 'customtheme'),
	'fields' => array(
		array(
			'key' => 'field_5bfbfdf544798',
			'label' => __('Link to site', 'customtheme'),
			'name' => 'link_to_site',
			'type' => 'link',
			'instructions' => __('Adds an URL for the project\'s site.', 'customtheme'),
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
		),
		array(
			'key' => 'field_5bfbfeb244799',
			'label' => __('Link to GitHub', 'customtheme'),
			'name' => 'link_to_github',
			'type' => 'url',
			'instructions' => __('Adds an URL to the project\'s GitHub repository.', 'customtheme'),
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'https://github.com/user/project',
		),
		array(
			'key' => 'field_5bfd9896ed592',
			'label' => __('Project Image', 'customtheme'),
			'name' => 'project_image',
			'type' => 'image',
			'instructions' => __('Add your Project Image', 'customtheme'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'project',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5bfc00c2c5240',
	'title' => __('Curriculum Field Group', 'customtheme'),
	'fields' => array(
		array(
			'key' => 'field_5bfc580e8dd89',
			'label' => __('Current Position', 'customtheme'),
			'name' => 'current_position',
			'type' => 'text',
			'instructions' => __('Your current position.', 'customtheme'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'Jr Web Developer',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5bfc62a0c9ea1',
			'label' => __('Portrait', 'customtheme'),
			'name' => 'portrait',
			'type' => 'image',
			'instructions' => __('Add a portrait of yourself.', 'customtheme'),
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5bfc00d6592e7',
			'label' => __('Degrees and Certificates', 'customtheme'),
			'name' => 'degrees_and_certificates',
			'type' => 'group',
			'instructions' => __('Add degrees and certificates.', 'customtheme'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'field_5bfc0162592e8',
					'label' => __('Degrees', 'customtheme'),
					'name' => 'degrees',
					'type' => 'repeater',
					'instructions' => __('Add your degrees.', 'customtheme'),
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => '',
					'min' => 0,
					'max' => 0,
					'layout' => 'table',
					'button_label' => '',
					'sub_fields' => array(
						array(
							'key' => 'field_5bfd422f0ea1f',
							'label' => __('Degree', 'customtheme'),
							'name' => 'degree',
							'type' => 'text',
							'instructions' => __('Add individual degree.', 'customtheme'),
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '(2015 - 2016) Asistente de Sonido y Producción Musical Instituto TAMABA',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
					),
				),
				array(
					'key' => 'field_5bfc034f592e9',
					'label' => __('Institution', 'customtheme'),
					'name' => 'institution',
					'type' => 'repeater',
					'instructions' => __('Add your institutions.', 'customtheme'),
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => '',
					'min' => 0,
					'max' => 0,
					'layout' => 'table',
					'button_label' => '',
					'sub_fields' => array(
						array(
							'key' => 'field_5bfd47627f1b8',
							'label' => __('Name', 'customtheme'),
							'name' => 'name',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5bfd47e77f1b9',
							'label' => __('Certificates', 'customtheme'),
							'name' => 'certificates',
							'type' => 'repeater',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'collapsed' => '',
							'min' => 0,
							'max' => 0,
							'layout' => 'table',
							'button_label' => '',
							'sub_fields' => array(
								array(
									'key' => 'field_5bfd48017f1ba',
									'label' => __('Certificate Name', 'customtheme'),
									'name' => 'certificate_name',
									'type' => 'text',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'placeholder' => '',
									'prepend' => '',
									'append' => '',
									'maxlength' => '',
								),
							),
						),
					),
				),
			),
		),
		array(
			'key' => 'field_5bfc0476592ea',
			'label' => __('Tecnologies', 'customtheme'),
			'name' => 'technologies',
			'type' => 'repeater',
			'instructions' => __('Add technologies you learned or are currently learning.', 'customtheme'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'table',
			'button_label' => '',
			'sub_fields' => array(
				array(
					'key' => 'field_5bfd6e1b14d95',
					'label' => __('Name', 'customtheme'),
					'name' => 'name',
					'type' => 'text',
					'instructions' => __('Add name of the particular technology.', 'customtheme'),
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5bfd6e3314d96',
					'label' => __('Mastery Percentage', 'customtheme'),
					'name' => 'mastery_percentage',
					'type' => 'number',
					'instructions' => __('Display how well do you know it in a range from 1 to 100.', 'customtheme'),
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'min' => '',
					'max' => '',
					'step' => '',
				),
			),
		),
		array(
			'key' => 'field_5bfc0544592ec',
			'label' => __('Books', 'customtheme'),
			'name' => 'books',
			'type' => 'group',
			'instructions' => __('Add books you\'ve read and books you\'re currently reading.', 'customtheme'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'field_5bfc056b592ed',
					'label' => __('Books read.', 'customtheme'),
					'name' => 'books_read',
					'type' => 'repeater',
					'instructions' => __('Add books you\'ve read', 'customtheme'),
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => '',
					'min' => 0,
					'max' => 0,
					'layout' => 'table',
					'button_label' => '',
					'sub_fields' => array(
						array(
							'key' => 'field_5bfd5e0afb5ca',
							'label' => __('Book', 'customtheme'),
							'name' => 'book',
							'type' => 'text',
							'instructions' => __('Add individual book.', 'customtheme'),
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => 60,
						),
					),
				),
				array(
					'key' => 'field_5bfc0599592ee',
					'label' => __('Books being read.', 'customtheme'),
					'name' => 'books_being_read',
					'type' => 'repeater',
					'instructions' => __('Add books you\'re currently reading.', 'customtheme'),
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => '',
					'min' => 0,
					'max' => 0,
					'layout' => 'table',
					'button_label' => '',
					'sub_fields' => array(
						array(
							'key' => 'field_5bfd5e36fb5cb',
							'label' => __('Book', 'customtheme'),
							'name' => 'book',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => 'Add a book you\'re currently reading.',
							'prepend' => '',
							'append' => '',
							'maxlength' => 60,
						),
					),
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'curriculum',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'featured_image',
	),
	'active' => 1,
	'description' => '',
));

endif;


// returns the content of $GLOBALS['post']
// if the page is called 'debug'
function my_the_content_filter($content) {
  // assuming you have created a page/post entitled 'debug'
  if ($GLOBALS['post']->post_type == 'post') {
    return $content = mb_strimwidth($content, 0, 120, '[...]'); ;
  }
  // otherwise returns the database content
  return $content;
}
add_filter( 'the_content', 'my_the_content_filter' );

function get_my_text() {
    return "<p> Testing </p>";
}
add_shortcode('mytext', 'get_my_text');
