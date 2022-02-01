<!DOCTYPE html>
<html lang="en">
<!--WOrked with Brandon Treu on this assingment-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Bascis</title>
    <?php //variables
       $yourName = "Mitchell";
       $number1 = 5;
       $number2 = 10;
       $total = $number1+$number2;
       $tools = array('PHP','HTML','Javascript');
      
    ?>
</head>

<body>
    <?php echo "<h1>3-1: PHP Basics</h1>"?>
    <h2><?php echo $yourName ?></h2>
    <p><?php echo $number1 ?></p>
    <p><?php echo $number2 ?></p>
    <p><?php echo $total ?></p>
    
    <?php foreach ($tools as $language)
    {
       echo "$language <br>";
    } ?>
    <script>
        const newArray = ["PHP", "HTML", "Javascript"];
        document.write(newArray);
    </script>
</body>

</html>