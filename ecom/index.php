<?php
$mysqli = new mysqli("localhost", "root", "", "ecom");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    $action = $_POST['action'];

    if ($action === 'add') {
        $product = $_POST['product'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $stmt = $mysqli->prepare("INSERT INTO cart_items (product_name, quantity, price) VALUES (?, ?, ?)");
        $stmt->bind_param("sid", $product, $quantity, $price);
        $stmt->execute();
        echo json_encode(['status' => 'added']);
        exit;
    }

    if ($action === 'fetch') {
        $result = $mysqli->query("SELECT * FROM cart_items");
        $items = [];
        $total = 0;
        while ($row = $result->fetch_assoc()) {
            $row['subtotal'] = $row['price'] * $row['quantity'];
            $total += $row['subtotal'];
            $items[] = $row;
        }
        echo json_encode(['items' => $items, 'total' => $total]);
        exit;
    }

    if ($action === 'clear') {
        $mysqli->query("DELETE FROM cart_items");
        echo json_encode(['status' => 'cleared']);
        exit;
    }

    if ($action === 'order') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        // Fetch cart
        $result = $mysqli->query("SELECT * FROM cart_items");
        $items = [];
        $total = 0;
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
            $total += $row['price'] * $row['quantity'];
        }

        if (count($items) === 0) {
            echo json_encode(['status' => 'error', 'message' => 'Cart is empty']);
            exit;
        }

        // Insert order
        $stmt = $mysqli->prepare("INSERT INTO orders (name, email, phone, address, total) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssd", $name, $email, $phone, $address, $total);
        $stmt->execute();
        $order_id = $stmt->insert_id;

        // Insert order items
        $stmt = $mysqli->prepare("INSERT INTO order_items (order_id, product_name, quantity, price) VALUES (?, ?, ?, ?)");
        foreach ($items as $item) {
            $stmt->bind_param("isid", $order_id, $item['product_name'], $item['quantity'], $item['price']);
            $stmt->execute();
        }

        // Clear cart
        $mysqli->query("DELETE FROM cart_items");

        echo json_encode(['status' => 'success', 'order_id' => $order_id]);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-commerce</title>
    <style>
        .product-form, .cart, .order-form { margin-bottom: 20px; }
        .item { margin: 5px 0; }
        button { margin: 0 5px; }
    </style>
</head>
<body>

<h1>E-commerce Site</h1>

<form class="product-form" data-product="T-shirt" data-price="499">
    <img src="https://www.nicepng.com/png/detail/1007-10078976_rrl-mitchell-and-ness-all-over-shirt.png" alt="T-shirt" width="100"><br>
    <button type="button" class="decrement">-</button>
    <input type="number" value="1" min="1">
    <button type="button" class="increment">+</button>
    <input type="submit" value="Add to Cart">
</form>

<form class="product-form" data-product="Sneakers" data-price="1299">
    <img src="https://www.nicepng.com/png/detail/1010-10100640_dress-shoes-slip-on-shoe.png" alt="Sneakers" width="100"><br>
    <button type="button" class="decrement">-</button>
    <input type="number" value="1" min="1">
    <button type="button" class="increment">+</button>
    <input type="submit" value="Add to Cart">
</form>

<div class="cart"></div>
<h3>Total: Rs. <span id="totalPrice">0</span></h3>
<button id="clearCart">Clear Cart</button>

<!-- Order Form -->
<div class="order-form">
    <h2>Enter Your Details</h2>
    <form id="orderForm">
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="tel" name="phone" placeholder="Phone" required><br>
        <textarea name="address" placeholder="Address" required></textarea><br>
        <button type="submit">Place Order</button>
    </form>
</div>

<script>
document.querySelectorAll('.product-form').forEach(form => {
    const input = form.querySelector('input[type="number"]');
    form.querySelector('.increment').onclick = () => input.stepUp();
    form.querySelector('.decrement').onclick = () => input.stepDown();

    form.onsubmit = e => {
        e.preventDefault();
        const product = form.dataset.product;
        const price = form.dataset.price;
        const quantity = input.value;

        fetch('', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `action=add&product=${product}&price=${price}&quantity=${quantity}`
        }).then(() => updateCart());
    };
});

document.getElementById('clearCart').onclick = () => {
    fetch('', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'action=clear'
    }).then(() => updateCart());
};

function updateCart() {
    fetch('', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'action=fetch'
    })
    .then(res => res.json())
    .then(data => {
        const cartDiv = document.querySelector('.cart');
        cartDiv.innerHTML = '<h2>Cart</h2>';
        data.items.forEach(item => {
            cartDiv.innerHTML += `<div class="item">${item.product_name} - Rs. ${item.price} x ${item.quantity} = Rs. ${item.subtotal}</div>`;
        });
        document.getElementById('totalPrice').textContent = data.total.toFixed(2);
    });
}

document.getElementById('orderForm').onsubmit = function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append('action', 'order');

    fetch('', {
        method: 'POST',
        body: new URLSearchParams(formData)
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert("Order placed! Order ID: " + data.order_id);
            this.reset();
            updateCart();
        } else {
            alert("Error: " + data.message);
        }
    });
};

updateCart();
</script>



</body>
</html>
