<?php
// news.php
require_once 'config.php';

function getNews($page = 1) {
    // Construir la URL usando las constantes definidas en config.php
    $url = NEWS_API_URL . "country=us&category=technology&pageSize=10&page=$page&apiKey=" . NEWS_API_KEY;
    
    // Usar cURL para obtener las noticias de la API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    // Agregar User-Agent para cumplir con la política de NewsAPI
    curl_setopt($ch, CURLOPT_USERAGENT, "MyNewsApp/1.0");
    $response = curl_exec($ch);
    
    // Debug temporal: imprimir la URL y la respuesta
    error_log("URL llamada: " . $url);
    error_log("Respuesta API: " . $response);
    
    // Comprobar si hubo un error en la solicitud
    if (curl_errno($ch)) {
        curl_close($ch);
        error_log("Error cURL: " . curl_error($ch));
        return [];
    }

    curl_close($ch);

    // Decodificar la respuesta JSON
    $data = json_decode($response, true);

    // Verificar que la respuesta sea válida y tenga artículos
    if (!$data || $data['status'] !== 'ok' || !isset($data['articles'])) {
        error_log("Respuesta inválida o sin artículos");
        return [];
    }

    return $data['articles'];
}
?>