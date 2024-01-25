<?php 
try {
    $pdo = new PDO('mysql:host=localhost;dbname=posphp', 'root', '');

}catch(PDOException $e) {
    echo $e->getMessage();
}
    // echo 'Connection successfulley';
?>