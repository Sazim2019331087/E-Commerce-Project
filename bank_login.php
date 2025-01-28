<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            max-width: 500px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
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

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        input[type="email"],
        input[type="password"],
        input[type="submit"],
        input[type="reset"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
        }

        input[type="submit"],
        input[type="reset"] {
            width: 48%;
            cursor: pointer;
            background-color: #3498db;
            color: white;
            font-size: 16px;
            border: none;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #2980b9;
        }

        .create-account-btn {
            text-align: center;
            font-size: 16px;
        }

        .create-account-btn a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        .error-message {
            color: #e74c3c;
            text-align: center;
            font-size: 18px;
        }

        .success-message {
            color: #2ecc71;
            text-align: center;
            font-size: 18px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>SUSTAINABLE BANK LTD</h1>
            <h2>Login Account</h2>
        </div>

        <form action="" method="POST">
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <div style="display: flex; justify-content: space-between;">
                <input type="submit" name="login_account" value="LOGIN ACCOUNT">
                <input type="reset" name="reset" value="RESET DETAILS">
            </div>
            <div class="create-account-btn">
                <p>Want to create an account? <a href="bank_sign_up.php">CREATE ACCOUNT</a></p>
            </div>
        </form>

        <?php
        require "config.php";
        require "local_time.php";

        if (isset($_POST["login_account"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $sql1 = "SELECT * FROM bank_details WHERE email='$email'";
            $q1 = mysqli_query($con, $sql1);
            $rc1 = mysqli_num_rows($q1);

            if ($rc1 == 0) {
                echo "<div class='error-message'>No Account found with this email!</div>";
            } else {
                $details = mysqli_fetch_assoc($q1);
                $actual_password = $details["password"];
                $name = $details["name"];
                $account_number = $details["account_number"];

                if ($password == $actual_password) {
                    $url = "bank_profile.php?account_number=" . $account_number;
                    header("location:$url");
                } else {
                    echo "<div class='error-message'>$name, your password is incorrect. Please try again!</div>";
                }
            }
        }
        ?>

    </div>

</body>

</html>
