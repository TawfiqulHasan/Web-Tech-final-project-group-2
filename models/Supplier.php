<?php

class Supplier {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }


    public function getAll() {
        return mysqli_query($this->conn,
            "SELECT * FROM suppliers"
        );
    }


    public function getById($id) {
        $res = mysqli_query($this->conn,
            "SELECT * FROM suppliers WHERE id=$id"
        );
        return mysqli_fetch_assoc($res);
    }


    public function create($company, $contact, $phone, $email, $address, $city, $terms) {
        return mysqli_query($this->conn,
            "INSERT INTO suppliers
            (company_name, contact_person, phone, email, address, city, payment_terms)
            VALUES
            ('$company','$contact','$phone','$email','$address','$city','$terms')"
        );
    }


    public function update($id, $company, $contact, $phone, $email, $address, $city, $terms) {
        return mysqli_query($this->conn,
            "UPDATE suppliers SET
            company_name='$company',
            contact_person='$contact',
            phone='$phone',
            email='$email',
            address='$address',
            city='$city',
            payment_terms='$terms'
            WHERE id=$id"
        );
    }


    public function delete($id) {
        return mysqli_query($this->conn,
            "DELETE FROM suppliers WHERE id=$id"
        );
    }
}
?>