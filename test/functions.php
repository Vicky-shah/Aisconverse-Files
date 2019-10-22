<?php

if ( ! function_exists( 'test_theme_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function aisconverse_test_theme_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Test theme, use a find and replace
         * to change 'test-theme' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'testtheme', get_template_directory() . '/languages' );

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
            'main-menu' => esc_html__( 'Primary Menu', 'testtheme' ),
        ) );

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
add_action( 'after_setup_theme', 'aisconverse_test_theme_setup' );


/**
 * Enqueue scripts and styles
 */

function aisconverse_test_theme_scripts() {
    //CSS
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css' );
    wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/css/slick-theme.css' );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css' );
    wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css' );

    //JS
    wp_enqueue_script("jquery");
    wp_enqueue_script( 'popper', get_template_directory_uri() . '/js/popper.js', array(), '1.0.0', true );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.js', array(), '1.0.0', true );
    wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'aisconverse_test_theme_scripts' );


// ADD Number to site identity customizer settings
function test_theme_phone_customize_register( $wp_customize ) {

    $wp_customize->add_section( 'test_theme_phone_number' , array(
        'title'      => __( 'Test Theme Settings', 'testtheme' ),
        'priority'   => 30,
    ));

    $wp_customize->add_setting( 'test_theme_phone_number', array());
    $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            'test_phone_number',
            array(
                'label'      => __( 'Header Phone Number', 'testtheme' ),
                'section'    => 'test_theme_phone_number',
                'settings'   => 'test_theme_phone_number',
                'priority'   => 1
            )
        )
    );
    $wp_customize->add_setting('test_theme_footer_img_settings', array());
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'test_theme_img_control', array(
        'label' => 'Footer Logo',
        'settings'  => 'test_theme_footer_img_settings',
        'section'   => 'test_theme_phone_number'
    ) ));
}
add_action( 'customize_register', 'test_theme_phone_customize_register' );


// Banner Slider

function test_theme_banner_slider(){
    // WP_Query arguments
    $args = array(
        'post_type' => array( 'post' ),
    );

// The Query
    $query = new WP_Query( $args );

// The Loop
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $post_date = get_the_date( 'j, F Y' );
            $postID = get_the_ID();
            /* grab the url for the full size featured image */
            $featured_img_url = get_the_post_thumbnail_url($postID, 'full');
            $image_id = get_post_thumbnail_id($postID);
            $alt_text = get_post_meta($image_id , '_wp_attachment_image_alt', true);
            echo '<div class="banner-slide">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="banner-info">
                                <span><img src="'.get_template_directory_uri().'/images/clock.png" alt="">'.$post_date.'</span>
                                <h2>'.get_the_title().'</h2>
                                <a href="'.get_the_permalink().'" title="" class="lnk-default">Read More</a>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img">
                            
                                <img src="'.$featured_img_url.'" alt="'.$alt_text.'">
                            </div>
                        </div>
                    </div>
                </div>';
        }
    } else {
        // no posts found
    }

// Restore original Post Data
    wp_reset_postdata();
}

// News Function Loop
function test_theme_news_function(){
    // WP_Query arguments
    $args = array(
        'post_type'              => array( 'test_theme_our_news' ),
        'post_status'            => array( 'publish' ),
        'posts_per_page'         => '2',
    );

// The Query
    $query = new WP_Query( $args );

// The Loop
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $post_date = get_the_date( 'j, F Y' );
            $postID = get_the_ID();
            /* grab the url for the full size featured image */
            $featured_img_url = get_the_post_thumbnail_url($postID, 'full');
            $image_id = get_post_thumbnail_id($postID);
            $alt_text = get_post_meta($image_id , '_wp_attachment_image_alt', true);
            echo '<div class="blog-post">
                        <div class="post-img">
                            <img src="'.$featured_img_url.'" alt="'.$alt_text.'">
                        </div>
                        <div class="post-info">
                            <span class="posted-date">'.$post_date.'</span>
                            <p>'.get_the_excerpt().'</p>
                        </div>
                    </div>';
        }
    } else {
        // no posts found
    }

// Restore original Post Data
    wp_reset_postdata();
}

if ( function_exists('register_sidebar') )
    register_sidebar(array(
            'name' => 'Header Search Area',
            'before_widget' => '<div class = "widgetizedArea">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );

// Hello World Shortcode
function testThemeShortcode( $atts){
    return '<div class = "test-shortcode"> Hello World! </div>';
}

add_shortcode( 'helloWorld', 'testThemeShortcode' );

//WooCommerce Support
add_theme_support( 'woocommerce' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

function my_theme_wrapper_start() {
    echo '<section id="main">';
}

function my_theme_wrapper_end() {
    echo '</section>';
}