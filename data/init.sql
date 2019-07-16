CREATE DATABASE test11;

  use test11;

  CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    level VARCHAR(30) NOT NULL,
    age INT(3) NOT NULL,
    tshirt VARCHAR(30),
    docName VARCHAR(30) NOT NULL,
    docPhone VARCHAR(30) NOT NULL,
    medInfo VARCHAR(50),
    water VARCHAR(5),
    walkRide VARCHAR(5),
    parentFirst VARCHAR(20),
    parentLast VARCHAR(20),
    primaryEmail VARCHAR(30) NOT NULL,
    primaryPhone VARCHAR(30) NOT NULL,
    otherParentFirst VARCHAR(20),
    otherParentLast VARCHAR(20),
    otherEmail VARCHAR(30),
    otherPhone VARCHAR(30),
    emergencyFirst VARCHAR(30) NOT NULL,
    emergencyLast VARCHAR(30) NOT NULL,
    emergencyPhone VARCHAR(30) NOT NULL,
    address VARCHAR(30),
    city VARCHAR(30),
    state VARCHAR(20),
    zipcode VARCHAR(10),
    resident VARCHAR(5),
    motherPickUp VARCHAR(5),
    fatherPickUp VARCHAR(5),
    pickUpList VARCHAR(100)
  );

  CREATE TABLE weekly (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    level VARCHAR(30) NOT NULL,
    attendence VARCHAR(100),
    lateOut VARCHAR(100),
    subs VARCHAR(100),
    tshirtQty INT(2)
  );
