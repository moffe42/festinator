<?php
include "vendor/autoload.php";

require_once("vendor/dompdf/dompdf/dompdf_config.inc.php");

$options = array();

if ( isset($_GET["input_file"]) )
    $file = rawurldecode($_GET["input_file"]);
else
    throw new DOMPDF_Exception("An input file is required (i.e. input_file _GET variable).");

$paper = DOMPDF_DEFAULT_PAPER_SIZE;
$orientation = "portrait";

if ( isset($_GET["base_path"]) ) {
    $base_path = rawurldecode($_GET["base_path"]);
    $file = $base_path . $file; # Set the input file
}

if ( isset($_GET["options"]) ) {
    $options = $_GET["options"];
}

$outfile = "dompdf_out.pdf"; # Don't allow them to set the output file

$dompdf = new DOMPDF();

$dompdf->load_html_file($file);

if ( isset($base_path) ) {
    $dompdf->set_base_path($base_path);
}

$dompdf->set_paper($paper, $orientation);

$dompdf->render();

$dompdf->stream($outfile, $options);
