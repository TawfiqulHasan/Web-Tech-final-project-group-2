document.addEventListener("DOMContentLoaded", function () {
    // Basic JavaScript validation
    const forms = document.querySelectorAll(".needs-validation");

    forms.forEach(function (form) {
        form.addEventListener("submit", function (event) {
            const requiredFields = form.querySelectorAll("[required]");
            let valid = true;

            requiredFields.forEach(function (field) {
                if (field.value.trim() === "") {
                    valid = false;
                    field.style.borderColor = "red";
                } else {
                    field.style.borderColor = "#bbb";
                }
            });

            if (!valid) {
                event.preventDefault();
                alert("Please fill all required fields.");
            }
        });
    });

    // Ajax / JSON feature for dashboard
    const lowStockBox = document.getElementById("ajaxLowStockBox");

    if (lowStockBox) {
        fetch("api.php?action=low_stock_count")
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (data.success) {
                    lowStockBox.innerHTML = "Low stock products: <strong>" + data.low_stock_count + "</strong>";
                } else {
                    lowStockBox.innerHTML = "Could not load low stock data.";
                }
            })
            .catch(function () {
                lowStockBox.innerHTML = "Ajax request failed.";
            });
    }

    // Ajax / JSON feature for report page
    const loadLowStockBtn = document.getElementById("loadLowStockBtn");
    const ajaxReportBox = document.getElementById("ajaxReportBox");

    if (loadLowStockBtn && ajaxReportBox) {
        loadLowStockBtn.addEventListener("click", function () {
            ajaxReportBox.innerHTML = "Loading...";

            fetch("api.php?action=low_stock_products")
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    if (!data.success) {
                        ajaxReportBox.innerHTML = "Could not load report.";
                        return;
                    }

                    if (data.products.length === 0) {
                        ajaxReportBox.innerHTML = "No low stock products.";
                        return;
                    }

                    let html = "<strong>Ajax Loaded Products:</strong><ul>";

                    data.products.forEach(function (product) {
                        html += "<li>" + product.name + " - Current Stock: " + product.current_stock + "</li>";
                    });

                    html += "</ul>";
                    ajaxReportBox.innerHTML = html;
                })
                .catch(function () {
                    ajaxReportBox.innerHTML = "Ajax request failed.";
                });
        });
    }
});
