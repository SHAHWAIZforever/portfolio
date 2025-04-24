<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pizza";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_order'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $totalOrderPrice = 0;

    $pizzas = [
        "Big Italy" => 10.00,
        "Meat Lover" => 12.00,
        "Veggy Lover" => 9.00,
    ];

    foreach ($pizzas as $pizzaName => $price) {
        $qtyKey = str_replace(' ', '_', strtolower($pizzaName)) . "_qty";
        if (!empty($_POST[$qtyKey]) && $_POST[$qtyKey] > 0) {
            $qty = (int) $_POST[$qtyKey];
            $total = $qty * $price;
            $totalOrderPrice += $total;

            $stmt = $conn->prepare("INSERT INTO orders (customer_name, contact_no, address, pizza_name, unit_price, quantity, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssidi", $name, $contact, $address, $pizzaName, $price, $qty, $total);
            $stmt->execute();
        }
    }

    $stmt = $conn->prepare("INSERT INTO customer_totals (customer_name, contact_no, address, total_price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $name, $contact, $address, $totalOrderPrice);
    $stmt->execute();

    header("Location: " . $_SERVER['PHP_SELF'] . "?order=success");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pizza Order Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .pizza-card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            transition: box-shadow 0.3s ease;
        }

        .pizza-card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .pizza-card img {
            width: 80px;
            height: auto;
            border-radius: 5px;
        }

        .quantity-buttons {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .quantity-buttons button {
            padding: 5px 10px;
            font-weight: bold;
        }

        .quantity-buttons input[type="number"] {
            width: 70px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .pizza-card {
                flex-direction: column !important;
                text-align: center;
            }

            .pizza-card .d-flex {
                flex-direction: column;
                align-items: center;
            }

            .quantity-buttons {
                justify-content: center;
                margin-top: 10px;
            }

            .pizza-card img {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
<div class="container my-5">
    <h2 class="text-center mb-4">Pizza Order Form</h2>

    <?php if (isset($_GET['order']) && $_GET['order'] == 'success'): ?>
        <div class="alert alert-success">Order placed successfully!</div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Contact No.</label>
                <input type="text" name="contact" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>
        </div>

        <h4 class="mb-3">Pizza Menu</h4>

        <?php
        $menu = [
            "Big Italy" => [
                'price' => 10.00,
                'image' => 'images/Screenshot 2025-04-19 124616.jpg'
            ],
            "Meat Lover" => [
                'price' => 12.00,
                'image' => 'images/p2.jpg'
            ],
            "Veggy Lover" => [
                'price' => 9.00,
                'image' => 'images/p3.jpg'
            ]
        ];
        foreach ($menu as $pizza => $details):
            $id = str_replace(' ', '_', strtolower($pizza));
        ?>
        <div class="pizza-card d-flex align-items-center justify-content-between flex-wrap">
            <div class="d-flex align-items-center flex-wrap">
                <img src="<?= $details['image'] ?>" alt="<?= $pizza ?>" class="me-3">
                <div>
                    <h6 class="mb-1"><?= $pizza ?> - <span class="text-muted">$<?= number_format($details['price'], 2) ?></span></h6>
                    <div class="form-check">
                        <input type="checkbox" id="<?= $id ?>_check" class="form-check-input" onclick="toggleQty('<?= $id ?>')">
                        <label class="form-check-label" for="<?= $id ?>_check">Add to Order</label>
                    </div>
                </div>
            </div>
            <div class="quantity-buttons mt-2 mt-md-0">
                <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity('<?= $id ?>', -1)">-</button>
                <input type="number"
                       name="<?= $id ?>_qty"
                       id="<?= $id ?>_qty"
                       class="form-control"
                       placeholder="0"
                       min="0"
                       value="0"
                       disabled
                       oninput="calculateTotal()">
                <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity('<?= $id ?>', 1)">+</button>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="mt-4 d-flex flex-wrap gap-2">
            <button type="button" onclick="calculateTotal()" class="btn btn-primary mb-2">Calculate Total</button>
            <button type="reset" class="btn btn-warning mb-2" onclick="resetTotal()">Clear Order</button>
            <button type="submit" name="submit_order" class="btn btn-success mb-2">Submit Order</button>
            <!-- <a href="logout.php" class="btn btn-danger mb-2">Logout</a> -->
            <a href="empty.php" class="btn btn-light mb-2">Empty Tables</a>
        </div>

        <h5 class="mt-3">Total Price: $<span id="totalPrice">0.00</span></h5>
    </form>
</div>

<script>
    const prices = {
        "big_italy": 10.00,
        "meat_lover": 12.00,
        "veggy_lover": 9.00
    };

    function toggleQty(id) {
        const qtyInput = document.getElementById(id + "_qty");
        const checkbox = document.getElementById(id + "_check");
        qtyInput.disabled = !checkbox.checked;
        if (!checkbox.checked) {
            qtyInput.value = '0';
        }
        calculateTotal();
    }

    function updateQuantity(id, change) {
        const qtyInput = document.getElementById(id + "_qty");
        let currentQty = parseInt(qtyInput.value) || 0;
        currentQty += change;
        if (currentQty < 0) currentQty = 0;
        qtyInput.value = currentQty;
        calculateTotal();
    }

    function calculateTotal() {
        let total = 0;
        for (const id in prices) {
            const checkbox = document.getElementById(id + "_check");
            const qtyInput = document.getElementById(id + "_qty");
            if (checkbox.checked && !qtyInput.disabled) {
                const qty = parseInt(qtyInput.value) || 0;
                total += prices[id] * qty;
            }
        }
        document.getElementById("totalPrice").textContent = total.toFixed(2);
    }

    function resetTotal() {
        document.getElementById("totalPrice").textContent = "0.00";
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
