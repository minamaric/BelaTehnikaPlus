# BelaTehnikaPlus

## Description
BelaTehnikaPlus is a website dedicated to providing information about various home appliances. It allows users to browse the menu, view available products, search, filter, sort, add/remove products from the cart, and make purchases. Users can register or log in, with protection against unauthorized access. Upon registration, a confirmation email is sent with an activation link. Once the user clicks the link, the registration is verified. If a user attempts to log in unsuccessfully 3 times within 5 minutes, their account is locked. Alerts are sent after the second failed attempt and when the account is locked.

An **admin panel** is provided to add or remove users from the database, view page visit statistics in percentages, and list registered and logged-in users for the current day. Pagination is implemented for the list of all users ever registered on the site.

## Technologies
This website is built using the following technologies:
- HTML
- CSS
- JavaScript
- jQuery
- Bootstrap
- XML
- PHP
- phpMyAdmin

## Project Structure
The project is organized as follows:

- `index.php`: The main landing page.
- `prodavnica.php`: The page displaying all products with search, filter, and sort functionality, implemented using PHP.
- `prijavi_se.php`: The registration and login page.
- `autor.php`: The page with author information.
- `kontakt.php`: A contact form for users to communicate with the admin.
- `admin_panel.php`: The admin panel where users can be added or deleted, product statistics can be viewed, and a list of the logged-in users for the current day is displayed.
- `korpa.php`: The shopping cart, which stores added products, calculates the total price, and enables purchases. The cart is only visible when the user is logged in.

## Features
- **Dynamic navigation** generated from the database using PHP.
- **Dynamic product listings** displayed from the database using PHP and phpMyAdmin.
- **Search, filter, and sort functionality** for products, along with pagination.
- "Add to Cart" button under each product. If an unauthenticated user clicks it, they are redirected to the login page with a notification that they must be logged in to add products to the cart.
- **Shopping cart** displays added products, calculates the total price, and allows for checkout.
- The **registration form** includes 5 input fields, and when the form is submitted, it is validated both on the client and server side. The password is encrypted for security. An email with an activation link is sent to the user. If the email is already registered in the database, the user is redirected to the login page.
- When the user logs in, both client-side and server-side validation occurs. The server compares the entered password with the one in the database. If the email exists in the database and the passwords match, the login is successful. If the user attempts to log in unsuccessfully 2 times within 5 minutes, they receive an alert email. After the third failed attempt, the account is locked, and the user is notified via email.
- After successful registration or login, the menu displays "Log out" instead of "Log in."
- There is a **"Already have an account?"** link that directs users to the login form.
- Users receive appropriate success or error messages for registration and login.
- The **admin panel** allows adding users and products, viewing page visit statistics, and managing registered users. It also includes a table displaying all registered users on the site.

## Installation
To set up the project locally, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/username/project-name.git
