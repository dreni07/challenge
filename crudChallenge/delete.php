<?php
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['product_id'])){
    $id = $_GET['product_id'];
    try{
        require 'db.inc.php';

        $sql = 'DELETE FROM products WHERE id = :id;';
        $preparing = $pdo->prepare($sql);
        $preparing->bindParam(':id',$id);
        $preparing->execute();

        if($preparing->rowCount()){
            header('Location:index.php');
        }
    } catch(PDOException $e){
        die('Failed ' . $e->getMessage());
    }
}


?>