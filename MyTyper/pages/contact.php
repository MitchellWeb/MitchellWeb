<?php
session_start();

$fname = "";
$lname = "";
$customerEmail = "";
$Reason = "";
$msg = "";

function formToAdmin($reason, $message, $email_to)
{
    mail("monesheim@monesheim.com", $reason,$message, "From: ".$email_to);
}

function formToUser($email_to, $reason,$fname,$lname)
{
    mail($email_to,"Confirmation Email", "Thank you ".$fname." ".$lname." We will get back to you about your ".$reason." as soon as possible. Have a great day, -MyTyper", "From: monesheim@monesheim.com");
    echo "A Confirmation Email Has Been sent to ". $email_to;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Place all links under this line-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style_index.css">
    <link rel="stylesheet" href="../CSS/style_global.css">
    <link rel="icon" href="../images/tab_icon.gif">
    <link rel="stylesheet" href="../CSS/contact_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Mono&display=swap" rel="stylesheet">
    <!--Place all links above this line-->
</head>
</script>

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

    <main class="container row">
    <?php
$valid = true;
if(!isset($_POST['submit']))
{
    $fnameRequired = "";
    $lnameRequired = "";
    $emailRequired = "";
    $msgRequired = "";  
    $returnContact = "";
    

?>
        <div class="form-container">
            <form class="contact-form" action="contact.php" method="post">

                <div class="d-flex flex-column">
                    <label for="fname">First Name <?php echo $required?></label>
                    <input type="text" name="fname">
                </div>

                <div class="d-flex flex-column">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname">
                </div>

                <div class="d-flex flex-column email">
                    <label for="email">Email</label>
                    <input type="text" name="email" placeholder="example@domain.com">
                </div>

                <div class="d-flex flex-column reason">
                    <label for="reason">Reason</label>
                    <select name="reason" id="reason"><br>
                        <option value="No Reason Specified">Default</option>
                        <option value="Question">Question</option>
                        <option value="Problem">Problem</option>
                        <option value="Help">Help</option>
                        <option value="Order Inquiry">Order Inquiry</option>
                    </select>
                </div>

                <div class="d-flex flex-column message">
                    <label for="reason">Message</label>
                    <textarea name="message" id="message" rows="6"></textarea>
                </div>

                <div class="d-flex justify-content-between buttons">
                    <input type="submit" name="submit" value="submit">
                    <input type="reset" name="reset" value="clear">
                </div>


            </form>
        </div>
        <?php
        
}
else{
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$customerEmail = $_POST['email'];
$Reason = $_POST['reason'];
$msg = $_POST['message'];

if($fname == "")
{
    $valid = false;
    $fnameRequired = "Missing First Name Required";
    $returnContact = "Return To Contact Page";
}
if($lname == "")
{
    $valid = false;
    $lnameRequired = "Missing Last Name Required";
    $returnContact = "Return To Contact Page";
}
if($customerEmail == "")
{
    $valid = false;
    $emailRequired = "Missing email address Required";
    $returnContact = "Return To Contact Page";
}
if($msg == "")
{
    $valid = false;
    $msgRequired = "Missing Message Field Required";
    $returnContact = "Return To Contact Page";
}

if($valid)
{
  formToAdmin($Reason, $msg, $customerEmail);
formToUser($customerEmail,$reason,$fname,$lname);  
}


}

        ?>
        <div class="d-flex flex-column" style="text-align: center;">
            <p><?php echo $fnameRequired ?></p>
            <p><?php echo $lnameRequired ?></p>
            <p><?php echo $emailRequired ?></p>
            <p><?php echo $msgRequired ?></p>
            <a href="contact.php"><p><?php echo $returnContact ?></p></a>
        </div>
    </main>
    <footer>
        <!--Footer section, identical across all pages of this project-->
        &copy;<?php echo date("Y");?>
    </footer>

    <!--Bootstrap JS bundle-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>