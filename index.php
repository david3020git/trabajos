
<?php


function downloadResource($url, $savePath) {
    echo '<br>';
    echo "Attempting to download: " . $url . " <br>"; // Mensaje de depuración
    $content = @file_get_contents($url);
    if ($content !== false) {
        file_put_contents($savePath, $content);
        echo "Downloaded resource: $savePath\n";
    } else {
        echo "Failed to download resource from: $url\n";
    }
}

function processPage($url, $baseUrl, $newDomain, $directoryPath, &$processedUrls, &$urlMapping, $depth, $maxDepth) {
    if ($depth > $maxDepth) {
        return [];  // Detener si se alcanza la profundidad máxima.
    }
    
    $normalizedUrl = normalizeUrl($url, $baseUrl);
    if (isset($processedUrls[$normalizedUrl])) {
        echo "Skipping already processed URL:" . $normalizedUrl . "<br>";
        return [];  // Prevenir procesamiento repetido.
    }
    
    $htmlContent = @file_get_contents($url);
    if ($htmlContent === FALSE) {
        echo "Error fetching the page from $url\n";
        return [];
    }

    $processedUrls[$normalizedUrl] = true;
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    @$doc->loadHTML($htmlContent);
    libxml_clear_errors();
    $xpath = new DOMXPath($doc);

    // Procesamiento de imágenes
    $images = $xpath->query("//img");
    foreach ($images as $img) {
        $src = $img->getAttribute('src');
        $src = normalizeUrl($src, $baseUrl);
        $imgPath = $directoryPath . '/' . basename($src);
        $img->setAttribute('src', $newDomain . '/' . $imgPath);
        downloadResource($src, $imgPath);
    }

    // Procesamiento de CSS
    $cssLinks = $xpath->query("//link[@rel='stylesheet']");
    foreach ($cssLinks as $css) {
        $cssHref = $css->getAttribute('href');
        $cssHref = normalizeUrl($cssHref, $baseUrl);
        $cssPath = $directoryPath . '/' . basename($cssHref);
        $css->setAttribute('href', $newDomain . '/' . $cssPath);
        downloadResource($cssHref, $cssPath);
    }

    // Procesamiento de JS
    $scriptLinks = $xpath->query("//script[@src]");
    foreach ($scriptLinks as $script) {
        $scriptSrc = $script->getAttribute('src');
        $scriptSrc = normalizeUrl($scriptSrc, $baseUrl);
        $scriptPath = $directoryPath . '/' . basename($scriptSrc);
        $script->setAttribute('src', $newDomain . '/' . $scriptPath);
        downloadResource($scriptSrc, $scriptPath);
    }

    // Actualización y recopilación de enlaces
    $newLinks = [];
    $links = $xpath->query("//a[@href]");
    echo '<br>';
    echo 'Total links found: ' . $links->length . '<br>';
    foreach ($links as $index => $link) {
        if ($link instanceof DOMElement) {
            $href = $link->getAttribute('href');
            echo '<br>';
            echo "Link ACTUAL ** $index: $href<br>"; // Mostrar el href actual

            // Normalizar la URL
            $href = normalizeUrl($href, $baseUrl);

            // Verificar y modificar el href si no es una URL completa
            if (!filter_var($href, FILTER_VALIDATE_URL) && !startsWith($href, '#')) {
                $href = $baseUrl . '/' . ltrim($href, '/');
            }
            
            // Evitar procesar URLs ya procesadas
            if (!isset($processedUrls[$href])) {
                $newLinks[] = $href;
            }

            // Calcular la nueva ruta y actualizar el atributo href en el documento solo si la URL es válida
            if (filter_var($href, FILTER_VALIDATE_URL)) {
                $fullNewPath = $newDomain . '/' . $directoryPath . '/' . basename($href) . '.html';
                $link->setAttribute('href', $fullNewPath);
                echo '<br>';
                echo "Updated Link ** $index to: $fullNewPath<br>"; // Mostrar el nuevo href

                // Agregar al mapeo de URL
                $urlMapping[$href] = $fullNewPath;
            }
        }
    }

    // Guardar el HTML modificado
    $updatedHtml = $doc->saveHTML();
    $pathParts = pathinfo($url);
    $slug = $pathParts['filename'] ?: 'index';
    $newFilePath = $directoryPath . "/{$slug}.html";
    file_put_contents($newFilePath, $updatedHtml);
    echo '<br>';
    echo "Processed and saved: $newFilePath\n";

    return $newLinks;
}

function startsWith($string, $startString) {
    return substr($string, 0, strlen($startString)) === $startString;
}

function normalizeUrl($href, $baseUrl) {
    // Asegúrate de que la URL sea absoluta y normalizada
    return filter_var($href, FILTER_VALIDATE_URL) ? $href : rtrim($baseUrl, '/') . '/' . ltrim($href, '/');
}

$baseUrl = 'https://pis-cms.ethis.at';
$pathindex = 'https://pis-cms.ethis.at/cms/pub/VEO';
$newDomain = 'https://proges.at/newsletterapi';
$directoryPath = "pages/new_pages";
$maxDepth = 2;

if (!is_dir($directoryPath)) {
    mkdir($directoryPath, 0777, true);
}

$processedUrls = [];
$urlMapping = [];
$initialUrl = $pathindex . '/magazines/index';
$newLinks = processPage($initialUrl, $baseUrl, $newDomain, $directoryPath, $processedUrls, $urlMapping, 1, $maxDepth);
//echo $newLinks;die;
// Procesar recursivamente los nuevos enlaces encontrados
$depth = 0;
while (!empty($newLinks) && $depth <= $maxDepth) {
    $currentLinks = $newLinks;
    $newLinks = [];
    foreach ($currentLinks as $link) {
        $newLinks = array_merge($newLinks, processPage($link, $baseUrl, $newDomain, $directoryPath, $processedUrls, $urlMapping, $depth + 1, $maxDepth));
    }
    $depth++;
}







?>



