<?php
require "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/styles/admin.css"> <!-- Link to the CSS file -->
    <title>Sylhet IT Shop</title>
</head>

<body>
    <center>
        <div>
            <h1>Welcome Admin</h1>
            <h2><a href="index.html"><button>Logout</button></a></h2>
        </div>

        <div>
            <h1>Order Details</h1>
            <table border="3px" cellspacing="3px" cellpadding="3px" id="dataset">
                <tr>
                    <th>Payment ID</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Account Number</th>
                    <th>Total Amount</th>
                    <th>Payment Time</th>
                    <th>Product Details</th>
                    <th>Destination</th>
                    <th>Action</th>
                </tr>
                <?php
                $sql1 = "SELECT * FROM order_details WHERE status='ORDER CONFIRMED'";
                $q1 = mysqli_query($con, $sql1);
                $tr1 = mysqli_num_rows($q1);
                $laptop_in_demand = 0;
                $mobile_in_demand = 0;
                $calculator_in_demand = 0;
                
                //$r1 = mysqli_fetch_assoc($q1);
                $i = 0;
                while($r1 = mysqli_fetch_assoc($q1)) 
                {
                    $pay_id = $r1["payment_id"];
                    $laptop = $r1["laptop"];
                    $mobile = $r1["mobile"];
                    $calculator = $r1["calculator"];
                    $payment_time = $r1["payment_time"];
                    $destination = $r1["destination"];
                    
                    $laptop_in_demand = $laptop_in_demand + ((int)$laptop);
                    $mobile_in_demand = $mobile_in_demand + ((int)$mobile);
                    $calculator_in_demand = $calculator_in_demand + ((int)$calculator);
                    
                    $sql2 = "SELECT * FROM payment_details WHERE payment_id='$pay_id'";
                    $q2 = mysqli_query($con, $sql2);
                    $r2 = mysqli_fetch_assoc($q2);
                    
                    $customer_account_number = $r2["sender_account"];
                    $total_amount = $r2["amount"];

                    //echo $customer_account_number;
                    
                    $sql3 = "SELECT * FROM customer_details WHERE account_number='$customer_account_number'";
                    $q3 = mysqli_query($con, $sql3);
                    $r3 = mysqli_fetch_assoc($q3);
                    $customer_email = $r3["email"];
                    $customer_name = $r3["name"];
                    
                    $product_details = "";
                    if($laptop!="0")
                    {
                        $product_details = $product_details." Laptop: ".$laptop."<br>";
                    }
                    if($mobile!="0")
                    {
                        $product_details = $product_details." Mobile: ".$mobile."<br>";
                    }
                    if($calculator!="0")
                    {
                        $product_details = $product_details." Calculator: ".(int)$calculator."\n";
                    }
                    //echo $product_details;
                    echo <<<_END
                    <tr align='center'>
                        <th>$pay_id</th>
                        <td>$customer_name</td>
                        <td>$customer_email</td>
                        <td align='center'>$customer_account_number</td>
                        <td align='center'>$total_amount</td>
                        <td>$payment_time</td>
                        <td>$product_details</td>
                        <td>$destination</td>
                        <td><a href='delivery.php?pay_id=$pay_id'><button>DELIVER</button></a></td>
                    </tr>
                    _END;
                }
                echo <<<_END
                <tr>
                <th colspan="9">Total Due Order : $tr1</th>
                </tr>
                _END;
                ?>
            </table>
        </div>
        <div>
            <h1>Stock Details</h1>
        </div>
        <div>
            <table border="3px" cellspacing="3px" cellpadding="3px" id="stock_details">
                <tr>
                    <th>Product</th>
                    <th>Demand</th>
                    <th>Stock</th>
                    <th>Shortage</th>
                    <th>Excess</th>
                    <th>Action</th>
                </tr>
                <?php 
                $sql4 = "SELECT * FROM product_details WHERE product_id = '111'";
                $sql5 = "SELECT * FROM product_details WHERE product_id = '222'";
                $sql6 = "SELECT * FROM product_details WHERE product_id = '333'";
                $q4 = mysqli_query($con,$sql4);
                $q5 = mysqli_query($con,$sql5);
                $q6 = mysqli_query($con,$sql6);
                $r4 = mysqli_fetch_assoc($q4);
                $r5 = mysqli_fetch_assoc($q5);
                $r6 = mysqli_fetch_assoc($q6);
                $laptop_in_stock = $r4["total_pieces"];
                $mobile_in_stock = $r5["total_pieces"];
                $calculator_in_stock = $r6["total_pieces"];
                $laptop_in_shortage = 0;
                $mobile_in_shortage = 0;
                $calculator_in_shortage = 0;
                
                $laptop_in_excess = 0;
                $mobile_in_excess = 0;
                $calculator_in_excess = 0;
                
                if ($laptop_in_stock<$laptop_in_demand)
                {
                    $laptop_in_shortage = $laptop_in_demand - $laptop_in_stock;
                }
                else{
                    $laptop_in_excess = $laptop_in_stock - $laptop_in_demand;
                }
                if ($mobile_in_stock<$mobile_in_demand)
                {
                    $mobile_in_shortage = $mobile_in_demand - $mobile_in_stock;
                }
                else{
                    $mobile_in_excess = $mobile_in_stock - $mobile_in_demand;
                }
                if ($calculator_in_stock<$calculator_in_demand)
                {
                    $calculator_in_shortage = $calculator_in_demand - $calculator_in_stock;
                }
                else{
                    $calculator_in_excess = $calculator_in_stock - $calculator_in_demand;
                }

                echo <<<_END
                <tr align='center'>
                    <td>Laptop</td>
                    <td>$laptop_in_demand</td>
                    <td>$laptop_in_stock</td>
                    <td>$laptop_in_shortage</td>
                    <td>$laptop_in_excess</td>
                    <td><a href='buy.php?product_id=111'><button>ADD</button></a></td>
                </tr>
                <tr align='center'>
                    <td>Mobile</td>
                    <td>$mobile_in_demand</td>
                    <td>$mobile_in_stock</td>
                    <td>$mobile_in_shortage</td>
                    <td>$mobile_in_excess</td>
                    <td><a href='buy.php?product_id=222'><button>ADD</button></a></td>
                </tr>
                <tr align='center'>
                    <td>Calculator</td>
                    <td>$calculator_in_demand</td>
                    <td>$calculator_in_stock</td>
                    <td>$calculator_in_shortage</td>
                    <td>$calculator_in_excess</td>
                    <td><a href='buy.php?product_id=333'><button>ADD</button></a></td>
                </tr>
                _END;
                ?>
            </table>
        </div>
    </center>
	    <script>
        $(document).ready(function(){
            setInterval(function(){
                $("#dataset").load(window.location.href+" #dataset");
            },500);
            setInterval(function(){
                $("#stock_details").load(window.location.href+" #stock_details");
            },500);
        });
    </script>
</body>

</html>
