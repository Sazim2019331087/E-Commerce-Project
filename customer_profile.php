<?php 
    require "config.php";
    require "local_time.php";
    session_start();
    $email = $_SESSION["email"];
    $name = $_SESSION["name"];
    $password = $_SESSION["password"];
    $account_number = $_SESSION["account_number"];
    $secret = $_SESSION["secret"];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sylhet IT Shop</title>
    <script src="js/jquery.min.js"></script>
	<link rel="stylesheet"href="assets/styles/profile.css">
</head>
<body>
    <center>
        <div>
            <h1>Sylhet IT Shop</h1>
            <h2>Customer Profile</h2>
            <button><a href="customer_logout.php">Logout</button></a>
        </div>
        <div class="customer_details">
            <?php 
            echo <<<_END
            <h3>Name: $name</h3>
            <br>
            <h3>Email: $email</h3>
            <br>
            <h3>Account Number: <span id='account_number_text'>$account_number</span></h3>
            <br>
            _END;
            ?>
        </div>
        <div id="update_account_number">

        </div>
        <div id="account_number_update">
            <?php 
            if($account_number==="NOT SET")
            {
                echo <<<_END
                <h2>Please Set Your Account Number</h2>
                <br>
                Account Number: <input type='text'id='account_number'>
                <br>
                Secret for transaction: <input type='text'id='secret'> 
                <br>
                <button id='button_set_account_number'name='set_account_number'>SUBMIT</button>
                _END;
            }
            ?>
        </div>
        <div id="shop">
            
        </div>
        <div>
            <h1>My Current Orders</h1>
            <table border="3px"cellspacing="3px"cellpadding="3px"id="dataset1">
                <tr>
                    <th>Payment ID</th>
                    <th>Product Details</th>
                    <th>Total Amount</th>
                    <th>Payment Time</th>
                    <th>Destination</th>
                </tr>
                <?php
                $sql_a = "SELECT * FROM order_details WHERE payment_id IN (SELECT payment_id FROM payment_details WHERE sender_account='$account_number') and status = 'ORDER CONFIRMED'";
                $q_a = mysqli_query($con,$sql_a);
                $t_1 = mysqli_num_rows($q_a);
                while($r_a=mysqli_fetch_assoc($q_a))
                {
                    $pid = $r_a["payment_id"];
                    
                    $payment_time = $r_a["payment_time"];
                    $sql_b = "SELECT * FROM payment_details WHERE payment_id = '$pid'";
                    $q_b = mysqli_query($con,$sql_b);
                    $rb = mysqli_fetch_assoc($q_b);
                    $paid_amount = $rb["amount"];
                    $laptop = $r_a["laptop"];
                    $mobile = $r_a["mobile"];
                    $calculator = $r_a["calculator"];
                    $destination = $r_a["destination"];
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
                        $product_details = $product_details." Calculator: ".$calculator."<br>";
                    }
                    echo <<<_END
                    <tr>
                        <td>$pid</td>
                        <td>$product_details</td>
                        <td>$paid_amount</td>
                        <td>$payment_time</td>
                        <td>$destination</td>
                    </tr>
                    _END;
                }        
                echo <<<_END
                    <tr>
                        <th colspan='5'>You currently have total $t_1 order.</th>
                    </tr>
                    _END;        
                ?>
            </table>
        </div>
        <div>
            <h1>My Past Orders</h1>
            <table border="3px"cellspacing="3px"cellpadding="3px"id="dataset2">
                <?php
                $sql_c = "SELECT * FROM order_details WHERE payment_id IN (SELECT payment_id FROM payment_details WHERE sender_account='$account_number') and status = 'DELIVERED'";
                $q_c = mysqli_query($con,$sql_c);
                $t_2 = mysqli_num_rows($q_c);
                echo <<<_END
                <tr>
                    <th colspan='6'>Total completed order: $t_2</th>
                </tr>
                <tr>
                    <th>Payment ID</th>
                    <th>Product Details</th>
                    <th>Total Amount</th>
                    <th>Payment Time</th>
                    <th>Delivery Time</th>
                    <th>Destination</th>
                </tr>
                
                _END;
                while($r_c=mysqli_fetch_assoc($q_c))
                {
                    $pid2 = $r_c["payment_id"];
                    
                    $payment_time2 = $r_c["payment_time"];
                    
                    $sql_d = "SELECT * FROM payment_details WHERE payment_id = '$pid2'";
                    $q_d = mysqli_query($con,$sql_d);
                    $rd = mysqli_fetch_assoc($q_d);
                    $paid_amount2 = $rd["amount"];
                    $laptop2 = $r_c["laptop"];
                    $mobile2 = $r_c["mobile"];
                    $calculator2 = $r_c["calculator"];
                    $destination2 = $r_c["destination"];
                    $delivery_time2 = $r_c["delivery_time"];
                    $product_details2 = "";
                    if($laptop2!="0")
                    {
                        $product_details2 = $product_details2." Laptop: ".$laptop2."<br>";
                    }
                    if($mobile2!="0")
                    {
                        $product_details2 = $product_details2." Mobile: ".$mobile2."<br>";
                    }
                    if($calculator2!="0")
                    {
                        $product_details2 = $product_details2." Calculator: ".$calculator2."<br>";
                    }
                    echo <<<_END
                    <tr>
                        <td>$pid2</td>
                        <td>$product_details2</td>
                        <td>$paid_amount2</td>
                        <td>$payment_time2</td>
                        <td>$delivery_time2</td>
                        <td>$destination2</td>
                    </tr>
                    _END;
                  
                } 
                               
                ?>
            </table>
        </div>
        
            <script>
                $(document).ready(function(){
					
					if($("#account_number_text").text()!="NOT SET")
					{
						$("#shop").html("<button><a href='market.php'>Go to Shop</a></button>");
					}

                    setInterval(function(){
                        $("#dataset1").load(window.location.href+" #dataset1");
                    },500);
                    setInterval(function(){
                        $("#dataset2").load(window.location.href+" #dataset2");
                    },500);
                    $("#button_set_account_number").click(
                        function(){
                            $.ajax({
                                method: "POST",
                                url: "set_account_number.php",
                                data:{
                                    account_number: $("#account_number").val(),
                                    secret: $("#secret").val()
                                },
                                success:function(data){
                                    $("#account_number_text").text(data);
                                    $("#shop").html("<button><a href='market.php'>Go to Shop</a></button>");
                                    $("#account_number_update").hide();
                                    $("#update_account_number").fadeIn(1000);
                                    $("#update_account_number").text("Account Number & Secret Updated!!");
                                    $("#update_account_number").css({"color":"green","fontSize":"15px"});
                                    $("#update_account_number").delay(3000);
                                    $("#update_account_number").fadeOut(1000);
                                }

                            });
                        }
                    );
                });
            </script>
        
    </center>
</body>
</html>