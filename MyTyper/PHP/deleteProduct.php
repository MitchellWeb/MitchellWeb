<?php
session_start();
if(isset($_SESSION['validUser']))
{
    
}
else{
    header("Location: ../pages/adminLogin.php");
}
$productId = $_GET['productId'];
        

require '../PHP/connectPDO.php';

    $sql = "DELETE FROM mytyper_products WHERE product_id = :productId;";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':productId', $productId);

    $stmt->execute();

    $count = $stmt->rowCount();

    echo $count. " Product Deleted Successfully";

    
?>

<a href="../pages/viewProductsList.php">Return To Product List</a>

