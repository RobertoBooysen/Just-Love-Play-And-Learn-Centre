<?php
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated as an admin(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    // Redirect to the AdminLogin.php page if not authenticated(Gosselin, Kokoska and Easterbrooks,2011)
    header("Location: AdminLogin.php");
    exit();
}

//Function to get all admin users from the SQL database(Gosselin, Kokoska and Easterbrooks,2011)
function getAllAdminUsers($conn)
{
    //SQL query to retrieve all admin users from the Admin table(Gosselin, Kokoska and Easterbrooks,2011)
    $sql = "SELECT username, password FROM admin"; //Select usernames and passwords(Gosselin, Kokoska and Easterbrooks,2011)
    $result = $conn->query($sql); //Execute the SQL query(Gosselin, Kokoska and Easterbrooks,2011)

    $adminUsers = []; //Initialize an array to store admin user data(Gosselin, Kokoska and Easterbrooks,2011)

    if ($result->num_rows > 0) {
        //Loop through the query result and store admin user data in an array(Gosselin, Kokoska and Easterbrooks,2011)
        while ($row = $result->fetch_assoc()) {
            $adminUsers[] = $row; //Append each admin user data to the array(Gosselin, Kokoska and Easterbrooks,2011)
        }
    }

    return $adminUsers; //Return the array containing all admin users(Gosselin, Kokoska and Easterbrooks,2011)
}


//Get all admin users from the SQL database(Gosselin, Kokoska and Easterbrooks,2011)
$adminUsers = getAllAdminUsers($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Define the viewport for responsive design(W3Schools,2023) -->
    <link rel="stylesheet" href="CSS/admin.css">
    <title>Admin Table</title> <!--Include a custom admin.css stylesheet(W3Schools,2023) -->
</head>
<style>
    /*Define styles for table elements(W3Schools,2023) */
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

    /*Button styling(W3Schools,2023) */
    .btn {
        padding: 5px 12px;
        font-size: 15px;
        color: black;
        background: #77d4e3;
        border: none;
        border-radius: 5px;
        margin-left: 58px;
    }

    /*Button styling(W3Schools,2023) */
    .delete {
        padding: 5px 12px;
        font-size: 15px;
        color: black;
        background: #d03c2f;
        border: none;
        border-radius: 5px;
        margin-left: 58px;
    }

    /*Styles for navigation links(W3Schools,2023) */
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

    /*Container styles for layout(W3Schools,2023) */
    .container {
        max-width: 1000px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    /*Box styles within the container(W3Schools,2023) */
    .container .box {
        width: calc(25% - 20px);
        margin: 10px;
        height: 300px;
        background: #77d4e3;
        box-sizing: border-box;
        overflow: hidden;
        border-radius: 5px;
    }

    /*Button styles(W3Schools,2023) */
    button {
        margin-top: auto;
        text-align: center;
        background-color: #ccccff;
        border: none;
        text-decoration: none;
    }

    /*styling button group*/
    .button-group {
        display: flex; /*Use flexbox for horizontal layout(W3Schools,2023) */
        align-items: center; /*Center items vertically(W3Schools,2023) */
    }

    .add-button {
        background-color: #77d4e3;
        color: black;
        border: none;
        padding: 10px 20px;
        margin: 20px;
        border-radius: 5px;
        cursor: pointer;
        top: 80px; /* Position the download button below the exit button with 20px spacing(W3Schools,2023) */
        left: 20px;
    }

    div {
        border-radius: 6px;
        color: black;
        font-family: Arial;
    }

    /*Styles for the exit button(W3Schools,2023) */
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

<button class="exit-button" onclick="exitPage()">Exit</button>

<br><br><br><br><br>

<a href="AddAdmin.php" type="button" class="add-button" style="text-decoration:none;">Add New Admin</a>
<br><br>

<h1>List Of Admin Users</h1>

<div style="overflow-x:auto;">
    <?php if (empty($adminUsers)): ?>
        <!--Displaying a message when there are no admin users found(Gosselin, Kokoska and Easterbrooks,2011) -->
        <p>No admin users found.</p>
    <?php else: ?>
        <!--Creating a table to display admin users(Gosselin, Kokoska and Easterbrooks,2011) -->
        <table>
            <thead>
            <!--Table header row with column names(Gosselin, Kokoska and Easterbrooks,2011) -->
            <tr>
                <th style="width: 33.3%">Username</th>
                <!--Displaying Username column(Gosselin, Kokoska and Easterbrooks,2011) -->
                <th style="width: 33.3%">Password</th>
                <!--Displaying Password column(Gosselin, Kokoska and Easterbrooks,2011) -->
                <th style="width: 33.3%">Action</th>
                <!--Displaying two buttons for edit and delete an admin user(Gosselin, Kokoska and Easterbrooks,2011) -->
            </tr>
            </thead>
            <tbody>
            <?php foreach ($adminUsers as $adminId => $admin): ?>
                <!--Iterating through the list of admin users(Gosselin, Kokoska and Easterbrooks,2011) -->
                <tr>
                    <!--Displaying the Username and Password of each admin user(Gosselin, Kokoska and Easterbrooks,2011) -->
                    <td><?php echo $admin['username']; ?></td>
                    <td><?php echo $admin['password']; ?></td>
                    <td>
                        <div class="button-group">
                            <button class="btn" data-child-name="<?php echo $admin['username']; ?>">
                                <a href="EditAdmin.php?username=<?php echo $admin['username']; ?>"
                                   style="color: black; text-decoration: none;">Edit</a>
                            </button>
                            <button class="delete" data-child-name="<?php echo $admin['username']; ?>">
                                <a href="DeleteAdmin.php?username=<?php echo $admin['username']; ?>"
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
    //Function to exit the page(W3schools,2023)
    function exitPage() {
        window.location.href = "AdminHome.php";
    }
</script>

</body>
</html>
