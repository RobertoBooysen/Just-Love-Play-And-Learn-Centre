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

//Function to get all admin events from the MySQL database
//(Gosselin, Kokoska and Easterbrooks,2011)
function getAllAdminEvents($conn)
{
    //Define an SQL query to retrieve event data
    $sql = "SELECT event_id, event_name, event_date, event_description, events_file FROM events";

    //Execute the SQL query
    $result = $conn->query($sql);

    if ($result) {
        //Create an empty array to store admin events
        $adminEvents = [];

        //Fetch event data from the result set
        while ($row = $result->fetch_assoc()) {
            $adminEvents[] = $row;
        }

        return $adminEvents;
    } else {
        return [];
    }
}

//Get all admin events and store them in the $adminEvents variable
//(Gosselin, Kokoska and Easterbrooks,2011)
$adminEvents = getAllAdminEvents($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--(W3Schools,2023-->
    <link rel="stylesheet" href="CSS/admin.css"> <!--Include an external CSS stylesheet -->
    <title>Events Table </title>
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

    /*styling button group*/
    /*(W3Schools,2023)*/
    .button-group {
        display: flex; /*Use flexbox for horizontal layout */
        align-items: center; /*Center items vertically */
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
<!--exit button that returns the user to Admin Home-->
<button class="exit-button" onclick="exitPage()">Exit</button>

<br><br><br><br><br>

<a href="AdminEvents.php" type="button" class="add-button" style="text-decoration:none;">Add New Event</a>
<br><br>

<h1>List Of Events</h1>

<div style="overflow-x:auto;">
    <?php if (empty($adminEvents)): ?>
        <!--Displaying a message when there are events found -->
        <!--(W3Schools,2023)-->
        <p>No events found.</p>
    <?php else: ?>
        <table>
            <!--(W3Schools,2023)-->
            <thead>
            <tr>
                <th>Event Name</th>   <!--Displaying Event name column-->
                <th>Description of Event</th> <!--Displaying Description of event column -->
                <th>Event Date</th> <!--Displaying Event date column -->
                <th>Event File</th>   <!--Displaying Event file column -->
                <th>Action</th>   <!--Displaying two buttons for edit and delete an admin user -->
            </tr>
            </thead>
            <tbody>
            <?php foreach ($adminEvents as $event_name => $event): ?>
                <tr>
                    <!--Display the event name in the table cell -->
                    <!--(W3Schools,2023)-->
                    <td style="width: 20%"><?php echo $event['event_name']; ?></td>

                    <!--Display the event description in the table cell -->
                    <td style="width: 20%"><?php echo $event['event_description']; ?></td>

                    <!--Display the event date in the table cell -->
                    <!--(W3Schools,2023)-->
                    <td style="width: 20%"><?php echo $event['event_date']; ?></td>

                    <!--Display the events file in the table cell -->
                    <td style="width: 20%"><?php echo $event['events_file']; ?></td>

                    <!--Create buttons for editing and deleting events -->
                    <!--(W3Schools,2023)-->
                    <td  style="width: 20%">
                        <div class="button-group">
                            <!--Edit button with a link to EditEvents.php -->
                            <button class="btn" data-child-name="<?php echo $event['event_name']; ?>">
                                <a href="EditEvents.php?event_id=<?php echo $event['event_id']; ?>"
                                   style="color: black; text-decoration: none;">Edit</a>
                            </button>

                            <!--Delete button with a link to DeleteEvents.php -->
                            <!--(W3Schools,2023)-->
                            <button class="delete-button" data-child-name="<?php echo $event['event_name']; ?>">
                                <a href="DeleteEvents.php?event_id=<?php echo $event['event_id']; ?>"
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
    //(Gosselin, Kokoska and Easterbrooks,2011)
    function exitPage() {
        window.location.href = "AdminHome.php";
    }
</script>

</body>
</html>