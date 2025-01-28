<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sylhet IT Shop</title>
    <link rel="stylesheet" href="assets/styles/form.css">
</head>
<body>
    <header>
        <h1>Sylhet IT Shop</h1>
        <p>Login to your account and start shopping!</p>
    </header>

    <main>
        <section class="form-section">
            <h2>Login Account</h2>
            <form action="" method="POST" class="form-container">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>

                <div class="form-actions">
                    <input type="submit" name="login_account" value="Login Account" class="button">
                    <input type="reset" name="reset" value="Reset Details" class="button reset-button">
                </div>

                <p class="login-link">
                    Want to create an account? <a href="customer_sign_up.php">Create Account</a>
                </p>
            </form>

            <?php 
            require "config.php";
            require "local_time.php";
            if (isset($_POST["login_account"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];

                $sql1 = "SELECT * FROM customer_details WHERE email='$email'";
                $q1 = mysqli_query($con, $sql1);
                $rc1 = mysqli_num_rows($q1);

                if ($rc1 == 0) {
                    echo "<p class='error'>No account found with this email!</p>";
                } else {
                    $details = mysqli_fetch_assoc($q1);
                    $actual_password = $details["password"];
                    $name = $details["name"];
                    $account_number = $details["account_number"];
                    $secret = $details["secret"];

                    if ($password == $actual_password) {
                        session_start();
                        $_SESSION["email"] = $email;
                        $_SESSION["account_number"] = $account_number;
                        $_SESSION["secret"] = $secret;
                        $_SESSION["password"] = $password;
                        $_SESSION["name"] = $name;
                        header("location:customer_profile.php");
                    } else {
                        echo "<p class='error'>$name, your password is incorrect. Please try again!</p>";
                    }
                }
            }
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Sylhet IT Shop. All rights reserved.</p>
    </footer>
</body>
</html>
