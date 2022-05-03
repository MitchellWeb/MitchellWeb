<?php
session_start();
if(isset($_SESSION['validUser']))
{
    
}
else{
    header("Location: adminLogin.php");
}

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="icon" href="../images/tab_icon.gif">
        <link rel="stylesheet" href="../CSS/style_global.css">

        <title>View Products List</title>
        <style>
            table tr:nth-child(odd) {
                background-color: #a9a9a9;
            }
            
            table {
                border-spacing: 0 10px;
                border-collapse: separate;
                max-height: 300px;
                height: 300px;
                overflow-y: scroll;
                margin: 0 auto;
            }
            
            td {
                border: solid black 2px;
                text-align: center;
            }
            th{
                text-align: center;
            }
            td.name {
                width: 200px;
                max-width: 200px;
            }
            
            td.price {
                max-width: 70px;
                width: 70px;
            }
            
            td.description {
                max-width: 500px;
                width: 500px;
            }
        </style>
    </head>
    <header class="container">
            <!--Header section, identical across all pages in this project, contains the mytyper logo that is anchored to index.html-->
            <div class="col-12 d-flex justify-content-center">
                <a href="index.php"><img src="../images/typerLogo.png" alt="logo for my typer"></a>
            </div>
        </header>
        <!--Nav section starts below this line-->
        <nav class="navbar navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <!--Place anchor tags to link other main pages under this line-->
                <a class="navbar-brand" href="index.php">Home</a>
                <a class="navbar-brand" href="products.php">Shop</a>
                <a class="navbar-brand" href="contact.php">Contact</a>
                <a class="navbar-brand" href="#">About Us</a>
                <a class="navbar-brand" href="cart.php"><img class="cart-icon" src="../images/iconmonstr-shopping-cart-thin-72.png" alt="cart"><p class="cart-count"><?php if($_SESSION['cartCount'] == ""){echo "0";}else{ echo $_SESSION['cartCount'];} ?></p></a>


                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <!--Label for Side menu-->
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <!--List of anchored links for the side menu-->
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="products.php">Shop</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="aboutUs.html">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cart.php">Cart</a>
                            </li>
                           

                            <li class="nav-item dropdown">
                                <!--Dropdown list of products-->
                                <a class="nav-link dropdown-toggle" href="products.php" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Products
                  </a>
                                <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                                <form method="post" action="singleCategory.php">    
                                    <li><a class="dropdown-item" <?php echo "href='singleCategory.php?cat=switch'"?>>Switches</a></li>
                                    <li><a class="dropdown-item" <?php echo "href='singleCategory.php?cat=keycaps'"?>>Keycaps</a></li>
                                    <li><a class="dropdown-item" <?php echo "href='singleCategory.php?cat=case'"?>>Cases</a></li>
                                    <li><a class="dropdown-item" <?php echo "href='singleCategory.php?cat=plate'"?>>Plates</a></li>
                                    <li><a class="dropdown-item" <?php echo "href='singleCategory.php?cat=pcb'"?>>PCBs</a></li>
                                    <li><a class="dropdown-item" <?php echo "href='singleCategory.php?cat=accessories'"?>>Accessories</a></li>
                                </form>
                                </ul>
                            </li>
                        </ul>
                        <a href="adminLogin.php"><img src="" alt="">Admin Login</a>
                    </div>
                </div>
            </div>
        </nav>
        <!--End nav-->
    <body>
    <div>
        <h1>back</h1>
        <a href="adminLogin.php"><img src="../images/iconmonstr-arrow-left-lined-96.png" alt=""></a>
    </div>
        <div id="productList">
            <h1 style="text-align: center;">Products</h1>
            <?php
                require '../PHP/connectPDO.php';

                $log = "SELECT * FROM mytyper_products";
                $logStmt = $conn->prepare($log);
                $logStmt->execute();
                $logStmt->setFetchMode(PDO::FETCH_ASSOC);
                 echo "<table>";
                    echo "<tr>";
                            echo "<th> Product Id</th>";
                            echo "<th> Product Name</th>";
                            echo "<th> Price</th>";
                            echo "<th> Description</th>";
                            echo "<th> Image File Name</th>";
                            echo "<th> Quantity </th>";
                            echo "<th> Category</th>"; 
                            echo "<th> 65%</th>"; 
                            echo "<th> 70%</th>"; 
                            echo "<th> 80%</th>"; 
                            echo "<th> full</th>"; 
                            echo "<th> Delete</th>";
                    echo "</tr>";
                while($row=$logStmt->fetch())
                {
                    $has65 = "no";
                    $has70 = "no";
                    $has80 = "no";
                    $hasFull = "no";

                   if($row['product_65'] == 1){
                       $has65 = "yes";
                   }
                   if($row['product_70'] == 1){
                       $has70 = "yes";
                   }
                   if($row['product_80'] == 1){
                    $has80 = "yes";
                   }
                   if($row['product_full'] == 1){
                        $hasFull = "yes";
                   }
                    ?>

                <tr>
                    <td class='id'>
                        <?php echo $row['product_id']?>
                    </td>
                    <td class='name'>
                        <?php echo $row['product_name']?>
                    </td>
                    <td class='price'>
                        <?php echo $row['product_price']?>
                    </td>
                    <td class='description'>
                        <?php echo $row['product_description']?>
                    </td>
                    <td class='image'>
                        <?php echo $row['product_image']?>
                    </td>
                    <td class='quantity'>
                        <?php echo $row['product_quantity']?>
                    </td>
                    <td class='category'>
                        <?php echo $row['product_category']?>
                    </td>
                    <td class='category'><?php echo $has65;?></td>
                    <td class='category'><?php echo $has70;?></td>
                    <td class='category'><?php echo $has80;?></td>
                    <td class='category'><?php echo $hasFull;?></td>
                    <td class='delete'>
                     <?php echo "<a onClick=\"javascript: return confirm('Are you sure you want to delete product number ".$row['product_id'].", ".$row['product_name']."');\" href='../PHP/deleteProduct.php?productId=".$row[ 'product_id']."'>";?>
                                    <button>
                                        Delete
                                    </button>
                                </a>
                    </td>
                </tr>

                <?php
            
                }
                echo "</table>";
    
            ?>
        </div>
        <footer >
            <!--Footer section, identical across all pages of this project-->
            &copy;<?php echo date("Y");?>
        </footer>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </html>