<?php
// Salir si se accede directamente
if (!defined('ABSPATH')) {
    exit;
}

include plugin_dir_path(__FILE__) . '../header.php';


//url Create view
$page_url_create_view = get_page_url_by_title('Create View');


/* Template Name: Detail Template */


?>
<style>
    .view-details-container {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .view-detail {
        margin-bottom: 20px;
        padding: 10px;
        border-bottom: 1px solid #eee;
    }
    
    .view-detail p {
        margin: 5px 0;
        font-size: 16px;
    }
    
    .items-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .item-detail {
        padding: 10px;
        background-color: #ffffff;
        border: 1px solid #eee;
        border-radius: 4px;
    }
    
    .item-detail p {
        margin: 5px 0;
        font-size: 14px;
    }
    

</style>

<!--
<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <?php
                if (!empty($page_url_create_view)) {
                    echo '<a class="navbar-brand" href="' . esc_url($page_url_create_view) . '">Create View</a>';
                }
                ?>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Layout</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Content</a>
            </li>
        </ul>
    </div>
</nav>
-->
<div id="my-section">
    <ul id="my-navbar">
        <li><a href="#" id="link-1">Link 1</a></li>
        <li><a href="#" id="link-2">Link 2</a></li>
        <li><a href="#" id="link-3">Link 3</a></li>
    </ul>
</div>


<div class="page-test" id="page-1">
    Content of Page 1
</div>

<div class="page-test" id="page-2">
    Content of Page 2
</div>

<div class="page-test" id="page-3">
    Content of Page 3
</div>

<div class="view-details-container">
    <h2>View Details</h2>
   
    

    <div class="view-detail">
        <p><strong>Name:</strong> <?php echo esc_html($view_details['name']); ?></p>
        <p><strong>Description:</strong> <?php echo strip_tags($view_details['description']); ?></p>
    </div>

    <h4>My Portfolio Artifacts Items in the View</h4>
    <div class="items-list">
        <?php foreach ($view_details['items'] as $item): ?>
            <div class="item-detail">
                <p><strong>Item Name:</strong> <?php echo esc_html($item['name']); ?></p>
                <p><strong>Item Type:</strong> <?php echo esc_html($item['type']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>




<script>
    jQuery(document).ready(function($) {
        // Hide all pages initially
        $('.page-test').hide();
    
        // Show the default page (e.g., page 1) on page load
        $('#page-1').show();
    
        // Handle clicks on navbar links
        $('#link-1').click(function() {
            $('.page-test').hide();
            $('#page-1').show();
        });
    
        $('#link-2').click(function() {
            $('.page-test').hide();
            $('#page-2').show();
        });
    
        $('#link-3').click(function() {
            $('.page-test').hide();
            $('#page-3').show();
        });
    });
    
    
</script>


<?php
//include plugin_dir_path(__FILE__) . '../footer.php';
?>

