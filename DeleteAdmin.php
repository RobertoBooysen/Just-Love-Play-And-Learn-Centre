<?php
// Include the database connection file
global $conn;
require_once 'DBConn.php';

// Check if the user is authenticated
//(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    // Redirect to the login page if not authenticated
    header("Location: AdminLogin.php");
    exit();
}
//(Gosselin, Kokoska and Easterbrooks,2011)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission for deleting an admin user
    $username = $_POST['usernameToDelete'];

    if ($conn === false) {
        // Display a database connection error message
        die("Database connection error: " . mysqli_connect_error());
    }

    // Prepare a SQL statement to delete the admin user
    $sql = "DELETE FROM admin WHERE username = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect back to the admin list page after deleting
            header("Location: AdminTable.php");
            exit();
        } else {
            // Display a message if deletion failed
            echo "Admin user deletion failed.";
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    }

    // Close the database connection
    //(Gosselin, Kokoska and Easterbrooks,2011)
    mysqli_close($conn);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['username'])) {
    // Display the confirmation form for deleting the admin user
    $username = $_GET['username'];
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <!-- Set the viewport for responsive design -->
        <!--(W3schools,2023)-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="CSS/admin.css"><!-- Include a custom admin.css stylesheet -->
        <!--(W3schools,2023)-->
        <title>Delete Admin</title>
    </head>
    <style>
        /* Define CSS custom properties */
        /*(W3Schools,2023)*/
        :root {
            --primary-color: rgb(11, 78, 179);
        }

        /* Apply box-sizing to all elements */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        /* Style for form labels */
        /*(W3Schools,2023)*/
        label {
            display: block;
            margin-bottom: 0.5rem;
        }

        /* Style for form input elements */
        /*(W3Schools,2023)*/
        input {
            display: block;
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            height: 50px;
        }

        /* CSS class for setting width to 50% */
        /*(W3Schools,2023)*/
        .width-50 {
            width: 50%;
        }

        /* CSS class for setting margin-left to auto */
        /*(W3Schools,2023)*/
        .ml-auto {
            margin-left: auto;
        }

        /* Style for form container with responsive width */
        /*(W3Schools,2023)*/
        .form {
            max-width: 1000px;
            margin: 0 auto;
            border: none;
            border-radius: 10px !important;
            overflow: hidden;
            padding: 1.5rem;
            background-color: #fff;
            padding: 20px 30px; /* Style for the form container */
        }

        /* Style for buttons */
        /*(W3Schools,2023)*/
        .btn {
            padding: 0.75rem;
            display: block;
            text-decoration: none;
            background-color: #77d4e3;
            color: black;
            text-align: center;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: 0.3s;
        }

        /* Hover effect for buttons */
        /*(W3Schools,2023)*/
        .btn:hover {
            box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2;
        }

        /* Style for buttons */
        .delete_btn {
            padding: 0.75rem;
            display: block;
            text-decoration: none;
            background-color: #d03c2f;
            color: black;
            text-align: center;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: 0.3s;
        }

        /* Hover effect for buttons */
        /*(W3Schools,2023)*/
        .delete_btn:hover {
            box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2;
        }

        /* Style for error messages */
        /*(W3Schools,2023)*/
        .error-message {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 15px;
            background-color: rgba(255, 0, 0, 0.8);
            color: #fff;
            border-radius: 5px;
            font-size: 16px;
            z-index: 9999;
        }
    </style>
    <body>

    <h1 style="text-align: center">Delete Admin User</h1>

    <form method="post" action="DeleteAdmin.php" class="form">
        <!-- This input element is used to store the username to be deleted in a hidden field -->
        <input type="hidden" name="usernameToDelete" value="<?php echo $username; ?>">
        <!-- Display a confirmation message to the user with the username to be deleted -->
        <p>Are you sure you want to delete the admin user with the username "<?php echo $username; ?>"?</p>
        <input type="submit" value="Delete" class="delete_btn" style="color: white; font-size: 16px">

        <br>

        <a href="AdminTable.php" class="btn">Cancel</a>
    </form>

    </body>
    </html>

<!--(Gosselin, Kokoska and Easterbrooks,2011)-->
    <?php
} else {
    // Invalid request
    header("Location: AdminTable.php");
    exit();
}
?>
