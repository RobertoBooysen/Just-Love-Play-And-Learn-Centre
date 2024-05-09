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

//Function to get all admin images from the SQL database
//(Gosselin, Kokoska and Easterbrooks,2011)
function getAllAdminImages($conn)
{
    $query = "SELECT * FROM images";
    $result = $conn->query($query);
    $adminImages = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $adminImages[] = $row;
        }
    }

    return $adminImages;
}

//Get all admin images from the SQL database
//(Gosselin, Kokoska and Easterbrooks,2011)
$adminImages = getAllAdminImages($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Configure viewport for responsive design -->
    <!--(W3Schools,2023)-->
    <link rel="stylesheet" href="CSS/admin.css">
    <!--Include a custom admin.css stylesheet -->
    <title>Images Table</title>
</head>
<style>
    /*Table Styles */
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

    /*Button Styles */
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

    /*Top Navigation Styles */
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

    /*Container Styles */
    /*(W3Schools,2023)*/
    .container {
        max-width: 1000px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    /*Box Styles */
    .container .box {
        width: calc(25% - 20px);
        margin: 10px;
        height: 300px;
        background: #77d4e3;
        box-sizing: border-box;
        overflow: hidden;
        border-radius: 5px;
    }

    /*Additional Button Styles */
    /*(W3Schools,2023)*/
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
    /*(W3Schools,2023)*/
    div {
        border-radius: 6px;
        color: black;
        font-family: Arial;
    }

    /*Exit Button Styles */
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
<!--exit button that returns the user to AdminHome-->
<button class="exit-button" onclick="exitPage()">Exit</button>

<br><br><br><br><br>

<a href="AdminImages.php" type="button" class="add-button" style="text-decoration:none;">Add New Image</a>
<br><br>

<h1>List Of Images</h1>

<div style="overflow-x:auto;">
    <?php if (empty($adminImages)): ?>
        <!--Displaying a message when there are events found -->
        <!--(W3Schools,2023)-->
        <p>No events found.</p>
    <?php else: ?>
        <!--Creating a table to display events-->
        <!--(W3Schools,2023)-->
        <table>
            <thead>
            <!--Table header row with column names -->
            <!--(W3Schools,2023)-->
            <tr>
                <th style="width: 20%">Child Name</th> <!--Displaying Child name column -->
                <th style="width: 20%">Description of Image</th> <!--Displaying description of image column -->
                <th style="width: 20%">Image file</th>   <!--Displaying image file column-->
                <th style="width: 20%">Date</th>   <!--Displaying date column-->
                <th style="width: 20%">Action</th>   <!--Displaying two buttons for edit and delete an admin user -->
            </tr>
            </thead>
            <tbody>
            <!--(W3Schools,2023)-->
            <?php foreach ($adminImages as $c_name => $image): ?>
                <tr>
                    <td><?php echo $image['c_name']; ?></td>
                    <td><?php echo $image['image_description']; ?></td>
                    <td><?php echo $image['image_file']; ?></td>
                    <td><?php echo $image['image_date']; ?></td>
                    <td>
                        <div class="button-group">
                            <button class="btn" data-child-name="<?php echo $image['c_id']; ?>">
                                <a href="EditImage.php?c_id=<?php echo $image['c_id']; ?>"
                                   style="color: black; text-decoration: none;">Edit</a>
                            </button>
                            <button class="delete-button" data-child-name="<?php echo $image['c_id']; ?>">
                                <a href="DeleteImage.php?c_name=<?php echo $image['c_id']; ?>"
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