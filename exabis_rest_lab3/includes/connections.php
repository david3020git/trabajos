<?php 


add_action('init', 'process_login_form');


function process_login_form() {
    $page_url_import = get_page_url_by_title('Import Views');
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['moodle_username']) && isset($_POST['moodle_password']) && isset($_POST['moodle_url']) && isset($_POST['moodle_service'])) {
        
        $username = sanitize_text_field($_POST['moodle_username']);
        $password = sanitize_text_field($_POST['moodle_password']);
        $url = sanitize_text_field($_POST['moodle_url']);
        $service = sanitize_text_field($_POST['moodle_service']);
        $token = null;
        //print_r("url in form");
        //print_r($url);
        //$name = 'davidtoken';

        if ($service == 'exaportservices') {
            // Lógica para el servicio exaporservices$name
            $token = obtain_moodle_token($url, $username, $password, $service );
            if ($token) {
                update_option('moodle_exaportservices_token', $token);
            }
        } elseif ($service == 'exaportcustom') {
            // Lógica para el nuevo servicio exaport_rest
            $token = obtain_moodle_token($url, $username, $password, $service );
           // print_r($token);
            if ($token) {
                update_option('moodle_exaport_custom_token', $token);
            }
        } else {
            // Manejo de error si el servicio no es reconocido
            echo "<p>Error: Unknown service.</p>";
            return;
        }

        if ($token) {
            update_option('moodle_url', $url);
            update_option('moodle_username', $username);
            // Redireccionamiento y otras lógicas aquí...
            //wp_redirect($page_url_import);
            exit;
        } else {
            echo "<p>Error: Moodle token could not be obtained. Please try again!</p>";
        }
    }
}


//test curl configuration 
function obtain_moodle_token($url, $username, $password, $service) {
    // Asegúrate de que la URL termine en 'login/token.php'
    $url = rtrim($url, '/') . '/login/token.php';
    $url = str_replace('https://', 'http://', $url); // Cambiar a HTTP para pruebas

    $datos = array(
        'username' => $username,
        'password' => $password,
        'service'  => $service
    );

    // Convertir datos a formato de query string
    $postData = http_build_query($datos);

    // Inicializar cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Configuraciones adicionales de cURL
    curl_setopt($ch, CURLOPT_TIMEOUT, 20); // Aumentar el tiempo de espera a 20 segundos
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // Aumentar el tiempo de espera de conexión a 10 segundos

    // Depuración
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    $verbose = fopen('php://temp', 'w+');
    curl_setopt($ch, CURLOPT_STDERR, $verbose);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        echo 'Error: ' . $error_msg;

        // Mostrar detalles de la depuración
        rewind($verbose);
        $verboseLog = stream_get_contents($verbose);
        echo "Verbose information:\n<pre>", htmlspecialchars($verboseLog), "</pre>\n";

        curl_close($ch);
        return null;
    }

    curl_close($ch);

    $body = $response;
    echo "<p>Complete answer: </p>" . $body; // Para depuración
    $data = json_decode($body);

    if (isset($data->token)) {
        return $data->token;
    } else {
        // Manejar la situación si no hay token
        return 'Error. Token no exists';
    }
}


//master working without configuration curl 
// function obtain_moodle_token($url, $username, $password,  $service) {
//     // Asegúrate de que la URL termine en 'login/token.php'
//     $url = rtrim($url, '/') . '/login/token.php';
//    // echo 'testing final url';
//     //print_r($url);
//     //print_r($username). "<br>";

//     $datos = array(
//         'username' => $username,
//         'password' => $password,
//      //   'name'     => $name,
//         'timeout'     => 15,
//         'service'  => $service
        
//     );
    
//     $response = wp_remote_post($url, array('body' => $datos));
    
//     if (is_wp_error($response)) {
//         echo 'error in token imposible to save';
//         var_dump($response);
//         return null;
//     }

//     $body = wp_remote_retrieve_body($response);
//     echo "<p>Complete answer: </p>" . $body; // Para depuración
//     $data = json_decode($body);

//     if (isset($data->token)) {
//         return $data->token;
//     } else {
//         // Manejar la situación si no hay token
//         return 'Error. Token no exists';
//     }
// }

//davidtoken = 1f28f5a4843af4504b0830de34791293

//     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['moodle_username']) && isset($_POST['moodle_password']) && isset($_POST['moodle_url']) && isset($_POST['moodle_service'])) {
//         // Obtén el token existente si está disponible
//         $existing_token = get_option('moodle_token');
//         $existing_url = get_option('moodle_url'); 
//         // Si no hay token existente o deseas actualizarlo siempre
//         if (!$existing_token) {
//             $username = sanitize_text_field($_POST['moodle_username']);
//             $password = sanitize_text_field($_POST['moodle_password']);
//             $url = sanitize_text_field($_POST['moodle_url']);
//             $service = sanitize_text_field($_POST['moodle_service']);
//             // echo($username);
//             // echo($password);
//             // echo($url);
//             // echo($service);
//             // die();
           

//             $token = obtain_moodle_token($url, $username, $password, $service);
//             update_option('moodle_url', $existing_url);
//             echo $existing_url;
//             if ($token) {
//                 update_option('moodle_token', $token);
                
//                // echo "<p>Token obtenido: " . esc_html($token) . "</p>";
//                 echo "<script type='text/javascript'>
//                 document.addEventListener('DOMContentLoaded', function(e) {
//                     e.preventDefault()
//                     if ('$token') {
//                         document.querySelector('.exabis-login-wrapper').style.display = 'none';
//                         document.getElementById('login-success-message').style.display = 'block';
//                     } else {
//                         alert('Error: Could not obtain Moodle token.');
//                     }
//                 });
//               </script>";
//             } else {
//                 echo '<p style="text-align: center;">Error: Could not obtain Moodle token.</p>';
//                 error_log('Error: Could not obtain Moodle token');
//             }
//         } else {
//             // Si ya existe un token, oculta el formulario y muestra un mensaje (opcional)
//             echo "<p>Token already in the database: </p>";
//             echo "<p>Token already in the database: " . esc_html($existing_token) . "</p>";
//             echo "<p>Url already in the database: " . esc_html($existing_url) . "</p>";
            
            
//             echo "<script type='text/javascript'>
//                     document.addEventListener('DOMContentLoaded', function() {
//                         document.querySelector('.exabis-login-wrapper').style.display = 'none';
//                         document.getElementById('login-success-message').innerText = 'A token already exists.';
//                         document.getElementById('login-success-message').style.display = 'block';
//                     });
//                   </script>";
//         }
        
     
//     }
// }
// function process_login_form() {
//     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['moodle_username']) && isset($_POST['moodle_password']) && isset($_POST['moodle_url']) && isset($_POST['moodle_service'])) {
//         //echo "<p>Formulario enviado</p>";
//         $page_url_home = get_page_url_by_title('Home Eportfolio');
//         $existing_token = get_option('moodle_token');
//         $existing_url = get_option('moodle_url'); 

//         //echo "<p>Token existente: $existing_token</p>";
//         //echo "<p>URL existente: $existing_url</p>";

//         $username = sanitize_text_field($_POST['moodle_username']);
//         $password = sanitize_text_field($_POST['moodle_password']);
//         $url = sanitize_text_field($_POST['moodle_url']);
//         $service = sanitize_text_field($_POST['moodle_service']);

//         // echo "<p>Username: $username</p>";
//         // echo "<p>Password: $password</p>";
//         // echo "<p>URL: $url</p>";
//         // echo "<p>Service: $service</p>";

//         $token = obtain_moodle_token($url, $username, $password, $service);
//         //echo 'Response Moodle';
//        // var_dump($token);
//         if ($token) {
//             echo "<p>Token obtenido: $token</p>";
//             update_option('moodle_token', $token);
//             update_option('moodle_url', $url);
//             update_option('moodle_username', $username);

//             //echo "<p>Token y URL guardados en la base de datos.</p>";
//             wp_redirect($page_url_home);
//             exit;
//             // Redireccionamiento y manejo del DOM con JavaScript aquí...
//         } else {
//             echo "<p>Error: Moodle token could not be obtained. Please try again! .</p>";
//         }
//     }
// }


?>