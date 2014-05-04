<?php

require_once "Poster.php";
require_once "PosterService.php";
require_once "DB.php";

$posterService = new PosterService($dbh);

$args = array(
    'email' => FILTER_VALIDATE_EMAIL,
    'headline' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    'invitation' => FILTER_SANITIZE_STRING,
    'pid' => array(
        'filter' => FILTER_VALIDATE_REGEXP, 
        "options" => array("regexp" => "/^[a-z0-9]{32}/")
    )
);

$input = filter_input_array(INPUT_POST, $args);

$poster = new Poster($dbh);

if ($input['pid']) {
    $poster->loadByPublicId($input['pid']);
} else {
    if ($posterService->isEmailUsed($input['email'])) {
        header('Location: http://www.misserpirat.dk/festinator/index.php?gg=ggg');
    }
}
$poster->setEmail($input['email']); 
$poster->setHeadline($input['headline']);
$poster->setInvitation($input['invitation']);
$poster->save();
header('Location: http://www.misserpirat.dk/festinator/' . $poster->getPublicId());
