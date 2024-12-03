<?php
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['product_id'])){
    $the_product_id = $_GET['product_id'];
    $the_product = getData($the_product_id);
}

function getData($product_id){
    try{
        require 'db.inc.php';
        $sql = 'SELECT * FROM products WHERE id = :product_id;';
        $preparing = $pdo->prepare($sql);
        $preparing->bindParam(':product_id',$product_id);

        $preparing->execute();
        

        $fetched = $preparing->fetch(PDO::FETCH_ASSOC);


        if($fetched){
            return $fetched;
        }
    } catch(PDOException $e){
        die('failed ' . $e->getMessage());
    }

    return;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $the_id = $_POST['id'];

    $product_price = $_POST['product_price'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_quantity = $_POST['product_quantity'];
    try{    
        require 'db.inc.php';

        $sql = 'UPDATE products SET title = :title,description = :description,quantity = :quantity,price = :price WHERE id = :id;';
        $prepare = $pdo->prepare($sql);

        $prepare->bindParam(':id',$the_id);
        $prepare->bindParam(':description',$product_description);
        $prepare->bindParam(':quantity',$product_quantity);
        $prepare->bindParam(':price',$product_price);
        $prepare->bindParam(':title',$product_name);

        $prepare->execute();

        if($prepare->rowCount()){
            header('Location:index.php');
        }
    } catch(PDOException $e){
        die('Failed ' . $e->getMessage());
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method='post'>
        <input type="hidden" value='<?php echo $the_product['id'] ?>' name='id'> 
        <input type="text" value='<?php echo $the_product['title'] ?>' name='product_name'>
        <input type="text" value='<?php echo $the_product['description'] ?>' name='product_description'>
        <input type="text" value='<?php echo $the_product['price'] ?>' name='product_price'>
        <input type="number" value='<?php echo $the_product['quantity'] ?>' name='product_quantity'>


        <input type="submit">
    </form>
</body>
</html>