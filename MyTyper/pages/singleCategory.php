<?php
session_start();
print_r($_SESSION['idArray']);
if(isset($_POST['submit'])){
$getCategory = $_POST['submit'];   
}
else{
    $getCategory =$_GET['cat'];
}


function callCats($cat)
    {
    require '../PHP/connectPDO.php';

    $sql = "SELECT product_id, product_name, product_price, product_description, product_image, product_quantity, product_category FROM mytyper_products WHERE product_category=:cat";
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(':cat', $cat);
    $stmt->execute();
    while($row=$stmt->fetch())
{

    ?>

    <div class="d-flex align-items-center flex-column product-block">
        <img class="product-image" src="../images/<?php echo $row['product_image']; ?>" alt="">
        <h1>
            <?php echo $row['product_name']; ?>
        </h1>
        <h2>
            <?php echo $row['product_price'];?>
        </h2>
        <form action="viewProduct.php" method="post">
            <button class="view-product-button" type="submit" value="<?php echo $row['product_id'];?>" name="view_product">View</button>
        </form>
    </div>

    <?php

}

}


?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $getCategory;?></title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <link rel="stylesheet" href="../CSS/style_products.css">
            <link rel="stylesheet" href="../CSS/style_global.css">
            <link rel="icon" href="../images/tab_icon.gif">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Nova+Mono&display=swap" rel="stylesheet">
            <style>
                .row {
                    --bs-gutter-x: 0;
                    --bs-gutter-y: 0;
                    display: flex;
                    flex-wrap: wrap;
                    margin-top: 0;
                    margin-right: 0;
                    margin-left: 0;
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
        <body style="margin: 0 auto;">
        
            <main class='container row d-flex justify-content-between '>
                <?php
        echo "<span style='border-bottom:solid black 4px; width:fit-content;' class='container row d-flex justify-content-center'>";
        callCats($getCategory);
        echo "</span>";
        ?>
            </main>
            <footer >
            <!--Footer section, identical across all pages of this project-->
            &copy;<?php echo date("Y");?>
        </footer>
        </body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        </html>