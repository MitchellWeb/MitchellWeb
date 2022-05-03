<?php
session_start();

$getProductId = $_POST['view_product'];
require '../PHP/connectPDO.php';//Connect to DB
$sql = "SELECT * FROM mytyper_products WHERE product_id = :getProdId";//create SQL select statement that retrieves all columns of row specified by product id
$stmt = $conn->prepare($sql);
$stmt->bindParam(':getProdId', $getProductId);
$stmt->execute();

$row=$stmt->fetch();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width ,  n initial-scale=1.0">
    <title>Product View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/style_viewProduct.css">
        <link rel="stylesheet" href="../CSS/style_global.css">
        <link rel="icon" href="../images/tab_icon.gif">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nova+Mono&display=swap" rel="stylesheet">
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
                <a class="navbar-brand" href="about.php">About Us</a>
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
                        <li class="nav-item" >
                                <a class="nav-link" href="cart.php"><div class="cart-cont"><img class="cart-img" src="../images/iconmonstr-shopping-cart-thin-72.png" alt=""><span class="counter-num"> <?php echo $_SESSION['cartCount']?></span></div></a>
                            </li>
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
    <main>
    <div>
        <a href="products.php"><img src="../images/iconmonstr-arrow-left-lined-96.png" alt=""></a>
    </div>
    <div class="product-container container ">
        <div class="image-container" ><img src="../images/<?php echo $row['product_image']; ?>" alt=""></div>
        <div class="info-container">
            <p><?php echo $row['product_name']; ?></p>
            <p><?php echo "$".$row['product_price'];?></p>
            <p>Size<br>
            
            <select><?php
        if($row['product_65'] == 1)
        {
            echo "<option value='65'>65%</option>";
            
        }
        if($row['product_70'] == 1)
        {
            echo "<option value='70'>70%</option>";
            
        }
        if($row['product_80'] == 1)
        {
            echo "<option value='80'>80%</option>";
            
        }
        if($row['product_full'] == 1)
        {
            echo "<option value='full'>full</option>";
            
        }
        ?></select></p>
            
                <form action="cart.php" method="post">
                    <input type="hidden" name="cart" value="<?php echo $row['product_id'] ?>">
                    <input type="submit" value="Add To Cart">
                </form>
            
        </div>
        <p class="desc-header">Description:<br></p>
        <div class="description">
            <p><?php echo $row['product_description']; ?></p>
        </div>
    </div>
</main>
<footer >
            <!--Footer section, identical across all pages of this project-->
            &copy;<?php echo date("Y");?>
        </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>