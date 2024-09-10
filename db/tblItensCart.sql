CREATE TABLE IF NOT EXISTS tblItenCart(
    id_item_cart INT PRIMARY KEY,
    id_cart INT NOT NULL,
    id_product INT NOT NULL,
    price_product DECIMAL (10,2) NOT NULL,
    qtd INT,
    created_at DATETIME,
    updated_at DATETIME

);