<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;


$apiKey = "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";
$url = 'https://api.openai.com/v1/chat/completions';

$headers = array(
    "Authorization: Bearer {$apiKey}",
    "OpenAI-Organization: org-bEOI9sNZZWwwsOCvlYjdEVVu",
    "Content-Type: application/json"
);

// Define messages
$messages = array();
$messages[] = array("role" => "user", "content" => "Hello future overlord!");

// Define data
$data = array();
$data["model"] = "gpt-3.5-turbo";
$data["messages"] = $messages;
$data["max_tokens"] = 50;

// init curl
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($curl);
if (curl_errno($curl)) {
    echo 'Error:' . curl_error($curl);
} else {
    echo $result;
}

curl_close($curl);



?>