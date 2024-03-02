
Table 1 - userRegistration -(Gimhani Garusing Arachchige) <br>
sql
```
CREATE TABLE `registrationinfo` (
  `id` int NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL COMMENT 'UNIQUE',
  `phone_number` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `city_code` int NOT NULL,
  `enter_password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `confirm_password` varchar(50) DEFAULT NULL
) 
```


Table 2 - booking -(Wasantha Hewa Walimunige) <br>

sql
```
CREATE TABLE `reservation` (
  `orderid` int NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `numberOfPersons` int NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`orderid`),
  ADD UNIQUE KEY `email` (`email`);
ALTER TABLE `reservation`
  MODIFY `orderid` int NOT NULL AUTO_INCREMENT;

```




Table 3 - REVEIW FORM -(Thilini Gamage)<br>

sql
```
CREATE TABLE `customersinfo` (
  `reviewId` int NOT NULL,
  `fname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lname` varchar(50) NOT NULL,
  `phoneNum` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `addStar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `additionalComment` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

```

Table 4 - cart -(Akila Randunu Pathirannehelage)<br>
sql
```
CREATE TABLE cart (
  id int NOT NULL,
  email varchar(50) NOT NULL,
  name varchar(50) NOT NULL,
  price float NOT NULL,
  image blob NOT NULL,
  quantity int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
```

Table 5 - orders -(Akila Randunu Pathirannehelage)<br>
sql
```
CREATE TABLE orders (
  id int NOT NULL,
  name varchar(50) NOT NULL,
  number varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  method varchar(50) NOT NULL,
  city varchar(50) NOT NULL,
  pin_code int NOT NULL,
  total_products varchar(50) NOT NULL,
  total_price float NOT NULL,
  date date NOT NULL,
  time time NOT NULL,
  flat int NOT NULL,
  state varchar(50) NOT NULL,
  country varchar(50) NOT NULL,
  street varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
```
<br>

Table 6 - products -(Akila Randunu Pathirannehelage)<br>
sql
```
CREATE TABLE products (
  id int NOT NULL,
  name varchar(50) NOT NULL,
  price float NOT NULL,
  category varchar(50) NOT NULL,
  rating varchar(50) NOT NULL,
  description text NOT NULL,
  image blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
```
<br>
