<?php 
    include_once "../include/db.php";

    $id = $_POST['pidd'];
    $sql = "delete from tbl_product where pid = $id";
    $delete=$pdo->prepare($sql);

    if($delete->execute()){

    }else {
        echo "Error delete product";
    }

?>