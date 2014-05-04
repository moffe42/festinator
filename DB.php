<?php

$dsn = 'mysql:dbname=misserpirat_dk;host=localhost';
$user = 'misserpirat_dk';
$password = 'Jacob82NG';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo "Something went terribley wrong!";
    die();
}
