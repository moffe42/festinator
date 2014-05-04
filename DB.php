<?php

require "config.php";
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo "Something went terribley wrong!";
    die();
}
