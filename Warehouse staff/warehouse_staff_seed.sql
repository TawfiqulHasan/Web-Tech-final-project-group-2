INSERT INTO users(name,email,password_hash,phone,role)
VALUES
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

INSERT INTO products(category_id,name,sku,unit,reorder_level,current_stock)
VALUES
(1,'Keyboard','KB101','pcs',5,20),
(1,'Mouse','MS102','pcs',5,3),
(1,'Monitor','MN103','pcs',2,0);

INSERT INTO products(category_id,name,sku,unit,reorder_level,current_stock)
VALUES
(1,'Laptop','LP104','pcs',3,8),
(1,'USB Cable','USB105','pcs',10,25);