CREATE TABLE IF NOT EXISTS tblItensOrders(
    id_item_order INT PRIMARY KEY AUTO_INCREMENT,
    id_order INT NOT NULL,
    id_product INT NOT NULL,
    price_product DECIMAL (10,2) NOT NULL,
    qtd INT NOT NULL,
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (id_order) REFERENCES tblOrders(id_order),
    FOREIGN KEY (id_product) REFERENCES tblProducts(id_product),

);