<?php
$new = true;
$pid = filter_input(
    INPUT_GET,
    'pid',
    FILTER_VALIDATE_REGEXP,
    array(
        "options" => array("regexp" => "/^[a-z0-9]{32}/")
    )
);
require_once "Poster.php";
require_once "DB.php";
$poster = new Poster($dbh);

if ($pid) {
    $poster->loadByPublicId($pid);
    $new = false;
}
?>
<html lang="da-DK">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="/festinator/css/normalize.css" >
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="/festinator/css/style.css?v=<?= time() ?>" >
	</head>
	<body>
		<div id="container">
			<div id="main">
				<div id="left">
					<img src="/festinator/image/left-top.png">
					<h1>Opret din egen unikke fest-i-festen</h1>
					<p>Picnic Fyns "Festinator" giver dig muligheden for at inviterer venner og familie, til &aring;rets byfest med din helt egen plakat.</p>
					<p>Inds&aelig;t din egen invitation, print plakaten og s&aelig;t den op i kantinen, fodboldklubben eller i klassev&aelig;relset.</p>
					<form method="post" action="saveposter.php">
						<label>Overskrift</label>
						<textarea name="headline" id="headline" maxlength="40"><?= $poster->getHeadline() ?></textarea>
						<label>Invitation</label>
						<textarea name="invitation" id="invitation" maxlength="600"><?= $poster->getInvitation() ?></textarea>
						<label>Din e-mail</label>
						<input type="text" name="email" id="email" value="<?= $poster->getEmail() ?>">
						<input type="hidden" name="pid" id="pid" value="<?= $poster->getPublicId() ?>">
						<input type="submit" value="Gem plaket">
					</form>
						<?php
						if (!$new) {
						?>
					    <form method="get" action="/festinator/<?= $poster->getId() ?>">
					        <input type="submit" value="Se offentlig link">
					    </form>
					    <a class="redbutton" href="http://www.facebook.com/share.php?u=<?php echo rawurlencode('http://www.misserpirat.dk/festinator/' . $poster->getId()); ?>&t=Picnic%20Fyn">Share</a>
					    <a class="redbutton" href="dompdf.php?input_file=<?php echo rawurlencode('http://www.misserpirat.dk/festinator/pdfposter.php?id=' . $poster->getId()); ?>">PDF</a>
					    <?php } ?>
					<p>Din plakat bliver gemt i galleriet, hvor andre vil kunne se din fest-invitation.</p>
				</div>
				<div id="right">
					<div id="postermockup">
						<img src="/festinator/image/plakat-large-notext.jpg" id="plakat">
						<h1 id="posterheadline">Festudvalget inviterer til &aring;rets sommerfest</h1>
						<p id="posterinvitation">Bacon ipsum dolor sit amet boudin turkey brisket meatloaf. Doner shoulder ribeye chicken chuck. Landjaeger ham hock shankle hamburger pork belly tri-tip pork shoulder spare ribs sirloin jerky tail capicola rump shank. Bresaola pork loin ham hock, brisket capicola flank kielbasa shoulder ribeye chicken jowl ham. Shoulder tri-tip pancetta boudin, porchetta spare ribs andouille ball tip pork belly rump. Ham hock andouille flank pork chop. Flank kielbasa pig ground round bacon. Porchetta pancetta pork belly pork spare ribs hamburger drumstick biltong ball tip beef ribs shoulder, salami meatball.</p>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script src="/festinator/script/main.js?v=<?= time() ?>"></script>
</html>
