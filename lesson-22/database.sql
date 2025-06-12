-- Создание базы данных
CREATE DATABASE IF NOT EXISTS catalog_db;
USE catalog_db;

-- Таблица продуктов
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT
);

-- Таблица отзывов
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    username VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

INSERT INTO products (name, price, description, image) VALUES
('Синтетическое моторное масло', 500, 'Высококачественное синтетическое масло для двигателей', 'uploads/oil1.jpg'),
('Полусинтетическое масло для двигателя', 600, 'Оптимальный выбор для современных автомобилей', 'uploads/oil2.jpg'),
('Минеральное моторное масло', 550, 'Надежная защита двигателя при любых условиях', 'uploads/oil3.jpg'),
('Моторное масло премиум класса', 700, 'Максимальная защита и производительность двигателя', 'uploads/oil4.jpg'),
('Экологичное масло с добавками', 650, 'Улучшенная формула для снижения износа двигателя', 'uploads/oil5.jpg');

