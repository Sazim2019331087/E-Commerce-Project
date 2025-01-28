<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUSTainable Bank</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .header {
            background-color: #1a73e8;
            color: white;
            padding: 30px 0;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            background-color: white;
            width: 100%;
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"], input[type="reset"] {
            width: 48%;
            padding: 12px;
            font-size: 16px;
            background-color: #1a73e8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #0c5cbf;
        }

        button {
            background-color: transparent;
            border: none;
            padding: 0;
            font-size: 16px;
            color: #1a73e8;
            cursor: pointer;
        }

        button:hover {
            text-decoration: underline;
        }

        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        .footer a {
            color: white;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media screen and (max-width: 768px) {
            .header {
                padding: 20px 0;
            }

            h1 {
                font-size: 28px;
            }

            h2 {
                font-size: 20px;
            }

            form {
                width: 90%;
            }

            input[type="submit"], input[type="reset"] {
                width: 48%;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>SUSTAINABLE BANK LTD</h1>
        <h2>Create Account</h2>
    </div>

    <div>
        <form action="" method="POST" id="signup-form">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" name="create_account" value="CREATE ACCOUNT">
            <input type="reset" name="reset" value="RESET DETAILS">
            
            <br><br>
            Already have an account? <button><a href="bank_login.php">LOGIN ACCOUNT</a></button>
        </form>
    </div>

    <?php 
    require "config.php";
    require "local_time.php";

    if(isset($_POST["create_account"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql1 = "SELECT * FROM bank_details WHERE email='$email'";
        $q1 = mysqli_query($con, $sql1);
        $rc1 = mysqli_num_rows($q1);

        if($rc1 > 0) {
            echo "<script>alert('Email already exists!');</script>";
        } else {
            $account_number = mt_rand(10000, 90000);
            $current_balance = 50000;
            $sql2 = "INSERT INTO bank_details VALUES('$email', '$name', '$password', '$account_number', $current_balance)";
            $q2 = mysqli_query($con, $sql2);
            header("Location: bank_login.php");
        }
    }
    ?>

    <footer class="footer">
        <p>&copy; 2025 SUSTainable Bank | <a href="privacy_policy.php">Privacy Policy</a> | <a href="terms_of_service.php">Terms of Service</a></p>
    </footer>

</body>
</html>
