<?php
require "config.php";
require "local_time.php";
$account_number = $_GET["account_number"];
$sql = "SELECT * FROM bank_details WHERE account_number='$account_number'";
$q = mysqli_query($con, $sql);
$r = mysqli_fetch_assoc($q);
$name = $r["name"];
$email = $r["email"];
$balance = $r["current_balance"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.min.js"></script>
    <title>SUSTainable Bank</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #3498db;
        }

        .header h2 {
            color: #555;
        }

        .account-details {
            font-size: 16px;
            margin: 20px 0;
        }

        .account-details p {
            margin: 10px 0;
        }

        .account-details b {
            font-weight: bold;
            color: #3498db;
        }

        .logout-btn {
            display: block;
            width: 100%;
            padding: 12px;
            text-align: center;
            background-color: #3498db;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #2980b9;
        }

        .balance-updating {
            color: #e74c3c;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>SUSTAINABLE BANK LTD</h1>
            <h2>Account Details</h2>
        </div>

        <div class="account-details">
            <input type="text" id="user_account_number" value="<?php echo $account_number; ?>" hidden>

            <p>Account Holder Name: <b><?php echo $name; ?></b></p>
            <p>Account Holder Email: <b><?php echo $email; ?></b></p>
            <p>Account Number: <b><?php echo $account_number; ?></b></p>
            <p>Total Balance: <b id="user_current_balance"><?php echo $balance; ?></b> BDT</p>

            <button class="logout-btn" onclick="window.location.href='bank_login.php'">Logout</button>
        </div>

        <div class="balance-updating" id="balance-updating-message"></div>
        
        <div
            style="background-color: #f4f4f9; border: 1px solid #ddd; padding: 20px; border-radius: 8px; margin: 20px auto; width: 90%; max-width: 800px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">

            <h1 style="font-size: 1.8rem; color: #007bff; text-align: center; margin-bottom: 20px;">All Transactions
            </h1>
            <?php 
            $sql_all_transactions = "
            SELECT 
            payment_id,
            sender_account,
            receiver_account,
            amount,
            payment_time,
            status,
            CASE
                WHEN sender_account = '$account_number' THEN 'SENT'
                WHEN receiver_account = '$account_number' THEN 'RECEIVED'
            END AS transaction_type
            FROM 
            payment_details
            WHERE 
                sender_account = '$account_number' 
                OR receiver_account = '$account_number';
            ";
            $query_all_transactions = mysqli_query($con,$sql_all_transactions);
            $total_row = mysqli_num_rows($query_all_transactions);

            ?>
            <table id="all_transactions"
                style="width: 100%; border-collapse: collapse; text-align: center; font-size: 1rem;">
                <thead>
                    <tr style="background-color: #007bff; color: white;">
                        <th colspan="4" style="padding: 10px; font-size: 1.2rem;">Total Transactions: <?php echo $total_row;?></th>
                    </tr>
                    <tr style="background-color: #f8f9fa; color: #333;">
                        <th style="padding: 10px; border: 1px solid #ddd;">Payment ID</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Sender Account</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Total Amount</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while($row = mysqli_fetch_assoc($query_all_transactions))
                    {
                        $payment_id = $row["payment_id"];
                        $sender = $row["sender_account"];
                        $receiver = $row["receiver_account"];
                        $payment_time = $row["payment_time"];
                        $payment_type = $row["transaction_type"];
                        $payment_amount = $row["amount"];
                        $acc = "";
                        $payment_symbol = "";
                        if($payment_type==="SENT")
                        {
                            $acc = $receiver;
                            $payment_symbol = "<font color='red'><b>-".$payment_amount." TK</b></font>";
                        }
                        if($payment_type==="RECEIVED")
                        {
                            $acc = $sender;
                            $payment_symbol = "<font color='green'><b>+".$payment_amount." TK</b></font>";                            
                        }
                        
                        echo <<<_END
                        <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">$payment_id</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">$acc</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">$payment_symbol</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">$payment_time</td>
                        </tr>
                        _END;
                    }
                    ?>
                </tbody>
            </table>
        </div>


        <script>
            $(document).ready(function () {
                //event.preventDefault();
                setInterval(function () {
                    $("#all_transactions").load(window.location.href + " #all_transactions");
                }, 1000);
                setInterval(function () {
                    $.ajax({
                        method: "POST",
                        url: "balance_check.php",
                        data: {
                            account_number: $("#user_account_number").val(),
                        },
                        success: function (data) {
                            $("#user_current_balance").text(data);
                            if (data !== '<?php echo $balance; ?>') {
                            $("#balance-updating-message").text("Balance Updated...").fadeOut('slow');
                            }
                        }
                    });
                }, 2000);
            });
        </script>
    </div>

</body>

</html>