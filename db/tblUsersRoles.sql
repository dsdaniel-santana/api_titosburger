CREATE TABLE IF NOT EXISTS tblUserRoles(
    id_use_role INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    `group` VARCHAR(10),
    created_at DATETIME.
    updated_at DATETIME
);