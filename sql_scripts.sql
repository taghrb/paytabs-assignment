CREATE DATABASE paytabs_db;

USE paytabs_db;

CREATE TABLE categories (
  category_id INT PRIMARY KEY AUTO_INCREMENT,
  parent_id INT,
  category_name VARCHAR(255)
);
