CREATE DATABASE IF NOT EXISTS coffee_machine;
CREATE TABLE drinks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        drink CHAR(10),
        numberOfSugars int(1),
        price float(3,2),
        extraHot boolean
    );