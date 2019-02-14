# php-custom-framework-social-network
Basic Social Network using a custom Model-View-Controller Framework in PHP.

The used MVC framework has been developed from scratch, using .htaccess for a basic redirect functionality. The framework does contain a 
base "library" sub-directory, where all core classes do reside. The "Core" class ( app/libraries/Core.php ) does contain the functionality
for splitting the URL into an array which will be used to identify the desired controller and method to be called.
Ex: ".../pages/index" ( Pages controller, index method ).

The "Database" core library class ( app/libraries/Database.php ) abstracts the interaction with the MySQL database with PHP Data Objects extension, and makes it easier 
for users of this framework to perform CRUD operations to the database.

The "Controller" core parent class declares two main methods: "view" and "model", used by the rest of the controllers which inherit from
the base class to load either views or models. 

Based on this framework, a basic social network app has been developed, with the following features:
1. user authentication
2. server side validation
3. perform CRUD operations as an user

The UI has been developed using Bootstrap 4. 


