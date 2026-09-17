<?php
/**
 * Alteco functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Alteco
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function alteco_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Alteco, use a find and replace
		* to change 'alteco' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'alteco', get_template_directory() . '/languages' );

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
			'main' => esc_html__( 'Main', 'alteco' ),
			'footer' => esc_html__( 'Footer', 'alteco' ),
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
			'alteco_custom_background_args',
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
add_action( 'after_setup_theme', 'alteco_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function alteco_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'alteco_content_width', 640 );
}
add_action( 'after_setup_theme', 'alteco_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function alteco_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'alteco' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'alteco' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'alteco_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function alteco_scripts() {
	wp_enqueue_style( 'alteco-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'alteco-style', 'rtl', 'replace' );

	wp_enqueue_script( 'alteco-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	
    wp_enqueue_style( 
        'main', 
        get_template_directory_uri() . '/css/main.min.css', 
        array(), 
        '1.0.0', 
        'all' 
    );



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'alteco_scripts' );

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


function aviz_pll_setup() {
    // register our translatable strings - again first check if function exists.
    if (function_exists( 'pll_register_string' ) ) {

        pll_register_string('worktime', 'ПН-ПТ 9:00 - 18:00', 'alteco');
        pll_register_string('workday', 'Робочі дні', 'alteco');
        pll_register_string('worktime-footer', '<span>Понеділок – четвер</span><span> з 9-00 до 18-00</span><span>П’ятниця з 9-00 до 17-00</span>', 'alteco');
        pll_register_string('worktime-footer-free', 'Вихідні: субота, неділя', 'alteco');
        pll_register_string('address-title', 'Адреса', 'alteco');
        pll_register_string('address-value', ' <span>Київ</span><span>вул. Якова Гніздовського, 1</span><span>(Магнітогорська, 1)</span><span>БЦ “Fimcenter”</span>', 'alteco');
        pll_register_string('social-title', ' Соціальні мережі', 'alteco');
        pll_register_string('copyright', 'Copyright 2011 – 2026 Alteco Group, LTD.', 'alteco');
        pll_register_string('team-slogan', 'Кращі спеціалісти своєї справи', 'alteco');
        pll_register_string('team-title', 'Команда <span>Alteco</span>', 'alteco');
        pll_register_string('price', 'Ціна:', 'alteco');
        pll_register_string('buy', 'Купити', 'alteco');
        pll_register_string('stancion-quest', 'Питання по станції', 'alteco');
        pll_register_string('cf-title', 'Телефонуйте або пишіть – отримайте повну консультацію', 'alteco');
        pll_register_string('cf-name', 'Ім`я', 'alteco');
        pll_register_string('cf-phone', 'Телефон', 'alteco');
        pll_register_string('cf-message', 'Напишіть ваше повідомлення', 'alteco');
        pll_register_string('cf-send', 'Відправити', 'alteco');









    }
}
add_action( 'after_setup_theme', 'aviz_pll_setup' );






register_post_type( 'about', [
    'label'  => null,
    'labels' => [
        'name'               => 'Про компанию', // основное название для типа записи
        'singular_name'      => 'Страница', // название для одной записи этого типа
        'add_new'            => 'Добавить страницу', // для добавления новой записи
        'add_new_item'       => 'Добавление страницы', // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => 'Редактирование страницы', // для редактирования типа записи
        'new_item'           => 'Новая страница', // текст новой записи
        'view_item'          => 'Смотреть страницу', // для просмотра записи этого типа.
        'search_items'       => 'Искать страницу', // для поиска по этим типам записи
        'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
        'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => 'Про компанию', // название меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => true, // зависит от public
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
    'hierarchical'        => true,
    'supports'            => [ 'title', 'editor', 'page-attributes', 'thumbnail'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => 'filial',
    // 'has_archive'         => true,
    'rewrite'             => true,
    'query_var'           => true,
] );


register_post_type( 'commercial-solar', [
    'label'  => null,
    'labels' => [
        'name' => 'Комерційні сес', // основна назва для типу запису
        'singular_name' => 'Сторінка', // назва для одного запису цього типу
        'add_new' => 'Додати сторінку', // для додавання нового запису
        'add_new_item' => 'Додавання сторінки', // заголовка у новоствореного запису в адмін-панелі.
        'edit_item' => 'Редагування сторінки', // для редагування типу запису
        'new_item' => 'Нова сторінка', // текст нового запису
        'view_item' => 'Дивитись сторінку', // для перегляду запису цього типу.
        'search_items' => 'Шукати сторінку', // для пошуку за цими типами запису
        'not_found' => 'Не знайдено', // якщо в результаті пошуку нічого не було знайдено
        'not_found_in_trash' => 'Не знайдено в кошику', // якщо не було знайдено в кошику
        'parent_item_colon' => '', // для батьків (у деревоподібних типів)
        'menu_name' => 'Комерційні сес', // назва меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => true, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    // 'show_ui'             => null, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => null, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => null, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-building',
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    'hierarchical'        => true,
    'supports'            => [ 'title', 'page-attributes', 'thumbnail'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => 'filial',
    // 'has_archive'         => true,
    'rewrite'             => true,
    'query_var'           => true,
] );


register_post_type( 'home-ess', [
    'label'  => null,
    'labels' => [
        'name' => 'Домашні системи резервного живлення', // основна назва для типу запису
        'singular_name' => 'Сторінка', // назва для одного запису цього типу
        'add_new' => 'Додати сторінку', // для додавання нового запису
        'add_new_item' => 'Додавання сторінки', // заголовка у новоствореного запису в адмін-панелі.
        'edit_item' => 'Редагування сторінки', // для редагування типу запису
        'new_item' => 'Нова сторінка', // текст нового запису
        'view_item' => 'Дивитись сторінку', // для перегляду запису цього типу.
        'search_items' => 'Шукати сторінку', // для пошуку за цими типами запису
        'not_found' => 'Не знайдено', // якщо в результаті пошуку нічого не було знайдено
        'not_found_in_trash' => 'Не знайдено в кошику', // якщо не було знайдено в кошику
        'parent_item_colon' => '', // для батьків (у деревоподібних типів)
        'menu_name' => 'Домашні системи резервного живлення', // назва меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => true, // зависит от public
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
    'hierarchical'        => true,
    'supports'            => [ 'title', 'page-attributes', 'thumbnail'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => 'filial',
    // 'has_archive'         => true,
    'rewrite'             => true,
    'query_var'           => true,
] );


register_post_type( 'services', [
    'label'  => null,
    'labels' => [
        'name' => 'Послуги', // основна назва для типу запису
        'singular_name' => 'Сторінка', // назва для одного запису цього типу
        'add_new' => 'Додати сторінку', // для додавання нового запису
        'add_new_item' => 'Додавання сторінки', // заголовка у новоствореного запису в адмін-панелі.
        'edit_item' => 'Редагування сторінки', // для редагування типу запису
        'new_item' => 'Нова сторінка', // текст нового запису
        'view_item' => 'Дивитись сторінку', // для перегляду запису цього типу.
        'search_items' => 'Шукати сторінку', // для пошуку за цими типами запису
        'not_found' => 'Не знайдено', // якщо в результаті пошуку нічого не було знайдено
        'not_found_in_trash' => 'Не знайдено в кошику', // якщо не було знайдено в кошику
        'parent_item_colon' => '', // для батьків (у деревоподібних типів)
        'menu_name' => 'Послуги', // назва меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => true, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    // 'show_ui'             => null, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => null, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => null, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-hammer',
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    'hierarchical'        => true,
    'supports'            => [ 'title', 'page-attributes', 'thumbnail', 'editor'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => 'filial',
    // 'has_archive'         => true,
    'rewrite'             => true,
    'query_var'           => true,
] );


register_post_type( 'technology', [
    'label'  => null,
    'labels' => [
        'name' => 'Технології', // основна назва для типу запису
        'singular_name' => 'Сторінка', // назва для одного запису цього типу
        'add_new' => 'Додати сторінку', // для додавання нового запису
        'add_new_item' => 'Додавання сторінки', // заголовка у новоствореного запису в адмін-панелі.
        'edit_item' => 'Редагування сторінки', // для редагування типу запису
        'new_item' => 'Нова сторінка', // текст нового запису
        'view_item' => 'Дивитись сторінку', // для перегляду запису цього типу.
        'search_items' => 'Шукати сторінку', // для пошуку за цими типами запису
        'not_found' => 'Не знайдено', // якщо в результаті пошуку нічого не було знайдено
        'not_found_in_trash' => 'Не знайдено в кошику', // якщо не було знайдено в кошику
        'parent_item_colon' => '', // для батьків (у деревоподібних типів)
        'menu_name' => 'Технології', // назва меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => true, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    // 'show_ui'             => null, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => null, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => null, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-schedule',
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    'hierarchical'        => true,
    'supports'            => [ 'title', 'page-attributes', 'thumbnail', 'editor'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => 'filial',
    // 'has_archive'         => true,
    'rewrite'             => true,
    'query_var'           => true,
] );










register_post_type( 'economy', [
    'label'  => null,
    'labels' => [
        'name' => 'Економіка та розрахунки', // основна назва для типу запису
        'singular_name' => 'Сторінка', // назва для одного запису цього типу
        'add_new' => 'Додати сторінку', // для додавання нового запису
        'add_new_item' => 'Додавання сторінки', // заголовка у новоствореного запису в адмін-панелі.
        'edit_item' => 'Редагування сторінки', // для редагування типу запису
        'new_item' => 'Нова сторінка', // текст нового запису
        'view_item' => 'Дивитись сторінку', // для перегляду запису цього типу.
        'search_items' => 'Шукати сторінку', // для пошуку за цими типами запису
        'not_found' => 'Не знайдено', // якщо в результаті пошуку нічого не було знайдено
        'not_found_in_trash' => 'Не знайдено в кошику', // якщо не було знайдено в кошику
        'parent_item_colon' => '', // для батьків (у деревоподібних типів)
        'menu_name' => 'Економіка та розрахунки', // назва меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => true, // зависит от public
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
    'hierarchical'        => true,
    'supports'            => [ 'title', 'page-attributes', 'thumbnail', 'editor'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => 'filial',
    // 'has_archive'         => true,
    'rewrite'             => true,
    'query_var'           => true,
] );








register_post_type( 'home-solar', [
    'label'  => null,
    'labels' => [
        'name' => 'Домашні сес', // основна назва для типу запису
        'singular_name' => 'Сторінка', // назва для одного запису цього типу
        'add_new' => 'Додати сторінку', // для додавання нового запису
        'add_new_item' => 'Додавання сторінки', // заголовка у новоствореного запису в адмін-панелі.
        'edit_item' => 'Редагування сторінки', // для редагування типу запису
        'new_item' => 'Нова сторінка', // текст нового запису
        'view_item' => 'Дивитись сторінку', // для перегляду запису цього типу.
        'search_items' => 'Шукати сторінку', // для пошуку за цими типами запису
        'not_found' => 'Не знайдено', // якщо в результаті пошуку нічого не було знайдено
        'not_found_in_trash' => 'Не знайдено в кошику', // якщо не було знайдено в кошику
        'parent_item_colon' => '', // для батьків (у деревоподібних типів)
        'menu_name' => 'Домашні сес', // назва меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => true, // зависит от public
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
    'hierarchical'        => true,
    'supports'            => [ 'title', 'page-attributes', 'thumbnail', 'editor'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => 'filial',
    // 'has_archive'         => true,
    'rewrite'             => true,
    'query_var'           => true,
] );




register_post_type( 'commercial-ess', [
    'label'  => null,
    'labels' => [
        'name' => 'Комерційні узе', // основна назва для типу запису
        'singular_name' => 'Сторінка', // назва для одного запису цього типу
        'add_new' => 'Додати сторінку', // для додавання нового запису
        'add_new_item' => 'Додавання сторінки', // заголовка у новоствореного запису в адмін-панелі.
        'edit_item' => 'Редагування сторінки', // для редагування типу запису
        'new_item' => 'Нова сторінка', // текст нового запису
        'view_item' => 'Дивитись сторінку', // для перегляду запису цього типу.
        'search_items' => 'Шукати сторінку', // для пошуку за цими типами запису
        'not_found' => 'Не знайдено', // якщо в результаті пошуку нічого не було знайдено
        'not_found_in_trash' => 'Не знайдено в кошику', // якщо не було знайдено в кошику
        'parent_item_colon' => '', // для батьків (у деревоподібних типів)
        'menu_name' => 'Комерційні узе', // назва меню
    ],
    'description'            => '',
    'public'                 => true,
    'publicly_queryable'  => true, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    // 'show_ui'             => null, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => null, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => null, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-table-col-before',
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    'hierarchical'        => true,
    'supports'            => [ 'title', 'page-attributes', 'thumbnail', 'editor'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies'          => 'filial',
    // 'has_archive'         => true,
    'rewrite'             => true,
    'query_var'           => true,
] );










require get_template_directory() . '/inc/menu-walker.php';
require get_template_directory() . '/inc/menu-walker-mb.php';