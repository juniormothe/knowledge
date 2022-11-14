CREATE DATABASE knowledge CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE
    contacts(
        id BIGINT(255) NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NULL,
        email VARCHAR(255) NULL,
        PRIMARY KEY (id)
    );

CREATE TABLE
    scale(
        id BIGINT(255) NOT NULL AUTO_INCREMENT,
        date_initial DATE NULL,
        date_final DATE NULL,
        scale_date TEXT NULL,
        scale_date_confirmed TEXT NULL,
        scale_date_changed TEXT NULL,
        PRIMARY KEY (id)
    );