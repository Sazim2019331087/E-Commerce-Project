<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.min.js"></script>
    <title>Supply Market</title>
    <style>
        /* Reset basic margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding: 20px;
        }

        /* Centered Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        /* Header Section */
        h1 {
            color: #007bff;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        button {
            font-size: 1rem;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        /* Button Styles */
        #open_cart {
            background-color: #28a745;
            color: white;
        }

        #open_cart:hover {
            background-color: #218838;
        }

        #open_cart:active {
            background-color: #1e7e34;
        }

        .reset-button {
            background-color: #dc3545;
            color: white;
        }

        .reset-button:hover {
            background-color: #c82333;
        }

        .reset-button:active {
            background-color: #bd2130;
        }

        .admin-button {
            background-color: #007bff;
            color: white;
        }

        .admin-button:hover {
            background-color: #0056b3;
        }

        .admin-button:active {
            background-color: #004085;
        }

        /* Product Cards */
        .product {
            background-color: white;
            padding: 20px;
            margin: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .product img {
            max-width: 100px;
            max-height: 100px;
            margin-bottom: 15px;
        }

        .amount {
            display: inline-block;
            width: 50px;
            text-align: center;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .buttons {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .buttons button {
            margin: 0 10px;
            width: 120px;
            font-size: 1rem;
        }

        .product h2 {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .product .price {
            font-size: 1.3rem;
            color: #007bff;
            margin-top: 10px;
        }

        /* Market Section Layout */
        #market {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }

        .product {
            width: 30%;
        }

        /* Responsive Design for smaller screens */
        @media screen and (max-width: 1200px) {
            .product {
                width: 45%;
            }
        }

        @media screen and (max-width: 768px) {
            .product {
                width: 90%;
            }

            .container {
                padding: 10px;
            }

            button {
                font-size: 0.9rem;
                padding: 8px 16px;
            }

            .product img {
                width: 80px;
                height: 80px;
            }

            .product h2 {
                font-size: 1.3rem;
            }

            .product .price {
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <button id="open_cart">Go to Cart</button>
        <a href="admin.php"><button class="admin-button">Admin</button></a>
        
        <h1>Supply Market</h1>

        <div id="market">
            <!-- Laptop Product Card -->
            <div class="product">
                <h2>Laptop</h2>
                <img src="./products/laptop.png" alt="Laptop">
                <div class="buttons">
                    <button id="dec111">Decrement</button>
                    <span class="amount" id="amount111">0</span> Pieces
                    <button id="inc111">Increment</button>
                </div>
                <div class="price">Total Price: <span id="price111">0</span> Tk</div>
                <button id="reset111" class="reset-button">Reset All</button>
            </div>

            <!-- Mobile Product Card -->
            <div class="product">
                <h2>Mobile</h2>
                <img src="./products/mobile.png" alt="Mobile">
                <div class="buttons">
                    <button id="dec222">Decrement</button>
                    <span class="amount" id="amount222">0</span> Pieces
                    <button id="inc222">Increment</button>
                </div>
                <div class="price">Total Price: <span id="price222">0</span> Tk</div>
                <button id="reset222" class="reset-button">Reset All</button>
            </div>

            <!-- Calculator Product Card -->
            <div class="product">
                <h2>Calculator</h2>
                <img src="./products/calculator.png" alt="Calculator">
                <div class="buttons">
                    <button id="dec333">Decrement</button>
                    <span class="amount" id="amount333">0</span> Pieces
                    <button id="inc333">Increment</button>
                </div>
                <div class="price">Total Price: <span id="price333">0</span> Tk</div>
                <button id="reset333" class="reset-button">Reset All</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            function updateAmountAndPrice(productId, amountId, priceId, url) {
                $.ajax({
                    method: "POST",
                    url: url,
                    data: { amount: $(amountId).text() },
                    success: function (response) {
                        data = JSON.parse(response);
                        $(amountId).text(data.amount);
                        $(priceId).text(data.price);
                    }
                });
            }

            $("#dec111").click(function () {
                updateAmountAndPrice('111', '#amount111', '#price111', 'decrement111.php');
            });

            $("#dec222").click(function () {
                updateAmountAndPrice('222', '#amount222', '#price222', 'decrement222.php');
            });

            $("#dec333").click(function () {
                updateAmountAndPrice('333', '#amount333', '#price333', 'decrement333.php');
            });

            $("#inc111").click(function () {
                updateAmountAndPrice('111', '#amount111', '#price111', 'increment111.php');
            });

            $("#inc222").click(function () {
                updateAmountAndPrice('222', '#amount222', '#price222', 'increment222.php');
            });

            $("#inc333").click(function () {
                updateAmountAndPrice('333', '#amount333', '#price333', 'increment333.php');
            });

            $("#reset111").click(function () {
                $("#price111").text(0);
                $("#amount111").text(0);
            });

            $("#reset222").click(function () {
                $("#price222").text(0);
                $("#amount222").text(0);
            });

            $("#reset333").click(function () {
                $("#price333").text(0);
                $("#amount333").text(0);
            });

            $("#open_cart").click(function () {
                var url = "wholesale_cart.php?laptop=" + $("#amount111").text() + "&mobile=" + $("#amount222").text() + "&calculator=" + $("#amount333").text() + "&lp=" + $("#price111").text() + "&mp=" + $("#price222").text() + "&cp=" + $("#price333").text();
                window.location.href = url;
            });
        });
    </script>
</body>

</html>
