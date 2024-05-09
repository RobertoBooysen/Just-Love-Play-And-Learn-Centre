<?php
//(Gosselin, Kokoska and Easterbrooks,2011)
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    header("Location: AdminLogin.php");
    exit();
}
//(Gosselin, Kokoska and Easterbrooks,2011)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $parentId = $_POST['parentId']; //Get the parent ID from the POST data
    $newEmail = $_POST['newEmail']; //Get the new email from the POST data
    $newName = $_POST['newName']; //Get the new name from the POST data
    $newPassword = $_POST['newPassword']; //Get the new password from the POST data

    if ($conn === false) {
        die("Database connection error: " . mysqli_connect_error()); //Display an error if there's a database connection issue
    }

    // Hash the new password
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); //Hash the new password securely

    $sql = "UPDATE parents SET p_email = ?, p_name = ?, password = ? WHERE id = ?"; //SQL statement for updating parent information

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssi", $newEmail, $newName, $hashedPassword, $parentId); // Bind parameters to the prepared statement

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ParentsTable.php"); //Redirect to ParentsTable.php after successful update
            exit();
        } else {
            echo "Parent update failed."; //Display a message if parent update fails
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn); //Close the database connection
    //(Gosselin, Kokoska and Easterbrooks,2011)
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $parentId = $_GET['id']; //Get the parent ID from the GET data

    if ($conn === false) {
        die("Database connection error: " . mysqli_connect_error()); //Display an error if there's a database connection issue
    }

    $sql = "SELECT * FROM parents WHERE id = ?"; //SQL statement to select parent data

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $parentId); //Bind the parent ID as a parameter
        //(Gosselin, Kokoska and Easterbrooks,2011)

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt); //Get the result of the executed query

            if ($parentData = mysqli_fetch_assoc($result)) {

                ?>

                <!DOCTYPE html>
                <html>
                <head>
                    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Set the viewport for responsive design -->
                    <!--(W3Schools,2023-->
                    <link rel="stylesheet" href="CSS/admin.css"> <!-- Include a custom admin.css stylesheet -->
                    <title>Edit Parent</title>
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

                    /*Styles for the exit button */
                    .exit-button {
                        position: fixed;
                        top: 20px;
                        left: 20px;
                        background-color: #d03c2f;
                        color: #ffffff;
                        padding: 10px 20px;
                        border: none;
                        border-radius: 5px;
                        font-size: 16px;
                        cursor: pointer;
                    }
                    /*(W3Schools,2023)*/
                    .exit-button:hover {
                        background-color: #41c4d8;
                        color: black;
                    }
                </style>
                <body>
                <!--(W3Schools,2023)-->
                <!--exit button that returns the user to the Parents Table-->

                <button class="exit-button" onclick="exitPage()">Exit</button>
                <br>

                <h1 style="text-align: center">Edit Parent Information</h1>

                <form method="post" action="EditParent.php" class="form">
                    <!--Displaying parent information on edit form-->
                    <!--(W3Schools,2023)-->
                    <label for="parentId">Child ID:</label>
                    <input type="text" name="parentId" id="parentId" value="<?php echo $parentId; ?>" readonly>
                    <br>
                    <label for="newEmail">New Parent Email:</label>
                    <input type="text" name="newEmail" id="newEmail" value="<?php echo $parentData['p_email']; ?>">
                    <br>
                    <label for="newName">New Parent Name:</label>
                    <input type="text" name="newName" id="newName" value="<?php echo $parentData['p_name']; ?>">
                    <br>
                    <label for="newPassword">New Password:</label>
                    <input type="password" name="newPassword" id="newPassword"
                           value="<?php echo $parentData['password']; ?>">
                    <br>
                    <input type="submit" value="Save" class="btn">
                </form>

                </body>
                <script>
                    //(W3schools,2023)
                    function exitPage() {
                        window.location.href = "ParentsTable.php";
                    }
                </script>
                </html>
                <?php
                //(W3schools,2023)
            } else {
                echo "Parent not found or missing data."; //Display an error message if the parent data is not found or incomplete
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn); //Close the database connection
    //(W3schools,2023)
} else {
    header("Location: ParentsTable.php"); //Redirect to ParentsTable.php if the HTTP request method is not 'GET' or the parent ID is not provided in the URL
    exit();
}
?>