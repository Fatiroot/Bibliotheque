 CREATE DATABASE Bibilotheque;

 CREATE TABLE `User` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fullname VARCHAR (255) NOT NULL,
    lastname VARCHAR (255) NOT NULL,
    email VARCHAR (255) NOT NULL,
    password VARCHAR (255) NOT NULL,
    phone VARCHAR (255) NOT NULL,
    budget FLOAT  

 );
 CREATE TABLE Role (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR (255) NOT NULL
    );

    CREATE TABLE Use_Role (
     id INT PRIMARY KEY AUTO_INCREMENT,
     user_id INT,
     FOREIGN KEY (user_id) REFERENCES `user`(id),
     role_id INT,
     FOREIGN KEY (role_id) REFERENCES Role(id)
    );
    
  CREATE TABLE Book (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR (255) NOT NULL,
    author VARCHAR (255) NOT NULL,
    genre VARCHAR (255) NOT NULL,
    description VARCHAR (255) NOT NULL,
    total_copies INT,
    available_copies INT 
 );
  CREATE TABLE Reservation (
   id INT PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR (255) NOT NULL,
    reservation_date DATE,
    return_date DATE,
    is_returned INT ,
     user_id INT,
    FOREIGN KEY (user_id) REFERENCES `user`(id),
     book_id INT,
    FOREIGN KEY (book_id) REFERENCES Book(id)

 );
