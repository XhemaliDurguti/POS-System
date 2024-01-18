<?php 
    include_once '../include/db.php';

    $productid = $_GET["id"];
    $barcode = $_GET["id"];

    $select = $pdo->prepare("select * from tbl_product where  pid = $productid OR barcode =$barcode and stock > 0");
    $select->execute();

    $row = $select->fetch(PDO::FETCH_ASSOC);

    $response = $row;
//print_r($response);
    header('Content-Type:application/json');
   
    echo json_encode($response);
?>