<?php

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_REGEXP,
    array(
        "options" => array("regexp" => "/^\d{1,10}/")
    )
);
require_once "Poster.php";
require_once "DB.php";
$poster = new Poster($dbh);

if (!$poster->loadById($id)) {
    echo "No poster available";
    die;
}
?>
<html lang="da-DK">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="/festinator/css/normalize.css" >
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="/festinator/css/style.css?v=<?= time() ?>" >
		<meta property="og:title" content="<?= $poster->getHeadline() ?>" />
		<meta property="og:site_name" content="Picnic Fyn" />
		<meta property="og:url" content="http://www.misserpirat.dk/festinator/<?= $poster->getId() ?>" />
		<meta property="og:description" content="<?= $poster->getInvitation() ?>" />
	</head>
	<body>
        <div id="posterpdf">
            <h1 id="posterheadline"><?= $poster->getHeadline() ?></h1>
            <p id="posterinvitation"><?= str_replace(array("\r\n","\r","\n"),"<br/>", $poster->getInvitation()) ?></p>
        </div>
	</body>
</html>

