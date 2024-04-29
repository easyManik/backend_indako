-- Active: 1714055583785@@147.139.210.135@5432
CREATE TABLE uom_list (
    id SERIAL PRIMARY KEY,
    uom_name VARCHAR(50) NOT NULL
);

CREATE TABLE product (
    id SERIAL PRIMARY KEY,
    code VARCHAR(50) NOT NULL,
    name VARCHAR(255) NOT NULL,
    color VARCHAR(50),
    is_raw_material BOOLEAN NOT NULL DEFAULT false,
    is_active BOOLEAN NOT NULL DEFAULT true,
    uom_id INT REFERENCES uom_list(uom_id),
    stock INT DEFAULT 0
);

CREATE TABLE product_prices (
    id SERIAL PRIMARY KEY,
    product_id INT REFERENCES product(id) ON DELETE CASCADE, 
    price DECIMAL(10, 2) NOT NULL, 
    published_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE product_uoms (
    id SERIAL PRIMARY KEY,
    product_id INT REFERENCES product(id) ON DELETE CASCADE,
    uom_id INT REFERENCES uom_list(uom_id) ON DELETE CASCADE,
    qty_conversion DECIMAL(10, 2) NOT NULL
);
 

CREATE TABLE sell_transaction (
    id SERIAL PRIMARY KEY,
    transaction_date DATE NOT NULL,
    customer_name VARCHAR(255) NOT NULL,
    is_cancelled BOOLEAN NOT NULL DEFAULT false,
    cancelled_at TIMESTAMP,
    is_printed BOOLEAN NOT NULL DEFAULT false, 
    printed_at TIMESTAMP,
    sub_total DECIMAL(10, 2) NOT NULL, 
    disc_amount DECIMAL(10, 2) NOT NULL DEFAULT 0.0,
    grand_total DECIMAL(10, 2) NOT NULL,
    notes TEXT, 
    sell_transaction_id INT REFERENCES sell_transaction(id) ON DELETE CASCADE, 
    product_id INT REFERENCES product(id) ON DELETE CASCADE,
    qty DECIMAL(10, 2), 
    uom_id INT REFERENCES uom_list(id) ON DELETE CASCADE, 
    price DECIMAL(10, 2), 
    disc_1 DECIMAL(5, 2) DEFAULT 0.0, 
    disc_2 DECIMAL(5, 2) DEFAULT 0.0, 
    total DECIMAL(10, 2), 
    cogs DECIMAL(10, 2)  
);

CREATE TABLE sell_transaction_detail (
    id SERIAL PRIMARY KEY,
    sell_transaction_id INT REFERENCES sell_transaction(id) ON DELETE CASCADE, 
    product_id INT REFERENCES product(id) ON DELETE CASCADE,
    qty DECIMAL(10, 2) NOT NULL, 
    uom_id INT REFERENCES uom_list(uom_id) ON DELETE CASCADE, 
    price DECIMAL(10, 2) NOT NULL, 
    disc_1 DECIMAL(5, 2) NOT NULL DEFAULT 0.0, 
    disc_2 DECIMAL(5, 2) NOT NULL DEFAULT 0.0, 
    disc_amount DECIMAL(10, 2) NOT NULL DEFAULT 0.0,
    total DECIMAL(10, 2) NOT NULL, 
    cogs DECIMAL(10, 2) NOT NULL 
);

SELECT * FROM product;

DROP Table sell_transaction;



 