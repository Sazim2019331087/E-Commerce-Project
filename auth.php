<?php
require "admin_details.php";

$email = $_POST["email"];
$password = $_POST["password"];
$admin_email = $_POST["admin_email"];
$admin_password = $_POST["admin_password"];
$supplier_email = $_POST["supplier_email"];
$supplier_password = $_POST["supplier_password"];


if($email==$admin_email)
{
    if($password==$admin_password)
    {
        header("location:admin.php");
    }
    else
    {
        echo "<center><h1>Wrong Password.Try Again....</h1><br><a href='operational_login.php'><button>Go Back</button></a></center>";
    }
}
else if($email==$supplier_email)
{
    if($password==$supplier_password)
    {
        header("location:supplier.php");
    }
    else
    {
        echo "<center><h1>Wrong Password.Try Again....</h1><br><a href='operational_login.php'><button>Go Back</button></a></center>";
    }    
}
else{
    echo "<center><h1>Wrong Email.Try Again....</h1><br><a href='operational_login.php'><button>Go Back</button></a></center>";
}
?>