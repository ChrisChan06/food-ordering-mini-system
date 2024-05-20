Food Ordering System Readme
System Overview
Our food ordering system provides a seamless experience for both users and administrators to manage food orders, categories, and items efficiently. The system consists of two main components: the front end, which handles user interactions, and the backend, where administrators manage the system's data and operations.

Front End(User Interaction Flow):

Start: Users open the website, initiating interaction with the food ordering system.

Homepage: The homepage loads, displaying available functionalities and a welcoming interface.

Fetch & Display Categories: Categories are fetched from the database and displayed on the homepage.

No Categories Available: If no categories exist, an error message is displayed.

Categories Available: If categories exist, the food menu section is displayed.

Fetch & Display Food Items: Food items are fetched and displayed under their respective categories.

Select Food Item: Users navigate through categories and select a food item to order.

Order Page: Detailed information about the selected food item is displayed.

Fill Order Form: Users fill out the order form with necessary details.

Submit Order Form: Users submit the form to place the order.

Validate & Process Order: The system validates the order information.

Store Order Details in DB: Valid orders are stored in the database for processing.

Redirect to Homepage with Message: Users are redirected to the homepage with a success or error message.

End: Users can continue browsing, place more orders, or exit the website.


Back End(Administrator Interaction Flow): 

Start: Admins log into the system to manage food orders and data.

Dashboard: The dashboard provides an overview of key metrics and access to management functionalities.

Manage Admin: Admins can manage other admin users.

CRUD Operations for Admins: Create, read, update, and delete admin users.

Manage Category: Admins can manage categories.

CRUD Operations for Categories: Create, read, update, and delete categories.

Manage Food: Admins can manage food items.

CRUD Operations for Food: Create, read, update, and delete food items.

Manage Order: Admins can manage orders.

Operations for Orders: Fetch order details and update order status.

Success/Fail Messages: Messages inform admins about the outcome of operations.

End: Admins can log out or continue managing tasks.

System Setup Instructions


Prerequisites:

VS Code installed on your system.
XAMPP installed and running locally.
PHP installed on your system.


Front End Setup:

Clone the repository from [https://github.com/ChrisChan06/food-ordering-mini-system].
Navigate to the food-ordering-mini-system directory.
Open the directory in VS Code.
Start the XAMPP control panel and ensure Apache server is running.
Move the frontend directory to the htdocs directory in your XAMPP installation folder.
Access the application at http://localhost/food-ordering-mini-system/ in your browser.

Back End Setup:

Clone the repository from [https://github.com/ChrisChan06/food-ordering-mini-system].
Navigate to the food-ordering-mini-system directory.
Open the directory in VS Code.
Start the XAMPP control panel and ensure Apache server and MySQL database are running.
Move the backend directory to the htdocs directory in your XAMPP installation folder.
Import the provided SQL database file into your MySQL database.
Update database configuration in config.php file with your MySQL credentials.
Access the backend APIs at http://localhost/food-ordering-mini-system/admin in your browser.

Additional Notes:

Ensure proper network connectivity between front end and back end for seamless communication.
Customize frontend and backend functionalities as per specific requirements.
Refer to API documentation for detailed information on available endpoints and request payloads.
