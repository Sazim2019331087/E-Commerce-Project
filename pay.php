<?php
require "config.php";
require "local_time.php";
require "admin_details.php";

$total_price = $_POST["tp"];
session_start();
$email = $_SESSION["email"];
$name = $_SESSION["name"];
$password = $_SESSION["password"];
$account_number = $_SESSION["account_number"];
$secret = $_SESSION["secret"];
$ecommerce_account = $admin_account_number;
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
        form {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 60%;
            border-radius: 8px;
            margin: 0 auto;
        }
        input[type="text"] {
            padding: 8px;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        #pay, #cancel_payment, #clear {
            padding: 12px 25px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 50%;
            margin: 10px auto;
            display: block;
        }
        #pay {
            background-color: #4CAF50;
            color: white;
        }
        #pay:hover {
            background-color: #45a049;
        }
        #cancel_payment {
            background-color: #FF5733;
            color: white;
        }
        #cancel_payment:hover {
            background-color: #e24d29;
        }
        #clear {
            background-color: #f1f1f1;
            color: #333;
            border: 1px solid #ccc;
        }
        #clear:hover {
            background-color: #ddd;
        }
        #result {
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }
    </style>
</head>

<body>
    <center>
        <div class="container">
            <h1>Payment Finalize</h1>
            <form action="" method="POST">
                <?php
                echo "<p>You are going to pay <strong>$total_price</strong> BDT from account number: <strong>$account_number</strong> of <strong>SUSTAINABLE BANK LTD</strong></p>";
                ?>
                <input type="text" id="sender" value="<?php echo $account_number; ?>" hidden>
                <input type="text" id="receiver" value="<?php echo $ecommerce_account; ?>" hidden>
                <input type="text" id="amount" value="<?php echo $total_price; ?>" hidden>
                <input type="text" id="time" value="<?php echo $time; ?>" hidden>
                <input type="text" id="actual_secret" value="<?php echo $secret; ?>" hidden>
                <label for="secret_pin">Transaction Secret:</label>
                <input type="text" id="secret_pin" required><br>
                <input type="submit" value="Pay" id="pay">
                <input type="reset" value="Clear" id="clear">
            </form>
            <button id="cancel_payment">Cancel Payment</button>
            <div id="result"></div>
        </div>
    </center>

    <script>
        $(document).ready(function () {
            $("#pay").click(function (event) {
                // Prevent default form submission
                event.preventDefault();

                $.ajax({
                    method: "POST",
                    url: "transaction.php",
                    data: {
                        sender: $("#sender").val(),
                        receiver: $("#receiver").val(),
                        amount: $("#amount").val(),
                        time: $("#time").val(),
                        actual_secret: $("#actual_secret").val(),
                        secret_pin: $("#secret_pin").val(),
                        lpc: "<?php echo $_POST["lpc"]?>",
                        mpc: "<?php echo $_POST["mpc"]?>",
                        cpc: "<?php echo $_POST["cpc"]?>",
                        addr: "<?php echo $_POST["addr"]?>"
                    },
                    success: function (response) {
                        const data = JSON.parse(response);
                        $("#result").fadeIn(1000);
                        $("#result").text(data.status + ". You will be auto redirected in 5 seconds...");
                        $("#result").css({ "color": data.color, "fontSize": "15px" });

                        // Redirect after 5 seconds
                        setTimeout(function () {
                            window.location = "market.php";
                        }, 5000);
                    }
                });
            });

            $("#cancel_payment").click(function () {
                $("#result").fadeIn(1000);
                $("#result").text("Payment Cancelled by You. You'll be redirected in 5 seconds...");
                $("#result").css({ "color": "red", "fontSize": "15px" });

                // Redirect after 5 seconds
                setTimeout(function () {
                    window.location = "market.php";
                }, 5000);
            });
        });
    </script>
</body>
</html>
