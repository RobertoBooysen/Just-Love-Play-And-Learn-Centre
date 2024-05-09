<?php
//(Gosselin, Kokoska and Easterbrooks,2011)
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    header("Location: AdminLogin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Handle form submission for editing an admin user
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];

    if ($conn === false) {
        die("Database connection error: " . mysqli_connect_error());
    }

    //Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    //Prepare a SQL statement to update the admin user by username
    $sql = "UPDATE admin SET password = ? WHERE username = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $newUsername);

        if (mysqli_stmt_execute($stmt)) {
            //Redirect back to the admin list page after editing
            header("Location: AdminTable.php");
            exit();
        } else {
            //Update failed
            echo "Admin user update failed.";
        }

        //Close the prepared statement
        mysqli_stmt_close($stmt);
    }

    //Close the database connection
    //(Gosselin, Kokoska and Easterbrooks,2011)
    mysqli_close($conn);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['username'])) {
    //Displaying the edit form for the admin user
    $username = $_GET['username'];

    if ($conn === false) {
        die("Database connection error: " . mysqli_connect_error());
    }

    //Prepare a SQL statement to fetch the admin user by username
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $sql = "SELECT * FROM admin WHERE username = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if ($adminData = mysqli_fetch_assoc($result)) {

                ?>

                <!DOCTYPE html>
                <html>
                <head>
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <!-- Set the viewport for responsive design -->
                    <!--(W3schools,2023)-->
                    <link rel="stylesheet" href="CSS/admin.css"> <!-- Include a custom admin.css stylesheet -->
                    <title>Edit Admin</title>
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

                    /*Styles for the exit button */
                    /*(W3Schools,2023)*/
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

                    .exit-button:hover {
                        background-color: #41c4d8;
                        color: black;
                    }
                </style>
                <body>
                <!--Exit button that return the user back tp the Admin Table-->
                <!--(W3Schools,2023)-->
                <button class="exit-button" onclick="exitPage()">Exit</button>
                <br>

                <h1 style="text-align: center">Edit Admin User</h1>

                <form method="post" action="EditAdmin.php" class="form">
                    <!--Displaying admin information on the edit form -->
                    <!--(W3Schools,2023)-->
                    <input type="hidden" name="newUsername" value="<?php echo $username; ?>">
                    <label for="newUsername">Username:</label>
                    <input type="text" name="newUsername" id="newUsername" value="<?php echo $adminData['username']; ?>"
                           readonly>
                    <br>
                    <label for="newPassword">New Password:</label>
                    <input type="password" name="newPassword" id="newPassword" pattern="[0-9]{8}" title="Please enter a 8 character long password."
                           value="<?php echo $adminData['password']; ?>">
                    <br>
                    <input type="submit" value="Save" class="btn">
                </form>

                </body>
                <script>
                    //(W3schools,2023)
                    function exitPage() {
                        window.location.href = "AdminTable.php";
                    }
                </script>
                </html>

                <?php
            } else {
                //Admin user not found or missing data
                ////(Gosselin, Kokoska and Easterbrooks,2011)
                echo "Admin user not found or missing data.";
            }
        }

        //Close the prepared statement
        mysqli_stmt_close($stmt);
    }

    //Close the database connection
    mysqli_close($conn);
} else {
    //Invalid request
    //(Gosselin, Kokoska and Easterbrooks,2011)
    header("Location: AdminTable.php");
    exit();
}
?>