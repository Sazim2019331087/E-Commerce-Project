<?php 
require "config.php";
require "admin_details.php";
$pay_id = $_GET["pay_id"];
$sql1 = "SELECT * FROM order_details WHERE payment_id='$pay_id';";
$q1 = mysqli_query($con,$sql1);
$r1 = mysqli_fetch_assoc($q1);
$laptop = $r1["laptop"];
$mobile = $r1["mobile"];
$calculator = $r1["calculator"];

$sql_l = "SELECT * FROM product_details WHERE product_id = '111'";
$sql_m = "SELECT * FROM product_details WHERE product_id = '222'";
$sql_c = "SELECT * FROM product_details WHERE product_id = '333'";

if($laptop!="0")
{
    $q_l = mysqli_query($con,$sql_l);
    $r_l = mysqli_fetch_assoc($q_l);
    $total_laptop = $r_l["total_pieces"];
    $total_laptop_remain = (int)$total_laptop + (int)$laptop;

    $sql_update_laptop = "UPDATE product_details SET total_pieces = $total_laptop_remain WHERE product_id = '111'";
    $q_update_laptop = mysqli_query($con,$sql_update_laptop);
}

if($mobile!="0")
{
    $q_m = mysqli_query($con,$sql_m);
    $r_m = mysqli_fetch_assoc($q_m);
    $total_mobile = $r_m["total_pieces"];
    $total_mobile_remain = (int)$total_mobile + (int)$mobile;

    $sql_update_mobile = "UPDATE product_details SET total_pieces = $total_mobile_remain WHERE product_id = '222'";
    $q_update_mobile = mysqli_query($con,$sql_update_mobile);
}
if($calculator!="0")
{
    $q_c = mysqli_query($con,$sql_c);
    $r_c = mysqli_fetch_assoc($q_c);
    $total_calculator = $r_c["total_pieces"];
    $total_calculator_remain = (int)$total_calculator + (int)$calculator;

    $sql_update_calculator = "UPDATE product_details SET total_pieces = $total_calculator_remain WHERE product_id = '333'";
    $q_update_calculator = mysqli_query($con,$sql_update_calculator);
}

$del_order = "DELETE FROM order_details WHERE payment_id='$pay_id'";
$del_order_q = mysqli_query($con,$del_order);
$del_payment = "DELETE FROM payment_details WHERE payment_id='$pay_id'";
$del_payment_q = mysqli_query($con,$del_payment);


header("location:supplier.php");
?>