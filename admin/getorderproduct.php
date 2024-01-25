<?php 
    include_once '../include/db.php';
    $id = $_GET['id'];


    $select = $pdo->prepare("select *  from tbl_invoice_details aid  inner join tbl_product p 
    on aid.barcode = p.barcode  where aid.invoice_id = $id");
    $select->execute();

    $row_invoice_details = $select->fetchAll(PDO::FETCH_ASSOC);
    
    $response = $row_invoice_details;
    // var_dump($response);
header('Content-Type:application/json');

echo json_encode($response);
?>