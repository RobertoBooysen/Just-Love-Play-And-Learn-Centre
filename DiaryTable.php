<?php
//(Gosselin, Kokoska and Easterbrooks,2011)
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated
//(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    //Redirect to the AdminLogin.php page if not authenticated
    header("Location: AdminLogin.php");
    exit();
}

//Function to get all diary entries from the MySQL database
//(Gosselin, Kokoska and Easterbrooks,2011)
function getAllDiaryEntries($conn)
{
    //Define an SQL query to retrieve diary data
    $sql = "SELECT c_id, c_name, diary_description, date FROM diary";

    //Execute the SQL query
    $result = $conn->query($sql);

    if ($result) {
        //Create an empty array to store diary entries
        //(Gosselin, Kokoska and Easterbrooks,2011)
        $diaryEntries = [];

        //Fetch diary data from the result set
        while ($row = $result->fetch_assoc()) {
            $diaryEntries[] = $row;
        }

        return $diaryEntries;
    } else {
        return [];
    }
}

//Get all diary entries and store them in the $diaryEntries variable
//(Gosselin, Kokoska and Easterbrooks,2011)
$diaryEntries = getAllDiaryEntries($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--(W3schools,2023)-->
    <link rel="stylesheet" href="CSS/admin.css"><!--Include an external CSS stylesheet -->
    <title>Diary Table</title>
</head>
<style>
    /*Styles for tables */
    /*(W3Schools,2023)*/
    table, td, th {
        border: 1px solid #ddd;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #caacd2;
    }

    th, td {
        padding: 15px;
    }

    /*Styles for buttons */
    /*(W3Schools,2023)*/
    .btn {
        padding: 5px 12px;
        font-size: 15px;
        color: black;
        background: #77d4e3;
        border: none;
        border-radius: 5px;
        margin-left: 58px;
    }

    /*Styles for top navigation links */
    .topnav a {
        float: left;
        color: black;
        text-align: center;
        padding: 16px 16px;
        text-decoration: none;
        font-size: 17px;
        display: block;
        width: 17.5%;
    }

    /*Styles for the main container */
    .container {
        max-width: 1000px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    /*Styles for individual boxes */
    /*(W3Schools,2023)*/
    .container .box {
        width: calc(25% - 20px);
        margin: 10px;
        height: 300px;
        background: #77d4e3;
        box-sizing: border-box;
        overflow: hidden;
        border-radius: 5px;
    }

    /*Styles for buttons */
    button {
        margin-top: auto;
        text-align: center;
        background-color: #ccccff;
        border: none;
        text-decoration: none;
    }

    /*styling button group*/
    /*(W3Schools,2023)*/
    .button-group {
        display: flex; /*Use flexbox for horizontal layout */
        align-items: center; /*Center items vertically */
    }

    /*Button styling */
    .delete-button {
        padding: 5px 12px;
        font-size: 15px;
        color: black;
        background: #d03c2f;
        border: none;
        border-radius: 5px;
        margin-left: 58px;
    }

    .add-button {
        background-color: #77d4e3;
        color: black;
        border: none;
        padding: 10px 20px;
        margin: 20px;
        border-radius: 5px;
        cursor: pointer;
        top: 80px; /* Position the download button below the exit button with 20px spacing */
        left: 20px;
    }

    /*General styles for div elements */
    /*(W3Schools,2023)*/
    div {
        border-radius: 6px;
        color: black;
        font-family: Arial;
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
<button class="exit-button" onclick="exitPage()">Exit</button>

<br><br><br><br><br>
<!--(W3Schools,2023)-->
<a href="AdminDiary.php" type="button" class="add-button" style="text-decoration:none;">Add New Diary Entry</a>

<br><br>

<h1>List Of Diary Entries</h1>

<div style="overflow-x:auto;">
    <?php if (empty($diaryEntries)): ?>
        <!--(Gosselin, Kokoska and Easterbrooks,2011)-->
        <!--Displaying a message when there are no diary entries found -->
        <p>No diary entries found.</p>
    <?php else: ?>
        <!--(W3Schools,2023)-->
        <table>
            <thead>
            <tr>
                <th style="width: 25%">Date</th> <!--Displaying Date column -->
                <th style="width: 25%">Child Name</th> <!--Displaying Child Name column -->
                <th style="width: 25%">Diary Description</th> <!--Displaying Diary Description column -->
                <th style="width: 25%">Action</th> <!--Displaying action buttons for editing and deleting diary entries -->
            </tr>
            </thead>
            <tbody>
            <?php foreach ($diaryEntries as $diaryEntry): ?>
                <!--(Gosselin, Kokoska and Easterbrooks,2011)-->
                <tr>
                    <!--Display the date in the table cell -->
                    <td><?php echo $diaryEntry['date']; ?></td>

                    <!--Display the child name in the table cell -->
                    <td><?php echo $diaryEntry['c_name']; ?></td>

                    <!--Display the diary description in the table cell -->
                    <td><?php echo $diaryEntry['diary_description']; ?></td>

                    <!--Create buttons for editing and deleting diary entries -->
                    <td>
                        <div class="button-group">
                            <!--Edit button with a link to EditDiaryEntry.php -->
                            <!--(Gosselin, Kokoska and Easterbrooks,2011)-->
                            <button class="btn" data-diary-id="<?php echo $diaryEntry['c_id']; ?>">
                                <a href="EditDiaryEntry.php?c_id=<?php echo $diaryEntry['c_id']; ?>"
                                   style="color: black; text-decoration: none;">Edit</a>
                            </button>

                            <!--Delete button with a link to DeleteDiaryEntry.php -->
                            <!--(Gosselin, Kokoska and Easterbrooks,2011)-->
                            <button class="delete-button" data-diary-id="<?php echo $diaryEntry['c_id']; ?>">
                                <a href="DeleteDiaryEntry.php?c_id=<?php echo $diaryEntry['c_id']; ?>"
                                   style="color: white; text-decoration: none;">Delete</a>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
    //(W3Schools,2023)
    function exitPage() {
        window.location.href = "AdminHome.php";
    }
</script>

</body>
</html>
