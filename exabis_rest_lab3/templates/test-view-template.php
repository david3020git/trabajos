<?php
// Salir si se accede directamente
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Template Name: Test Template
 */

// function my_template_custom_style() {
//     wp_enqueue_style('my-custom-style', plugins_url('/public/css/styles.css', __FILE__));
// }
// add_action('wp_enqueue_scripts', 'my_template_custom_style');
//get_header();
include plugin_dir_path(__FILE__) . '../header.php';


?>
<style>
       /* TESTING MESAGES*/

.grid-container {
    display: grid;    
    background-color: white;
}
.grid-box{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    justify-items: center; /* Centra las columnas en el contenedor si hay espacio adicional */
    background-color: #f7f7f7;
    padding: 20px;
    margin: 20px;
    gap: 30px 0px;
   
    /*   box-sizing: border-box; */
}

.grid-item {
    height: 280px; /* Altura fija para las cajas para mantener todas del mismo tamaño */
    
    width:450px;
    overflow: auto;
    
    box-sizing: border-box;
    /* padding: 10px; */
    background-color: white;
    justify-content: center; /* Centra el contenido horizontalmente dentro de la caja */
    align-items: center; /* Centra el contenido verticalmente dentro de la caja */
    text-align: center;
    box-shadow:  0px 1px 3px #f7f7f7;
    padding: 5px;
    /* margin-top: 5px; */
    margin: auto 0px;
    transition: transform 0.3s ease, background-color 0.3s ease; /* Suaviza la transición del hover */
}
.grid-item:hover {
    background-color: #e7e7e7; /* Cambia el color de fondo al hacer hover */
    transform: scale(1.05); /* Hace el elemento ligeramente más grande */
    cursor: pointer; /* Cambia el cursor para indicar que es clickeable */
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Ajusta la sombra al hacer hover */
}

.item-preview {
    display: none;
    /* Estilos adicionales para el previo */
}
/* Estilo para el previo al hacer hover */
.grid-item:hover .item-preview {
    display: block; /* Asegúrate de que .item-preview sea un elemento que contenga tu previo */
}

.grid-item:hover {
    transform: scale(1.05);
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}


p {
    margin-top: 5px; /* Reduce el margen superior */
    margin-bottom: 5px; /* Reduce el margen inferior */
    padding: 0; /* Si quieres también reducir el relleno */
}
.container-header{
    display: grid;
    margin:  0 auto;
    text-align: center;
}

 
    

</style>

<div id="main-content">
    <?php
    if (have_posts()) : 
        while (have_posts()) : the_post(); 
            the_content(); 
        endwhile; 
    endif;
    ?>
</div>


<?php
//include plugin_dir_path(__FILE__) . '../footer.php';
?>








