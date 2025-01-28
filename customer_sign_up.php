<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Sylhet IT Shop</title>
    <link rel="stylesheet" href="assets/styles/form.css">
</head>
<body>
    <header>
        <h1>Sylhet IT Shop</h1>
        <p>Create your account to start shopping with us!</p>
    </header>

    <main>
        <section class="form-section">
            <h2>Create Account</h2>
            <form action="" method="POST" class="form-container">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>

                <div class="form-actions">
                    <input type="submit" name="create_account" value="Create Account" class="button">
                    <input type="reset" name="reset" value="Reset Details" class="button reset-button">
                </div>

                <p class="login-link">
                    Already have an account? <a href="customer_login.php">Login Here</a>
                </p>
            </form>

            <?php 
            require "config.php";
            require "local_time.php";
            if (isset($_POST["create_account"])) {
                $name = $_POST["name"];
                $email = $_POST["email"];
                $password = $_POST["password"];

                $sql1 = "SELECT * FROM customer_details WHERE email='$email'";
                $q1 = mysqli_query($con, $sql1);
                $rc1 = mysqli_num_rows($q1);
                if ($rc1 > 0) {
                    echo "<p class='error'>Email already exists!</p>";
                } else {
                    $account_number = "NOT SET";
                    $secret = "NOT SET";
                    $sql2 = "INSERT INTO customer_details VALUES('$email','$name','$password','$account_number','$secret')";
                    $q2 = mysqli_query($con, $sql2);
                    header("location:customer_login.php");
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
