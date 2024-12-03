<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'] . '$';
    $product_description = $_POST['product_description'];
    $quantity = $_POST['quantity'];

    try{
        require 'db.inc.php';
        $sql = 'INSERT INTO products(title,description,quantity,price) VALUES (:title,:description,:quantity,:price);';
        $preparing = $pdo->prepare($sql);

        $preparing->bindParam(':title',$product_name);
        $preparing->bindParam(':description',$product_description);
        $preparing->bindParam(':quantity',$quantity);
        $preparing->bindParam(':price',$product_price);

        $preparing->execute();

        if($preparing->rowCount()){
            header('Location:index.php');
        }
    } catch(PDOException $e){
        die('Failed ' . $e->getMessage());
    }
}

?>