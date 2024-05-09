<?php
//(Gosselin, Kokoska and Easterbrooks,2011)
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    //Redirect to the AdminLogin.php page if not authenticated
    header("Location: AdminLogin.php");
    exit();
}

//Function to handle form submission for editing a diary entry
//(Gosselin, Kokoska and Easterbrooks,2011)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $c_id_to_edit = $_POST['c_id_to_edit'];
    $newDiaryDescription = $_POST['newDiaryDescription'];
    $newDiaryDate = $_POST['newDiaryDate'];

    //Prepare a SQL statement to update the diary entry by c_id
    $sql = "UPDATE diary SET diary_description = ?, date = ? WHERE c_id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssi", $newDiaryDescription, $newDiaryDate, $c_id_to_edit);

        if (mysqli_stmt_execute($stmt)) {
            //Redirect back to the diary entry list page after editing
            header("Location: DiaryTable.php");
            exit();
        } else {
            //Update failed
            echo "Diary entry update failed.";
        }

        //Close the prepared statement
        mysqli_stmt_close($stmt);
    }

    //Close the database connection
    //(Gosselin, Kokoska and Easterbrooks,2011)
    mysqli_close($conn);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['c_id'])) {
    //Display the edit form for the diary entry
    $c_id_to_edit = $_GET['c_id'];

    //Prepare a SQL statement to fetch the diary entry by c_id
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $sql = "SELECT * FROM diary WHERE c_id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $c_id_to_edit);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if ($diaryData = mysqli_fetch_assoc($result)) {
                ?>

                <!DOCTYPE html>
                <html>
                <head>
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <!--Set the viewport for responsive design -->
                    <!--(W3Schools,2023-->
                    <link rel="stylesheet" href="CSS/admin.css"> <!--Include a custom admin.css stylesheet -->
                    <!--(W3Schools,2023-->
                    <title>Edit Diary Entry</title>
                </head>
                <style>
                    /*Define CSS custom properties */
                    /*(W3Schools,2023)*/
                    :root {
                        --primary-color: rgb(11, 78, 179);
                    }

                    /*Apply box-sizing to all elements */
                    *,
                    *::before,
                    *::after {
                        box-sizing: border-box;
                    }

                    /*Style for form labels */
                    label {
                        display: block;
                        margin-bottom: 0.5rem;
                    }

                    /*Style for form input elements */
                    /*(W3Schools,2023)*/
                    input {
                        display: block;
                        width: 100%;
                        padding: 0.75rem;
                        border: 1px solid #ccc;
                        border-radius: 0.25rem;
                        height: 50px;
                    }

                    /*CSS class for setting width to 50% */
                    .width-50 {
                        width: 50%;
                    }

                    /*CSS class for setting margin-left to auto */
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
                        padding: 20px 30px; /*Style for the form container */
                    }

                    /*Style for buttons */
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

                    /*Hover effect for buttons */
                    .btn:hover {
                        box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2;
                    }

                    /*Style for error messages */
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
                <!--(W3Schools,2023)-->
                <!--Button that returns the user back to the Diary Table-->
                <button class="exit-button" onclick="exitPage()">Exit</button>
                <br>

                <h1>Edit Diary Entry</h1>
                <form method="post" action="EditDiaryEntry.php" class="form">
                    <!--Include hidden input field for c_id -->
                    <!--(W3Schools,2023)-->
                    <input type="hidden" name="c_id_to_edit" value="<?php echo $c_id_to_edit; ?>">

                    <!--Displaying diary entry information on the edit form -->
                    <!--(W3Schools,2023)-->
                    <label for="childName">Child Name:</label>
                    <input type="text" name="childName" id="childName"
                           value="<?php echo $diaryData['c_name']; ?>" readonly>
                    <br>

                    <label for="newDiaryDate">New Diary Date:</label>
                    <input type="text" name="newDiaryDate" id="newDiaryDate"
                           value="<?php echo $diaryData['date']; ?>">
                    <br>

                    <label for="newDiaryDescription">New Diary Description:</label>
                    <input type="text" name="newDiaryDescription" id="newDiaryDescription"
                           value="<?php echo $diaryData['diary_description']; ?>">
                    <br>

                    <input type="submit" value="Save" class="btn">
                </form>
                </body>
                <script>
                    //(W3Schools,2023)
                    function exitPage() {
                        window.location.href = "DiaryTable.php";
                    }
                </script>
                </html>
                <?php
            } else {
                //Diary entry not found or missing data
                //(W3Schools,2023)
                echo "Diary entry not found or missing data.";
            }
        }

        //Close the prepared statement
        mysqli_stmt_close($stmt);
    }

    //Close the database connection
    mysqli_close($conn);
} else {
    //Invalid request
    //(W3Schools,2023)
    header("Location: DiaryTable.php");
    exit();
}
?>