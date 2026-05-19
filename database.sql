CREATE DATABASE IF NOT EXISTS warehouse_db;
USE warehouse_db;

DROP TABLE IF EXISTS activity_logs;
DROP TABLE IF EXISTS stock_discrepancy_reports;
DROP TABLE IF EXISTS stock_transactions;
DROP TABLE IF EXISTS purchase_order_items;
DROP TABLE IF EXISTS purchase_orders;
DROP TABLE IF EXISTS product_locations;
DROP TABLE IF EXISTS supplier_products;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS suppliers;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS warehouse_zones;
DROP TABLE IF EXISTS warehouses;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password_hash VARCHAR(255),
    phone VARCHAR(20),
    role ENUM('staff','purchasing','manager','admin'),
    profile_pic VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE warehouses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    address TEXT,
    city VARCHAR(100),
    manager_id INT,
    is_active TINYINT(1) DEFAULT 1
);

CREATE TABLE warehouse_zones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    warehouse_id INT,
    zone_code VARCHAR(50),
    description TEXT
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    description TEXT,
    parent_id INT NULL
);

CREATE TABLE suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(100),
    contact_person VARCHAR(100),
    phone VARCHAR(20),
    email VARCHAR(100),
    address TEXT,
    city VARCHAR(100),
    payment_terms TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(100),
    sku VARCHAR(100),
    description TEXT,
    unit ENUM('pcs','kg','litres','boxes'),
    reorder_level INT,
    current_stock INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE supplier_products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_id INT,
    product_id INT,
    unit_price DECIMAL(10,2),
    lead_time_days INT,
    is_preferred_supplier TINYINT(1) DEFAULT 0
);

CREATE TABLE product_locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    warehouse_id INT,
    zone_id INT,
    bin_code VARCHAR(100)
);

CREATE TABLE purchase_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_id INT,
    raised_by INT,
    approved_by INT NULL,
    status ENUM('draft','submitted','approved','received','cancelled'),
    expected_delivery_date DATE,
    total_estimated_value DECIMAL(10,2),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE purchase_order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    po_id INT,
    product_id INT,
    ordered_qty INT,
    unit_price DECIMAL(10,2),
    received_qty INT
);

CREATE TABLE stock_transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    warehouse_id INT,
    user_id INT,
    type ENUM('in','out','adjustment','transfer'),
    quantity INT,
    unit_price DECIMAL(10,2) NULL,
    po_id INT NULL,
    reason TEXT,
    reference_note TEXT,
    transaction_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE stock_discrepancy_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    warehouse_id INT,
    reported_by INT,
    description TEXT,
    expected_qty INT,
    actual_qty INT,
    status ENUM('open','under_review','resolved'),
    resolved_by INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action_type VARCHAR(100),
    entity VARCHAR(100),
    entity_id INT,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users(name,email,password_hash,phone,role)
VALUES
('Partha Sharothi Mazumder','parthasmajumder2018@gmail.com','7890','01700000000','admin'),
('Tawfiq','staff@gmail.com','1234','01700000000','staff');

INSERT INTO warehouses(name,address,city)
VALUES
('Main Warehouse','Dhaka Warehouse','Dhaka');

INSERT INTO warehouse_zones(warehouse_id,zone_code,description)
VALUES
(1,'A1','Electronics Zone'),
(1,'B1','Accessories Zone');

INSERT INTO categories(name,description)
VALUES
('Electronics','Electronic Products');

INSERT INTO suppliers(company_name,contact_person,phone,email,address,city,payment_terms)
VALUES
('ABC Supplier','Mr. Rahim','01824356356','rahim@gmail.com','Dhaka','Dhaka','Payment within 30 days');


INSERT INTO products(category_id,name,sku,unit,reorder_level,current_stock)
VALUES
(1,'Keyboard','KB101','pcs',5,20),
(1,'Mouse','MS102','pcs',5,3),
(1,'Monitor','MN103','pcs',2,0);

INSERT INTO activity_logs(user_id, action_type, entity, entity_id, description)
VALUES
(1, 'seed', 'database', 1, 'Initial sample data inserted');
