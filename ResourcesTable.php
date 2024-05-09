<?php
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    // Redirect to the AdminLogin.php page if not authenticated
    header("Location: AdminLogin.php");
    exit();
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to get all admin resources from the MySQL database
function getAllAdminResources($conn)
{
    //Define an SQL query to retrieve resource data
    $sql = "SELECT resource_id, name_of_resource, resource_date, resource_file, resource_name FROM resources";

    //Execute the SQL query
    $result = $conn->query($sql);

    if ($result) {
        //Create an empty array to store admin resources
        $adminResources = [];

        //Fetch resource data from the result set
        while ($row = $result->fetch_assoc()) {
            $adminResources[] = $row;
        }

        return $adminResources;
    } else {
        return [];
    }
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Get all admin resources and store them in the $adminResources variable
$adminResources = getAllAdminResources($conn);//(Gosselin, Kokoska and Easterbrooks,2011)
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/admin.css">
    <title>Resources Table</title>
</head>
<style>
    /*styling table*/
    table, td, th {
        border: 1px solid #ddd;
        text-align: center;
    }/*(W3Schools,2023)*/

    /*styling table*/
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #caacd2;
    }/*(W3Schools,2023)*/

    /*styling table*/
    th, td {
        padding: 15px;
    }/*(W3Schools,2023)*/

    /*styling button*/
    .btn {
        padding: 5px 12px;
        font-size: 15px;
        color: black;
        background: #77d4e3;
        border: none;
        border-radius: 5px;
        margin-left: 58px;
    }/*(W3Schools,2023)*/

    /*styling top navigation bar*/
    .topnav a {
        float: left;
        color: black;
        text-align: center;
        padding: 16px 16px;
        text-decoration: none;
        font-size: 17px;
        display: block;
        width: 17.5%;
    }/*(W3Schools,2023)*/

    /*styling container*/
    .container {
        max-width: 1000px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }/*(W3Schools,2023)*/

    /*styling container box*/
    .container .box {
        width: calc(25% - 20px);
        margin: 10px;
        height: 300px;
        background: #77d4e3;
        box-sizing: border-box;
        overflow: hidden;
        border-radius: 5px;
    }/*(W3Schools,2023)*/

    /*styling button*/
    button {
        margin-top: auto;
        text-align: center;
        background-color: #ccccff;
        border: none;
        text-decoration: none;
    }/*(W3Schools,2023)*/

    /*Button styling */
    .delete-button {
        padding: 5px 12px;
        font-size: 15px;
        color: black;
        background: #d03c2f;
        border: none;
        border-radius: 5px;
        margin-left: 58px;
    }/*(W3Schools,2023)*/

    /*styling button group*/
    .button-group {
        display: flex; /*Use flexbox for horizontal layout */
        align-items: center; /*Center items vertically */
    }/*(W3Schools,2023)*/

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
    }/*(W3Schools,2023)*/

    /*styling div*/
    div {
        border-radius: 6px;
        color: black;
        font-family: Arial;
    }/*(W3Schools,2023)*/

    /* Styles for the exit button */
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

    }/*(W3Schools,2023)*/

    /*styling exit button hover*/
    .exit-button:hover {
        background-color: #41c4d8;
        color: black;
    }/*(W3Schools,2023)*/

</style>
<body>

<button class="exit-button" onclick="exitPage()">Exit</button><!--(W3Schools,2023)-->

<br><br><br><br><br>

<a href="AdminResources.php" type="button" class="add-button" style="text-decoration:none;">Add New
    Resource</a><!--(W3Schools,2023)-->
<br><br>

<h1>List Of Resources</h1><!--(W3Schools,2023)-->

<div style="overflow-x:auto;"><!--(Gosselin, Kokoska and Easterbrooks,2011)-->
    <?php if (empty($adminResources)): ?>
        <!--Displaying a message when there are no resources found -->
        <p>No resource found.</p><!--(W3Schools,2023)-->
    <?php else: ?>
        <table>
            <thead>
            <tr>
                <th style="width: 20%">Resource Name</th> <!--Displaying Name_of_resource column -->
                <th style="width: 20%">Resource Description</th> <!--Displaying resource_name column -->
                <th style="width: 20%">Resource Date</th> <!--Displaying resource_date column -->
                <th style="width: 20%">Resource File</th> <!--Displaying resource_file column -->
                <th style="width: 20%">Action</th>   <!--Displaying two buttons for edit and delete an admin user -->
            </tr><!--(W3Schools,2023)-->
            </thead>
            <tbody>
            <?php foreach ($adminResources as $resources): ?><!--(Gosselin, Kokoska and Easterbrooks,2011)-->
                <tr>
                    <!--Displaying the name of the resource -->
                    <td><?php echo $resources['name_of_resource']; ?></td><!--(Gosselin, Kokoska and Easterbrooks,2011)-->

                    <!--Displaying the custom name of the resource -->
                    <td><?php echo $resources['resource_name']; ?></td><!--(Gosselin, Kokoska and Easterbrooks,2011)-->

                    <!--Displaying the date of the resource -->
                    <td><?php echo $resources['resource_date']; ?></td><!--(Gosselin, Kokoska and Easterbrooks,2011)-->

                    <!--Displaying the file name of the resource -->
                    <td><?php echo $resources['resource_file']; ?></td><!--(Gosselin, Kokoska and Easterbrooks,2011)-->

                    <td>
                        <div class="button-group">
                            <!--Edit button with a link to EditResource.php -->
                            <button class="btn" data-child-name="<?php echo $resources['name_of_resource']; ?>">
                                <a href="EditResource.php?resource_id=<?php echo $resources['resource_id']; ?>"
                                   style="color: black; text-decoration: none;">Edit</a>
                            </button><!--(Gosselin, Kokoska and Easterbrooks,2011)-->

                            <!--Delete button with a link to DeleteResource.php -->
                            <button class="delete-button" data-child-name="<?php echo $resources['name_of_resource']; ?>">
                                <a href="DeleteResource.php?resource_id=<?php echo $resources['resource_id']; ?>"
                                   style="color: white; text-decoration: none;">Delete</a>
                            </button><!--(Gosselin, Kokoska and Easterbrooks,2011)-->
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
    //JavaScript function to navigate to "AdminHome.php" when the Exit button is clicked
    function exitPage() {
        window.location.href = "AdminHome.php";
    }//(W3Schools,2023)
</script>

</body>
</html>