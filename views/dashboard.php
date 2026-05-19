<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <style>
        body {
            font-family: Arial;
            margin: 0;
            background: #f1f5f9;
        }

        
        .navbar {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            padding: 15px 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 8px;
            font-weight: bold;
            font-size: 13px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        
        .container {
            padding: 25px;
        }

        
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .title {
            font-size: 13px;
            color: gray;
        }

        .value {
            font-size: 26px;
            font-weight: bold;
            margin-top: 6px;
            color: #111827;
        }

        
        table {
            width: 100%;
            margin-top: 25px;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        th {
            background: #4f46e5;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #f9fafb;
        }

        
        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            color: white;
        }

        .in { background: green; }
        .out { background: red; }
        .adjustment { background: orange; }

        h2 {
            margin: 0;
            color: #111827;
        }

        h3 {
            margin-top: 30px;
        }
    </style>
</head>

<body>


<div class="navbar">
    <div><b> Inventory Management System</b></div>

    <div>
        <a href="../controllers/DashboardController.php">Dashboard</a>
        <a href="../controllers/CategoryController.php?action=list">Categories</a>
        <a href="../controllers/ProductController.php?action=list">Products</a>
        <a href="../controllers/SupplierController.php?action=list">Suppliers</a>
        <a href="../controllers/WarehouseController.php?action=list">Warehouses</a>
        <a href="../controllers/POController.php?action=list">PO</a>
        <a href="../controllers/InventoryController.php?action=list">Inventory</a>
        <a href="../controllers/DiscrepancyController.php?action=list" style="color:white; margin-right :15px;">Discrepancy</a>
         <a href="../controllers/StockMovementController.php?action=list" style="color:white; margin-right :15px;">Stock Report</a>
          <a href="../controllers/LowStockController.php?action=list" style="color:white; margin-right:15px;">Low Stock</a> 
          <a href="../controllers/SupplierReportController.php?action=list" style="color:white; margin-right:15px;">SupplierReport</a>
           <a href="../controllers/MonthlyAuditController.php?action=list" style="color:white; margin-right:15px;">MonthlyAudit</a>
        <a href="../controllers/logincontroller.php">Logout</a>
    </div>
</div>

<div class="container">

    <h2>Dashboard</h2>

    <!-- CARDS -->
    <div class="cards">

        <div class="card">
            <div class="title">Total Products</div>
            <div class="value"> <?= $totalProducts ?></div>
        </div>

        <div class="card">
            <div class="title">Total Suppliers</div>
            <div class="value"> <?= $totalSuppliers ?></div>
        </div>

        <div class="card">
            <div class="title">Stock Value</div>
            <div class="value"> <?= number_format($stockValue, 2) ?></div>
        </div>

        <div class="card">
            <div class="title">Open Issues</div>
            <div class="value"> <?= $openDiscrepancy ?></div>
        </div>

        <div class="card">
            <div class="title">Overdue PO</div>
            <div class="value"> <?= $overduePO ?></div>
        </div>

    </div>

    
    <h3>Recent Transactions</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Warehouse</th>
            <th>Type</th>
            <th>Qty</th>
            <th>Date</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($txnQuery)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['product_name'] ?></td>
            <td><?= $row['warehouse_name'] ?></td>
            <td>
                <span class="badge <?= $row['type'] ?>">
                    <?= strtoupper($row['type']) ?>
                </span>
            </td>
            <td><?= $row['quantity'] ?></td>
            <td><?= $row['created_at'] ?></td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>