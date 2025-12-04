DROP DATABASE IF EXISTS SMART_WALLET;
CREATE DATABASE IF NOT EXISTS SMART_WALLET;
use SMART_WALLET;

DROP TABLE IF EXISTS incomes;
CREATE TABLE if not exists incomes(
    id int PRIMARY key AUTO_INCREMENT,
    montants DECIMAL(10,2) not null check (montants > 0),
    categorie VARCHAR(30) not null,
    description VARCHAR(100) not null,
    date DATETIME DEFAULT (CURRENT_TIMESTAMP)
);

DROP TABLE IF EXISTS expenses;
CREATE TABLE if not exists expenses(
    id int PRIMARY key AUTO_INCREMENT,
    montants DECIMAL(10,2) not null check (montants > 0),
    categorie VARCHAR(30) not null,
    description VARCHAR(100) not null,
    date DATETIME DEFAULT (CURRENT_TIMESTAMP)
);

insert into incomes (montants, categorie, description) 
values (55.5, "t9diya", "khizo btata"),
(55.5, "t9diya", "khizo btata"),
(55.5, "t9diya", "khizo btata");

select * from incomes;
delete from incomes;

show tables;
CREATE DATABASE IF NOT EXISTS finance_manager;