<?php
/**
 * Dogghouse FCT functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Dogghouse_FCT
 * @since 1.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dogghouse_fct_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/dogghouse_fct
	 * If you're building a theme based on Dogghouse FCT, use a find and replace
	 * to change 'dogghouse_fct' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'dogghouse_fct' );

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

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'dogghouse_fct' ),
		'social' => __( 'Social Links Menu', 'dogghouse_fct' ),
		'footer' => __( 'Footer Menu', 'dogghouse_fct' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

}
add_action( 'after_setup_theme', 'dogghouse_fct_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dogghouse_fct_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer Left', 'dogghouse_fct' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your footer, on the left.', 'dogghouse_fct' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Right', 'dogghouse_fct' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer, on the right.', 'dogghouse_fct' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'dogghouse_fct_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Dogghouse FCT 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function dogghouse_fct_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'dogghouse_fct' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'dogghouse_fct_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Dogghouse FCT 1.0
 */
function dogghouse_fct_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'dogghouse_fct_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function dogghouse_fct_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'dogghouse_fct_pingback_header' );


/**
 * Enqueue scripts and styles.
 */
function dogghouse_fct_scripts() {
	// Theme stylesheet.
	wp_enqueue_style( 'dogghouse_fct-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	/* Begin Custom Enqueues */
    
  /* jQuery Cycle2 */    
  wp_enqueue_script( 'jquery-cycle', get_template_directory_uri() . '/assets/js/jquery.cycle2.min.js', array( 'jquery' ), date('YmdHis'), true );
    
  /* jQuery Cycle2 Carousel */
  wp_enqueue_script ( 'cycle-carousel', get_template_directory_uri() . '/assets/js/jquery.cycle2.carousel.min.js', array( 'jquery' ), date('YmdHis'), true );
    
  /* jQuery ImagesLoaded */
  wp_enqueue_script ( 'images-loaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), date('YmdHis'), true );
    
  /* jQuery Fancybox */
  wp_enqueue_script ( 'fancybox', get_template_directory_uri() . '/assets/js/fancybox/dist/jquery.fancybox.min.js', array( 'jquery' ), date('YmdHis'), true );
  wp_enqueue_script ( 'fancybox-media', get_template_directory_uri() . '/assets/js/fancybox/src/js/media.js', array( 'jquery' ), date('YmdHis'), true );
  wp_enqueue_style( 'fancy-style', get_template_directory_uri() . '/assets/js/fancybox/dist/jquery.fancybox.min.css', array(), date('YmdHis') );
    
  /* jQuery Stellar Parallax */
  wp_enqueue_script ( 'stellar-parallax', get_template_directory_uri() . '/assets/js/jquery.stellar.min.js' );
	
  /* jQuery Masonry */
   wp_enqueue_script ( 'masonry', get_template_directory_uri() . '/assets/js/masonry.pkgd.min.js', array( 'jquery' ), date('YmdHis'), true );
    
  /* Fonts on Fonts on Fonts */
  wp_enqueue_style ( 'font-awesome', get_template_directory_uri() . '/assets/fonts/font-awesome-5.15.4/css/all.min.css' );    
    
  wp_enqueue_style ( 'ion-icons', get_template_directory_uri() . '/assets/fonts/ionicons-2.0.1/css/ionicons.min.css' );  
  
  wp_enqueue_script( 'site-functions', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), date('YmdHis'), true );

  wp_enqueue_script('jquery-tabs', '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array('jquery', 'jquery-ui-core') );
    
   wp_enqueue_style('jquery-ui-css', '//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css', array('jquery', 'jquery-ui-core') );
}
add_action( 'wp_enqueue_scripts', 'dogghouse_fct_scripts' );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function dogghouse_fct_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'dogghouse_fct_front_page_template' );

/** 
 * Set SASS color vars with colorpicker fields from the ACF Options page 
 */
define('WP_SCSS_ALWAYS_RECOMPILE', true);

add_filter( 'wp_scss_variables','wp_scss_set_variables' );

function wp_scss_set_variables() {
  $primary = get_field( 'primary', 'option' ) ? : '#3F5563';
  $secondary = get_field( 'secondary', 'option' ) ? : '#3D403F';
	$tertiary = get_field( 'tertiary', 'option' ) ? : '#477982';
	$darkgray = get_field( 'medgray', 'option' ) ? : '#3e4140';
	$medgray = get_field( 'darkgray', 'option' ) ? : '#B4B5B4';
	$lightgray = get_field( 'lightgray', 'option' ) ? : '#F6F6F6';
	
	$typekit_fonts_script = get_field('typekit_fonts_script', 'option') ? : 'url("'.get_template_directory_uri().'/style.css");';
	$typekit_font_headings = get_field( 'typekit_font_headings', 'option' ) ? : 'Georgia, serif';
	$typekit_font_main = get_field( 'typekit_font_main', 'option' ) ? : 'Arial, sans-serif';
	
	$google_fonts_script = get_field('google_fonts_script', 'option') ? : 'url("'.get_template_directory_uri().'/style.css");';
	$google_font_headings = get_field('google_font_headings', 'option') ? : $typekit_font_headings;
	$google_font_main = get_field('google_font_main', 'option') ? : $typekit_font_main;
	
	$mainfont = $google_font_main ? : $typekit_font_main;
	$headingfont = $google_font_headings ? : $typekit_font_headings;
    
	$variables = array(
		'primary' => $primary,
		'secondary' => $secondary,
		'tertiary' => $tertiary,
		'medgray' => $medgray,
		'darkgray' => $darkgray,
		'lightgray' => $lightgray,
		'import-google-fonts' => $google_fonts_script,
		'import-typekit-fonts' => $typekit_fonts_script,
		'mainfont' => $mainfont,
		'headingfont' => $headingfont,
	);
    return $variables;
}

/**
 * Create ACF Options Page for theme options
 */

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

/** 
  * Custom Image Sizes
  */

add_action( 'after_setup_theme', 'custom_image_sizes' );
function custom_image_sizes() {
    /* New image size for HD images */
    add_image_size( 'full_hd', 1920, 1080, $crop = true );
		/* New image size for hero images */
    add_image_size( 'hero_image', 1920, 900, $crop = true );
    /* New image size for featured images */
    add_image_size( 'featured_image', 1920, 768, $crop = true );
    /* New image size for image & content blocks */
    add_image_size( 'image_content_block', 768, 615, $crop = true );
    /* New image size for half-width blocks */
    add_image_size( 'half_width_block', 768, 460, $crop = true );
}


/**
 * Gravity Forms Dynamic Isotope Quote Request Population
 * With "Add to Quote" cart functionality
 */

// ============================================================================
// GRAVITY FORMS FIELD POPULATION FUNCTIONS
// ============================================================================

/**
 * Populate Elements dropdown with all available elements
 * Only includes elements that have isotopes with valid variant data
 */
add_filter('gform_pre_render_1', 'populate_elements_dropdown');
add_filter('gform_pre_validation_1', 'populate_elements_dropdown');
add_filter('gform_pre_submission_filter_1', 'populate_elements_dropdown');
add_filter('gform_admin_pre_render_1', 'populate_elements_dropdown');

function populate_elements_dropdown($form) {
    foreach ($form['fields'] as &$field) {
        if ($field->id == '1') {
            global $wpdb;
            
            $choices = array();
            
            // Query all element posts
            $elements = get_posts(array(
                'post_type' => 'element',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
                'post_status' => 'publish'
            ));
            
            // Add empty placeholder FIRST
            $choices[] = array(
                'text' => 'Select Element',
                'value' => '',
                'isSelected' => false
            );
            
            // Filter elements to only include those with valid isotopes
            foreach ($elements as $element) {
                // Get all isotopes for this element
                $isotopes = get_posts(array(
                    'post_type' => 'isotope',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'fields' => 'ids',
                    'meta_query' => array(
                        array(
                            'key' => 'associated_element',
                            'value' => '"' . $element->ID . '"',
                            'compare' => 'LIKE'
                        )
                    )
                ));
                
                if (empty($isotopes)) {
                    continue;
                }
                
                $has_valid_isotope = false;
                
                foreach ($isotopes as $isotope_id) {
                    // Check for chemical_form or physical_form in isotope_variants
                    $chemical_forms = $wpdb->get_results($wpdb->prepare(
                        "SELECT meta_value FROM {$wpdb->postmeta} 
                        WHERE post_id = %d 
                        AND meta_key LIKE %s 
                        AND meta_value != ''",
                        $isotope_id,
                        'isotope_variants_%_chemical_form'
                    ));
                    
                    $physical_forms = $wpdb->get_results($wpdb->prepare(
                        "SELECT meta_value FROM {$wpdb->postmeta} 
                        WHERE post_id = %d 
                        AND meta_key LIKE %s 
                        AND meta_value != ''",
                        $isotope_id,
                        'isotope_variants_%_physical_form'
                    ));
                    
                    if (!empty($chemical_forms) || !empty($physical_forms)) {
                        $has_valid_isotope = true;
                        break;
                    }
                }
                
                if ($has_valid_isotope) {
                    $choices[] = array(
                        'text' => $element->post_title,
                        'value' => $element->ID,
                        'isSelected' => false
                    );
                }
            }
            
            $field->choices = $choices;
        }
    }
    
    return $form;
}

// ============================================================================
// AJAX HANDLERS FOR CASCADING DROPDOWNS
// ============================================================================

/**
 * AJAX Handler: Get isotopes for selected element
 * Only returns isotopes that have isotope_variants with chemical_form OR physical_form
 */
add_action('wp_ajax_get_isotopes_by_element', 'ajax_get_isotopes_by_element');
add_action('wp_ajax_nopriv_get_isotopes_by_element', 'ajax_get_isotopes_by_element');

function ajax_get_isotopes_by_element() {
    $element_id = isset($_POST['element_id']) ? intval($_POST['element_id']) : 0;
    
    if (!$element_id) {
        wp_send_json_error('No element ID provided');
    }
    
    // Query isotopes associated with this element
    $isotopes = get_posts(array(
        'post_type' => 'isotope',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'associated_element',
                'value' => '"' . $element_id . '"',
                'compare' => 'LIKE'
            )
        )
    ));
    
    $choices = array();
    
    // Filter isotopes to only include those with chemical_form OR physical_form in isotope_variants
    foreach ($isotopes as $isotope) {
        $variants = get_field('isotope_variants', $isotope->ID);
        
        if (!$variants || !is_array($variants)) {
            continue;
        }
        
        // Check if any variant has chemical_form or physical_form
        $has_form = false;
        foreach ($variants as $variant) {
            if (!empty($variant['chemical_form']) || !empty($variant['physical_form'])) {
                $has_form = true;
                break;
            }
        }
        
        if ($has_form) {
            $choices[] = array(
                'text' => $isotope->post_title,
                'value' => $isotope->ID
            );
        }
    }
    
    wp_send_json_success($choices);
}

/**
 * AJAX Handler: Get variant options for selected isotope
 * Returns which form type to display (chemical OR physical) and the available options
 */
add_action('wp_ajax_get_isotope_variants', 'ajax_get_isotope_variants');
add_action('wp_ajax_nopriv_get_isotope_variants', 'ajax_get_isotope_variants');

function ajax_get_isotope_variants() {
    $isotope_id = isset($_POST['isotope_id']) ? intval($_POST['isotope_id']) : 0;
    
    if (!$isotope_id) {
        wp_send_json_error('No isotope ID provided');
    }
    
    // Get the isotope_variants repeater field
    $variants = get_field('isotope_variants', $isotope_id);
    
    if (!$variants || !is_array($variants)) {
        wp_send_json_success(array(
            'has_chemical_form' => false,
            'has_physical_form' => false,
            'chemical_forms' => array(),
            'physical_forms' => array(),
            'enrichment_levels' => array(),
            'qty_units' => array()
        ));
    }
    
    // Initialize arrays for unique values
    $chemical_forms = array();
    $physical_forms = array();
    $enrichment_levels = array();
    $qty_units = array();
    
    // Loop through variants and collect unique values
    foreach ($variants as $variant) {
        // Chemical Form
        if (!empty($variant['chemical_form'])) {
            $chemical_forms[] = trim($variant['chemical_form']);
        }
        
        // Physical Form
        if (!empty($variant['physical_form'])) {
            $physical_forms[] = trim($variant['physical_form']);
        }
        
        // Enrichment Level
        if (!empty($variant['enrichment_level'])) {
            $enrichment_levels[] = trim($variant['enrichment_level']);
        }
        
        // Quantity Unit
        if (!empty($variant['qty_unit'])) {
            $qty_units[] = trim($variant['qty_unit']);
        }
    }
    
    // Remove duplicates and sort
    $chemical_forms = array_unique($chemical_forms);
    $physical_forms = array_unique($physical_forms);
    $enrichment_levels = array_unique($enrichment_levels);
    $qty_units = array_unique($qty_units);
    
    sort($chemical_forms);
    sort($physical_forms);
    sort($enrichment_levels);
    sort($qty_units);
    
    // Format as Gravity Forms choices
    $response = array(
        'has_chemical_form' => !empty($chemical_forms),
        'has_physical_form' => !empty($physical_forms),
        
        'chemical_forms' => array_map(function($value) {
            return array('text' => $value, 'value' => $value);
        }, array_values($chemical_forms)),
        
        'physical_forms' => array_map(function($value) {
            return array('text' => $value, 'value' => $value);
        }, array_values($physical_forms)),
        
        'enrichment_levels' => array_map(function($value) {
            return array('text' => $value, 'value' => $value);
        }, array_values($enrichment_levels)),
        
        'qty_units' => array_map(function($value) {
            return array('text' => $value, 'value' => $value);
        }, array_values($qty_units))
    );
    
    wp_send_json_success($response);
}

// ============================================================================
// ENQUEUE JAVASCRIPT FOR AJAX FUNCTIONALITY
// ============================================================================

/**
 * Enqueue custom JavaScript for form interaction
 */
add_action('gform_enqueue_scripts_1', 'enqueue_isotope_form_scripts', 10, 2);

function enqueue_isotope_form_scripts($form, $is_ajax) {
    wp_enqueue_script(
        'isotope-form-ajax',
        get_stylesheet_directory_uri() . '/assets/js/isotope-form-ajax.js',
        array('jquery'),
        '1.0.4',
        true
    );
    
    // Pass AJAX URL and field IDs to JavaScript
    wp_localize_script('isotope-form-ajax', 'isotopeFormData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'formId' => $form['id'],
        'fieldIds' => array(
            'element' => '1',
            'isotope' => '3',
            'chemicalForm' => '5',
            'physicalForm' => '6',
            'enrichment' => '7',
            'qtyUnit' => '8',
            'quantity' => '9',
            'units' => '10',        
            'comments' => '11', 
            'cartData' => '12'
        )
    ));
}

// ============================================================================
// CART DATA PROCESSING AND DISPLAY
// ============================================================================

/**
 * Format cart data for display in entries and notifications
 */
add_filter('gform_entry_post_save', 'process_isotope_cart_data', 10, 2);

function process_isotope_cart_data($entry, $form) {
    // Only process form ID 1
    if ($form['id'] != 1) {
        return $entry;
    }
    
    // Get the cart data from field 12
    $cart_json = rgar($entry, '12');
    
    if (empty($cart_json)) {
        return $entry;
    }
    
    // Decode the JSON
    $cart_items = json_decode($cart_json, true);
    
    if (!is_array($cart_items) || empty($cart_items)) {
        return $entry;
    }
    
    // Build a readable format - keep as plain text, no HTML
    $formatted_output = "ISOTOPE QUOTE REQUEST\n";
    $formatted_output .= str_repeat("=", 50) . "\n\n";
    
    foreach ($cart_items as $index => $item) {
        $item_number = $index + 1;
        $formatted_output .= "Item #{$item_number}\n";
        $formatted_output .= str_repeat("-", 50) . "\n";
        $formatted_output .= "Element: " . $item['element']['text'] . "\n";
        $formatted_output .= "Isotope: " . $item['isotope']['text'] . "\n";
        
        if (!empty($item['chemicalForm'])) {
            $formatted_output .= "Chemical Form: " . $item['chemicalForm'] . "\n";
        }
        
        if (!empty($item['physicalForm'])) {
            $formatted_output .= "Physical Form: " . $item['physicalForm'] . "\n";
        }
        
        if (!empty($item['enrichment'])) {
            $formatted_output .= "Enrichment Level: " . $item['enrichment'] . "\n";
        }
        
        if (!empty($item['quantity'])) {
            $formatted_output .= "Quantity: " . $item['quantity'];
            if (!empty($item['qtyUnit'])) {
                $formatted_output .= " " . $item['qtyUnit'];
            }
            $formatted_output .= "\n";
        }

        if (!empty($item['units'])) {
            $formatted_output .= "Units: " . $item['units'] . "\n";
        }
        
        if (!empty($item['comments'])) {
            $formatted_output .= "Comments: " . $item['comments'] . "\n";
        }
        
        $formatted_output .= "\n";
    }
    
    // Update the entry with the formatted data
    GFAPI::update_entry_field($entry['id'], '12', $formatted_output);
    
    return $entry;
}

/**
 * Format cart data for email notifications with HTML
 */
add_filter('gform_notification', 'format_isotope_cart_for_email', 10, 3);

function format_isotope_cart_for_email($notification, $form, $entry) {
    // Only process form ID 1
    if ($form['id'] != 1) {
        return $notification;
    }
    
    // Get the cart data from field 12
    $cart_data = rgar($entry, '12');
    
    if (empty($cart_data)) {
        return $notification;
    }
    
    // Try to decode as JSON first (in case it hasn't been processed yet)
    $cart_items = json_decode($cart_data, true);
    
    if (!is_array($cart_items)) {
        // It's already formatted text, parse it
        $html_output = '<div style="font-family: Arial, sans-serif; max-width: 800px; margin: 20px 0;">';
        $html_output .= '<div style="background: #0073aa; color: white; padding: 20px; border-radius: 8px 8px 0 0;">';
        $html_output .= '<h2 style="margin: 0; font-size: 24px;">Isotope Quote Request</h2>';
        $html_output .= '</div>';
        
        // Split by "Item #" to get individual items
        $items = preg_split('/Item #\d+\n-+\n/', $cart_data);
        array_shift($items); // Remove the header part
        
        foreach ($items as $index => $item_text) {
            if (empty(trim($item_text))) continue;
            
            $item_number = $index + 1;
            $bg_color = ($index % 2 == 0) ? '#f9f9f9' : '#ffffff';
            
            $html_output .= '<div style="background: ' . $bg_color . '; padding: 20px; border-bottom: 1px solid #ddd;">';
            $html_output .= '<h3 style="color: #0073aa; margin-top: 0; margin-bottom: 15px; font-size: 18px;">Item #' . $item_number . '</h3>';
            $html_output .= '<table style="width: 100%; border-collapse: collapse;">';
            
            // Parse each line
            $lines = explode("\n", trim($item_text));
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line)) continue;
                
                if (strpos($line, ':') !== false) {
                    list($label, $value) = explode(':', $line, 2);
                    $label = trim($label);
                    $value = trim($value);
                    
                    $html_output .= '<tr>';
                    $html_output .= '<td style="padding: 8px 12px; font-weight: bold; color: #555; width: 180px; vertical-align: top;">' . esc_html($label) . ':</td>';
                    $html_output .= '<td style="padding: 8px 12px; color: #333;">' . esc_html($value) . '</td>';
                    $html_output .= '</tr>';
                }
            }
            
            $html_output .= '</table>';
            $html_output .= '</div>';
        }
        
        $html_output .= '<div style="background: #f5f5f5; padding: 15px; text-align: center; color: #666; font-size: 12px; border-radius: 0 0 8px 8px;">';
        $html_output .= 'Total Items: ' . count($items);
        $html_output .= '</div>';
        $html_output .= '</div>';
        
        // Replace the field merge tag with formatted HTML
        $notification['message'] = str_replace('{Isotope Items:12}', $html_output, $notification['message']);
        
        return $notification;
    }
    
    // It's JSON, format it nicely
    if (empty($cart_items)) {
        return $notification;
    }
    
    $html_output = '<div style="font-family: Arial, sans-serif; max-width: 800px; margin: 20px 0;">';
    $html_output .= '<div style="background: #0073aa; color: white; padding: 20px; border-radius: 8px 8px 0 0;">';
    $html_output .= '<h2 style="margin: 0; font-size: 24px;">Isotope Quote Request</h2>';
    $html_output .= '</div>';
    
    foreach ($cart_items as $index => $item) {
        $item_number = $index + 1;
        $bg_color = ($index % 2 == 0) ? '#f9f9f9' : '#ffffff';
        
        $html_output .= '<div style="background: ' . $bg_color . '; padding: 20px; border-bottom: 1px solid #ddd;">';
        $html_output .= '<h3 style="color: #0073aa; margin-top: 0; margin-bottom: 15px; font-size: 18px;">Item #' . $item_number . '</h3>';
        $html_output .= '<table style="width: 100%; border-collapse: collapse;">';
        
        $html_output .= '<tr><td style="padding: 8px 12px; font-weight: bold; color: #555; width: 180px;">Element:</td><td style="padding: 8px 12px; color: #333;">' . esc_html($item['element']['text']) . '</td></tr>';
        $html_output .= '<tr><td style="padding: 8px 12px; font-weight: bold; color: #555;">Isotope:</td><td style="padding: 8px 12px; color: #333; font-weight: bold;">' . esc_html($item['isotope']['text']) . '</td></tr>';
        
        if (!empty($item['chemicalForm'])) {
            $html_output .= '<tr><td style="padding: 8px 12px; font-weight: bold; color: #555;">Chemical Form:</td><td style="padding: 8px 12px; color: #333;">' . esc_html($item['chemicalForm']) . '</td></tr>';
        }
        
        if (!empty($item['physicalForm'])) {
            $html_output .= '<tr><td style="padding: 8px 12px; font-weight: bold; color: #555;">Physical Form:</td><td style="padding: 8px 12px; color: #333;">' . esc_html($item['physicalForm']) . '</td></tr>';
        }
        
        if (!empty($item['enrichment'])) {
            $html_output .= '<tr><td style="padding: 8px 12px; font-weight: bold; color: #555;">Enrichment Level:</td><td style="padding: 8px 12px; color: #333;">' . esc_html($item['enrichment']) . '</td></tr>';
        }
        
        if (!empty($item['quantity'])) {
            $qty_display = esc_html($item['quantity']);
            if (!empty($item['qtyUnit'])) {
                $qty_display .= ' ' . esc_html($item['qtyUnit']);
            }
            $html_output .= '<tr><td style="padding: 8px 12px; font-weight: bold; color: #555;">Quantity:</td><td style="padding: 8px 12px; color: #333;">' . $qty_display . '</td></tr>';
        }

        if (!empty($item['units'])) {
            $html_output .= '<tr><td style="padding: 8px 12px; font-weight: bold; color: #555;">Units:</td><td style="padding: 8px 12px; color: #333;">' . esc_html($item['units']) . '</td></tr>';
        }

        if (!empty($item['comments'])) {
            $html_output .= '<tr><td style="padding: 8px 12px; font-weight: bold; color: #555;">Comments:</td><td style="padding: 8px 12px; color: #333;">' . nl2br(esc_html($item['comments'])) . '</td></tr>';
        }
        
        $html_output .= '</table>';
        $html_output .= '</div>';
    }
    
    $html_output .= '<div style="background: #f5f5f5; padding: 15px; text-align: center; color: #666; font-size: 12px; border-radius: 0 0 8px 8px;">';
    $html_output .= 'Total Items: ' . count($cart_items);
    $html_output .= '</div>';
    $html_output .= '</div>';
    
    // Replace the field merge tag with formatted HTML
    $notification['message'] = str_replace('{Isotope Items:12}', $html_output, $notification['message']);
    
    return $notification;
}

/**
 * Change the label for field 12 in entry detail view
 * Display as formatted table instead of plain text
 */
add_filter('gform_entry_field_value', 'format_isotope_cart_entry_display', 10, 4);

function format_isotope_cart_entry_display($value, $field, $entry, $form) {
    // Only process field 12 on form 1
    if ($form['id'] != 1 || $field->id != 12) {
        return $value;
    }
    
    // Check if this is JSON data
    $cart_items = json_decode($value, true);
    
    // If it's not valid JSON, display the formatted text
    if (!is_array($cart_items)) {
        // It's the formatted text version
        $value = str_replace('<br />', '', $value); // Remove any br tags
        return '<pre style="background: #f5f5f5; padding: 15px; border-radius: 4px; overflow-x: auto; white-space: pre-wrap; font-family: monospace;">' . esc_html($value) . '</pre>';
    }
    
    if (empty($cart_items)) {
        return $value;
    }
    
    // Build HTML table for admin view
    $html = '<div style="margin: 20px 0;">';
    $html .= '<h3 style="margin-top: 0;">Isotope Quote Request Items</h3>';
    $html .= '<table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">';
    $html .= '<thead><tr style="background: #0073aa; color: white;">';
    $html .= '<th style="border: 1px solid #ddd; padding: 10px; text-align: left;">#</th>';
    $html .= '<th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Element</th>';
    $html .= '<th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Isotope</th>';
    $html .= '<th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Chemical Form</th>';
    $html .= '<th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Physical Form</th>';
    $html .= '<th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Enrichment</th>';
    $html .= '<th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Quantity</th>';
    $html .= '<th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Units</th>';
    $html .= '<th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Comments</th>';
    $html .= '</tr></thead><tbody>';
    
    foreach ($cart_items as $index => $item) {
        $html .= '<tr' . ($index % 2 == 0 ? ' style="background: #f9f9f9;"' : '') . '>';
        $html .= '<td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><strong>' . ($index + 1) . '</strong></td>';
        $html .= '<td style="border: 1px solid #ddd; padding: 10px;">' . esc_html($item['element']['text']) . '</td>';
        $html .= '<td style="border: 1px solid #ddd; padding: 10px;"><strong>' . esc_html($item['isotope']['text']) . '</strong></td>';
        $html .= '<td style="border: 1px solid #ddd; padding: 10px;">' . (esc_html($item['chemicalForm']) ?: '—') . '</td>';
        $html .= '<td style="border: 1px solid #ddd; padding: 10px;">' . (esc_html($item['physicalForm']) ?: '—') . '</td>';
        $html .= '<td style="border: 1px solid #ddd; padding: 10px;">' . (esc_html($item['enrichment']) ?: '—') . '</td>';
        
        $qty_display = $item['quantity'] ? esc_html($item['quantity']) : '—';
        if (!empty($item['qtyUnit']) && !empty($item['quantity'])) {
            $qty_display .= ' ' . esc_html($item['qtyUnit']);
        }
        $html .= '<td style="border: 1px solid #ddd; padding: 10px;">' . $qty_display . '</td>';
        $html .= '<td style="border: 1px solid #ddd; padding: 10px;">' . (esc_html($item['units']) ?: '—') . '</td>';
        $html .= '<td style="border: 1px solid #ddd; padding: 10px;">' . (esc_html($item['comments']) ?: '—') . '</td>';
        $html .= '</tr>';
    }
    
    $html .= '</tbody></table>';
    $html .= '</div>';
    
    return $html;
}

/**
 * Convert product_catalog_json to ACF Isotope Variants repeater
 * 
 * This function reads the product_catalog_json field from imported isotopes
 * and converts it to ACF repeater rows with the new field structure:
 * - chemical_form
 * - z_protons
 * - n_neutrons
 * - atomic_mass
 * - natural_abundance
 * - enrichment_level
 * 
 * When uncommented, it will run automatically on load of any WordPress backend page.
 */

//function convert_product_catalog_json_to_acf() {
//    // Check if already run
//    if (get_option('isotope_variants_json_converted')) {
//        return;
//    }
//    
//    // Only admins can trigger this
//    if (!current_user_can('manage_options')) {
//        return;
//    }
//    
//    // Get all isotope posts
//    $isotopes = get_posts(array(
//        'post_type' => 'isotope',
//        'posts_per_page' => -1,
//        'post_status' => 'any'
//    ));
//    
//    $converted = 0;
//    $skipped = 0;
//    $errors = array();
//    
//    foreach ($isotopes as $post) {
//        // Get the JSON from the imported CSV column
//        $isotope_json = get_post_meta($post->ID, 'isotope_variants_json', true);
//        
//        if (empty($isotope_json)) {
//            $skipped++;
//            continue;
//        }
//        
//        // Decode the JSON
//        $variants = json_decode($isotope_json, true);
//        
//        if (!is_array($variants) || empty($variants)) {
//            $errors[] = "Post ID {$post->ID} ({$post->post_title}): Invalid JSON";
//            $skipped++;
//            continue;
//        }
//        
//        // Clear existing repeater rows
//        delete_field('isotope_variants', $post->ID);
//        
//        // Build ACF repeater data with new structure
//        $repeater_data = array();
//        foreach ($variants as $variant) {
//            $repeater_data[] = array(
//                'chemical_form' => $variant['chemical_form'] ?? '',
//                'z_protons' => $variant['z_protons'] ?? '',
//                'n_neutrons' => $variant['n_neutrons'] ?? '',
//                'atomic_mass' => $variant['atomic_mass'] ?? '',
//                'natural_abundance' => $variant['natural_abundance'] ?? '',
//                'enrichment_level' => $variant['enrichment_level'] ?? ''
//            );
//        }
//        
//        // Update ACF repeater
//        update_field('isotope_variants', $repeater_data, $post->ID);
//        
//        $converted++;
//    }
//    
//    // Mark as complete so it doesn't run again
//    update_option('isotope_variants_json_converted', true);
//    
//    // Show admin notice
//    add_action('admin_notices', function() use ($converted, $skipped, $errors) {
//        echo '<div class="notice notice-success is-dismissible">';
//        echo '<h2>✓ Product Catalog Conversion Complete!</h2>';
//        echo '<p><strong>Converted:</strong> ' . $converted . ' isotopes</p>';
//        echo '<p><strong>Skipped:</strong> ' . $skipped . ' isotopes (no product data)</p>';
//        
//        if (!empty($errors)) {
//            echo '<h3>Errors:</h3>';
//            echo '<ul>';
//            foreach ($errors as $error) {
//                echo '<li>' . esc_html($error) . '</li>';
//            }
//            echo '</ul>';
//        }
//	});
//}
//add_action('admin_init', 'convert_product_catalog_json_to_acf');

/**
 * Function to convert imported 'isotope_variants_json' meta field (from CSV)
 * into the ACF Repeater Field 'isotope_variants'.
 *
 * This function is configured to process ONLY posts associated with the specific
 * element ID set in $element_id (currently 159 for Protactinium).
 */
//function convert_product_catalog_json_to_acf() {
//    // Check if the conversion process has already been successfully run
//    // NOTE: You must uncomment delete_option() at the bottom, load an admin page, then comment it out again
//    // to reset and re-run this function if needed.
//    if (get_option('isotope_variants_json_converted')) {
//        return;
//    }
//
//    // Only allow users with 'manage_options' capability (Admins) to run this
//    if (!current_user_can('manage_options')) {
//        return;
//    }
//
//    // --- CONFIGURATION ---
//    $repeater_field_key = 'isotope_variants';
//    // CURRENT TARGET ID: 159 (Protactinium). Change this ID to process a different single element.
//    $element_id = 159; 
//    // ---------------------
//
//    // Get only the isotope posts that match the single target element ID
//    $isotopes = get_posts(array(
//        'post_type'      => 'isotope',
//        'posts_per_page' => -1,
//        'post_status'    => 'any',
//        'meta_query' => array(
//            array(
//                'key' => 'associated_element',
//                'value' => '"' . $element_id . '"',
//                'compare' => 'LIKE',
//                'type' => 'NUMERIC',
//            ),
//        ),
//    ));
//
//    $converted = 0;
//    $skipped = 0;
//    $errors = array();
//
//    foreach ($isotopes as $post) {
//        // Get the JSON string from the imported CSV column meta field
//        $isotope_json = get_post_meta($post->ID, 'isotope_variants_json', true);
//        
//        // FIX: Remove slashes (essential safeguard against import tool escaping)
//        $clean_json = stripslashes($isotope_json);
//
//        if (empty($clean_json)) {
//            $skipped++;
//            continue;
//        }
//
//        // Decode the JSON
//        $variants = json_decode($clean_json, true);
//
//        // Validation check
//        if (!is_array($variants) || empty($variants)) {
//            $errors[] = "Post ID {$post->ID} ({$post->post_title}): Invalid JSON or empty array.";
//            $skipped++;
//            continue;
//        }
//
//        // Clear existing repeater rows to avoid data duplication
//        delete_field($repeater_field_key, $post->ID);
//
//        // Build ACF repeater data with the structure compatible with ALL post types
//        $repeater_data = array();
//        foreach ($variants as $variant) {
//            $repeater_data[] = array(
//                // Fields present only in old/stable data (will be empty for new radioactive posts)
//                'chemical_form' => $variant['chemical_form'] ?? '',
//                'physical_form' => $variant['physical_form'] ?? '',
//                'enrichment_level' => $variant['enrichment_level'] ?? '',
//
//                // Core nuclear properties
//                'z_protons' => $variant['z_protons'] ?? '',
//                'n_neutrons' => $variant['n_neutrons'] ?? '',
//                'atomic_mass' => $variant['atomic_mass'] ?? '',
//                'natural_abundance' => $variant['natural_abundance'] ?? '',
//                
//                // Fields specific to Monoisotopic/Radioactive data
//                'nuclear_spin' => $variant['nuclear_spin'] ?? '',
//                'specific_activity' => $variant['specific_activity'] ?? '', // Added specific_activity
//                'half-life' => $variant['half_life'] ?? '', // Corrected ACF field slug
//                
//                // Fields specific to Radioactive data
//                'mode_of_decay' => $variant['mode_of_decay'] ?? '',
//                'nuclear_magnetic_moment' => $variant['nuclear_magnetic_moment'] ?? '',
//            );
//        }
//
//        // Update ACF repeater field
//        if (update_field($repeater_field_key, $repeater_data, $post->ID)) {
//            $converted++;
//        } else {
//            $errors[] = "Post ID {$post->ID} ({$post->post_title}): Failed to update ACF field '{$repeater_field_key}'.";
//        }
//    }
//
//    // Mark as complete so it doesn't run again
//    update_option('isotope_variants_json_converted', true);
//
//    // Show admin notice with results
//    add_action('admin_notices', function() use ($converted, $skipped, $errors) {
//        $error_class = empty($errors) ? 'notice-success' : 'notice-warning';
//
//        echo '<div class="notice ' . esc_attr($error_class) . ' is-dismissible">';
//        echo '<h2>✓ Isotope Variants Conversion Complete!</h2>';
//        echo '<p><strong>Converted:</strong> ' . esc_html($converted) . ' isotopes</p>';
//        echo '<p><strong>Skipped:</strong> ' . esc_html($skipped) . ' isotopes (no data or invalid JSON)</p>';
//
//        if (!empty($errors)) {
//            echo '<h3>Conversion Errors:</h3>';
//            echo '<ul>';
//            foreach ($errors as $error) {
//                echo '<li>' . esc_html($error) . '</li>';
//            }
//            echo '</ul>';
//        }
//        echo '</div>';
//    });
//}
//add_action('admin_init', 'convert_product_catalog_json_to_acf');

/**
 * OPTIONAL: Reset function if you need to re-run the conversion
 * Uncomment the line below, load any admin page once, then comment it back out
 */
 // delete_option('isotope_variants_json_converted');
