CREATE TABLE IF NOT EXISTS tblProducts(
    id_product INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(10) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description VARCHAR(50) NOT NULL,
    id_category INT NOT NULL,
    id_status INT NOT NULL,
    created_at DATETIME,
    updated_at DATETIME,
    foreign key (id_category) REFERENCES tblCategories(id_category),
    foreign key (id_status) REFERENCES tblStatus(id_status),
)