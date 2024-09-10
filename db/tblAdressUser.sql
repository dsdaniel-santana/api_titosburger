CREATE TABLE IF NOT EXISTS tblAdressUser(
    id_adress INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT NOT NULL,
    adress VARCHAR(20) NOT NULL,
    adress1 VARCHAR(20) NOT NULL,
    city VARCHAR(20) NOT NULL,
    state VARCHAR(20) NOT NULL,
    created_at DATETIME,
    updated_at DATETIME
    
);