# PHP-Game-User-Linking-System
A partially completed PHP CRUD app about games and customers

This is one of the last school projects i made with PHP. It's inspired by steam, which has customers and games that are linked to them.

Important:
- This repository does not contain any database files. The goal of the repository is to show my project's code!
- Sensitive data such as password inside the PHP Mailer settings have been replaced with placeholders!

Features:
- To prevent unauthorized access, a login is required. That way, only administrators are allowed to access the application. (password hashing and verify).
- When you try entering the mainscreen of the app without logging in, you will be returned to the login screen. (sessions and header locations)
- After logging in succesfully the admin gets to see the list of every customer. (SELECT)
- The admin can add a customer to the database by pressing "toevoegen". (INSERT)
- By pressing the "opties" button the admin opens a small menu with more CRUD options such as a DELETE or UPDATE
- By pressing on "Game koppelen" the admin can link games from the database to the customer from a dropdown menu. 
- By pressing on "Aantal games mailen" the admin sends a list of the customer's games to it's email-adress. (PHP Mailer)

This app consists of lookups and linking tables, which I am very comfortable with by now! I think i have made a lot of progression in terms of databses, as i found it quite challenging a couple months ago.

Future ideas:
- CRUD system for games table aswell
- A customer login / interface where they can see their own games aswell (but not edit or delete them).


  
