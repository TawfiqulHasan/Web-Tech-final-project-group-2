<?php
class SupplierController {
    public function index() {
        require_role(["admin", "manager", "purchasing"]);

        view("suppliers/index", ["suppliers" => Supplier::all()]);
    }

    public function store() {
        require_role(["admin", "manager", "purchasing"]);

        $company_name = trim($_POST["company_name"] ?? "");
        $email = trim($_POST["email"] ?? "");

        if ($company_name === "") {
            set_flash("error", "Company name is required.");
            redirect("index.php?route=suppliers");
        }

        if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            set_flash("error", "Supplier email is invalid.");
            redirect("index.php?route=suppliers");
        }

        $id = Supplier::create([
            "company_name" => $company_name,
            "contact_person" => trim($_POST["contact_person"] ?? ""),
            "phone" => trim($_POST["phone"] ?? ""),
            "email" => $email,
            "address" => trim($_POST["address"] ?? ""),
            "city" => trim($_POST["city"] ?? ""),
            "payment_terms" => trim($_POST["payment_terms"] ?? "")
        ]);

        log_activity("create", "suppliers", $id, "Created supplier: " . $company_name);
        set_flash("success", "Supplier added successfully.");
        redirect("index.php?route=suppliers");
    }
}
?>
