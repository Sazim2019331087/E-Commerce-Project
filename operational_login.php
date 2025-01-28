<?php 
require "admin_details.php"; // Fetching admin details for authentication
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/styles/login.css"> <!-- Optional: Link to external CSS for better styling -->
    <title>Sylhet IT Shop</title>
</head>
<body>
    <div class="login-container">
        <h2>Admin and Supplier Login</h2>
        <form action="auth.php" method="POST" class="login-form">
            <input type="hidden" name="admin_email" value="<?php echo $admin_email; ?>">
            <input type="hidden" name="supplier_email" value="<?php echo $supplier_email; ?>">
            <input type="hidden" name="admin_password" value="<?php echo $admin_password; ?>">
            <input type="hidden" name="supplier_password" value="<?php echo $supplier_password; ?>">
            
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
            </div>

            <div class="button-group">
                <input type="submit" name="login" value="Login">
                <input type="reset" name="clear" value="Clear">
            </div>
        </form>
    </div>

</body>
</html>
