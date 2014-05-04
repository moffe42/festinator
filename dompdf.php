<?php
require_once("dompdf/dompdf_config.inc.php");

$options = array();

if ( isset($_GET["input_file"]) )
    $file = rawurldecode($_GET["input_file"]);
else
    throw new DOMPDF_Exception("An input file is required (i.e. input_file _GET variable).");

$paper = 'A4';
$orientation = "portrait";

$outfile = "poaster.pdf"; # Don't allow them to set the output file

$dompdf = new DOMPDF();
$dompdf->load_html_file($file);
$dompdf->set_paper($paper, $orientation);
$dompdf->render();
$dompdf->stream($outfile, array("Attachment"=>0));
