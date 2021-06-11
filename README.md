# Happy Recipes
A website where users can find recipes, sign up to receive weekly recipes, and find inspiration for cooking. Also users can create a profile and log in to save favorite recipes.

# Authors
Ceser Escalona - Co-Founder/Developer

Phillip Ball - Co-Founder/Developer

# Project Requirements
1. Separates all database/business logic using the MVC pattern.

    *Implemented by: Separating files based on model, view, contoller, and using separate directories.
2. Routes all URLs and leverages a templating language using the Fat-Free framework.

    *Implemented by: Creating routes in the controller and calling them in the index. Also using composer and .htaccess files. 
3. Has a clearly defined database layer using PDO and prepared statements. You should have at least two related tables.

    *Implemented by: Using MySql in phpMyAdmin and the DataLayer class in the model directory. Tables related are hr_users and hr_recipes, hr_recipes and hr_ingredients.
4. Data can be viewed and added.

    *Implemented by: Creating and logging in as a user. As well as users favoriting recipes.
5. Has a history of commits from both team members to a Git repository. Commits are clearly commented.

    *Implemented by: Clearly commenting and communicating with each other to define tasks.
6. Uses OOP, and defines multiple classes, including at least one inheritance relationship.

    *Implemented by: Having the ability to create and manipulate user and recipe objects. Inheritance happens between a user and an admin.
7. Contains full Docblocks for all PHP files and follows PEAR standards.

    *Implemented by: Defined all functions with next line curly braces and used the length limit line to keep code short.
8. Has full validation on the client side through JavaScript and server side through PHP.

    *Implemented by: Including JavaScript script tags in the html, also added php validation by using the validation class in the model.
9. All code is clean, clear, and well-commented. DRY (Don't Repeat Yourself) is practiced.

    *Implemented by: Made sure to not repeat code by never copying blocks of code as well as using repeat statements and handlebar notation.
10. Your submission shows adequate effort for a final project in a full-stack web development course.

    *Implemented by: Consistent work throughout the quarter, as well as use of various programming languages and frameworks.
11. BONUS:  Incorporates Ajax that access data from a JSON file, PHP script, or API.

    *Implemented by: Accessing the usda api to randomly generate a food item and its nutrients.
    
# UML Class Diagram
![UML_Diagram_final](https://user-images.githubusercontent.com/77752703/121733504-6b648b80-caa8-11eb-9b61-dfbebe11e173.png)


# ER Database Diagram
![ER_Diagram_final](https://user-images.githubusercontent.com/77752703/121733472-61db2380-caa8-11eb-8189-08681ecf90a3.png)

