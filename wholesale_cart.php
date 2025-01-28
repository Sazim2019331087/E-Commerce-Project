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
    <title>Wholesale Market - Your Cart</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            color: #007bff;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            font-size: 1.2rem;
        }

        td {
            font-size: 1rem;
            color: #333;
        }

        .total-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #28a745;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            font-size: 1.2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .shop-more {
            text-align: center;
            margin-top: 20px;
        }

        .shop-more a {
            font-size: 1rem;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .shop-more a:hover {
            text-decoration: underline;
        }

        .empty-cart {
            text-align: center;
            font-size: 1.2rem;
            color: #dc3545;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Cart Details</h1>
        <form action="wholesale_pay.php" method="POST">
            <input type="hidden" name="tp" value="<?php echo $total_price; ?>">
            <input type="hidden" name="lpc" value="<?php echo $laptop; ?>">
            <input type="hidden" name="mpc" value="<?php echo $mobile; ?>">
            <input type="hidden" name="cpc" value="<?php echo $calculator; ?>">

            <table>
                <tr>
                    <th>Item Name</th>
                    <th>Pieces</th>
                    <th>Price</th>
                </tr>
                <?php 
                if ($laptop !== "0") {
                    echo "<tr><td>Laptop</td><td>$laptop</td><td>$lp BDT</td></tr>";
                }
                if ($mobile !== "0") {
                    echo "<tr><td>Mobile</td><td>$mobile</td><td>$mp BDT</td></tr>";
                }
                if ($calculator !== "0") {
                    echo "<tr><td>Calculator</td><td>$calculator</td><td>$cp BDT</td></tr>";
                }
                if ($mobile === "0" && $laptop === "0" && $calculator === "0") {
                    echo "<tr><td colspan='3' class='empty-cart'>You haven't selected anything.</td></tr>";
                }
                ?>
                <tr>
                    <td colspan="2"><strong>Total Price:</strong></td>
                    <td class="total-price"><?php echo $total_price; ?> BDT</td>
                </tr>
                <tr>
                    <td colspan="1"><strong>Delivery Address:</strong></td>
                    <td colspan="2"><input type="text" name="addr" required></td>
                </tr>
                <tr>
                    <td colspan="3"><input type="submit" value="Confirm & Pay" name="confirm"></td>
                </tr>
            </table>
        </form>

        <div class="shop-more">
            <a href="buy.php">Shop More</a>
        </div>
    </div>
</body>
</html>
