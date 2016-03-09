DROP TABLE IF EXISTS Users;

/* This is a very simple table for a mysql-php example */
CREATE TABLE Users (
    id INT NOT NULL AUTO_INCREMENT,
    hashedPass VARCHAR(255) NOT NULL,
    email VARCHAR(45) UNIQUE NOT NULL,
    PRIMARY KEY (ID)
);