<?php 
require "config.php";
require "local_time.php";
$pay_id = $_GET["pay_id"];
$delivery_time = $time;

$sql1 = "SELECT * FROM order_details WHERE payment_id = '$pay_id';";
$q1 = mysqli_query($con,$sql1);
$r1 = mysqli_fetch_assoc($q1);

$laptop = $r1["laptop"];
$mobile = $r1["mobile"];
$calculator = $r1["calculator"];

$sql_l = "SELECT * FROM product_details WHERE product_id = '111'";
$sql_m = "SELECT * FROM product_details WHERE product_id = '222'";
$sql_c = "SELECT * FROM product_details WHERE product_id = '333'";

$redirect = "1";

if($laptop!="0")
{
    $q_l = mysqli_query($con,$sql_l);
    $r_l = mysqli_fetch_assoc($q_l);
    $total_laptop = $r_l["total_pieces"];
    $total_laptop_remain = (int)$total_laptop - (int)$laptop;

    if((int)$total_laptop_remain<0)
    {
        $total_laptop_need = (int)$laptop - (int)$total_laptop;
        echo<<<_END
        <center>
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 15px;">
                <h1 style="font-size: 1.5rem; margin: 0;">Laptop Shortage</h1>
                <p style="font-size: 1rem; margin: 5px 0;">You need $total_laptop_need laptop more to deliver.</p>
            </div>
        </center>
        _END;
        $redirect="0";
    }
    else
    {
        $sql_update_laptop = "UPDATE product_details SET total_pieces = $total_laptop_remain WHERE product_id = '111'";
        $q_update_laptop = mysqli_query($con,$sql_update_laptop);
    }
}

if($mobile!="0")
{
    $q_m = mysqli_query($con,$sql_m);
    $r_m = mysqli_fetch_assoc($q_m);
    $total_mobile = $r_m["total_pieces"];
    $total_mobile_remain = (int)$total_mobile - (int)$mobile;

    if((int)$total_mobile_remain<0)
    {
        $total_mobile_need = (int)$mobile - (int)$total_mobile;
        echo<<<_END
        <center>
            <div style="background-color: #fff3cd; color: #856404; padding: 10px; border: 1px solid #ffeeba; border-radius: 5px; margin-bottom: 15px;">
                <h1 style="font-size: 1.5rem; margin: 0;">Mobile Shortage</h1>
                <p style="font-size: 1rem; margin: 5px 0;">You need $total_mobile_need mobile more to deliver.</p>
            </div>
        </center>
        _END;
        $redirect="0";
    }
    else
    {
        $sql_update_mobile = "UPDATE product_details SET total_pieces = $total_mobile_remain WHERE product_id = '222'";
        $q_update_mobile = mysqli_query($con,$sql_update_mobile);
    }
}
if($calculator!="0")
{
    $q_c = mysqli_query($con,$sql_c);
    $r_c = mysqli_fetch_assoc($q_c);
    $total_calculator = $r_c["total_pieces"];
    $total_calculator_remain = (int)$total_calculator - (int)$calculator;

    if((int)$total_calculator_remain<0)
    {
        $total_calculator_need = (int)$calculator - (int)$total_calculator;
        echo<<<_END
        <center>
            <div style="background-color: #cce5ff; color: #004085; padding: 10px; border: 1px solid #b8daff; border-radius: 5px; margin-bottom: 15px;">
                <h1 style="font-size: 1.5rem; margin: 0;">Calculator Shortage</h1>
                <p style="font-size: 1rem; margin: 5px 0;">You need $total_calculator_need calculator more to deliver.</p>
            </div>
        </center>
        _END;
        $redirect="0";
    }
    else
    {
        $sql_update_calculator = "UPDATE product_details SET total_pieces = $total_calculator_remain WHERE product_id = '333'";
        $q_update_calculator = mysqli_query($con,$sql_update_calculator);
    }
}

if($redirect=="0")
{
    echo<<<_END
    <center>
        <div style="margin-top: 20px; text-align: center;">
            <a href='admin.php' style="text-decoration: none;">
                <button style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 1rem;">Go Back</button>
            </a>
        </div>
    </center>
    _END;
}
else
{
    $sql = "UPDATE order_details SET status='DELIVERED' , delivery_time = '$delivery_time' WHERE payment_id = '$pay_id'";
    $q = mysqli_query($con,$sql);

    header("location:admin.php");
}
?>