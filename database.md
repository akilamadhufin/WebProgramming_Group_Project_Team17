
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
  `name` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'UNIQUE',
  `rating` varchar(50) NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

```

Table 4 - orderDelivery -(Akila Randunu Pathirannehelage)<br>
sql
```
CREATE TABLE `deliveryData` (
  `deliveryOrderId` int NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `deliveryEmail` varchar(50) NOT NULL,
  `deliveryAddress` varchar(50) NOT NULL,
  `phoneNum` varchar(50) NOT NULL,
  `deliveryDate` date NOT NULL,
  `deliveryTime` time(6) NOT NULL,
  `mealName` varchar(50) NOT NULL,
  `portionSize` varchar(50) NOT NULL,
  `addMore` varchar(50) NOT NULL,
  `deliveryMessage` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

```

Table 4 - orderPickup -(Akila Randunu Pathirannehelage)<br>
sql
```
CREATE TABLE `pickupData` (
  `pickupOrderId` int NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `pickupEmail` varchar(50) NOT NULL,
  `phoneNum` varchar(50) NOT NULL,
  `pickupDate` date NOT NULL,
  `pickupTime` time(6) NOT NULL,
  `mealName` varchar(50) NOT NULL,
  `portionSize` varchar(50) NOT NULL,
  `addMore` varchar(50) NOT NULL,
  `pickupMessage` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```
<br>
