<?php
    session_start();

    $currentPage = 'dashboard.php';
    include "navigation.php";
    
    $date= date('Y-m-d', strtotime('-7 days'));
    $conn = connect();
    
    $sql= "SELECT * from products WHERE updated_at>'$date'";
    $prod= $conn->query($sql);
?>

<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=10" >

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/product.css">
        <link rel="stylesheet" type="text/css" href="../css/navigation.css">
        <title>Dashboard</title>
    </head>
    <body style="background-image: url('../img/bg6.jpg');background-size:100vmax;" >
        <div class="row" style="padding: 40px;">    
            <div class="leftcolumn">
                <?php include('product_cards.php')?>
            </div>
            <?php include('side_info.php')?>
        </div>
        
    </body>
    
</html>