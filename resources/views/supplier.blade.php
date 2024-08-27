<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.dashboard-container {
    display: flex;
    min-height: 100vh;
}

.sidebar {
    background-color: #333;
    color: white;
    padding: 20px;
    width: 250px;
}

.sidebar h2 {
    margin: 0;
    padding: 0;
    text-align: center;
}

.sidebar nav ul {
    list-style-type: none;
    padding: 0;
}

.sidebar nav ul li {
    margin: 20px 0;
}

.sidebar nav ul li a {
    color: white;
    text-decoration: none;
    display: block;
    padding: 10px;
    border-radius: 4px;
}

.sidebar nav ul li a:hover {
    background-color: #555;
}

.main-content {
    flex-grow: 1;
    padding: 20px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.header h1 {
    margin: 0;
}

.header input[type="search"] {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.cards {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 20px;
    flex-grow: 1;
    margin: 0 10px;
    text-align: center;
}

.card h3 {
    margin: 0;
    font-size: 20px;
    color: #333;
}

.card p {
    font-size: 28px;
    margin: 10px 0 0 0;
    color: #555;
}

.table-section {
    background-color: white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.table-section h2 {
    margin: 0 0 20px 0;
    font-size: 24px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table thead {
    background-color: #f4f4f4;
}

table th, table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table tr:hover {
    background-color: #f9f9f9;
}

</style>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <h2>Supplier Dashboard</h2>
            <nav>
                <ul>
                    <li><a href="#">Overview</a></li>
                    <li><a href="#">Orders</a></li>
                    <li><a href="#">Inventory</a></li>
                    <li><a href="#">Suppliers</a></li>
                    <li><a href="#">Reports</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header">
                <h1>Overview</h1>
                <input type="search" placeholder="Search...">
            </header>

            <section class="cards">
                <div class="card">
                    <h3>Total Suppliers</h3>
                    <p>150</p>
                </div>
                <div class="card">
                    <h3>Total Orders</h3>
                    <p>230</p>
                </div>
                <div class="card">
                    <h3>Inventory Value</h3>
                    <p>$50,000</p>
                </div>
                <div class="card">
                    <h3>Pending Orders</h3>
                    <p>12</p>
                </div>
            </section>

            <section class="table-section">
                <h2>Recent Orders</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Supplier</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>12345</td>
                            <td>ABC Supplies</td>
                            <td>2024-08-21</td>
                            <td>Shipped</td>
                            <td>$1,200</td>
                        </tr>
                        <tr>
                            <td>12346</td>
                            <td>XYZ Suppliers</td>
                            <td>2024-08-20</td>
                            <td>Processing</td>
                            <td>$800</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
