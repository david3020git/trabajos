<?php
// Salir si se accede directamente
if (!defined('ABSPATH')) {
    exit;
}
include plugin_dir_path(__FILE__) . '../header.php';
//include plugin_dir_path(__FILE__) . '../includes/functions.php';







/* Template Name: Create Template */


?>
<style>
    .form-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .create-view-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
    }
    
    .form-group label {
        margin-bottom: 5px;
        font-weight: bold;
    }
    
    .form-group input[type="text"],
    .form-group textarea {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }
    
    .form-group textarea {
        height: 100px;
        resize: vertical;
    }
    
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
    

</style>
<div class="form-container">
    
    <form method="post" class="create-view-form">
        <div class="form-group">
            <label for="view_name">View Name:</label>
            <input type="text" id="view_name" name="view_name" placeholder="View Name" required>
        </div>
        <div class="form-group">
            <label for="view_description">View Description:</label>
            <textarea id="view_description" name="view_description" placeholder="View Description" required></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Create View" class="submit-button">
        </div>
    </form>
</div>




    <!--
        <form method="post">
            <input type="text" name="view_name" placeholder="Nombre de la vista" required>
            <textarea name="view_description" placeholder="Descripción de la vista" required></textarea>
            <input type="submit" value="Crear Vista">
        </form>
    -->
   





<?php
//include plugin_dir_path(__FILE__) . '../footer.php';
?>

