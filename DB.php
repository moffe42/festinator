<?php

require "config.php";
try {
    $dbh = new PDO($config['db']['dsn'], $config['db']['user'], $config['db']['password']);
} catch (PDOException $e) {
    echo "Something went terribley wrong!";
    die();
}
