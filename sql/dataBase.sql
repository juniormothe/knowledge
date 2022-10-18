CREATE DATABASE classes CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE
    contacts(
        id BIGINT(255) NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NULL,
        email VARCHAR(255) NULL,
        PRIMARY KEY (id)
    );