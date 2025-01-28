<?php
require "config.php";
require "local_time.php";
require "admin_details.php";

$total_price = $_POST["tp"];
$email = $admin_email;
$name = $admin_name;
$account_number = $admin_account_number;
$secret = $admin_secret;
$ecommerce_account = $supplier_account_number;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.min.js"></script>
    <title>Wholesale Market</title>
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
            padding-top: 20px;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 30px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .payment-info {
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 1.5;
        }
        .payment-info b {
            color: #2c3e50;
        }
        .form-group {
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        /* Shorter Transaction Secret input field */
        #secret_pin {
            width: 50%;
        }
        input[type="submit"], input[type="reset"], #cancel_payment {
            background-color: #3498db;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
        }
        input[type="submit"]:hover, input[type="reset"]:hover, #cancel_payment:hover {
            background-color: #2980b9;
        }
        #result {
            margin-top: 20px;
            font-size: 16px;
            text-align: center;
        }
        #cancel_payment {
            background-color: #e74c3c;
            margin-top: 10px;
        }
        #cancel_payment:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <center>
        <div class="container">
            <h1>Payment Finalize</h1>
            <div class="payment-info">
                <?php
                echo "You are going to pay <b>$total_price BDT</b> from account number: <b>$account_number</b> of <b>SUSTAINABLE BANK LTD</b>";
                ?>
            </div>
            <form action="" method="POST">
                <input type="text" id="sender" value="<?php echo $account_number; ?>" hidden>
                <input type="text" id="receiver" value="<?php echo $ecommerce_account;?>" hidden>
                <input type="text" id="amount" value="<?php echo $total_price; ?>" hidden>
                <input type="text" id="time" value="<?php echo $time; ?>" hidden>
                <input type="text" id="actual_secret" value="<?php echo $secret; ?>" hidden>

                <div class="form-group">
                    <label for="secret_pin">Transaction Secret:</label>
                    <input type="text" id="secret_pin" name="secret_pin" required>
                </div>

                <div class="form-group">
                    <input type="submit" value="Pay" id="pay">
                    <input type="reset" value="Clear" name="clear">
                </div>
            </form>

            <div id="result"></div>

            <div>
                <button id="cancel_payment">Cancel Payment</button>
            </div>
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
                            window.location = "buy.php";
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
                    window.location = "buy.php";
                }, 5000);
            });
        });
    </script>
</body>
</html>
