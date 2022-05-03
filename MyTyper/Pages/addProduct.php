<?php
session_start();

if(isset($_SESSION['validUser'])){
    
    
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
        <link rel="icon" href="../images/tab_icon.gif">
        <link rel="stylesheet" href="../CSS/adminControl.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style_global.css">
        <title>Add Product</title>
        <style>
            table tr:nth-child(odd)
            {
                background-color: #a9a9a9;
            }
            table{
                border-spacing: 0px;
                max-height: 300px;
                height: 300px;
                overflow-y: scroll;
            }
            table tr:nth-of-type(2){
                background-color:#a3ff7f;
            }
            td{
             border-left: 2px solid black;
             
            }
            th{
                text-align: center;
            }
            td.name{
                width: 200px;
                max-width: 200px;
            }
            td.price{
                max-width: 70px ;
                width: 70px;
            }
            td.description{
                max-width: 500px ;
                width: 500px;
            }
            .error{
                color: red;
            }
            body{
                margin-left: auto;
                margin-right: auto;
            }

        </style>
    </head>
<?php
$validForm = "";
$nameError = "";
$priceError = "";
$descError = "";
$imageError = "";
$qntyError = "";
$catError = "";
$name = "";
$price = "";
$desc = "";
$image = "";
$qnty = "";
$cat = "";

if(isset($_POST['submit'])){
    $validForm = true;
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }    
//create insert statement to insert new row into table

require '../PHP/connectPDO.php';
//style

$_65 = "";
$_70 = "";
$_80 = "";
$full = "";



$name = $_POST['product_name'];
$price = $_POST['product_price'];
$desc = $_POST['product_description'];
$image = $_FILES["fileToUpload"]["name"];
$qnty = $_POST['product_quantity'];
$cat = $_POST['product_category'];

if($name == "")
{
    $validForm = false;
    $nameError = "Product Name Required";
}
if($price == "")
{
    $validForm = false;
    $priceError = "Product Price Required";
}
if($desc == "")
{
    $validForm = false;
    $descError = "Product Description Required";
}
if($image == "")
{
    $validForm = false;
    $imageError = "Product Image Required";
}
if($qnty == "")
{
    $validForm = false;
    $qntyError = "Product Quantity Required";
}
if($cat == "")
{
    $validForm = false;
    $catError = "Product Category Required";
}




if(!isset($_POST['65']))
{
    $_65 == 0;
}
else{
   $_65 = $_POST['65'];
}

if(!isset($_POST['70']))
{
    $_70 == 0;
}
else{
    
   $_70 = $_POST['70'];
}

if(!isset($_POST['80']))
{
    $_80 == 0;
}
else{
   $_80 = $_POST['80'];
}

if(!isset($_POST['full']))
{
    $full == 0;
}
else{
   $full = $_POST['full'];
}

$sqlCheck = "SELECT product_name FROM mytyper_products WHERE product_name = :productNameCheck";
$checkStmt = $conn->prepare($sqlCheck);
$checkStmt->bindParam(':productNameCheck', $name);
$checkStmt->execute();
$checkCount = $checkStmt->rowCount();
echo $checkRow;
if($checkCount>0)
{
   
    $validForm = false;
    echo "<script>alert('Error: Duplicate Entry Detected');</script>";
}
else{

if($validForm){
$sql = "INSERT INTO mytyper_products (product_name, product_price, product_description, product_image, product_quantity, product_category, product_65, product_70, product_80, product_full) VALUES (:name, :price, :desc, :image, :qnty, :cat, :_65, :_70, :_80, :full)";

$stmt = $conn->prepare($sql);

$stmt->bindParam(':name', $name);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':desc', $desc);
$stmt->bindParam(':image', $image);
$stmt->bindParam(':qnty', $qnty);
$stmt->bindParam(':cat', $cat);
$stmt->bindParam(':_65',$_65);
$stmt->bindParam(':_70',$_70);
$stmt->bindParam(':_80',$_80);
$stmt->bindParam(':full',$full);

$stmt->execute(); 
$count = $stmt->rowCount();
if($count>0)
{
    echo "<script>alert('Successful Entry')</script>";
    $name = "";
    $price = "";
    $desc = "";
    $image = "";
    $qnty = "";
    $cat = "";
}
else{
    echo "<script>alert('Entry was unsuccessful')</script>";
}
}
}
}
?>
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
        <div>
        <div>
        <a href="adminLogin.php"><img src="../images/iconmonstr-arrow-left-lined-96.png" alt=""></a>
    </div>
            <h1>Add Product</h1>
            <form style="background-color: white;" class="add-form" method="post" action="addProduct.php" enctype="multipart/form-data">
                <p>
                    <label for="product_name">Prouct name:</label><br>
                    <h1 class="error"><?php echo $nameError?></h1>
                    <input type="text" name="product_name" id="product_name" value="<?php echo $name?>"/><br>
                </p>
                <p>
                    <label for="product_price">Prouct price:</label><br>
                    <h1 class="error"><?php echo $priceError?></h1>
                    <input type="text" name="product_price" id="product_price" value="<?php echo $price?>"  /><br>
                </p>
                <p>
                    <label for="product_description">Prouct description:</label><br>
                    <h1 class="error"><?php echo $descError?></h1>
                    <textarea type="text" name="product_description" id="product_description" rows="6" cols="21" ></textarea><br>
                </p>
                <p>
                    <input type="file" name="fileToUpload" id="fileToUpload"  />
                    <h1 class="error"><?php echo $imageError?></h1>
                </p>
                <p>
                    <label for="product_quantity">Prouct quantity:</label><br>
                    <h1 class="error"><?php echo $qntyError?></h1>
                    <input type="text" name="product_quantity" id="product_quantity" value="<?php echo $qnty?>" /><br>
                </p>
                <p>
                
                    <label for="product_category">Prouct category:</label><br>
                    <h1 class="error"><?php echo $catError?></h1>
                    <select name="product_category" id="product_category" ><br>
                    <option value="<?php echo $cat?>"><?php echo $cat ?></option>
                <option value="case">case</option>
                <option value="keycaps">keycaps</option>
                <option value="switch">switch</option>
                <option value="plate">plate</option>
                <option value="pcb">pcb</option>
                <option value="accessories">accessories</option>
                    </select><br>
                </p>

                <h2>Sizes</h2>
                <p>
                    <label for="65">65%</label>
                    <input type="checkbox" id="65" name="65" value="1">
                </p>
                <p>
                    <label for="70">70%</label>
                    <input type="checkbox" id="70" name="70" value="1">
                </p>
                <p>
                    <label for="80">80%</label>
                    <input type="checkbox" id="80" name="80" value="1">
                </p>
                <p>
                    <label for="full">full</label>
                    <input type="checkbox" id="full" name="full" value="1">
                </p>
                <br><input type="submit" name="submit" value="Add Product">
            </form>

        </div>
        <!--List of all products entered in the database, refreshes everytime form is submitted-->
        <div id="productList" style="background-color: white;">
            <h1>Products</h1>
            <?php
            
                require '../PHP/connectPDO.php';
                $setGreen = "";

                $log = "SELECT product_name, product_price, product_description, product_image, product_quantity, product_category, product_65, product_70, product_80, product_full FROM mytyper_products ORDER BY product_id DESC";
                $logStmt = $conn->prepare($log);
                $logStmt->execute();
                $logStmt->setFetchMode(PDO::FETCH_ASSOC);
                 echo "<table>";
                    echo "<tr>";
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
                   

                        echo "<tr>";
                            echo "<td class='name'>".$row['product_name']."</td>";
                            echo "<td class='price'>".$row['product_price']."</td>";
                            echo "<td class='description'>".$row['product_description']."</td>";
                            echo "<td class='image'>".$row['product_image']."</td>";
                            echo "<td class='quantity'>".$row['product_quantity']."</td>";
                            echo "<td class='category'>".$row['product_category']."</td>";
                            echo "<td class='category'>".$has65."</td>";
                            echo "<td class='category'>".$has70."</td>";
                            echo "<td class='category'>".$has80."</td>";
                            echo "<td class='category'>".$hasFull."</td>";
                        echo "</tr>";
                    //SELECT * FROM Table ORDER BY ID DESC LIMIT 1
                    //find/stop on last row
                    //two selects
                    
                    
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