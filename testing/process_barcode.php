<?php
// Lidhu me bazën e të dhënave (ndrysho parametrat sipas konfigurimit të bazës së të dhënave tënde)
$host = 'localhost';
$db   = 'pos';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$productid = $_GET["id"];
$barcode = $_GET["id"];

$select = $pdo->prepare("select * from tbl_product where  pid = $productid OR barcode =$barcode");
$select->execute();

$row = $select->fetch(PDO::FETCH_ASSOC);

$response = $row;
//print_r($response);
header('Content-Type:application/json');

echo json_encode($response);