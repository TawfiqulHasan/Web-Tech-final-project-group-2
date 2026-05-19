<h2>Discrepancy Details</h2>

<p><b>Product:</b> <?= $report['product_name'] ?></p>
<p><b>Warehouse:</b> <?= $report['warehouse_name'] ?></p>
<p><b>Expected:</b> <?= $report['expected_qty'] ?></p>
<p><b>Actual:</b> <?= $report['actual_qty'] ?></p>
<p><b>Description:</b> <?= $report['description'] ?></p>

<hr>

<h3>Resolve Report</h3>

<form method="POST" action="../controllers/DiscrepancyController.php?action=resolve">

    <input type="hidden" name="id" value="<?= $report['id'] ?>">

    <textarea name="resolution_note" required placeholder="Write resolution note..."></textarea>

    <br><br>

    <button type="submit">Mark as Resolved</button>

</form>

<br>

<a href="../controllers/DiscrepancyController.php?action=list">
    ← Back
</a>