<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$input = trim($_GET['number'] ?? '');

if (empty($input)) {
    echo json_encode(["success" => false, "error" => "Number parameter missing"]);
    exit;
}

// Number normalize
$number = preg_replace('/[^0-9]/', '', $input);
if (substr($number, 0, 1) === '0') {
    $number = substr($number, 1);
}

$ORIGINAL_API = "https://amscript.xyz/PublicApi/Siminfo.php?number=";
$url = $ORIGINAL_API . urlencode($number);

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_TIMEOUT        => 20,
    CURLOPT_USERAGENT      => 'Mozilla/5.0',
    CURLOPT_FOLLOWLOCATION => true,
]);

$response = curl_exec($ch);
$curlError = curl_error($ch);
curl_close($ch);

if (!$response || $curlError) {
    echo json_encode(["success" => false, "error" => "CURL Failed: " . $curlError]);
    exit;
}

$data = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(["success" => false, "error" => "Invalid API response"]);
    exit;
}

// ✅ Sahi structure: data[0]
$res = $data['data'][0] ?? null;

if (empty($res)) {
    echo json_encode(["success" => false, "error" => "No record found for $number"]);
    exit;
}

echo json_encode([
    "success" => true,
    "details" => [
        "mobile"  => $res['phone']     ?? $number,
        "name"    => $res['full_name'] ?? "Not Found",
        "cnic"    => $res['cnic']      ?? "Not Found",
        "address" => $res['address']   ?? "Not Found"
    ],
    "Developer" => "Usman Tech",
    "Channel"   => "https://whatsapp.com/channel/0029VbCU3Z4CcW4mInVX8n1k" // change this link to your channel link
], JSON_PRETTY_PRINT);
?>