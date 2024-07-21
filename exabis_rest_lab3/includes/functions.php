<?php 

require_once 'connections.php';
//require_once 'fuctions_activated.php';



    // Cargar los archivos de idioma para la internacionalización
    function exabis_rest_load_textdomain() {
        load_plugin_textdomain('exabis-rest', false, basename(MY_PLUGIN_DIR) . '/languages');
    }
    add_action('plugins_loaded', 'exabis_rest_load_textdomain');



    function exabis_rest_register_menu_page() {
        // Permitir el acceso a editores, autores y administradores
        $capability = 'manage_options';

        add_menu_page( 'Custom Menu Title', 'Exabis Portfolio', $capability, 'exabis_rest', 'exabis_rest_my_custom_menu_callback', 'dashicons-admin-site', 6 );
    
    }

    function exabis_rest_my_custom_menu_callback() { 

        // Get the description data from mdl_exaportuser table
        // Definir la pestaña activa
        $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : '';
        

        // Registrar y enlazar el archivo CSS
        wp_enqueue_style('exabis-custom-style', plugin_dir_url(__FILE__) . 'public/css/styles.css');
        wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css', array(), '5.3.1' );
        
        ?>
        <div class="wrap">
            jola
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <h2 class="nav-tab-wrapper">
                <a href="?page=exabis_rest&tab=login" class="nav-tab <?php echo esc_attr($active_tab == 'login' ? 'nav-tab-active' : ''); ?>">
                    <?php esc_html_e('Login', 'exabis-rest'); ?>
                </a>
                <a href="?page=exabis_rest&tab=import" class="nav-tab <?php echo esc_attr($active_tab == 'import' ? 'nav-tab-active' : ''); ?>">
                    <?php esc_html_e('Import', 'exabis-rest'); ?>
                </a>
            </h2>

            <?php
            // Incluir la plantilla adecuada según la pestaña activa
            if ($active_tab == 'login') {
                include(MY_PLUGIN_DIR . 'templates/login-template.php');
            } elseif ($active_tab == 'import') {
                include(MY_PLUGIN_DIR . 'templates/import-template.php');
            }
            ?>
        </div>
        <?php
        
        
    }
    add_action( 'admin_menu', 'exabis_rest_register_menu_page' );

    function exabis_assign_page_templates($template) {
        global $post;

        $base_dir = plugin_dir_path(dirname(__FILE__)); // Sube un nivel en la estructura de directorios

        if ($post->post_title == 'Home') {
            $template = $base_dir . 'templates/home-template.php';
        } elseif ($post->post_title == 'Create') {
            $template = $base_dir . 'templates/create-template.php';
        }

        return $template;
    }

    add_filter('template_include', 'exabis_assign_page_templates');




    function get_page_url_by_title($title) {
        $args = array(
            'post_type' => 'page',
            'post_status' => 'publish',
            'title' => $title,
            'posts_per_page' => 1
        );
    
        $query = new WP_Query($args);
        $page_url = '';
    
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $page_url = get_permalink();
            }
        }
    
        wp_reset_postdata();
        return $page_url;
    }

    function register_my_taxonomy() {
        $args = array(
            'labels' => array(
                'name' => 'Page Categories',
                'singular_name' => 'Page Category',
            ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true,
            'hierarchical' => true,
            'rewrite' => array('slug' => 'page-category'),
            'show_admin_column' => true,
        );

        register_taxonomy('page_categories', 'page', $args);
    }
    add_action('init', 'register_my_taxonomy');


    /**
     * Custom css js for pages
    */

    
    
    function my_plugin_enqueue_custom_style() {
        // Verifica si estamos en una página individual
        if (is_page()) {
            global $post;
            
            // Comprueba si la página actual tiene el meta 'es_pagina_de_mi_plugin'
            if (get_post_meta($post->ID, 'es_pagina_de_mi_plugin', true)) {
                // Encola el CSS personalizado
                // Asegúrate de cambiar la ruta a la ubicación correcta de tu archivo CSS en tu plugin
                wp_enqueue_style('my-custom-page-style', plugins_url('../public/css/styles.css', __FILE__));
            }
        }
    }
    add_action('wp_enqueue_scripts', 'my_plugin_enqueue_custom_style');
    
    // /**
    //  * Clean test_post.php without header an footer
    // */
    // function my_plugin_custom_page_template($template) {
    //     if (is_page()) {
    //         $page_id = get_queried_object_id();
    //         if (get_post_meta($page_id, 'es_pagina_de_mi_plugin', true)) {
    //             $new_template = plugin_dir_path(__FILE__) . '../templates/test_post.php';
    //             if (file_exists($new_template)) {
    //                 return $new_template;
    //             }
    //         }
    //     }
    
    //     return $template;
    // }
    // add_filter('template_include', 'my_plugin_custom_page_template', 99);
    
    /**
    * Register template  in arrays templates wodpress
    */
    function my_plugin_register_template($templates) {
        $templates[plugin_dir_path(__FILE__) . '../templates/test-view-template.php'] = __('My Custom Page', 'my-exabis-rest-domain ');
        $templates[plugin_dir_path(__FILE__) . '../templates/test-template.php'] = __('My Custom Page', 'my-exabis-rest-domain');
        return $templates;
    }
    add_filter('theme_page_templates', 'my_plugin_register_template');
    

    /**
     * Load template since plugin
    */
    function my_plugin_redirect_template($template) {
        $post = get_post();
        $post_meta_template = get_post_meta($post->ID, '_wp_page_template', true);
    
        if ($post_meta_template && strpos($post_meta_template, 'test-view-template.php') !== false) {
            $template = plugin_dir_path(__FILE__) . '../templates/test-view-template.php';
        }elseif ($post_meta_template && strpos($post_meta_template, 'test-template.php') !== false) {
            $template = plugin_dir_path(__FILE__) . '../templates/test-template.php';
        }
    
        return $template;
    }
    add_filter('template_include', 'my_plugin_redirect_template');
    
    
    
        
?>
