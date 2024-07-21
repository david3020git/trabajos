<?php 


// Salir si se accede directamente
if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . '../includes/functions.php';

$page_url_create_view = get_page_url_by_title('Create View');
$page_url_home_eportfolio = get_page_url_by_title('Home Eportfolio');
$page_url_detail_view = get_page_url_by_title('Detail View');
$page_url_login_moodle = get_page_url_by_title('Login Moodle');
$page_url_test_request = get_page_url_by_title('Test Request');
$page_url_my_portfolio_artifacts = get_page_url_by_title('My Portfolio Artifacts');
$page_url_import_view = get_page_url_by_title('Import Views');


?>
<div>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <!--<a class="navbar-brand active" href="#">Create View</a>-->
      <?php 

      if (!empty($page_url_home_eportfolio)) {
        echo '<a class="navbar-brand" href="' . esc_url($page_url_home_eportfolio) . '">Home </a>';
      }
      if (!empty($page_url_import_view)) {
          echo '<a class="navbar-brand" href="' . esc_url($page_url_import_view) . '">Import Views</a>';
      }

      if (!empty($page_url_login_moodle)) {
        echo '<a class="navbar-brand" href="' . esc_url($page_url_login_moodle) . '">Login Moodle</a>';
      }
      if (!empty($page_url_test_request)) {
        echo '<a class="navbar-brand" href="' . esc_url($page_url_test_request) . '">Test Request</a>';
      }
      if (!empty($page_url_my_portfolio_artifacts)) {
        echo '<a class="navbar-brand" href="' . esc_url($page_url_my_portfolio_artifacts) . '">My Portfolio Artifacts</a>';
      }
      
        
            ?>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!--
          <li class="nav-item">
            <a class="nav-link" href="#">List Views</a>
          </li>
        
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
          </li>
        -->
        </ul>
      <!--  <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->
      </div>
    </div>
  </nav>
</div>