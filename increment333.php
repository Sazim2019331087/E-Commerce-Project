<?php
    $amount = $_POST["amount"];
    $amount = (int)$amount+1;
    $price = (int)$amount*1000;
    echo json_encode(["amount"=>$amount,"price"=>$price]);
?>