<?php
session_start();
settype($_SESSION['arrayId'], "array");
settype($_SESSION['cartCount'],"integer");
require '../PHP/connectPDO.php';
//settype($_SESSION['result'], "array");

if(isset($_POST['cart']))
    {   $newId = $_POST['cart'];
        if($_SESSION['cartCount'] == 0)
        {
            $_SESSION['cartCount'] = 1;
        }
        
        else{
        $_SESSION['cartCount']++;
        }

    array_push($_SESSION['arrayId'],$newId);
    print_r(array_unique($_SESSION['arrayId'])); 
    print_r($_SESSION['arrayId']);  
        if(count(array_unique($_SESSION['arrayId']))< $_SESSION['cartCount'])
        {
            $_SESSION['cartCount']--;
        }
 
    }
   
    if(isset($_POST['remove']))
    {
        
        array_splice($_SESSION['arrayId'],$_POST['remove'],1);
        if($_SESSION['cartCount'] < 0){
            $_SESSION['cartCount'] = 0;
            echo "too";
        }else{
            $_SESSION['cartCount']--;
            echo "<script>console.log('too ling');</script>";
        }
    }
?>
<!--<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }-->
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style_global.css">
    <link rel="icon" href="../images/tab_icon.gif">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Mono&display=swap" rel="stylesheet">
    <style>
        .display-cart>p{
            margin: 20px 30px;
        }
        .buttons{
            margin:10px 30px;
            border-radius: 25px;
        }
        .buttons:hover{
            background-color: #c8c8a2;
        }
        .display-cart{
            width: 52%;
            display: flex;
            justify-content: end;
            align-items: center;
            flex-direction: row;
            flex-wrap: wrap;
            margin: 5px auto;
            border-bottom: solid black 2px;
        }
        @media(max-width:700px)
        {
            .display-cart{
                width: 100%;
                display: flex;
            justify-content: space-around;
            align-items: center;
            flex-direction: row;
            flex-wrap: wrap;
            margin: 5px 0px;
            border-bottom: solid black 2px;
            }
            .name-cart{
                width: 40%;
            }
            .price-cart{
                width: 40%;
            }
            .qnty-cart{
                width: 20%;
            }
            .img-cart{
                width: 30%;
            }
            .remove-cart{
                width: 30%;
            }
            .display-cart>p{
                margin: 7px 10px;
            }
        }
    </style>
</head>
<body>
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
                <a class="navbar-brand" href="cart.php"><img class="cart-icon" src="../images/iconmonstr-shopping-cart-thin-72.png" alt="cart"><p class="cart-count"><?php if($_SESSION['cartCount'] == ""){$_SESSION['cartCount'] = 0;}if($_SESSION['cartCount'] < 0){$_SESSION['cartCount'] = 0;}echo $_SESSION['cartCount']; ?></p></a>


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
                                    <li><a class="dropdown-item" href="#">Keycaps</a></li>
                                    <li><a class="dropdown-item" href="#">Switches</a></li>
                                    <li><a class="dropdown-item" href="#">Keycaps</a></li>
                                    <li><a class="dropdown-item" href="#">Switches</a></li>
                                    <li><a class="dropdown-item" href="#">Keycaps</a></li>
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
    <?php
    
    //here

    //here
   
    for($i= 0; $i < count(array_unique($_SESSION['arrayId'])); $i++)
    {
      
       
    
       if(array_unique($_SESSION['arrayId']) != $_SESSION['arrayId'] )
    {
        array_splice($_SESSION['arrayId'],$i+1);
        

        //--$_SESSION['cartCount'];
    }


    $sql = "SELECT * FROM mytyper_products WHERE product_id = :getProdId";//create SQL select statement that retrieves all columns of row specified by product id
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':getProdId', array_unique($_SESSION['arrayId'])[$i]);
    $stmt->execute();

    $row=$stmt->fetch();
    if($row['product_name'] == "")
    { 
    }
    else{
    ?>
    <div class=" display-cart">
        <p class="name-cart">Name: <?php echo $row['product_name']; ?></p>
        <p class="price-cart">Price: <?php echo $row['product_price']; ?></p>
        <p class="qnty-carts">Qnty: 1</p>
        <img class="img-cart" style="max-width: 100px;" src="../images/<?php echo $row['product_image'];?>" alt="<?php echo $row['product_description']; ?>">
    <form class="remove-cart" action="cart.php" method="post">
        <input type="hidden" name="remove" value="<?php echo $i?>">
        <button type="submit" style="border: none; background-color:transparent;"><img src="../images/iconmonstr-x-mark-circle-thin-48.png" alt=""></button> 
    </form>
    </div>
    <?php
    }
}
    ?>
    <div class="d-flex justify-content-center">
    <a href="products.php"><button class="buttons">Continue Shopping</button></a>
    <a href="#"><button class="buttons">Checkout</button></a>
    </div>
    <footer>
            <!--Footer section, identical across all pages of this project-->
            &copy;<?php echo date("Y");?>
        </footer>

        <!--Bootstrap JS bundle-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>