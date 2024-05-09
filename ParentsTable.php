<?php
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated as an admin
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    //Redirect to the AdminLogin.php page if not authenticated
    header("Location: AdminLogin.php");
    exit(); //Exit the script to prevent further execution
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to get all parents from the database
function getAllParents($conn)
{
    //SQL query to select approved parents from the 'parents' table
    $sql = "SELECT id, p_name, p_email, password FROM parents WHERE status='approved'";
    $result = $conn->query($sql);

    $parents = [];

    //Check if there are any results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //Add each parent's data to the $parents array
            $parents[] = $row;
        }
    }//(Gosselin, Kokoska and Easterbrooks,2011)

    return $parents;
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Get all parents by calling the getAllParents function
$parents = getAllParents($conn); //Assuming $conn is your database connection
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Set the viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--(W3Schools,2023)-->

    <!-- Link to your custom stylesheet for admin.css -->
    <link rel="stylesheet" href="CSS/admin.css"><!--(W3Schools,2023)-->

    <!-- Set the title of the page -->
    <title>Parents Table</title><!--(W3Schools,2023)-->

</head>
<style>
    /*Styling the table*/
    table, td, th {
        border: 1px solid #ddd;
        text-align: center;
    }/*(W3Schools,2023)*/

    /*Styling the table*/
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #caacd2;
    }/*(W3Schools,2023)*/

    /*Styling the table*/
    th, td {
        padding: 15px;
    }/*(W3Schools,2023)*/

    /*Styling the button*/
    .btn {
        padding: 5px 12px;
        font-size: 15px;
        color: black;
        background: #77d4e3;
        border: none;
        border-radius: 5px;
        margin-left: 58px;
    }/*(W3Schools,2023)*/

    /*Styling the top navigation bar*/
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

    /*styling button group*/
    .button-group {
        display: flex; /*Use flexbox for horizontal layout */
        align-items: center; /*Center items vertically */
    }/*(W3Schools,2023)*/

    /*Styling the container*/
    .container .box {
        width: calc(25% - 20px);
        margin: 10px;
        height: 300px;
        background: #77d4e3;
        box-sizing: border-box;
        overflow: hidden;
        border-radius: 5px;
    }/*(W3Schools,2023)*/

    /*Styling the button*/
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

    /*Styling the button container*/
    .button-container {
        margin-top: auto; /*Moving the button to the bottom in block*/
        display: flex;
        justify-content: center;
        align-items: center;
    }/*(W3Schools,2023)*/

    /*Styling the content*/
    .content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }/*(W3Schools,2023)*/

    /*Styling the div*/
    div {
        border-radius: 6px;
        color: black;
        font-family: Arial;
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

    /*Styles for the exit button */
    .exit-button {
        position: fixed; /*Set the button's position to fixed */
        top: 20px; /*Distance from the top of the viewport */
        left: 20px; /*Distance from the left of the viewport */
        background-color: #d03c2f; /*Background color for the exit button */
        color: #ffffff; /*Text color for the exit button */
        padding: 10px 20px; /*Padding for the button */
        border: none; /*Remove button border */
        border-radius: 5px; /*Apply border-radius to the button */
        font-size: 16px; /*Set font size for the button */
        cursor: pointer; /*Change cursor to a pointer on hover */

    }/*(W3Schools,2023)*/

    /*Styles for the exit button */
    .exit-button:hover {
        background-color: #41c4d8;
        color: black;
    }/*(W3Schools,2023)*/

</style>
<body>
<!--Exit button with an onclick event to trigger the exitPage() function -->
<button class="exit-button" onclick="exitPage()">Exit</button><!--(W3Schools,2023)-->

<br><br><br><br><br>

<!--Button to add a new parent, with a link to "ParentRegister.php" -->
<a href="ParentRegister.php" type="button" class="add-button" style="text-decoration:none;">Add New Parent</a><!--(W3Schools,2023)-->
<br><br>

<!--Main heading -->
<h1>Approved Parent Portal Users</h1>

<div style="overflow-x:auto;">
    <?php if (empty($parents)): ?>
        <!--Displaying a message when there are no parents found -->
        <p>No parents found.</p><!--(W3Schools,2023)-->
    <?php else: ?>
        <!--Creating a table to display parents -->
        <table>
            <thead>
            <!--Table header row with column names -->
            <tr>
                <th style="width: 20%">ID</th> <!--Displaying ID column -->
                <th style="width: 20%">Email</th> <!--Displaying Email column -->
                <th style="width: 20%">Name</th> <!--Displaying Name column -->
                <th style="width: 20%">Password</th> <!--Displaying Password column -->
                <th style="width: 20%">Action</th> <!--Displaying two buttons for edit and delete an admin user -->
            </tr><!--(W3Schools,2023)-->
            </thead>
            <tbody>
            <?php foreach ($parents as $parent): ?><!--(Gosselin, Kokoska and Easterbrooks,2011)-->
                <!--Iterating through the list of parents -->
                <tr>
                    <!--Displaying the ID, Email, Name, and Password of each parent -->
                    <td><?php echo $parent['id']; ?></td>
                    <td><?php echo $parent['p_email']; ?></td>
                    <td><?php echo $parent['p_name']; ?></td>
                    <td><?php echo $parent['password']; ?></td>
                    <td><!--(Gosselin, Kokoska and Easterbrooks,2011)-->
                        <div class="button-group">
                            <!--Edit and Delete buttons for each parent, with links -->
                            <button class="btn" data-child-name="<?php echo $parent['id']; ?>">
                                <a href="EditParent.php?id=<?php echo $parent['id']; ?>"
                                   style="color: black; text-decoration: none;">Edit</a>
                            </button><!--(W3Schools,2023)-->
                            <button class="delete-button" data-child-name="<?php echo $parent['id']; ?>">
                                <a href="DeleteParent.php?id=<?php echo $parent['id']; ?>"
                                   style="color: white; text-decoration: none;">Delete</a>
                            </button><!--(W3Schools,2023)-->
                        </div>
                    </td><!--(W3Schools,2023)-->
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