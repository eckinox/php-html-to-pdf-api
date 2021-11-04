<?php

require_once "vendor/autoload.php";

use Eckinox\PhpPuppeteer\Browser;

$payload = file_get_contents("php://input");
$options = json_decode($payload, true);
$options["cacheDir"] = __DIR__ . "/_cache";

if (!file_exists($options["cacheDir"])) {
	mkdir($options["cacheDir"]);
}

// Check if content is provided
if (empty($options["url"]) && empty($options["html"])) {
	http_response_code(400);
	die("Bad request. You must provide either the \"url\" or the \"html\" in your options.");
}

$browser = new Browser();
$content = $browser->pdf($options);

header("Content-type: application/pdf");
echo $content;
