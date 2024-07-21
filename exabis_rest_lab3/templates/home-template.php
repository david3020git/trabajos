<?php
/**
 * Template Name: Home Template
 */
// Salir si se accede directamente
if (!defined('ABSPATH')) {
    exit;
}

include plugin_dir_path(__FILE__) . '../header.php';

//url detail view
$page_url_detail_view = get_page_url_by_title('Detail View');

//url Edit view
$page_url_edit_view = get_page_url_by_title('Edit View');

//url Create view
$page_url_create_view = get_page_url_by_title('Create View');

//url Create view
$page_url_home = get_page_url_by_title('Home Eportfolio');

/* Template Name: Home Template */







?>

<style>
    /* Estilos para la tabla */
    .table {
    display: table;
    width: 100%;
    border-collapse: collapse;
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
    
    .title-home{
        text-align: center;
    }



</style>

<div>
    <!-- create-view-template.php -->
    
    <div class="">
    <h2 class="title-home">List of Views</h2>
    <?php if (!empty($pages_category_view)): ?>
        <ul class="posts-list">
            <?php foreach ($pages_category_view as $page): ?>
                <li> 
                    <a href="<?php echo $page->permalink; ?>">
                        <?php echo $page->title; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No pages found.</p>
    <?php endif; ?>
    </div>

    

</div>

<?php
//include plugin_dir_path(__FILE__) . '../footer.php';
?>
