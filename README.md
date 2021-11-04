# A PHP API that generates PDFs from HTML
A slim PDF generation API that relies on [Puppeteer](https://pptr.dev/).

This API is a one-file wrapper on top of [eckinox/php-puppeteer](https://github.com/eckinox/php-puppeteer).

Basically, this gives you access to all of Puppeteer's most important features and options for PDF generations, without making you write any Javascript.
Just send a request with your content and options, and get your PDF.

## Getting started
1. **Install Puppeteer**. To install Puppeteer and its dependencies, we recommend you take a look at [Puppeteer's official installation guide](https://developers.google.com/web/tools/puppeteer/get-started) as well as their [official troubleshooting guide](https://github.com/puppeteer/puppeteer/blob/main/docs/troubleshooting.md).
2. Clone this repository to your server.
3. Start making POST requests to generate PDFs!

### Usage example
Here's an example of PDF generation in PHP:

```php
<?php
// Define your options
$pdfConfig = [
	"url" => "http://github.com/eckinox/php-html-to-pdf-api",
	"pdf" => [
		"format" => "Letter",
		"landscape" => true,
		"margin" => [
			"top"  => "0mm",
			"bottom"  => "0mm",
			"left"  => "0mm",
			"right"  => "0mm",
		],
		"printBackground" => true,
	],
    "goto" => [
        "waitUntil" => "networkidle0",
    ],
];
// Send the request to the API with curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://your.api/url"; // @TODO: Replace this value with the URL of the API on your sever
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($pdfConfig));
$pdfContents = curl_exec($ch);

// Short contents usually means there's been an error
if (strlen($pdfContents) < 100) {
    throw new Error($pdfContents);
}

header("Content-Type: application/pdf");
header("Content-Transfer-Encoding: Binary");
echo $pdfContents;
```

## Options
To learn about all of the available options, take a look at [`eckinox/php-puppeteer`'s options documentation](https://github.com/eckinox/php-puppeteer#options).
