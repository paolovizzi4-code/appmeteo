<?php
// Mostra tutti gli errori PHP per debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Imposta header JSON
header("Content-Type: application/json");

// Funzione per uscire con errore JSON
function jsonError($msg) {
    echo json_encode(["error" => $msg]);
    exit;
}

// Controlla input città
if (!isset($_GET['city']) || empty($_GET['city'])) {
    jsonError("Città mancante");
}

$city = strtolower(trim($_GET['city']));

// Mappa città → coordinate
$cities = [
    "torino" => [45.07, 7.69],
    "roma"   => [41.90, 12.49],
    "milano" => [45.46, 9.19]
];

if (!array_key_exists($city, $cities)) {
    jsonError("Città non supportata");
}

$lat = $cities[$city][0];
$lon = $cities[$city][1];

// URL API Open-Meteo
$url = "https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&daily=temperature_2m_max&timezone=Europe%2FRome";

// Chiamata API con cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 5); // timeout 5 secondi
$response = curl_exec($ch);
$curlError = curl_error($ch);
curl_close($ch);

if ($response === FALSE) {
    jsonError("Errore nella richiesta API: $curlError");
}

// Decodifica JSON
$data = json_decode($response, true);
if ($data === null) {
    jsonError("Errore decodifica JSON");
}

if (!isset($data['daily']['temperature_2m_max'])) {
    jsonError("Dati meteo non disponibili");
}

// Pulizia e validazione temperature
$temps = $data['daily']['temperature_2m_max'];
$result = [];
foreach ($temps as $temp) {
    if (is_numeric($temp) && $temp >= -100 && $temp <= 60) {
        $result[] = $temp;
    }
}

// Ordinamento
sort($result);

// Output JSON finale
echo json_encode($result);
?>
