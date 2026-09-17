<?php



/**
 * turbo-new functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package turbo-new
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', SCRIPTS_VERSION );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function turbo_new_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on turbo-new, use a find and replace
		* to change 'turbo-new' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'turbo-new', get_template_directory() . '/languages' );

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
    register_nav_menus(
        array(
            'menu-1' => esc_html__( 'Primary', 'turbodrive' ),
            'footer-1' => esc_html__( 'Footer_one', 'turbodrive' ),
            'footer-2' => esc_html__( 'Footer_two', 'turbodrive' ),
            'footer-3' => esc_html__( 'Footer_three', 'turbodrive' ),
        )
    );

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'turbo_new_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'turbo_new_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function turbo_new_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'turbo_new_content_width', 640 );
}
add_action( 'after_setup_theme', 'turbo_new_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function turbo_new_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'turbo-new' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'turbo-new' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'turbo_new_widgets_init' );


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



/** * Completely Remove jQuery From WordPress */
function my_init() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', false);
    }
}
add_action('init', 'my_init');


/**
 * Enqueue scripts and styles.
 */
function turbo_new_scripts() {

    $template_current_slug = get_page_template_slug();

    $assets_style = [
        'home.php' => ['home.min.css']
    ];



    if(DEV_MODE){
        $version = time();
    }else{
        $version = SCRIPTS_VERSION;
    }

    wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.min.css', array(), $version);
    wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.min.css', array(), $version);



    if(isset($assets_style[$template_current_slug])){
        foreach ($assets_style[$template_current_slug] as $style_item){
            wp_enqueue_style( $style_item, get_template_directory_uri() . '/css/' . $style_item, array(), $version);
        }
    }


    wp_dequeue_style( 'contact-form-7');
 



}



add_action( 'wp_enqueue_scripts', 'turbo_new_scripts' );




register_post_type( 'setup', [
    'label'  => null,
    'labels' => [
        'name'               => 'Наборы параметров', // основное название для типа записи
        'singular_name'      => 'Набор параметров', // название для одной записи этого типа
        'add_new'            => 'Добавить наборы параметров', // для добавления новой записи
        'add_new_item'       => 'Добавление набора параметров', // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => 'Редактирование набора параметров', // для редактирования типа записи
        'new_item'           => 'Новый наборы параметров', // текст новой записи
        'view_item'          => 'Смотреть наборы параметров', // для просмотра записи этого типа.
        'search_items'       => 'Искать наборы параметров', // для поиска по этим типам записи
        'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
        'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => 'Набор параметров', // название меню
    ],
    'description'            => '',
    'public'                 => true,
    // 'publicly_queryable'  => null, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    // 'show_ui'             => null, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => null, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => null, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-admin-appearance',
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    //'hierarchical'        => false,
    'supports'            => [ 'title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => '',
    //   'has_archive'         => false,
    'rewrite'             => true,
    'query_var'           => true,
] );





register_post_type( 'avtopark', [
    'label'  => null,
    'labels' => [
        'name'               => 'Автопарк', // основное название для типа записи
        'singular_name'      => 'Автомобиль', // название для одной записи этого типа
        'add_new'            => 'Добавить автомобиль', // для добавления новой записи
        'add_new_item'       => 'Добавление автомобиля', // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => 'Редактирование автомобиля', // для редактирования типа записи
        'new_item'           => 'Новый автомобиль', // текст новой записи
        'view_item'          => 'Смотреть автомобиль', // для просмотра записи этого типа.
        'search_items'       => 'Искать автомобиль', // для поиска по этим типам записи
        'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
        'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => 'Автопарк', // название меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => false, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    // 'show_ui'             => null, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => null, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => null, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-car',
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    //'hierarchical'        => false,
    'supports'            => [ 'title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => '',
    //   'has_archive'         => false,
    'rewrite'             => true,
    'query_var'           => true,
] );




register_post_type( 'prices', [
    'label'  => null,
    'labels' => [
        'name'               => 'Тарифы', // основное название для типа записи
        'singular_name'      => 'Тариф', // название для одной записи этого типа
        'add_new'            => 'Добавить тариф', // для добавления новой записи
        'add_new_item'       => 'Добавление тарифа', // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => 'Редактирование тарифа', // для редактирования типа записи
        'new_item'           => 'Новый тариф', // текст новой записи
        'view_item'          => 'Смотреть тариф', // для просмотра записи этого типа.
        'search_items'       => 'Искать тариф', // для поиска по этим типам записи
        'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
        'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => 'Тарифы', // название меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => false, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    // 'show_ui'             => null, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => null, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => null, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-money-alt',
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    //'hierarchical'        => false,
    'supports'            => [ 'title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => '',
    //   'has_archive'         => false,
    'rewrite'             => true,
    'query_var'           => true,
] );







register_post_type( 'reviews', [
    'label'  => null,
    'labels' => [
        'name'               => 'Отзывы', // основное название для типа записи
        'singular_name'      => 'Отзыв', // название для одной записи этого типа
        'add_new'            => 'Добавить отзыв', // для добавления новой записи
        'add_new_item'       => 'Добавление отзыва', // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => 'Редактирование отзыва', // для редактирования типа записи
        'new_item'           => 'Новый отзыв', // текст новой записи
        'view_item'          => 'Смотреть отзыв', // для просмотра записи этого типа.
        'search_items'       => 'Искать отзыв', // для поиска по этим типам записи
        'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
        'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => 'Отзывы', // название меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => false, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    // 'show_ui'             => null, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => null, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => null, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-admin-comments',
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    //'hierarchical'        => false,
    'supports'            => [ 'title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => '',
    //   'has_archive'         => false,
    'rewrite'             => true,
    'query_var'           => true,
] );




register_post_type( 'videoreviews', [
    'label'  => null,
    'labels' => [
        'name'               => 'Видео отзывы', // основное название для типа записи
        'singular_name'      => 'Видео отзыв', // название для одной записи этого типа
        'add_new'            => 'Добавить видео отзыв', // для добавления новой записи
        'add_new_item'       => 'Добавление видео отзыва', // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => 'Редактирование видео отзыва', // для редактирования типа записи
        'new_item'           => 'Новый видео отзыв', // текст новой записи
        'view_item'          => 'Смотреть видео отзыв', // для просмотра записи этого типа.
        'search_items'       => 'Искать видео отзыв', // для поиска по этим типам записи
        'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
        'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => 'Видео отзывы', // название меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => false, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    // 'show_ui'             => null, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => null, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => null, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-admin-comments',
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    //'hierarchical'        => false,
    'supports'            => [ 'title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => '',
    //   'has_archive'         => false,
    'rewrite'             => true,
    'query_var'           => true,
] );










register_post_type( 'services-content', [
    'label'  => null,
    'labels' => [
        'name'               => 'Содержимое услуги', // основное название для типа записи
        'singular_name'      => 'Содержимое услуги', // название для одной записи этого типа
        'add_new'            => 'Добавить содержимое услуги', // для добавления новой записи
        'add_new_item'       => 'Добавление содержимого услуги', // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => 'Редактирование содержимого услуги', // для редактирования типа записи
        'new_item'           => 'Новое содержимое услуги', // текст новой записи
        'view_item'          => 'Смотреть содержимое услуги', // для просмотра записи этого типа.
        'search_items'       => 'Искать содержимое услуги', // для поиска по этим типам записи
        'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
        'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => 'Содержимое услуг', // название меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => false, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    // 'show_ui'             => null, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => null, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => null, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-star-empty',
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    //'hierarchical'        => false,
    'supports'            => [ 'title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    //'taxonomies'          => 'services',
    //   'has_archive'         => false,
    'rewrite'             => true,
    'query_var'           => true,
] );







function true_register_taxonomy() {

    $args = array(
        'labels' => array(
            'name'                     => 'Услуги', // основное название во множественном числе
            'singular_name'            => 'Услуга', // название единичного элемента таксономии
            'menu_name'                => 'Услуги', // Название в меню. По умолчанию: name.
            'all_items'                => 'Все услуги',
            'edit_item'                => 'Изменить услугу',
            'view_item'                => 'Просмотреть услугу', // текст кнопки просмотра записи на сайте (если поддерживается типом)
            'update_item'              => 'Обновить услугу',
            'add_new_item'             => 'Добавить услугу',
            'new_item_name'            => 'Название услуги',
            'parent_item'              => 'Родительская услуга', // только для таксономий с иерархией
            'parent_item_colon'        => 'Родительская услуга:',
            'search_items'             => 'Искать услугу',
            'popular_items'            => 'Популярные услуги', // для таксономий без иерархий
            'separate_items_with_commas' => 'Разделяйте услуги запятыми',
            'add_or_remove_items'      => 'Добавить или удалить услугу',
            'choose_from_most_used'    => 'Выбрать из часто используемых услуг',
            'not_found'                => 'Услуга не найдена',
            'back_to_items'            => '← Назад к услугам',
        ),
        'public' => true,
        'hierarchical' => true,
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'services','hierarchical' => true),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
    );
    register_taxonomy( 'services', 'services-content', $args );
}


add_action( 'init', 'true_register_taxonomy' );











register_post_type( 'categorii-content', [
    'label'  => null,
    'labels' => [
        'name'               => 'Содержимое категорий', // основное название для типа записи
        'singular_name'      => 'Содержимое категории', // название для одной записи этого типа
        'add_new'            => 'Добавить содержимое категории', // для добавления новой записи
        'add_new_item'       => 'Добавление содержимого категории', // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => 'Редактирование содержимого категории', // для редактирования типа записи
        'new_item'           => 'Новое содержимое категории', // текст новой записи
        'view_item'          => 'Смотреть содержимое категории', // для просмотра записи этого типа.
        'search_items'       => 'Искать содержимое категории', // для поиска по этим типам записи
        'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
        'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => 'Содержимое категорий', // название меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => false, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    // 'show_ui'             => null, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => null, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => null, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-star-empty',
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    //'hierarchical'        => false,
    'supports'            => [ 'title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    //'taxonomies'          => 'services',
    //   'has_archive'         => false,
    'rewrite'             => true,
    'query_var'           => true,
] );







function true_register_taxonomy_categorii() {

    $args = array(
        'labels' => array(
            'name'                     => 'Категории', // основное название во множественном числе
            'singular_name'            => 'Категория', // название единичного элемента таксономии
            'menu_name'                => 'Категории', // Название в меню. По умолчанию: name.
            'all_items'                => 'Все категории',
            'edit_item'                => 'Изменить Категорию',
            'view_item'                => 'Просмотреть Категорию', // текст кнопки просмотра записи на сайте (если поддерживается типом)
            'update_item'              => 'Обновить категорию',
            'add_new_item'             => 'Добавить категорию',
            'new_item_name'            => 'Название категории',
            'parent_item'              => 'Родительская категория', // только для таксономий с иерархией
            'parent_item_colon'        => 'Родительская категория:',
            'search_items'             => 'Искать категорию',
            'popular_items'            => 'Популярные категории', // для таксономий без иерархий
            'separate_items_with_commas' => 'Разделяйте категории запятыми',
            'add_or_remove_items'      => 'Добавить или удалить категорию',
            'choose_from_most_used'    => 'Выбрать из часто используемых категорий',
            'not_found'                => 'Категория не найдена',
            'back_to_items'            => '← Назад к Категориям',
        ),
        'public' => true,
        'hierarchical' => true,
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'categorii'),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
    );
    register_taxonomy( 'categorii', 'categorii-content', $args );
}


add_action( 'init', 'true_register_taxonomy_categorii' );










register_post_type( 'faq', [
    'label'  => null,
    'labels' => [
        'name'               => 'ЧаВо', // основное название для типа записи
        'singular_name'      => 'ЧаВо', // название для одной записи этого типа
        'add_new'            => 'Добавить вопрос-ответ', // для добавления новой записи
        'add_new_item'       => 'Добавление вопроса-ответа', // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => 'Редактирование вопроса-ответа', // для редактирования типа записи
        'new_item'           => 'Новый вопрос-ответ', // текст новой записи
        'view_item'          => 'Смотреть вопрос-ответ', // для просмотра записи этого типа.
        'search_items'       => 'Искать вопрос-ответ', // для поиска по этим типам записи
        'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
        'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => 'ЧаВо', // название меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => false, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    // 'show_ui'             => null, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => null, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => null, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-admin-page',
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    //'hierarchical'        => false,
    'supports'            => [ 'title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => '',
    //   'has_archive'         => false,
    'rewrite'             => true,
    'query_var'           => true,
] );








register_post_type( 'filials', [
    'label'  => null,
    'labels' => [
        'name'               => 'Филиалы', // основное название для типа записи
        'singular_name'      => 'Филиал', // название для одной записи этого типа
        'add_new'            => 'Добавить филиал', // для добавления новой записи
        'add_new_item'       => 'Добавление филиала', // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => 'Редактирование филиала', // для редактирования типа записи
        'new_item'           => 'Новый филиалт', // текст новой записи
        'view_item'          => 'Смотреть филиал', // для просмотра записи этого типа.
        'search_items'       => 'Искать филиал', // для поиска по этим типам записи
        'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
        'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => 'Филиалы', // название меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => false, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    // 'show_ui'             => null, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => null, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => null, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-admin-home',
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    //'hierarchical'        => false,
    'supports'            => [ 'title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => '',
    //   'has_archive'         => false,
    'rewrite'             => true,
    'query_var'           => true,
] );



register_post_type( 'gift', [
    'label'  => null,
    'labels' => [
        'name'               => 'Сертификаты', // основное название для типа записи
        'singular_name'      => 'Сертификат', // название для одной записи этого типа
        'add_new'            => 'Добавить сертификат', // для добавления новой записи
        'add_new_item'       => 'Добавление сертификата', // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => 'Редактирование сертификата', // для редактирования типа записи
        'new_item'           => 'Новый мертификат', // текст новой записи
        'view_item'          => 'Смотреть Сертификат', // для просмотра записи этого типа.
        'search_items'       => 'Искать Сертификат', // для поиска по этим типам записи
        'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
        'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => 'Сертификаты', // название меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => false, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    // 'show_ui'             => null, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => null, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => null, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-buddicons-community',
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    //'hierarchical'        => false,
    'supports'            => [ 'title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => '',
    //   'has_archive'         => false,
    'rewrite'             => true,
    'query_var'           => true,
] );


add_action( 'init', 'gp_register_taxonomy_for_object_type' );
function gp_register_taxonomy_for_object_type() {
    register_taxonomy_for_object_type( 'post_tag', 'gift' );
};




register_post_type( 'instructors', [
    'label'  => null,
    'labels' => [
        'name'               => 'Инструкторы', // основное название для типа записи
        'singular_name'      => 'Инструктор', // название для одной записи этого типа
        'add_new'            => 'Добавить инструктора', // для добавления новой записи
        'add_new_item'       => 'Добавление инструктора', // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => 'Редактирование инструктора', // для редактирования типа записи
        'new_item'           => 'Новый инструктор', // текст новой записи
        'view_item'          => 'Смотреть инструктора', // для просмотра записи этого типа.
        'search_items'       => 'Искать инструктора', // для поиска по этим типам записи
        'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
        'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => 'Инструкторы', // название меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => false, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    // 'show_ui'             => null, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => null, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => null, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-welcome-learn-more',
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    //'hierarchical'        => false,
    'supports'            => [ 'title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => '',
    //   'has_archive'         => false,
    'rewrite'             => true,
    'query_var'           => true,
] );


function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);






function aviz_pll_setup() {
    // register our translatable strings - again first check if function exists.
    if (function_exists( 'pll_register_string' ) ) {
        pll_register_string( 'program', 'Program', 'turbodrive', false );
        pll_register_string( 'price', 'Price', 'turbodrive', false );
        pll_register_string( 'join', 'Join', 'turbodrive', false );
        pll_register_string( 'join-to-program', 'Join to program', 'turbodrive', false );
        pll_register_string( 'how-to-get-there', 'How to get there', 'turbodrive', false );
        pll_register_string( 'in-map', 'In map', 'turbodrive', false );
        pll_register_string( 'home-page', 'Home-page', 'turbodrive', false );
        pll_register_string( 'news', 'News', 'turbodrive', false );
        pll_register_string( 'page', 'Page', 'turbodrive', false );
        pll_register_string( 'see-more', 'See-more', 'turbodrive', false );
        pll_register_string( 'servicee', 'Service', 'turbodrive', false );
        pll_register_string( 'categorii', 'Categorii', 'turbodrive', false );
        pll_register_string( 'open', 'Open', 'turbodrive', false );
        pll_register_string( 'test-by-topic', 'Test by topic', 'turbodrive', false );
        pll_register_string( 'back', 'Back', 'turbodrive', false );
        pll_register_string( 'test-by-bilet', 'Test by bilet', 'turbodrive', false );
        pll_register_string( 'practic', 'Practic', 'turbodrive', false );
    }
}
add_action( 'after_setup_theme', 'aviz_pll_setup' );









add_action('wpseo_register_extra_replacements', 'register_custom_yoast_variables');
function get_writer() {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : false;
    if ($paged){
        return ' - ' . pll__('Page') . ' ' . $paged;
    }
    return '';
}
function register_custom_yoast_variables() {
    wpseo_register_var_replacement('%%writer%%', 'get_writer', 'advanced', 'Номер страницы');
}




function true_breadcrumbs(){

    $post_type = get_post_type();


    // получаем номер текущей страницы
    $page_num = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $separator = '<li class="breadcrumbs__sep"> —</li>'; //  разделяем обычным слэшем, но можете чем угодно другим

    echo '<ol class="breadcrumbs__list" itemscope="" itemtype="https://schema.org/BreadcrumbList">';


    // если главная страница сайта
    if( is_front_page() ){

    } else { // не главная


        echo '<li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">';
        echo '<a class="breadcrumbs__link" href="' . home_url() . '" itemprop="item">';
        echo '<span class="breadcrumbs__name" itemprop="name">' . pll__('Home-page') . '</span>';
        echo '</a>';
        echo '<meta itemprop="position" content="1">';
        echo '</li>';

        echo $separator;


        if ($post_type == 'services-content'){




            echo '<li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">';

            if(pll_current_language() == 'ru'){
                echo '<a class="breadcrumbs__link" href="/services" itemprop="item">';
            }else{
                echo '<a class="breadcrumbs__link" href="/ua/poslugi" itemprop="item">';
            }


            echo '<span class="breadcrumbs__name" itemprop="name">' . pll__('Service') . '</span>';
            echo '</a>';
            echo '<meta itemprop="position" content="2">';
            echo '</li>';

            echo $separator;

            echo '<li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">';

            echo '<span class="breadcrumbs__name" itemprop="name">' .  single_cat_title('', false) . '</span>';

            echo '<meta itemprop="position" content="3">';
            echo '</li>';

        }

        if ($post_type == 'categorii-content'){




            echo '<li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">';

            if(pll_current_language() == 'ru'){
                echo '<a class="breadcrumbs__link" href="/kategorii" itemprop="item">';
            }else{
                echo '<a class="breadcrumbs__link" href="/ua/kategorii" itemprop="item">';
            }


            echo '<span class="breadcrumbs__name" itemprop="name">' . pll__('Categorii') . '</span>';
            echo '</a>';
            echo '<meta itemprop="position" content="2">';
            echo '</li>';

            echo $separator;

            echo '<li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">';

            echo '<span class="breadcrumbs__name" itemprop="name">' .  single_cat_title('', false) . '</span>';

            echo '<meta itemprop="position" content="3">';
            echo '</li>';

        }




        if( is_single() ){ // записи


            if(pll_current_language() == 'ru'){
                $page_url = get_page_uri(809);
            }else{
                $page_url = get_page_uri(995);
            }

            echo '<li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">';
            echo '<a class="breadcrumbs__link" href="' . $page_url . '" itemprop="item">';
            echo '<span class="breadcrumbs__name" itemprop="name">' . pll__('News') . '</span>';
            echo '</a>';
            echo '<meta itemprop="position" content="2">';
            echo '</li>';

            echo $separator;

            echo '<li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">';
            echo '<span class="breadcrumbs__name" itemprop="name">' . get_the_title() . '</span>';
            echo '<meta itemprop="position" content="3">';
            echo '</li>';

        } elseif ( is_page() ){ // страницы WordPress


            $ancestors = get_post_ancestors($post->ID ?? false);
            if (isset($ancestors[0])){
                echo '<li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">';
                echo '<a class="breadcrumbs__link" href="' . get_page_link($ancestors[0]) . '" itemprop="item">';
                echo '<span class="breadcrumbs__name" itemprop="name">' . get_the_title($ancestors[0]) . '</span>';
                echo '</a>';
                echo '<meta itemprop="position" content="2">';
                echo '</li>';

                echo $separator;

                echo '<li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">';
                echo '<span class="breadcrumbs__name" itemprop="name">' . get_the_title() . '</span>';
                echo '<meta itemprop="position" content="3">';
                echo '</li>';


            }else{
                echo '<li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">';
                echo '<span class="breadcrumbs__name" itemprop="name">' . get_the_title() . '</span>';
                echo '<meta itemprop="position" content="2">';
                echo '</li>';
            }




        } elseif ( is_category() ) {

            single_cat_title();

        } elseif( is_tag() ) {

            single_tag_title();

        } elseif ( is_day() ) { // архивы (по дням)

            echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $separator;
            echo '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a>' . $separator;
            echo get_the_time('d');

        } elseif ( is_month() ) { // архивы (по месяцам)

            echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $separator;
            echo get_the_time('F');

        } elseif ( is_year() ) { // архивы (по годам)

            echo get_the_time( 'Y' );

        } elseif ( is_author() ) { // архивы по авторам

            global $author;
            $userdata = get_userdata( $author );
            echo 'Опубликовал(а) ' . $userdata->display_name;

        } elseif ( is_404() ) { // если страницы не существует

            echo 'Ошибка 404';

        }



    }

    echo '</ol>';

}




function artabr_menu_no_link($no_link){
    $in_link = '!<li(.*?)class="(.*?)current-menu-item(.*?)"><a(.*?)>(.*?)</a>!si';
    $out_link = '<li$1class="\\2current-menu-item\\3">$5';
    return preg_replace($in_link, $out_link, $no_link );
}
add_filter('wp_nav_menu', 'artabr_menu_no_link');




register_post_type( 'pdd-quest', [
    'label'  => null,
    'labels' => [
        'name'               => 'Вопросы', // основное название для типа записи
        'singular_name'      => 'Вопросы', // название для одной записи этого типа
        'add_new'            => 'Добавить вопрос', // для добавления новой записи
        'add_new_item'       => 'Добавление вопроса', // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => 'Редактирование вопроса', // для редактирования типа записи
        'new_item'           => 'Новый вопрос', // текст новой записи
        'view_item'          => 'Смотреть вопрос', // для просмотра записи этого типа.
        'search_items'       => 'Искать вопрос', // для поиска по этим типам записи
        'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
        'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => 'ПДД тесты', // название меню
    ],
    'description'            => '',

    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'show_in_rest' => true,
    'menu_icon'           => 'dashicons-star-empty',
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    //'hierarchical'        => false,
    'supports'            => [ 'title', 'tags'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    //'taxonomies'          => 'services',
    //'has_archive'         => true,
    'rewrite'             => true,
    'query_var'           => true,


] );


















function register_pdd() {

    $args = array(
        'labels' => array(
            'name'                     => 'Темы', // основное название во множественном числе
            'singular_name'            => 'Тема', // название единичного элемента таксономии
            'menu_name'                => 'Темы', // Название в меню. По умолчанию: name.
            'all_items'                => 'Все темы',
            'edit_item'                => 'Изменить тему',
            'view_item'                => 'Просмотреть тему', // текст кнопки просмотра записи на сайте (если поддерживается типом)
            'update_item'              => 'Обновить тему',
            'add_new_item'             => 'Добавить тему',
            'new_item_name'            => 'Название темы',
            'parent_item'              => 'Родительская тема', // только для таксономий с иерархией
            'parent_item_colon'        => 'Родительская тема:',
            'search_items'             => 'Искать тему',
            'popular_items'            => 'Популярные темы', // для таксономий без иерархий
            'separate_items_with_commas' => 'Разделяйте темы запятыми',
            'add_or_remove_items'      => 'Добавить или удалить тему',
            'choose_from_most_used'    => 'Выбрать из часто используемых тем',
            'not_found'                => 'Тема не найден',
            'back_to_items'            => '← Назад к темам',
        ),
        'public' => true,
        'hierarchical' => true,
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'pdd-bilet'),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest' => true,
    );

    register_taxonomy( 'pdd-bilet','pdd-quest', $args );

}


add_action( 'init', 'register_pdd' );











function register_pdd_bilets() {

    $args = array(
        'labels' => array(
            'name'                     => 'Билет', // основное название во множественном числе
            'singular_name'            => 'Билет', // название единичного элемента таксономии
            'menu_name'                => 'Билеты', // Название в меню. По умолчанию: name.
            'all_items'                => 'Все билеты',
            'edit_item'                => 'Изменить билет',
            'view_item'                => 'Просмотреть билет', // текст кнопки просмотра записи на сайте (если поддерживается типом)
            'update_item'              => 'Обновить билет',
            'add_new_item'             => 'Добавить билет',
            'new_item_name'            => 'Название билета',
            'parent_item'              => 'Родительский билет', // только для таксономий с иерархией
            'parent_item_colon'        => 'Родительский билет:',
            'search_items'             => 'Искать билет',
            'popular_items'            => 'Популярные билеты', // для таксономий без иерархий
            'separate_items_with_commas' => 'Разделяйте билеты запятыми',
            'add_or_remove_items'      => 'Добавить или удалить билет',
            'choose_from_most_used'    => 'Выбрать из часто используемых билетов',
            'not_found'                => 'Билет не найден',
            'back_to_items'            => '← Назад к билетам',
        ),
        'public' => true,
        'hierarchical' => false,
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'pdd-bilets'),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest' => true,
    );
    register_taxonomy( 'pdd-bilets', 'pdd-quest', $args );
}


add_action( 'init', 'register_pdd_bilets' );







require get_template_directory() . '/inc/special-pages.php';
require get_template_directory() . '/inc/menu-walker.php';
WPKama_Special_Pages::init();