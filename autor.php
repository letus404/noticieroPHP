<?php
// author.php

function getRandomAuthor() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://randomuser.me/api/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Timeout de 5 segundos
    $response = curl_exec($ch);
    $err = curl_errno($ch);
    curl_close($ch);

    if ($err || !$response) {
        return [
            'name' => 'Autor Desconocido',
            'picture' => 'https://via.placeholder.com/50'
        ];
    }

    $data = json_decode($response, true);
    if (!$data || !isset($data['results'][0])) {
        return [
            'name' => 'Autor Desconocido',
            'picture' => 'https://via.placeholder.com/50'
        ];
    }

    $user = $data['results'][0];

    return [
        'name' => ucfirst($user['name']['first']) . ' ' . ucfirst($user['name']['last']),
        'picture' => $user['picture']['thumbnail']
    ];
}
