
Table 1 - userRegistration -(Gimhani Garusing Arachchige)
---sql
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

---

Table 3 - REVEIW FORM -(Thilini Gamage)

---sql
CREATE TABLE `customersinfo` (
  `name` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'UNIQUE',
  `rating` varchar(50) NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


---
