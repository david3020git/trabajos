<?php 
// Salir si se accede directamente
if (!defined('ABSPATH')) {
    exit;
}
include plugin_dir_path(__FILE__) . '../header.php';
//url Create view
$page_url_home = get_page_url_by_title('Home Eportfolio');

?>

<style>
    .title-import{
        text-align: center;
    }
    /* Estilos para la tabla */
    .table {
    display: table;
    width: 70%;
    border-collapse: collapse;
    margin: 0 auto;
    align-items: center;
    padding: 20px;
    }

    /* Estilos para el encabezado de la tabla */
    .table-header {
    display: table-header-group;
    background-color: #f5f5f5; /* Color de fondo del encabezado */
    }

    /* Estilos para el cuerpo de la tabla */
    .table-body {
    display: table-row-group;
    }

    /* Estilos para las filas de la tabla */
    .tr {
    display: table-row;
    }

    /* Estilos para las celdas de encabezado */
    .th {
    display: table-cell;
    padding: 8px;
    border: 1px solid #ddd; /* Bordes de las celdas */
    text-align: left;
    font-weight: bold; /* Texto en negrita para el encabezado */
    }

    /* Estilos para las celdas de datos */
    .td {
    display: table-cell;
    padding: 8px;
    border: 1px solid #ddd; /* Bordes de las celdas */
    }

    /* Estilos para la sección de acciones */
    .table .tr .td a {
    color: #007bff; /* Color del enlace */
    text-decoration: none; /* Sin subrayado */
    }

    .table .tr .td a:hover {
    text-decoration: underline; /* Subrayado al pasar el ratón por encima */
    }

    /* Estilo para el botón de agregar vista */
    .btn-primary {
    background-color: #007bff; /* Color de fondo del botón */
    color: white; /* Color del texto del botón */
    border: none; /* Sin bordes */
    padding: 10px 15px; /* Espaciado interno del botón */
    text-align: center; /* Alineación del texto */
    text-decoration: none; /* Sin subrayado */
    display: inline-block; /* Mostrar en línea */
    font-size: 16px; /* Tamaño del texto */
    margin: 4px 2px; /* Margen alrededor del botón */
    cursor: pointer; /* Cursor como puntero */
    border-radius: 4px; /* Bordes redondeados */
    
    }

    /* Style form */
    .submit-button {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    
    .submit-button:hover {
        background-color: #0056b3;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        width: 70%;
        margin: 0 auto;
        padding: 20px;
    }



</style>

<div>
    <!-- create-view-template.php -->

    <div class="views-list">
        <h2 class="title-import">List of Views</h2>
        <form method="post" class="create-view-form">
        <!-- Contenedor para la tabla responsiva -->
        <div class="table-responsive">
            <div class="table">

                <!-- Cabecera de la tabla -->
                <div class="table-header">
                    <div class="tr">
                        <div class="th">Select</div> <!-- Columna para los checkbox -->
                        <div class="th">Name</div>
                        
                    </div>
                </div>

                <!-- Cuerpo de la tabla -->
                <div class="table-body">
                    <?php foreach ($views as $view): ?>
                        <div class="tr">
                            <div class="td">
                                <input type="checkbox" name="selected_views[]" value="<?php echo $view['id']; ?>">
                            </div>
                            <div class="td"><?php echo $view['name']; ?></div>
                            <!-- Otras columnas aquí -->
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
        <div class="form-group">
            <input type="submit" value="Import View" class="submit-button">
        </div>
        </form>
    </div>
</div>

<!--
<div>
   
    
    <div class="views-list">
        <h2>List of Views</h2>
    
       
        <div class="table-responsive">
            <div class="table">
    
                
                <div class="table-header">
                    <div class="tr">
                        
                        <div class="th">Name</div>
                        <div class="th">Actions</div>
                    </div>
                </div>
    
               
                <div class="table-body">
                    <?php
                    //  foreach ($views as $view): ?>
                        <div class="tr">
                            <div class="td"><?php //echo esc_html($view['id']); ?></div>
                            <div class="td"><?php //echo esc_html($view['name']); ?></div>
                           
                            
                        </div>
                    <?php //endforeach; ?>
                </div>
            </div>
        </div>
    
        
    </div>
    

</div>
-->