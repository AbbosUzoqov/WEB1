CREATE TABLE `catalogs` (Add commentMore actions
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `parentId` int(11) DEFAULT NULL,
    , PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `catalogs` (`id`, `name`, `parentId`) VALUES
(1, 'Каталог товаров', NULL),
(2, 'Мойки', 1),
(3, 'Ulgran', 2),
(4, 'Smth', 3),
(5, 'Smth2', 3),
(6, 'Handmade', 2),
(7, 'Smth', 6),
(8, 'Smth2', 6),
(9, 'Фильтры', 1),
(10, 'Vigro Mramor', 9),
(11, 'Ulgran', 9),
(14, 'Smth', 11),
(15, 'Smth2', 11);Add comment