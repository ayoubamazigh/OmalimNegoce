CREATE DATABASE Omalimnegoce;

USE Omalimnegoce;

CREATE TABLE Article(
    title VARCHAR(40) NOT NULL,
    descrition VARCHAR(500) NOT NULL,
    temp VARCHAR(10),
    type VARCHAR(25),
    image VARCHAR(40)
)ENGINE = INNODB;

CREATE TABLE Admin(
    username VARCHAR(10),
    password VARCHAR(25),
    num_visitors INT
)ENGINE = INNODB;

insert into admin values('admin', 'admin', 0);
