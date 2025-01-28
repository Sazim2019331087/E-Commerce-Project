<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/styles/market.css"> <!-- Link to market.css -->
    <title>Sylhet IT Shop</title>
</head>

<body>
    <div class="navbar">
        <div class="navbar-container">
            <a href="market.php" class="navbar-brand">Sylhet IT Shop</a>
            <ul class="navbar-links">
                <li><a href="customer_profile.php">My Profile</a></li>
                <li><button id="open_cart">Go to Cart</button></li>
            </ul>
        </div>
    </div>

    <div class="container">
        <div class="product-card">
            <h2>Laptop</h2>
            <img src="./products/laptop.png" alt="Laptop">
            <div class="product-controls">
                <button id="dec111" class="product-btn">Decrement</button>
                <span id="amount111">0</span> Pieces
                <button id="inc111" class="product-btn">Increment</button>
            </div>
            <p>Total Price: <span id="price111">0</span> Tk</p>
            <button id="reset111" class="reset-btn">Reset</button>
        </div>

        <div class="product-card">
            <h2>Mobile</h2>
            <img src="./products/mobile.png" alt="Mobile">
            <div class="product-controls">
                <button id="dec222" class="product-btn">Decrement</button>
                <span id="amount222">0</span> Pieces
                <button id="inc222" class="product-btn">Increment</button>
            </div>
            <p>Total Price: <span id="price222">0</span> Tk</p>
            <button id="reset222" class="reset-btn">Reset</button>
        </div>

        <div class="product-card">
            <h2>Calculator</h2>
            <img src="./products/calculator.png" alt="Calculator">
            <div class="product-controls">
                <button id="dec333" class="product-btn">Decrement</button>
                <span id="amount333">0</span> Pieces
                <button id="inc333" class="product-btn">Increment</button>
            </div>
            <p>Total Price: <span id="price333">0</span> Tk</p>
            <button id="reset333" class="reset-btn">Reset</button>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#dec111, #dec222, #dec333").click(function () {
                let id = this.id.replace("dec", "");
                let amountId = "#amount" + id;
                let priceId = "#price" + id;

                $.ajax({
                    method: "POST",
                    url: "decrement" + id + ".php",
                    data: { amount: $(amountId).text() },
                    success: function (response) {
                        let data = JSON.parse(response);
                        $(amountId).text(data.amount);
                        $(priceId).text(data.price);
                    }
                });
            });

            $("#inc111, #inc222, #inc333").click(function () {
                let id = this.id.replace("inc", "");
                let amountId = "#amount" + id;
                let priceId = "#price" + id;

                $.ajax({
                    method: "POST",
                    url: "increment" + id + ".php",
                    data: { amount: $(amountId).text() },
                    success: function (response) {
                        let data = JSON.parse(response);
                        $(amountId).text(data.amount);
                        $(priceId).text(data.price);
                    }
                });
            });

            $("#reset111, #reset222, #reset333").click(function () {
                let id = this.id.replace("reset", "");
                $("#price" + id).text(0);
                $("#amount" + id).text(0);
            });

            $("#open_cart").click(function () {
                let url = "cart.php?laptop=" + $("#amount111").text() + "&mobile=" + $("#amount222").text() + "&calculator=" + $("#amount333").text() +
                    "&lp=" + $("#price111").text() + "&mp=" + $("#price222").text() + "&cp=" + $("#price333").text();
                window.location = url;
            });
        });
    </script>
</body>

</html>
