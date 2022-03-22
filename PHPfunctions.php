<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $time = time();
        echo(date("m-d-Y",$time)) . "<br>";
        
    ?>
    <?php
    
    $Itime = gmdate("d-m-Y") . "<br>";
    echo($Itime);
?>
<?php
    function stringMod()
    {
        $str = "This is a test string that includes the word dmacc";
        echo "This is the original string: " . $str . "<br>";
        echo 'The length of the original string is ' . strlen($str) . "<br>";
        echo 'This line has no white space'.ctype_space($str)."<br>";
        echo 'The following string is in all lowercase: '.strtolower($str)."<br>";
        if (str_contains(strtoupper($str), 'DMACC')) { 
            echo 'The original string contains the word DMACC <br>';
        }
        else
        {
            echo 'The original string does not contain the word DMACC <br>';
        }
        
    }
    stringMod() . "<br>";
?>
<?php

    function phoneNum()
    {
        $phoneNum = 1234567890;
        echo substr($phoneNum, 0,3) . "-" . substr($phoneNum, 3,3) . "-" . substr($phoneNum, 6,4);
    }
    phoneNum();
?> 
        
<?php
function formatUSD()
{
    $money = 123456;
    echo "You have this much money: $money <br>";
    echo 'This is your money formatted: $' . number_format($money, 2);
}
formatUSD();

?>
      
    

</body>
</html>