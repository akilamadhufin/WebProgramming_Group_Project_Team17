# Exercise 5: Readme.md

***Welcome to the task README!***

# WEB PROGRAMMING_HOT POT - Team 17

Welcome to "Hot Pot," an innovative web programming project brought to you by Team 17! Hot Pot is a dynamic and user-centric web application designed to revolutionize the way users discover, share, and indulge in their culinary preferences. Focused on the diverse world of hot pot cuisine, our platform aims to create a vibrant community of food enthusiasts, providing an immersive and interactive experience.

## Table of Contents
- [Features](#features)
- [Database Tables](#database-tables)
- [Created Forms](#created-forms)
- [Created Tables](#created-tables)

---

## Features

- [x] Feature 1 (Gimhani Garusing Arachchige): User Registration with different user interface (for admin and users) and login/logout.
- [x] Feature 2 (Gimhani Garusing Arachchige): User editing and deleting data
- [x] Feature 3 (Wasantha Hewa Walimunige): Book Table and edit or delete reservations for user and admin
- [x] Feature 4 (Thilini Gamage): Add reviews and edit or delete reviews for user and admin
- [x] Feature 5 (Akila Randunu Pathirannehelage): Order online- Adding items to cart and make Delivery or pickup, edit delete order data for both user and Admin
- [x] Feature 6 (Akila Randunu Pathirannehelage): admin adding/ editing/ deleteing items to display for customers

### Feature 1 - User Registration

User can register- name, email, address, phone. click on log in. open in new php. enter email and password. new user. click on sign up. enter personal data. click on register. display successfully registered.

### Feature 2 - User editing and deleting data

User can log in and view,edit/delete his/her data. admin can view edit and delete all users data (individual data or as abulk).

### Feature 3 - Book Table

user can book a table- date,time,name, phone,email. Once a reservation is made.seperate php page wil be opended and display reservation details. user can view, edit/ delete reservation data. admin can edit or delete (individual or as abulk) all reservation data.

### Feature 4 - Add reviews

user can add reviews(comments) based on their experinces. they can view, edit or delete their reviews. admin can edit or delete all reviews.

### Feature 5 - Order online

onile order- user can click on add to cart button add items to cart. Then then can checkout and total price will be displayed and data will be stored in database.  users can view/ change or delete their order data if they require. Admin can view all order data of all users and can edit or delete one by one or as a bulk.

### Feature 5 - Adding items to menu (display for customers)

Admin can add items ( images and other details) to display them in the menu for the customers. Admin can edit or delete those items.
---

## Database Tables

- Table 1 (Gimhani Garusing Arachchige): reginfo
- Table 2 (Wasantha Hewa Walimunige): reservation
- Table 3 (Thilini Gamage): customersinfo
- Table 4 (Akila Randunu Pathirannehelage): products
- Table 5 (Akila Randunu Pathirannehelage): cart
- Table 6 (Akila Randunu Pathirannehelage): orders

> ER Diagram of the database. 
![Screenshot 2024-03-01 224844](https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/assets/127040789/1522762b-b0ef-493a-ae39-272673d2423a)
---

## Created Forms

List and describe any forms that have been created as part of the project. Include details about the purpose of each form and any validation logic.

- Form 1 (Gimhani Garusing Arachchige): userRegistrationForm : Link to the related code file (github) | Link to the form (http://shell.hamk.fi/~gimhani23000/project/registration.php)](http://shell.hamk.fi/~gimhani23000/project/loginform.php)). | HTML and Java script Validations Applied
- Form 2 (Gimhani Garusing Arachchige): login form : Link to the related code file (github) | Link to the form (http://shell.hamk.fi/~gimhani23000/project/registration.php)](http://shell.hamk.fi/~gimhani23000/project/loginform.php)). | HTML and Java script Validations Applied 
- Form 3 (Gimhani Garusing Arachchige): admin editing/ deleting user data: Link to the related code file (github) | Link to the form (http://shell.hamk.fi/~gimhani23000/project/registration.php)](http://shell.hamk.fi/~gimhani23000/project/loginform.php)). | HTML and Java script Validations Applied
- Form 4 (Gimhani Garusing Arachchige): user editing/ deleting user data: Link to the related code file (github) | Link to the form (http://shell.hamk.fi/~gimhani23000/project/registration.php)](http://shell.hamk.fi/~gimhani23000/project/loginform.php)). | HTML and Java script Validations Applied

  
- Form 5: (Wasantha Hewa Walimunige): reservation Form: Link to the related code file (github - https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/allReservations.php) | Link to the form (http://shell.hamk.fi/~wasantha23000/WebProgramming/hotpotWebsite/allReservations.php).  | HTML and Java script Validations
- Form 6: (Wasantha Hewa Walimunige): user editing/ deleting reservation data: Link to the related code file (github - https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/allReservations.php) | Link to the form (http://shell.hamk.fi/~wasantha23000/WebProgramming/hotpotWebsite/allReservations.php).  | HTML and Java script Validations
- Form 7: (Wasantha Hewa Walimunige): admin editing/ deleting reservation data: Link to the related code file (github - https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/allReservations.php) | Link to the form (http://shell.hamk.fi/~wasantha23000/WebProgramming/hotpotWebsite/allReservations.php).  | HTML and Java script Validations

  
- Form 8: (Thilini Gamage): addReviewForm: Link to the related code file (github)(https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/addReviews.php) | Link to the form (shell.hamk.fi).  | HTML and Java script Validations(http://shell.hamk.fi/~thilini23002/project/addReviews.php)
- Form 9: (Thilini Gamage): user editing or deleting review: Link to the related code file (github)(https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/addReviews.php) | Link to the form (shell.hamk.fi).  | HTML and Java script Validations(http://shell.hamk.fi/~thilini23002/project/addReviews.php)
  - Form 10: (Thilini Gamage): admin editing or deleting review: Link to the related code file (github)(https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/addReviews.php) | Link to the form (shell.hamk.fi).  | HTML and Java script Validations(http://shell.hamk.fi/~thilini23002/project/addReviews.php)
  
- Form 11: (Akila Randunu Pathirannehelage): edting items in the cart: Link to the related code file (https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/cart.php) | Link to the form (http://shell.hamk.fi/~akila23000/WebProgramming/HOTPOT_Website_Group17/cart.php).  | HTML and Java script Validations
- Form 12: (Akila Randunu Pathirannehelage): checkout form: Link to the related code file (https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/checkout.php) | Link to the form (http://shell.hamk.fi/~akila23000/WebProgramming/HOTPOT_Website_Group17/checkout.php).  | HTML and Java script Validations
- Form 13: (Akila Randunu Pathirannehelage): user editing/deleting order details: Link to the related code file (https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/myOrder.php) | Link to the form (http://shell.hamk.fi/~akila23000/WebProgramming/HOTPOT_Website_Group17/myOrder.php).  | HTML and Java script Validations
- Form 14: (Akila Randunu Pathirannehelage): admin editing/deleting order details: Link to the related code file (https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/editProfile.php) | Link to the form (http://shell.hamk.fi/~akila23000/WebProgramming/HOTPOT_Website_Group17/allOrderDetails.php).  | HTML and Java script Validations
- Form 15: (Akila Randunu Pathirannehelage): admin adding or editing items in the menu to display for users: Link to the related code file (https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/products.php) | Link to the form (http://shell.hamk.fi/~akila23000/WebProgramming/HOTPOT_Website_Group17/adminAddProducts.php).  | HTML and Java script Validations

---

## Created Tables


- Table 1 (Gimhani Garusing Arachchige): userRegistration | Link to the related code file (github) | Link to the table (https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/database.md)).
  
- Table 2 (Wasantha Hewa Walimunige): reservation | Link to the related code file ([github](https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/database.md)) | Link to the table ([shell.hamk.fi](http://shell.hamk.fi/pma/index.php?route=/sql&db=wp_wasantha23000&table=reservation&pos=0)).
  
- Table 3 (Thilini Gamage): customersinfo | Link to the related code file (https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/database.md) | Link to the table (shell.hamk.fi).(http://shell.hamk.fi/pma/index.php?route=/sql&pos=0&db=wp_thilini23002&table=customersinfo)
  
- Table 4 (Akila Randunu Pathirannehelage): orders | Link to the related code file (https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/database.md) | Link to the table (http://shell.hamk.fi/pma/index.php?route=/sql&pos=0&db=wp_akila23000&table=deliveryData).
  
- Table 5 (Akila Randunu Pathirannehelage): cart | Link to the related code file (https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/database.md) | Link to the table (http://shell.hamk.fi/pma/index.php?route=/sql&pos=0&db=wp_akila23000&table=pickupData).

- Table 6 (Akila Randunu Pathirannehelage): products | Link to the related code file (https://github.com/akilamadhufin/WebProgramming_Group_Project_Team17/blob/main/database.md) | Link to the table (http://shell.hamk.fi/pma/index.php?route=/sql&pos=0&db=wp_akila23000&table=pickupData).
---

