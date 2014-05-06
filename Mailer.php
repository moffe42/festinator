<?php

class Mailer
{
    public static function mailReceipt($email, $headline, $publicId)
    {
        $subject = 'Picnicfyn.dk - Du har oprettet en fest';

        $headers = "From: Picnic Fyn <noreply@picnicfyn.dk>\r\n";
        $headers .= "Reply-To: Picnic Fyn <info@picnicfyn.dk>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

        $message = '
            <html>
            <head>
              <title>Picnicfyn.dk - Du har oprettet en fest</title>
              </head>
              <body>
                <h1>Velkommen til Picnic Fyn</h1>
                <p>Du har oprettet en fest!</p>
                <p>Du kan til hver en tid ændre i din fest p&aring; følgende link:<p>
                <a href="http://www.picnicfyn.dk/festinator/' . $publicId . '">http://www.picnicfyn.dk/festinator/' . $publicId . '</a>
                <p>Skulle du have nogle spørgsm&aring;l vedrørende din fest eller Picnic Fyn i det hele tage er du
                velkommen til at kontakte Picnic Fyn p&aring; <a href="mailto:info@picnicfyn.dk">info@picnicfyn.dk</a>.</p>
                <h3>Venlig hilsen</h3>
                <h1>Picnic Fyn</h1>
            </body>
            </html>';

        mail($email, $subject, $message, $headers);
    }
}
