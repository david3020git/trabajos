<?php
// Asegúrate de que este archivo no se pueda cargar directamente
if (!defined('ABSPATH')) {
    exit; // Salir si se accede directamente
}

include plugin_dir_path(__FILE__) . '../header.php';


// Aquí comienza el contenido de la plantilla de 'Login'

?>

<div class="exabis-login-wrapper">

    <div id="login-success-message" style="display:none;">
        <p class="text-center">Token saved correctly.</p>
    </div>
    <!--<h2 class="text-center mb-4"><?php esc_html_e('Login to Moodle', 'exabis-rest'); ?></h2>-->
    
    <form method="post" action="" class="login-form">
 
        <div class="mb-3">
            <label for="moodle-url" class="form-label"><?php esc_html_e('Url:', 'exabis-rest'); ?></label>
            <input type="text" id="moodle-url" name="moodle_url" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="moodle-service" class="form-label"><?php esc_html_e('Service rest:', 'exabis-rest'); ?></label>
            <input type="text" id="moodle-service" name="moodle_service" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="moodle-username" class="form-label"><?php esc_html_e('Username:', 'exabis-rest'); ?></label>
            <input type="text" id="moodle-username" name="moodle_username" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="moodle-password" class="form-label"><?php esc_html_e('Password:', 'exabis-rest'); ?></label>
            <input type="password" id="moodle-password" name="moodle_password" class="form-control" />
        </div>
        <div class="text-center">
            <input type="submit" value="<?php esc_attr_e('Login', 'exabis-rest'); ?>" class="btn btn-primary" />
        </div>
    </form>

    

</div>





<?php
//include plugin_dir_path(__FILE__) . '../footer.php';
?>
