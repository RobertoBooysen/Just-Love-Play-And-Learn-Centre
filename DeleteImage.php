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
    //Handle form submission for deleting an image
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $child_name_to_delete = $_POST['child_name_to_delete'];

    //Prepare a SQL statement to delete the image by child name
    $sql = "DELETE FROM images WHERE c_id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $child_name_to_delete);

        if (mysqli_stmt_execute($stmt)) {
            //Redirect back to the image list page after deleting
            header("Location: ImagesTable.php");
            exit();
        } else {
            // Deletion failed
            echo "Image deletion failed.";
        }

        //Close the prepared statement
        //(Gosselin, Kokoska and Easterbrooks,2011)
        mysqli_stmt_close($stmt);
    }

    //Close the database connection
    //(Gosselin, Kokoska and Easterbrooks,2011)
    mysqli_close($conn);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['c_name'])) {
    //Display the confirmation form for deleting an image
    $child_name_to_delete = $_GET['c_name'];
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Set the viewport for responsive design -->
        <!--(W3schools,2023)-->
        <link rel="stylesheet" href="CSS/admin.css"><!-- Include a custom admin.css stylesheet -->
        <title>Delete Image</title>
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
        /*(W3Schools,2023)*/
        .width-50 {
            width: 50%;
        }

        /* CSS class for setting margin-left to auto */
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

    <h1 style="text-align: center">Delete Image</h1>
     <!--(W3schools,2023)-->
    <form method="post" action="DeleteImage.php" class="form">
        <!--This input element is used to store the child name to be deleted in a hidden field -->
        <input type="hidden" name="child_name_to_delete" value="<?php echo $child_name_to_delete; ?>">
        <!--Display a confirmation message to the user with the child name whose image is about to be deleted -->
        <p>Are you sure you want to delete the image for "<?php echo $child_name_to_delete; ?>"?</p>
        <input type="submit" value="Delete" class="delete_btn" style="color: white; font-size: 16px">

        <br>

        <a href="ImagesTable.php" class="btn">Cancel</a>
    </form>

    </body>
    </html>

    <?php
} else {
    // Invalid request
    //(W3Schools,2023)
    header("Location: AdminImages.php");
    exit();
}
?>
