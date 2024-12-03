<?php
    function getProducts(){
        try{
            require 'db.inc.php';

            $sql = 'SELECT * FROM products;';
            $preparing = $pdo->prepare($sql);
            $preparing->execute();

            $fetched_data = $preparing->fetchAll(PDO::FETCH_ASSOC);


            if($fetched_data){
                return $fetched_data;
            }
        }catch(PDOException $e){
            die('Failed ' . $e->getMessage());
        }

        return;
    }

    $products = getProducts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            margin-top:20px;
            border-collapse:collapse;
        }
        table,thead,tr,th,td{
            border:1px solid black;
        }
        th,td{
            padding:10px;
        }
        .add-product form input{
            display:block;
            border:1px solid black;
            padding:8px 20px;
            border-radius:4px;
            margin:5px 0;
        }
    </style>
</head>
<body>
    <div class="add-product">
        <form action="add.php" method='post'>
            <input type="text" name='product_name' placeholder='Product Name'>
            <input type="text" name='product_price' placeholder='Product Price'>
            <input type="text" name='product_description' placeholder='Description'>
            <input type="number" name='quantity' placeholder='Quantity'>
            <input type="submit">
        </form>
    </div>
    <?php if($products): ?>
        <table>
            <thead>
                <th>Title</th>
                <th>Price</th>
                <th>Description</th>
                <th>Quantity</th>
            </thead>

            <tbody>
                <?php foreach($products as $product):?>
                    <td><?php echo htmlspecialchars($product['title'])?></td>
                    <td><?php echo htmlspecialchars($product['price'])?></td>
                    <td><?php echo htmlspecialchars($product['description'])?></td>
                    <td><?php echo htmlspecialchars($product['quantity']) ?></td>
                    <td><a href="update.php?product_id=<?php echo htmlspecialchars($product['id']) ?>">Update</a></td>
                    <td><a href="delete.php?product_id=<?php echo htmlspecialchars($product['id']) ?>">Delete</a></td>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No Products Added</p>
    <?php endif; ?>
</body>
</html>