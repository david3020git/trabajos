<?php 

//global $moodle_service_url; 
//$moodle_service_url= 'http://localhost/moodleTest/moodle/webservice/rest/server.php';
//$moodle_url = get_option('moodle_url') . '/webservice/rest/server.php';
$moodle_service_url = get_option('moodle_url') . '/webservice/rest/server.php';



    function make_moodle_request($service_url, $token, $function_name, $additional_params = array()) {
        // echo 'testing parameters fuctionn';
        // echo $service_url;
        // echo $token;

        $params = array(
            'wstoken' => $token,
            'wsfunction' => $function_name,
            'moodlewsrestformat' => 'json',
        );

        $params = array_merge($params, $additional_params);
         //echo 'testing params\n ';
         //var_dump($params);
        $response = wp_remote_post($service_url, array(
            'body' => $params
        ));
        //echo 'testing $response\n ';
         //var_dump($response);
        if (is_wp_error($response)) {
            // Manejar error
            //echo 'testing moodle_request function error ';
            //echo $response->get_error_message();
            
            return null;
        }
        //var_dump($response);
        $body = wp_remote_retrieve_body($response);
        //echo 'testing body response \n';
       // var_dump($body);
        return json_decode($body, true);
    }

    function get_moodle_views() {
        $token = get_option('moodle_exaportservices_token');
        
        $moodle_url = get_option('moodle_url') . '/webservice/rest/server.php';

        $params = array(
            'wstoken' => $token,
            'wsfunction' => 'block_exaport_get_views',// block_exaport_get_views
            'moodlewsrestformat' => 'json',
        );

        $response = wp_remote_post($moodle_url, array(
            'body' => $params,
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded']
        ));

        if (is_wp_error($response)) {
            // Manejar error
            return null;
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        return $data; // Esto debería devolver la lista de vistas
    }

    function get_moodle_view_details($view_id) {
        //global $moodle_service_url;
        
        $moodle_url = get_option('moodle_url') . '/webservice/rest/server.php';
        $token = get_option('moodle_token'); // Asegúrate de que el token se almacena y recupera correctamente
        //$id= $view_id;
       // echo $id;
        //$user_id_moodle = 3;
       // $token = MOODLE_API_TOKEN;
    
       //echo 'viewd iddd';
       //var_dump($view_id);
        $function_name = 'block_exaport_get_view';
        $additional_params = array('id' => $view_id);
        // echo $moodle_url;
        // echo '<br>';
        // echo $token;
        // echo '<br>';
        // print_r($additional_params);
        //echo $additional_params;
        //echo $user_id_moodle;
        $response = make_moodle_request($moodle_url, $token, $function_name, $additional_params);
        echo 'detail response moodle <br>';
        var_dump($response);
        return $response;
    }

    // function add_moodle_view($name, $description) {
    //     $moodle_service_url = get_option('moodle_url') . '/webservice/rest/server.php';
    //     $token = get_option('moodle_token');
    
    //     $function_name = 'block_exaport_add_view';
    //     $params = array(
    //         'name' => $name,
    //         'description' => $description,
    //     );
    
    //     $response = make_moodle_request($moodle_service_url, $token, $function_name, $params);
    
    //     // Aquí manejas la respuesta, por ejemplo, comprobar si la vista fue agregada correctamente
    //     if (isset($response['success']) && $response['success']) {
    //         return "La vista ha sido creada exitosamente en Moodle.";
    //     } else {
    //         return "Error al crear la vista en Moodle.";
    //     }
    // }
    
    // function edit_moodle_view($view_id, $name, $description){
    //     $moodle_service_url = get_option('moodle_url') . '/webservice/rest/server.php';
    //     $token = get_option('moodle_token');
    //     echo $view_id;
    //     echo $name;
    //     echo $description;
    //     $function_name = 'block_exaport_update_view';
    //     $params = array(
    //         'id'    => $view_id,
    //         'name' => $name,
    //         'description' => $description,
    //     );
    
    //     $response = make_moodle_request($moodle_service_url, $token, $function_name, $params);
        
    //     // Aquí manejas la respuesta, por ejemplo, comprobar si la vista fue agregada correctamente
    //     if (isset($response['success']) && $response['success']) {
    //         return "The view has been successfully updated.";
    //     } else {
    //         return "Error updating the view.";
    //     }


    // }

    // function delete_moodle_view($view_id){

    //     $moodle_service_url = get_option('moodle_url') . '/webservice/rest/server.php';
    //     $token = get_option('moodle_token');

    //     $function_name = 'block_exaport_delete_view';
    //     $params = array(
    //         'id'    => $view_id,
          
    //     );
    //     $response = make_moodle_request($moodle_service_url, $token, $function_name, $params);
    //     //var_dump($response);
    //     // Aquí manejas la respuesta, por ejemplo, comprobar si la vista fue agregada correctamente
    //     if (isset($response['success']) && $response['success']) {
    //         return "The view has been successfully updated.";
    //     } else {
    //         return "Error updating the view.";
    //     }
        
    // }

    function get_all_items_view(){

        $moodle_service_url = get_option('moodle_url') . '/webservice/rest/server.php';
        $token = get_option('moodle_exaportservices_token');

        $function_name = 'block_exaport_get_all_items';
        $params = array();
        $response = make_moodle_request($moodle_service_url, $token, $function_name, $params);
       // var_dump($response);
        // Aquí manejas la respuesta, por ejemplo, comprobar si la vista fue agregada correctamente
        if (!empty($response)) {
            return $response ;
        } else {
            return "Error: No items found.";
        }
        
        
    }

    function list_pages_by_category($category_name) {
        $args = array(
            'category_name'  => $category_name,
            'post_status'    => 'publish',
            'posts_per_page' => -1,  // Obtener todas las páginas
            'post_type'      => 'page',  // Buscar páginas en lugar de publicaciones
        );
    
        $query = new WP_Query($args);
        print_r("query pages <br>");
        //print_r($query);
        $pages = array();
        if ($query->have_posts()) {
            print_r("query pages iffffff<br>");
            while ($query->have_posts()) {
                $query->the_post();
                $pages[] = array(
                    'ID' => get_the_ID(),
                    'post_title' => get_the_title(),
                    'permalink' => get_permalink(),
                );
            }
        }
    
        wp_reset_postdata();
        return $pages;
    }
    
    // function list_posts_by_category($category_name) {
    //     $args = array(
    //         'category_name' => $category_name,
    //         'post_status' => 'publish',
    //         'posts_per_page' => -1,  // Obtener todos los posts
    //     );
    
    //     $query = new WP_Query($args);
    
    //     $posts = array();
    //     if ($query->have_posts()) {
    //        // print_r($query);
    //         while ($query->have_posts()) {
    //             $query->the_post();
    //             $posts[] = array(
    //                 'ID' => get_the_ID(),
    //                 'post_title' => get_the_title(),
    //                 'permalink' => get_permalink(),
    //             );
    //         }
    //     }
    //     // else{
    //     //     echo 'in else';
    //     // }
    //     //var_dump($posts);
    
    //     wp_reset_postdata();
    //     return $posts;
    // }
    
    function get_custom_view($id){

        $moodle_service_url = get_option('moodle_url') . '/webservice/rest/server.php';
        $token = get_option('moodle_exaportservices_token');

        //$function_name = 'block_exaport_get_item';
        $function_name = 'block_exaport_get_custom_view_test';
        //print_r($category_id);
        $params = array(
            //'itemid'    => $viewid,
           // 'owneruserid'  => $owneruserid,
            'id'  => $id,
            
        );
        $response = make_moodle_request($moodle_service_url, $token, $function_name, $params);
        //print_r($response);
        // Aquí manejas la respuesta, por ejemplo, comprobar si la vista fue agregada correctamente
        if (!empty($response)) {
            return $response ;
        } else {
            return "Error: No items found.";
        }
    }

    // function list_posts_by_category($category_name) {
    //     // Argumentos para WP_Query
    //     $args = array(
    //         'category_name' => $category_name,
    //         'post_status' => 'publish',
    //         'posts_per_page' => -1,  // Obtener todos los posts
    //     );
    
    //     // Crear una nueva consulta
    //     $query = new WP_Query($args);
    
    //     // Comenzar a listar los posts
    //     // if ($query->have_posts()) {
    //     //     echo '<ul>';
    
    //     //     while ($query->have_posts()) {
    //     //         $query->the_post();
    
    //     //         // Mostrar el título y el enlace de cada post
    //     //         echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
    //     //     }
    
    //     //     echo '</ul>';
    //     // } else {
    //     //         // Si no hay posts en la categoría, mostrar un mensaje
    //     //     echo '<p>No hay posts en esta categoría.</p>';
    //     // }

    //     // Restablecer la consulta global de WordPress
    //     wp_reset_postdata();
    //     return $query;

    // }
    function get_test($id){

        $moodle_service_url = get_option('moodle_url') . '/webservice/rest/server.php';
        $token = get_option('moodle_token');

        //$function_name = 'block_exaport_get_item';
        $function_name = 'block_exaport_get_custom_view_test';
        //print_r($category_id);
        $params = array(
            //'itemid'    => $viewid,
           // 'owneruserid'  => $owneruserid,
            'id'  => $id,
            
        );
        $response = make_moodle_request($moodle_service_url, $token, $function_name, $params);
        print_r($response);
        // Aquí manejas la respuesta, por ejemplo, comprobar si la vista fue agregada correctamente
        if (!empty($response)) {
            return $response ;
        } else {
            return "Error: No items found.";
        }
        
        
    }

    function get_moodle_userid($username, $token) {
        // Construct the URL for the Moodle REST service
        $moodle_service_url = get_option('moodle_url') . '/webservice/rest/server.php';
        // echo $moodle_service_url;
        // echo $username;
        // echo $token;
        $function_name = 'core_user_get_users_by_field';
        $params = array(
            'field' => 'username',
            'values' => array($username),
        );
    
        // Log attempt to get Moodle UserID for the user
        error_log("Attempting to get Moodle UserID for user: $username");
    
        // Make the request to Moodle
        $response = wp_remote_post($moodle_service_url, array(
            'body' => array(
                'wstoken' => $token,
                'wsfunction' => $function_name,
                'moodlewsrestformat' => 'json',
                'field' => 'username',
                'values[0]' => $username,
            )
        ));
    
        // Check for errors in the response
        if (is_wp_error($response)) {
            error_log("Error making request to Moodle: " . $response->get_error_message());
            return null;
        }
        
        // Retrieve the body from the response
        $body = wp_remote_retrieve_body($response);
        //var_dump($body);
        $data = json_decode($body, true);
        
        
        // Check if the response data is valid
        if (!$data) {
            error_log("Empty or invalid response from Moodle: $body");
            return null;
        }
    
        // Log the response from Moodle
        error_log("Response received from Moodle: " . print_r($data, true));
    
        // Check if the UserID is present in the response
        if (isset($data[0]['id'])) {
            error_log("UserID found: " . $data[0]['id']);
            return $data[0]['id'];
        } else {
            error_log("UserID not found in response.");
            return null;
        }
    }

    /**
     * Get page by taxonomy 
    */

    function get_pages_by_taxonomy($taxonomy_slug) {
        // Set up the query arguments
        $args = array(
            'post_type' => 'page', // Fetch pages
            'posts_per_page' => -1, // Retrieve all matching pages
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy_slug,
                    'field'    => 'slug',
                    'operator' => 'EXISTS', // This fetches pages associated with any term in the specified taxonomy
                ),
            ),
        );
    
        // Perform the query
        $query = new WP_Query($args);
    
        // Initialize an array to hold page details
        $page_details = array();
    
        // Check if any posts were returned
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                // Add each page's details to the array
                $page_details[] = (object) array(
                    'ID' => get_the_ID(),
                    'title' => get_the_title(),
                    'permalink' => get_permalink(),
                );
            }
        }
    
        // Reset post data
        wp_reset_postdata();
    
        // Return the array of page details
        return $page_details;
    }
    
    
    

 




?>