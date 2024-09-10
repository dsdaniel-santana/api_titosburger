CREATE TABLE IF NOT EXISTS tblOrders(
    id_order INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT NOT NULL,
    id_status INT NOT NULL,
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (id_user) REFERENCES tblUsers (id_user),
    FOREIGN KEY (id_status) REFERENCES tblStatus (id_status)

);