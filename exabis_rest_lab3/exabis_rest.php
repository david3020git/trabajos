<?php
/*
* Plugin Name: Exabis Rest
* Plugin URI: exabisrest
* Description: API Rest for to connect moodle and WordPress
* Version: 1
* Author: David Lee
* Author URI: 
* License: 
* License URI:
* Text Domain: my-exabis-rest-domain 
*/

if (!defined('ABSPATH')) {
    exit; // Salir si se accede directamente
}


define('MY_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MY_PLUGIN_URL', plugin_dir_url(__FILE__));
define('MOODLE_API_URL', 'https://tu.moodle.com/webservice/rest/server.php');
define('MOODLE_API_TOKEN', 'moodle_token');

// Incluir configuración de base de datos externa, si es necesario
//include_once MY_PLUGIN_DIR . 'db/external_db_config.php';


require_once plugin_dir_path(__FILE__) . 'includes/ExabisRestPageCreator.php';
//include MY_PLUGIN_DIR . 'admin/cpt_exabis/cpt.exabis.php';
include MY_PLUGIN_DIR . 'includes/functions.php';
// instal init plugin
function exabis_rest_activate_plugin() {
    ExabisRestPageCreator::activate();
}

// Registrar la función de activación del plugin
register_activation_hook(__FILE__, 'exabis_rest_activate_plugin');
ExabisRestPageCreator::getInstance();

// locate_template('footer.php', true);
//register_activation_hook(__FILE__, array('ExabisRestPageCreator', 'activate'));


//include MY_PLUGIN_DIR . 'db/external_db_config.php';



// include plugin_dir_path( __FILE__ ) . 'admin/cpt_exabis/cpt.exabis.php';
// include plugin_dir_path( __FILE__ ) . 'include/functions.php';
// include plugin_dir_path( __FILE__ ) . 'db/external_db_config.php';