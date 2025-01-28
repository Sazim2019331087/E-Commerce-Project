<?php
require "config.php";
require "local_time.php";

$laptop = $_GET["laptop"];
$mobile = $_GET["mobile"];
$calculator = $_GET["calculator"];
$lp = $_GET["lp"];
$mp = $_GET["mp"];
$cp = $_GET["cp"];

$total_price = (int)$lp +  (int)$mp +  (int)$cp;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.min.js"></script>
    <title>Sylhet IT Shop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        center {
            margin-top: 50px;
        }
        h1 {
            color: #4CAF50;
            margin-bottom: 30px;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        td {
            background-color: #f9f9f9;
        }
        input[type="text"] {
            padding: 8px;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .button {
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 4px;
            display: block;
            width: 80%;
            margin: 20px auto;
            cursor: pointer;
            text-align: center;
        }
        .confirm-button {
            background-color: #4CAF50;
            color: white;
            border: none;
        }
        .confirm-button:hover {
            background-color: #45a049;
        }
        .shop-more-button {
            background-color: #007BFF;
            color: white;
            border: none;
        }
        .shop-more-button:hover {
            background-color: #0056b3;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .cart-summary {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <center>
        <form action="pay.php" method="POST">
            <div class="container">
                <h1>Your Cart Details</h1>
                <input type="text" name="tp" value="<?php echo $total_price;?>" hidden>
                <input type="text" name="lpc" value="<?php echo $laptop;?>" hidden>
                <input type="text" name="mpc" value="<?php echo $mobile;?>" hidden>
                <input type="text" name="cpc" value="<?php echo $calculator;?>" hidden>

                <table border="1">
                    <tr>
                        <th>Item Name</th>
                        <th>Pieces</th>
                        <th>Price</th>
                    </tr>
                    <?php 
                    if($laptop !== "0") {
                        echo "<tr>
                                <td>Laptop</td>
                                <td>$laptop</td>
                                <td>$lp BDT</td>
                              </tr>";
                    }
                    if($mobile !== "0") {
                        echo "<tr>
                                <td>Mobile</td>
                                <td>$mobile</td>
                                <td>$mp BDT</td>
                              </tr>";
                    }
                    if($calculator !== "0") {
                        echo "<tr>
                                <td>Calculator</td>
                                <td>$calculator</td>
                                <td>$cp BDT</td>
                              </tr>";
                    }
                    if($mobile === "0" && $laptop === "0" && $calculator === "0") {
                        echo "<tr>
                                <td colspan='3'>You haven't selected anything</td>
                              </tr>";
                    }
                    ?>
                    <tr>
                        <th colspan="2">Total Price:</th>
                        <th><?php echo $total_price;?> BDT</th>
                    </tr>
                    <tr>
                        <th colspan="1">Delivery Address:</th>
                        <th colspan="2"><input type="text" name="addr" required></th>
                    </tr>
                </table>

                <input type="submit" value="Confirm & Pay" name="confirm" class="button confirm-button">
            </div>
        </form>
        <div>
            <a href="market.php"><button class="button shop-more-button">Shop More</button></a>
        </div>
    </center>
</body>
</html>
