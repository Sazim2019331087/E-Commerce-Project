<?php
require "config.php";
require "local_time.php";
require "admin_details.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.min.js"></script>
    <title>Supplier Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-top: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 30px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #2980b9;
        }

        .total-supply {
            font-weight: bold;
            font-size: 18px;
            background-color: #eaf1f8;
            padding: 10px;
        }

        .logout-btn {
            background-color: #e74c3c;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 4px;
            color: white;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        .action-column {
            width: 150px;
        }

        #dataset {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome Supplier</h1>
        <h2><a href="index.html" class="logout-btn">Logout</a></h2>

        <div>
            <h2>Order Details</h2>
            <table id="dataset">
                <thead>
                    <tr>
                        <th>Payment ID</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Account Number</th>
                        <th>Total Amount</th>
                        <th>Payment Time</th>
                        <th>Product Details</th>
                        <th>Destination</th>
                        <th class="action-column">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql1 = "SELECT * FROM payment_details WHERE sender_account='$admin_account_number' and receiver_account='$supplier_account_number'";
                    $q1 = mysqli_query($con, $sql1);
                    $tr1 = mysqli_num_rows($q1);
                    while ($r1 = mysqli_fetch_assoc($q1)) {
                        $pay_id = $r1["payment_id"];
                        $amount = $r1["amount"];
                        $sql2 = "SELECT * FROM order_details WHERE payment_id = '$pay_id'";
                        $q2 = mysqli_query($con, $sql2);
                        $r2 = mysqli_fetch_assoc($q2);
                        $laptop = $r2["laptop"];
                        $mobile = $r2["mobile"];
                        $calculator = $r2["calculator"];
                        $payment_time = $r2["payment_time"];
                        $destination = $r2["destination"];
                        $product_details = "";

                        if ($laptop != "0") {
                            $product_details = $product_details . "Laptop: " . $laptop . "<br>";
                        }
                        if ($mobile != "0") {
                            $product_details = $product_details . "Mobile: " . $mobile . "<br>";
                        }
                        if ($calculator != "0") {
                            $product_details = $product_details . "Calculator: " . (int)$calculator . "<br>";
                        }
                        echo <<<END
                        <tr>
                            <td>$pay_id</td>
                            <td>$admin_name</td>
                            <td>$admin_email</td>
                            <td>$admin_account_number</td>
                            <td>$amount</td>
                            <td>$payment_time</td>
                            <td>$product_details</td>
                            <td>$destination</td>
                            <td class="action-column"><a href='supply.php?pay_id=$pay_id'><button>SUPPLY</button></a></td>
                        </tr>
                    END;
                    }
                    echo <<<END
                    <tr>
                        <td colspan='9' class="total-supply">Total Due Supply: $tr1</td>
                    </tr>
                END;
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            setInterval(function () {
                $("#dataset").load(window.location.href + " #dataset");
            }, 500);
        });
    </script>
</body>

</html>
