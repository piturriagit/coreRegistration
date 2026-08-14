CREATE DATABASE usuarios_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_0900_ai_ci;

USE usuarios_db;

CREATE USER 'admin'@'localhost'
    IDENTIFIED BY 'admin@123';

GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, ALTER, INDEX
    ON usuarios_db.*
    TO 'admin'@'localhost';

FLUSH PRIVILEGES;

CREATE TABLE usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE
);

-- $mysql -h localhost -u admin -p usuarios_db
-- mysql> show databases;
-- +--------------------+
-- | Database           |
-- +--------------------+
-- | information_schema |
-- | performance_schema |
-- | usuarios_db        |
-- +--------------------+
-- 3 rows in set (0.00 sec)
-- 
-- mysql> show tables;
-- +-----------------------+
-- | Tables_in_usuarios_db |
-- +-----------------------+
-- | usuarios              |
-- +-----------------------+
-- 1 row in set (0.00 sec)
-- 
-- mysql> select * from usuarios order by id desc;
-- Empty set (0.00 sec)