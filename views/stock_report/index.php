<!DOCTYPE html>
<html>
<head>
    <title>Stock Movement Report</title>

    <style>
        body { font-family: Arial; background:#f4f6f9; padding:20px; }

        .filter-box {
            background:white;
            padding:15px;
            border-radius:10px;
            margin-bottom:20px;
            box-shadow:0 2px 10px rgba(0,0,0,0.08);
        }

        input, select, button {
            padding:8px;
            margin:5px;
        }

        button {
            background:#4f46e5;
            color:white;
            border:none;
            border-radius:6px;
            cursor:pointer;
        }

        table {
            width:100%;
            border-collapse:collapse;
            background:white;
        }

        th {
            background:#4f46e5;
            color:white;
            padding:10px;
        }

        td {
            padding:10px;
            text-align:center;
            border-bottom:1px solid #eee;
        }

        tr:hover { background:#f9fafb; }
    </style>
</head>

<body>

<h2>Stock Movement Report (AJAX)</h2>

<!-- FILTER -->
<div class="filter-box">

    <input type="text" id="product" placeholder="Product ID">
    <input type="text" id="warehouse" placeholder="Warehouse ID">

    <select id="type">
        <option value="">All Types</option>
        <option value="in">IN</option>
        <option value="out">OUT</option>
        <option value="adjustment">ADJUSTMENT</option>
        <option value="transfer">TRANSFER</option>
    </select>

    <input type="date" id="from">
    <input type="date" id="to">

    <button onclick="loadData()">Search</button>

</div>

<!-- TABLE -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Warehouse</th>
            <th>Type</th>
            <th>Qty</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody id="tableData"></tbody>
</table>

<script>
function loadData() {

    let product = document.getElementById("product").value || "";
    let warehouse = document.getElementById("warehouse").value || "";
    let type = document.getElementById("type").value || "";
    let from = document.getElementById("from").value || "";
    let to = document.getElementById("to").value || "";

    let url = "../controllers/StockMovementAPI.php";

    let params = new URLSearchParams();

    if (product) params.append("product", product);
    if (warehouse) params.append("warehouse", warehouse);
    if (type) params.append("type", type);
    if (from) params.append("from", from);
    if (to) params.append("to", to);

    fetch(url + "?" + params.toString())
    .then(res => res.json())
    .then(data => {

        console.log("API DATA:", data);

        let rows = "";

        if (data.length === 0) {
            rows = `<tr><td colspan="6">No data found</td></tr>`;
        } else {
            data.forEach(row => {
                rows += `
                    <tr>
                        <td>${row.id}</td>
                        <td>${row.product_name}</td>
                        <td>${row.warehouse_name}</td>
                        <td>${row.type}</td>
                        <td>${row.quantity}</td>
                        <td>${row.transaction_date}</td>
                    </tr>
                `;
            });
        }

        document.getElementById("tableData").innerHTML = rows;
    })
    .catch(err => {
        console.log("AJAX ERROR:", err);
    });
}
</script>

</body>
</html>