CREATE TABLE IF NOT EXISTS tblStatus(
    id_status INT PRIMARY KEY AUTO_INCREMENT,
    status VARCHAR(20) NOT NULL,
    created_at DATETIME,
    updated_at DATETIME
);