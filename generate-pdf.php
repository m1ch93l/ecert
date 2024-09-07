<?php

require __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$name     = $_POST["fullname"];

$options = new Options;
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

//Set the paper size and orientation
$dompdf->setPaper("letter", "landscape");

//Load the HTML and replace placeholders with values from the form
$html = file_get_contents("certificate.php");

$html = str_replace(["{{ fullname }}"], [$name], $html);

$dompdf->loadHtml($html);

$dompdf->render();

$dompdf->addInfo("Title", "An Example PDF"); // "add_info" in earlier versions of Dompdf

//Send the PDF to the browser
$dompdf->stream("certificate.pdf", ["Attachment" => 0]);

//Save the PDF file locally
$output = $dompdf->output();
file_put_contents("file.pdf", $output);