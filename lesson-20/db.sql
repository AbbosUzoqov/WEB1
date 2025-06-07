CREATE DATABASE menu_db;
USE menu_db;

CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    parent_id INT DEFAULT NULL,
    FOREIGN KEY (parent_id) REFERENCES menu_items(id) ON DELETE CASCADE
);


INSERT INTO menu_items (title, parent_id) VALUES 
('Каталог товаров', NULL),
('Мойки', 1),
('Ulgran', 2),
('Smith', 3),
('Smith', 3),
('Vigro Mramor', 2),
('Handmade', 2),
('Smith', 7),
('Smith', 7),
('Vigro Glass', 2),
('Фильтры', 1),
('Ulgran', 11),
('Smith', 12),
('Smith', 12),
('Vigro Mramor', 11);
