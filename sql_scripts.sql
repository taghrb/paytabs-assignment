CREATE DATABASE paytabs_db;

USE paytabs_db;

CREATE TABLE categories (
  category_id INT PRIMARY KEY AUTO_INCREMENT,
  parent_id INT,
  category_name VARCHAR(255)
);

INSERT INTO `categories` (`category_id`, `parent_id`, `category_name`) VALUES
(1, NULL, 'Category A'),
(2, NULL, 'Category B'),
(3, 2, 'Sub B1'),
(4, 2, 'Sub B2'),
(5, 4, 'SUB SUB B2-1'),
(6, 4, 'SUB SUB B2-2'),
(7, 5, 'SUB SUB SUB B2-1-1'),
(8, 5, 'SUB SUB SUB B2-1-2');
