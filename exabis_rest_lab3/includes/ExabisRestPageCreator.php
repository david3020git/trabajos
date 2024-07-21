<?php 


class ExabisRestPageCreator {

    // Almacena la instancia única de la clase
    private static $instance = null;

    private function __construct() {
        // Registro del shortcode
        add_shortcode('request_token', array($this, 'request_token_shortcode'));
        
        // Registro del nuevo shortcode
        add_shortcode('create_view', array($this, 'create_view_shortcode'));

        add_shortcode('view_detail', array($this, 'view_detail_shortcode'));

        add_shortcode('edit_view', array($this, 'edit_view_shortcode'));

        add_shortcode('home_shorcode', array($this, 'home_shorcode'));

        add_shortcode('deleted_view', array($this, 'delete_view_shorcode'));
        add_shortcode('test_view', array($this, 'testing_shorcode'));
        add_shortcode('portfolio_artifacts', array($this, 'my_portfolio_artifacts_shorcode'));
        add_shortcode('import_view', array($this, 'get_import_views_shorcode'));
       // add_action('init', array($this, 'my_plugin_enqueue_custom_styles'));

    }

    // Método para obtener la instancia de la clase
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new ExabisRestPageCreator();
        }
        return self::$instance;
    }

    public static function activate() {
        // Obtiene la instancia única de la clase
        $instance = self::getInstance();
        $instance->create_page('Home Eportfolio', 'Welcome Eportfolio[home_shorcode]' );
        // $instance->create_page('Create View', 'Create your view here [create_view]');
        // $instance->create_page('Detail View', 'Detail view here [view_detail]');
        // $instance->create_page('Edit View', 'Edit view here [edit_view]');
        $instance->create_page('Login Moodle', '[request_token]');
        $instance->create_page('Test Request', '[test_view]');
       // $instance->create_page('My Portfolio Artifacts', '[portfolio_artifacts]');
        $instance->create_page('Import Views', '[import_view]');
        
    }

    private static function create_page($title, $content) {
        // Configurar argumentos para WP_Query
        $args = array(
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'title'          => $title,
            'posts_per_page' => 1
        );
    
        // Crear una nueva instancia de WP_Query
        $query = new WP_Query($args);
    
        // Verificar si la página ya existe
        if (!$query->have_posts()) {
            $page_data = array(
                'post_title'    => $title,
                'post_content'  => $content,
                'post_status'   => 'publish',
                'post_type'     => 'page',
                'post_author'   => get_current_user_id(),
            );
            wp_insert_post($page_data);
        }
    
        // Restaurar la consulta original de WordPress
        wp_reset_postdata();
    }

    public function home_shorcode(){
        ob_start();
        require_once plugin_dir_path(__FILE__) . 'make_moodle_request.php';
    
       // $pages_category_view = list_pages_by_category('category_view');
        
        $pages_category_view = get_pages_by_taxonomy('page_categories');
        //var_dump($pages_category_view);
        // foreach ($pages as $page) {
        //     echo "<li><a href='{$page->permalink}'>{$page->title}</a> (ID: {$page->ID})</li>";
        // }
        
        //print_r($pages_category_view);
        //$posts_category_view = list_posts_by_category('category_view');
        //list_pages_by_category
        $template_path = plugin_dir_path(__FILE__) . '../templates/test-template.php';
        //include $template_path;
        //print_r($posts_category_view);
        
        

        $render_template = function() use ($pages_category_view, $template_path) {
            include $template_path;
        };
        $render_template();



        return ob_get_clean();

    }
    public function request_token_shortcode() {
         ob_start();
        // Aquí va el HTML del formulario o incluye un archivo de plantilla
        $template_path = plugin_dir_path(__FILE__) . '../templates/login-template.php';
        
        // Incluye el archivo de plantilla
        include($template_path);
        
        return ob_get_clean();

        
    }

    
    public function testing_shorcode() {
        require_once plugin_dir_path(__FILE__) . 'make_moodle_request.php';
        //$test_services_rest = get_test(2);
        $all_items = get_all_items_view();
        var_dump($all_items);
        
        // $views = get_moodle_views();
        // $all_items = get_all_items_view();
    
        // if (is_array($views) && !empty($views)) {
        //     foreach ($views as $view) {
        //         $view_id = $view['id'];
        //         $view_details = get_moodle_view_details($view_id);
    
        //         // Define las variables antes de incluir la plantilla
        //         $template_path = plugin_dir_path(__FILE__) . '../templates/test_post.php';
                
        //         // Asegúrate de que las variables $view_details y $all_items están definidas
        //         ob_start();
        //         include($template_path);
        //         $content = ob_get_clean();
    
        //         // Crear el post
        //         $new_post = array(
        //             'post_title'    => $view_details['name'],
        //             'post_content'  => $content,
        //             'post_status'   => 'publish',
        //             'post_author'   => get_current_user_id(),
        //             'post_type'     => 'post'
        //         );
    
        //         // Insertar el post
        //         $post_id = wp_insert_post($new_post);
    
        //         if (!$post_id) {
        //             echo 'Error al insertar el post para la vista con ID ' . $view_id;
        //         }
        //     }
        // } else {
        //     echo 'No se encontraron vistas.';
        // }
    }


    public function get_import_views_shorcode() {
        require_once plugin_dir_path(__FILE__) . 'make_moodle_request.php';
    
        $taxonomy = 'page_custom_category';
        $page_url_home = get_page_url_by_title('Home Eportfolio');
    
        // Slug de la nueva taxonomía
        $taxonomy = 'page_categories'; // Asegúrate de usar el slug correcto

        // Asegura que la taxonomía exista (aunque ya la registraste, es buena práctica verificar)
        if (!taxonomy_exists($taxonomy)) {
            register_taxonomy(
                $taxonomy,
                'page',
                array(
                    'label' => __('Page Categories'),
                    'rewrite' => array('slug' => 'page-category'),
                    'hierarchical' => true,
                )
            );
        }

        // Nombre o slug de la categoría específica dentro de la taxonomía
        $category_name = 'my-custom-category'; // Usa el slug real de la categoría que deseas asignar
        // Asegura que la categoría específica exista
        if (!term_exists($category_name, $taxonomy)) {
            wp_insert_term('My Custom Category', $taxonomy); // 'My Custom Category' es el nombre visible de la categoría
        }


        $views = get_moodle_views();
        if (!$views) {
            return 'Views could not be obtained.';
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_views'])) {
            $selectedViews = $_POST['selected_views'];
            //echo $selectedViews;
    
            foreach ($selectedViews as $view_id) {
                $template_path = plugin_dir_path(__FILE__) . '../templates/test_post.php';
                $view_details = get_custom_view($view_id);
               // var_dump($view_details);
                ob_start();
                include($template_path);
                $content = ob_get_clean();
    
                $new_page = array(
                    'post_title'    => $view_details['name'],
                    'post_content'  => $content,
                    'post_status'   => 'publish',
                    'post_author'   => get_current_user_id(),
                    'post_type'     => 'page'
                );
    
                $page_id = wp_insert_post($new_page);
    
                if ($page_id) {
                    // Asigna la categoría específica a la página
                    $term = get_term_by('slug', $category_name, $taxonomy);
                    wp_set_post_terms($page_id, [$term->term_id], $taxonomy, true);
                    //update_post_meta($page_id, 'es_pagina_de_mi_plugin', true);
                    add_post_meta($page_id, 'es_pagina_de_mi_plugin', true);
                    update_post_meta($page_id, '_wp_page_template', 'test-view-template.php');
                    wp_redirect($page_url_home);
                    //exit;
                } else {
                    echo 'Error inserting the page for the view ' . $view_id;
                }
            }
        }
        

        $template_path = plugin_dir_path(__FILE__) . '../templates/import-view-template.php';
        $render_template = function() use ($views, $template_path) {
            include $template_path;
        };
        $render_template();
    
        return ob_get_clean();
    }

    
   


    //master code
    // public function get_import_views_shorcode() {
    //     require_once plugin_dir_path(__FILE__) . 'make_moodle_request.php';
    
    //     // Define la taxonomía o categoría personalizada
    //     $taxonomy = 'page_custom_category';
    //     $page_url_home = get_page_url_by_title('Home Eportfolio');
    //     // Asegúrate de que la taxonomía exista (crea si no existe)
    //     if (!taxonomy_exists($taxonomy)) {
    //         register_taxonomy(
    //             $taxonomy,
    //             'page',
    //             array(
    //                 'label' => __('Page Categories'),
    //                 'rewrite' => array('slug' => 'page-custom-category'),
    //                 'hierarchical' => true,
    //             )
    //         );
    //     }
    
    //     $views = get_moodle_views();
    //     if (!$views) {
    //         return 'Views could not be obtained.';
    //     }
    
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_views'])) {
    //         $selectedViews = $_POST['selected_views'];
    
    //         foreach ($selectedViews as $view_id) {
    //             $template_path = plugin_dir_path(__FILE__) . '../templates/test_post.php';
    //             $view_details = get_custom_view($view_id);
    //             print_r("testing new format");
    //             print_r($view_details);
    //             ob_start();
    //             include($template_path);
    //             $content = ob_get_clean();
    
    //             // Crear una página
    //             $new_page = array(
    //                 'post_title'    => $view_details['name'],
    //                 'post_content'  => $content,
    //                 'post_status'   => 'publish',
    //                 'post_author'   => get_current_user_id(),
    //                 'post_type'     => 'page'
    //             );
    
    //             $page_id = wp_insert_post($new_page);
    
    //             if ($page_id) {
    //                 // Asigna la categoría (taxonomía) a la página
    //                 wp_set_post_terms($page_id, ['page_custom_category'], $taxonomy, true);
    //                 // wp_redirect($page_url_home);
    //                 // exit;
    //             } else {
    //                 echo 'Error inserting the page for the view ' . $view_id;
    //             }
    //         }
            
    //     }
        
    //     $template_path = plugin_dir_path(__FILE__) . '../templates/import-view-template.php';
    //     $render_template = function() use ($views, $template_path) {
    //         include $template_path;
    //     };
    //     $render_template();
     
    //     return ob_get_clean();
    // }
    


    // public function get_import_views_shorcode(){
    //     require_once plugin_dir_path(__FILE__) . 'make_moodle_request.php';
    //     //ob_start();

    //     $category_name = 'category_view';
    //     $category_id = get_cat_ID($category_name);

    //     if (!$category_id) {
    //         // La categoría no existe, así que la creamos
    //         $new_category = wp_insert_term(
    //             $category_name, // El nombre de la categoría
    //             'category',     // El tipo de taxonomía
    //             array(
    //                 'description' => 'Description category', // Opcional
    //                 'slug'        => 'category_view'  // Opcional
    //             )
    //         );

    //         // wp_insert_term devuelve un array si tiene éxito
    //         if (is_array($new_category) && isset($new_category['term_id'])) {
    //             $category_id = $new_category['term_id'];
    //         }
    //     }

    //     $views = get_moodle_views();
    //    // print_r($views);
    //     $page_url_home = get_page_url_by_title('Home Eportfolio');

    //     // var_dump($views);
    //     if (!$views) {
    //          return 'Views could not be obtained.';
    //     }
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_views'])) {
    //         $selectedViews = $_POST['selected_views'];
    //         //$all_items = get_all_items_view();
    //         //print_r("all items <br>");
    //         //print_r($all_items);
    
    //         foreach ($selectedViews as $view_id) {
    //             $template_path = plugin_dir_path(__FILE__) . '../templates/test_post.php';
    //             $view_details = get_custom_view($view_id);
    //             print_r("vieww details   wwwwwww ");
    //             print_r($view_details);
    //             ob_start();
    //             include($template_path);
    //             $content = ob_get_clean();
        
    //             // Crear una página en lugar de un post
    //             $new_page = array(
    //                 'post_title'    => $view_details['name'],
    //                 'post_content'  => $content,
    //                 'post_status'   => 'publish',
    //                 'post_author'   => get_current_user_id(),
    //                 'post_type'     => 'page' // Cambio a 'page'
    //             );
    
    //             $page_id = wp_insert_post($new_page);
                     
    //             if (!$page_id) {
    //                 echo 'Error inserting the post for the view ' . $view_id;
    //             }
    //         }
    //     }
    //     // // Verificar si el formulario ha sido enviado
    //     // if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_views'])) {
    //     //     // Capturar los valores de los checkbox seleccionados
    //     //     $selectedViews = $_POST['selected_views'];

    //     //     //$custom_view = get_custom_view();
    //     //     $all_items = get_all_items_view();
    //     //     //echo 'items <br>';
    //     //     //print_r($all_items);
    //     //     // Procesar cada valor seleccionado
    //     //     foreach ($selectedViews as $view_id) {
    //     //         // Aquí puedes realizar operaciones con cada ID de vista seleccionada
    //     //         //echo "ID de vista seleccionada: " . htmlspecialchars($view_id) . "<br>";
    //     //         $template_path = plugin_dir_path(__FILE__) . '../templates/test_post.php';
    //     //         $view_details = get_custom_view($view_id);
    //     //         //$view_details = get_moodle_view_details($view_id);
    //     //         //echo 'custom viewd detail';
    //     //         var_dump($view_details);

    //     //         ob_start();
    //     //         include($template_path);
    //     //         $content = ob_get_clean();
    
    //     //         // Crear el post
    //     //         $new_post = array(
    //     //             'post_title'    => $view_details['name'],
    //     //             'post_content'  => $content,
    //     //             'post_status'   => 'publish',
    //     //             'post_author'   => get_current_user_id(),
    //     //             'post_type'     => 'post',
    //     //             'post_category' => array($category_id)  
    //     //         );
    //     //        // var_dump($new_post);
    //     //         // Insertar el post
    //     //         $post_id = wp_insert_post($new_post);
                 
    //     //         if (!$post_id) {
    //     //             echo 'Error inserting the post for the view with ID ' . $view_id;
    //     //         }


    //     //     }
    //     //     //echo "Create view post correct" ;
    //     //     

    //     // }

     
    //     $template_path = plugin_dir_path(__FILE__) . '../templates/import-view-template.php';
    //      //include($template_path);
    //     $render_template = function() use ($views, $template_path) {
    //          include $template_path;
    //     };
    //      $render_template();
    //     return ob_get_clean();

    // }
    

    
    public function my_portfolio_artifacts_shorcode(){
        ob_start();
        require_once plugin_dir_path(__FILE__) . 'make_moodle_request.php';
        $template_path = plugin_dir_path(__FILE__) . '../templates/portfolio-artifacts-view-template.php';
        $view_items = get_all_items_view();
       // print_r($view_items);
        
        //include($template_path);
        $render_template = function() use ($view_items, $template_path) {
            include $template_path;
        };
        $render_template();

        return ob_get_clean();
    }

    


    
    
    
    // Resto de métodos de la clase...
}

//add_action('wp_enqueue_scripts', 'my_plugin_enqueue_custom_styles');


?>