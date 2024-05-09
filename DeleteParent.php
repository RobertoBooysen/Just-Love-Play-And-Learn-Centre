<?php
//(Gosselin, Kokoska and Easterbrooks,2011)
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated
//(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    header("Location: AdminLogin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Handle form submission for deleting a parent
    $parentId = $_POST['parentIdToDelete'];

    //Prepare a SQL statement to delete the parent by ID
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $sql = "DELETE FROM parents WHERE id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $parentId);

        if (mysqli_stmt_execute($stmt)) {
            //Redirect back to the parent list page after deleting
            //(Gosselin, Kokoska and Easterbrooks,2011)
            header("Location: ParentsTable.php");
            exit();
        } else {
            //Deletion failed
            echo "Parent deletion failed.";
        }

        //Close the prepared statement
        //(Gosselin, Kokoska and Easterbrooks,2011)
        mysqli_stmt_close($stmt);
    }

    //Close the database connection
    mysqli_close($conn);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    //Display the confirmation form for deleting the parent
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $parentId = $_GET['id'];
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Set the viewport for responsive design -->
        <!--(W3schools,2023)-->
        <link rel="stylesheet" href="CSS/admin.css"> <!-- Include a custom admin.css stylesheet -->
        <title>Delete Parent</title>
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
        input {
            display: block;
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            height: 50px;
        }

        /* CSS class for setting width to 50% */
        .width-50 {
            width: 50%;
        }

        /* CSS class for setting margin-left to auto */
        /*(W3Schools,2023)*/
        .ml-auto {
            margin-left: auto;
        }

        /* Style for form container with responsive width */
        .form {
            max-width: 1000px;
            margin: 0 auto;
            border: none;
            border-radius: 10px !important;
            overflow: hidden;
            padding: 1.5rem;
            background-color: #fff;
            padding: 20px 30px; /*Style for the form container */
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
        .btn:hover {
            box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2;
        }

        /* Style for error messages */
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

        /*Style for buttons */
        /*(W3Schools,2023)*/
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

        /*Hover effect for buttons */
        .delete_btn:hover {
            box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2;
        }
    </style>

    <body>

    <h1 style="text-align: center">Delete Parent</h1>
<!--(W3Schools,2023)-->
    <form method="post" action="DeleteParent.php" class="form">
        <!--This input element is used to store the parent ID to be deleted in a hidden field -->
        <input type="hidden" name="parentIdToDelete" value="<?php echo $parentId; ?>">
        <!--Display a confirmation message to the user with the parent ID that is about to be deleted -->
        <p>Are you sure you want to delete the parent with ID "<?php echo $parentId; ?>"?</p>
        <input type="submit" value="Delete" class="delete_btn" style="color: white; font-size: 16px">

        <br>

        <a href="ParentsTable.php" class="btn">Cancel</a>
    </form>

    </body>
    </html>

    <?php
} else {
    //Invalid request
    //(W3Schools,2023)
    header("Location: ParentsTable.php");
    exit();
}
?>
