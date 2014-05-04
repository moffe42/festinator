<?php
function LoadJpeg($imgname)
{
    /* Attempt to open */
    $im = @imagecreatefromjpeg($imgname);

//Set up some colors, use a dark gray as the background color
$white = imagecolorallocate($im, 255, 255, 255);
 
//Set the path to our true type font 
$font_path = 'advent_light';
 
//Set our text string 
$string = 'Hello World!';
 
//Write our text to the existing image.
imagettftext($im, 50, 0, 10, 160, $white, $font_path, $string);

    return $im;
}

header('Content-Type: image/jpeg');

$img = LoadJpeg('/customers/8/2/6/misserpirat.dk/httpd.www/festinator/image/plakat-large-notext.jpg');

imagejpeg($img);
imagedestroy($img);
?>
