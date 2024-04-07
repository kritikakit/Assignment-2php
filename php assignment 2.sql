CREATE DATABASE filee;
USE filee;

CREATE TABLE mineinfo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uid INT NOT NULL,
    uname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    phone VARCHAR(20) NOT NULL
);
DROP TABLE mineinfo;

CREATE TABLE mineinfo (
    product_number INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255) NOT NULL
);