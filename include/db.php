<?php 
try {
    $pdo = new PDO('mysql:host=localhost;dbname=pos', 'root', '');

}catch(PDOException $e) {
    echo $e->getMessage();
}
    // echo 'Connection successfulley';
?>