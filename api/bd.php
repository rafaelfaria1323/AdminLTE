<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'userRequisicoes');
define('DB_PASS', 'Requisicoes2021');
define('DB_NAME', 'bd_requisicoes_esco');

// We connect to the database using the values above
$connect = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
// We tell PDO to report us every error
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
