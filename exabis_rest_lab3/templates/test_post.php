
<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!$view_details) {
    echo 'Error no have view id' . $view_id;
    return '';
}
//echo $view_details;
//include plugin_dir_path(__FILE__) . '../header.php';


// Salir si se accede directamente


 // view_template.php


// Reemplaza $view_details con la variable que contiene los datos de la vista.




// // //code estructured testing sections 
// // // Header con información personal basado en el tipo 'personal_information'
// $header = "<section id='header' class='grid-item'>";
// foreach ($view_details['items'] as $detail_item) {
//     if ($detail_item['type'] == 'personal_information') {
//         $header .= "<div class='header'>";
//         $header .= "<div class='personal-info'> class='grid-item'";
//         $header .= "<h1>" . $detail_item['firstname'] . " " . $detail_item['lastname'] . "</h1>";
//         $header .= "<div class='view-description'>" . $view_details['description'] . "</div>";
//         $header .= "<p>" . $detail_item['text'] . "</p>";
//         $header .= "<p>e-mail: " . $detail_item['email'] . "</p>";
//         $header .= "<p>phone: " . $detail_item['phone'] . "</p>";
//         $header .= "</div>"; // Cierre de personal-info
        
//         $header .= "</div>"; // Cierre de header
//         break; // Asumimos que solo hay un bloque de 'personal_information'
//     }
// }
// $header .= "</section>";

// // Sección de Portafolio
// $portfolio = "<section id='portfolio' class='grid-item'>";
// foreach ($view_details['items'] as $detail_item) {
//     if ($detail_item['type'] == 'item') {
//         $portfolio .= "<div class='portfolio-item grid-item'>";
//         $portfolio .= "<img src='{$detail_item['url']}' alt='{$detail_item['name']}' />";
//         $portfolio .= "<h3>{$detail_item['name']}</h3>";
//         $portfolio .= "<p>{$detail_item['intro']}</p>";
//         $portfolio .= "</div>"; // Cierre de portfolio-item
//     }
// }
// $portfolio .= "</section>";

// // Detalles del CV con una estructura de sección y grilla
// // $cv_section = "<section id='cv-information' class='cv-section'>";
// // foreach ($view_details['items'] as $detail_item) {
// //     if ($detail_item['type'] == 'cv_information' && isset($detail_item['details'])) {
// //         $cvDetails = $detail_item['details'];
// //         $cv_section .= "<div class='cv-item'>";
// //         // Aquí comienzas con la estructura de la información del CV
// //         $cv_section .= "<div class='cv-content'>";
// //         // Por ejemplo, asumamos que 'edu' representa la educación en el CV
// //         if ($cvDetails['resume_itemtype'] == 'edu') {
// //             $cv_section .= "<div class='education-details'>";
// //             $cv_section .= "<h3>Education</h3>";
// //             $cv_section .= "<p><strong>Institution:</strong> " . ($cvDetails['institution'] ?? 'N/A') . "</p>";
// //             $cv_section .= "<p><strong>Degree:</strong> " . ($cvDetails['qualname'] ?? 'N/A') . "</p>";
// //             // ... otros detalles de educación ...
// //             $cv_section .= "</div>"; // Cierre de education-details
// //         }
// //         // ... procesar otros tipos de información del CV ...

// //         $cv_section .= "</div>"; // Cierre de cv-content
// //         $cv_section .= "</div>"; // Cierre de cv-item
// //     }
// // }
// // $cv_section .= "</section>";

// // Estructura completa de la página
// $page_structure = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Views</title></head><body>";
// $page_structure .= "<div class='grid-container'>";
// // Añadir aquí el contenido de las secciones

// $page_structure .= $header; // Añadir la cabecera
// $page_structure .= $portfolio; // Añadir la sección de portafolio
// //$page_structure .= $cv_details; // Añadir los detalles del CV
// $page_structure .= "</div>"; // Final del contenedor grid-container
// $page_structure .= "</body></html>";

// echo $page_structure;


//master code
//third code
$description = "<div class='container-header'>";
$description .= "<h3 class='view-title'>" . $view_details['name'] . "</h3>";
$description .= "<div class='view-description'>" . $view_details['description'] . "</div>";
$description .= "</div>";
$description .= "<div class='grid-container'>";
$description .= "<div class='grid-box'>";
foreach ($view_details['items'] as $detail_item) {
    $description .= "<div class='item grid-item'>";
    

    // $description .= "<div class='item-text'>";
    // $description .= "<p class='item-name'>" . $detail_item['name'] . " </p>";
    // $description .= "</div>"; // Cierre del div item-text
    
    // div containter items
   

    // Aquí se manejan los diferentes tipos de elementos
    if ($detail_item['type'] == 'cv_information') {
        // $description .= "<div class='item-preview'> ";
        // $description .= "information previe cv_information";
        // $description .= "</div>"; // close .item-preview '
        $description .= "<div class='item-content' >";
        $description .= "<div class='item-cv-information grid-item'>";
        // Asegúrate de verificar si cada campo existe antes de intentar mostrarlo
       // error_log(print_r($cvDetails, true));
        if (isset($detail_item['details'])) {
            $cvDetails = $detail_item['details'];
            // Utiliza el valor resume_itemtype para determinar qué sección mostrar
            switch ($cvDetails['resume_itemtype']) {
                case 'edu':
                    $description .= "<p>Education Details:</p>";
                    $description .= "<p> " . ($cvDetails['startdate'] ?? 'N/A') . "</p>";
                    $description .= "<p>" . ($cvDetails['enddate'] ?? 'N/A') . "</p>";
                    $description .= "<p>" . ($cvDetails['institution'] ?? 'N/A') . "</p>";
                    $description .= "<p>" . ($cvDetails['qualtype'] ?? 'N/A') . "</p>";
                    $description .= "<p>" . ($cvDetails['qualname'] ?? 'N/A') . "</p>";
                    break;

                case 'employ':
                    $description .= "<p>Employment Details:</p>";
                    $description .= "<p>" . ($cvDetails['startdate'] ?? 'N/A') . "</p>";
                    $description .= "<p>" . ($cvDetails['enddate'] ?? 'N/A') . "</p>";
                    $description .= "<p>" . ($cvDetails['employer'] ?? 'N/A') . "</p>";
                    $description .= "<p>" . ($cvDetails['jobtitle'] ?? 'N/A') . "</p>";
                    break;

                case 'certif':
                    $description .= "<p>Certification Details:</p>";
                    $description .= "<p>Date: " . ($cvDetails['date'] ?? 'N/A') . "</p>";
                    $description .= "<p>Title: " . ($cvDetails['title'] ?? 'N/A') . "</p>";
                    break;

                case 'interests':
                    $description .= "<p>Interests:</p>";
                    $description .= "<p>" . ($cvDetails['interests'] ?? 'N/A') . "</p>";
                    break;
                
                case 'goalspersonal':
                    $description .= "<p>Goalspersonal:</p>";
                    $description .= "<p>" . ($cvDetails['goalspersonal'] ?? 'N/A') . "</p>";
                    error_log(print_r($cvDetails->goalspersonal, true));
                    break;

                case 'goalsacademic':
                    $description .= "<p>Goalsacademic:</p>";
                    $description .= "<p>" . ($cvDetails['goalsacademic'] ?? 'N/A') . "</p>";
                    error_log(print_r($cvDetails->goalspersonal, true));
                    break;
                case 'goalscareers':
                    $description .= "<p>Goalscareers:</p>";
                    $description .= "<p>" . ($cvDetails['goalscareers'] ?? 'N/A') . "</p>";
                    error_log(print_r($cvDetails->goalspersonal, true));
                    break;  
                case 'skillspersonal':
                    $description .= "<p>Skills Personal:</p>";
                    $description .= "<p>" . ($cvDetails['skillspersonal'] ?? 'N/A') . "</p>";
                    error_log(print_r($cvDetails->goalspersonal, true));
                    break; 
                case 'skillsacademic':
                   $description .= "<p>Skills Academic:</p>";
                   $description .= "<p>" . ($cvDetails['skillsacademic'] ?? 'N/A') . "</p>";
                   error_log(print_r($cvDetails->goalspersonal, true));
                   break;    
                case 'skillscareers':
                  $description .= "<p>Skills Careers:</p>";
                  $description .= "<p>" . ($cvDetails['skillscareers'] ?? 'N/A') . "</p>";
                  error_log(print_r($cvDetails->goalspersonal, true));
                  break;

                default:
                  $description .= "<p>Unknown Item Type:</p>";
                  $description .= "<p>This CV item type is not recognized. Please check your data or update the handling code to support this item type.</p>";
                //   Puedes optar por registrar esto o manejarlo de otra manera si es necesario
                  error_log("Unknown resume item type: " . $cvDetails['resume_itemtype']);
                  break;              
            }

            // Muestra los attachments si están disponibles
            if (!empty($cvDetails['attachments'])) {
                foreach ($cvDetails['attachments'] as $attachment) {
                    $description .= "<div class='item-attachment'>";
                    $description .= "<a href='" . $attachment['fileurl'] . "' target='_blank'>" . htmlspecialchars($attachment['filename'], ENT_QUOTES) . "</a>";
                    $description .= "</div>"; // Cierre del div item-attachment
                }
            }
        }
        $description .= "</div>"; // Cierre del div item-cv-information
        $description .= "</div>"; // Cierre del div .item-content

        
    } elseif ($detail_item['type'] == 'personal_information') {
        $description .= "<div class='item-personal-information grid-item'>";
        $description .= "<p>Personal information</p>";
        $description .= "<p>Name: " . $detail_item['firstname'] . " " . $detail_item['lastname'] . "</p>";
        $description .= "<p>Email: " . $detail_item['email'] . "</p>";
        $description .= "<p>Text: " . $detail_item['text'] . "</p>";
        $description .= "<p>Title: " . $detail_item['block_title'] . "</p>";
        $description .= "</div>"; // Cierre del div item-personal-information
    } elseif ($detail_item['type'] == 'item') {
        // Si tiene URL, se muestra la imagen
        if (isset($detail_item['url']) && !empty($detail_item['url'])) {
            $description .= "<div class='item-file-container grid-item'>";
            // ' alt='" . $detail_item['name'] . "'
            $description .= "img<img src='" . $detail_item['url'] . "><br>";
            $description .= "</div>"; // Cierre del div item-file-container
        }
        $description .= "<div class='item-intro'>" . $detail_item['intro'] . "</div>";
        $description .= "<div class='item-url'>" . $detail_item['url'] . "</div>";
        $description .= "<div class='item-name'>" . $detail_item['name'] . "</div>"; // Cierre del div item-intro
    } elseif ($detail_item['type'] == 'headline') {
        $description .= "<div class='item-headline grid-item' >";
        $description .= "<p>" . $detail_item['block_title'] . "</p>";
        $description .= "<p>" . $detail_item['text'] . "</p>";
        
                
        $description .= "</div>"; // Cierre del div item-headline
    }
    elseif ($detail_item['type'] == 'text') {
        $description .= "<div class='item-text grid-item' >";
        $description .= "<p>" . $detail_item['block_title'] . "</p>";
        $description .= "<p>" . $detail_item['text'] . "</p>";
        $description .= "<p>" . $detail_item['id'] . "</p>";

        
        $description .= "</div>"; // Cierre del div item-text
    }
    // Puedes agregar más casos para otros tipos si es necesario

    
    $description .= "</div>"; // Cierre del div item
}
$description .= "</div>";
$description .= "</div>";
$description .= "</div>"; //CLOSE HEADER SITE CONTET


echo $description;



// $description = "<h3 class='view-title'>" . $view_details['name'] . "</h3>";
// $description .= "<div class='view-description'>" . $view_details['description'] . "</div>";

// foreach ($view_details['items'] as $detail_item) {
//     $description .= "<div class='item'>";
//     $description .= "<div class='item-text'>";
//     $description .= "<p class='item-name'>" . $detail_item['name'] . "</p>";
//     $description .= "</div>"; // Cierre del div item-text

//     // Aquí se manejan los diferentes tipos de elementos
//     if ($detail_item['type'] == 'personal_information') {
//         $description .= "<div class='item-personal-information'>";
//         $description .= "<p>Personal information</p>";
//         $description .= "<p>Name: " . $detail_item['firstname'] . " " . $detail_item['lastname'] . "</p>";
//         $description .= "<p>Email: " . $detail_item['email'] . "</p>";
//         $description .= "</div>"; // Cierre del div item-personal-information
//     } elseif ($detail_item['type'] == 'item') {
//         if (isset($detail_item['url']) && !empty($detail_item['url'])) {
//             $description .= "<div class='item-file-container'>";
//             $description .= "<img src='" . $detail_item['url'] . "' alt='" . $detail_item['name'] . "'>";
//             $description .= "</div>"; // Cierre del div item-file-container
//         }
//         $description .= "<div class='item-name'>" . $detail_item['name'] . "</div>"; 
//         $description .= "<div class='item-intro'>" . $detail_item['intro'] . "</div>"; // Cierre del div item-intro
        

//         // foreach ($all_items[0]['items'] as $all_item) {
//         //     if ($all_item['name'] == $detail_item['name']) {
//         //         if ($all_item['type'] == 'file' && $all_item['isimage']) {
//         //             $description .= "<div class='item-file-container'>";
//         //             $description .= "<img src='" . $all_item['file'] . "' >";
//         //             $description .= "</div>"; // Cierre del div item-file-container
//         //         }
//         //         break;
//         //     }
//         // }
//         // $description .= "<div class='item-intro'>" . $detail_item['intro'] . "</div>"; // Cierre del div item-intro
//     } elseif ($detail_item['type'] == 'headline') {
//         $description .= "<div class='item-headline'>";
//         $description .= "<p>" . $detail_item['text'] . "</p>";
//         $description .= "</div>"; // Cierre del div item-headline
//     }
//     // Puedes agregar más casos para otros tipos si es necesario

//     $description .= "</div>"; // Cierre del div item
// }

// echo $description;

?>

