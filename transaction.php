<?php 
require "config.php";
require "admin_details.php";
$sender_account = $_POST["sender"];
$receiver_account = $_POST["receiver"];
$payment_time = $_POST["time"];
$amount = $_POST["amount"];
$secret_pin = $_POST["secret_pin"];
$actual_secret = $_POST["actual_secret"];
$status = "ORDER CONFIRMED";

if($secret_pin=="")
{
	echo json_encode(["status"=>"Pin is empty","color"=>"red"]);
}
else if($actual_secret!==$secret_pin)
{
    echo json_encode(["status"=>"Pin is incorrect","color"=>"red"]);
}
else if($amount=="0")
{
    echo json_encode(["status"=>"0TK cannot be paid","color"=>"red"]);	
}
else
{
    $sql1 = "SELECT * FROM bank_details WHERE account_number='$sender_account'";
    $q1 = mysqli_query($con,$sql1);
    $r1 = mysqli_fetch_assoc($q1);
    $current_balance = $r1["current_balance"];
    if($current_balance<$amount)
    {
        echo json_encode(["status"=>"Payment Failed for Low Amount","color"=>"red"]);
    }
    else
    {
        $remainder = $current_balance - (int)$amount;
        $sql2 = "UPDATE bank_details SET current_balance = $remainder WHERE account_number = '$sender_account'";
        $q2 = mysqli_query($con,$sql2);
        $pay_id = mt_rand(1000,50000);
        $payment_status = "SUCCESSFUL";
        $sql3 = "INSERT INTO payment_details VALUES('$pay_id','$sender_account','$receiver_account','$amount','$payment_time','$payment_status')";
        $q3 = mysqli_query($con,$sql3);
        
        $sql4 = "SELECT * FROM bank_details WHERE account_number='$receiver_account'";
        $q4 = mysqli_query($con,$sql4);
        $r4 = mysqli_fetch_assoc($q4);
        $receiver_current_balance = $r4["current_balance"];
        $receiver_updated_balance = $receiver_current_balance + (int)$amount;

        $sql5 = "UPDATE bank_details SET current_balance = $receiver_updated_balance WHERE account_number = '$receiver_account'";
        $q5 = mysqli_query($con,$sql5);
        
        $lpc = $_POST["lpc"];
        $mpc = $_POST["mpc"];
        $cpc = $_POST["cpc"];
        $addr = $_POST["addr"];

        if($sender_account==$admin_account_number)
        {
            $status = "ADMIN ORDER";
        }
        $sql6 = "INSERT INTO order_details VALUES('$pay_id',$lpc,$mpc,$cpc,'$payment_time','TBA','$addr','$status')";
        $q6 = mysqli_query($con,$sql6);

        echo json_encode(["status"=>"Payment Successful","color"=>"green"]);
    }

}
?>