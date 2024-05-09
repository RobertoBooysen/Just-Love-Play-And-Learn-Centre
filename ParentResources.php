<?php
global $conn;
require_once 'DBConn.php';

//Check if the child_id session variable is set to determine if the parent is logged in
if (!isset($_SESSION['child_id'])) {
    //Redirect to the ParentLogin.php page if not logged in
    header("Location: ParentLogin.php");
    exit(); //Exit the script to prevent further execution
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to fetch parent resources and information from MySQL
function getParentResourcesFromMySQL($conn)
{
    $sql = "SELECT * FROM resources";
    $result = mysqli_query($conn, $sql);

    $data = array();

    //Check if there are results and process them
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Add each resource's data to the $data array
            $data[] = $row;
        }
    }

    return $data;
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Fetch parent resources and information from MySQL by calling the function
$parentResources = getParentResourcesFromMySQL($conn);//(Gosselin, Kokoska and Easterbrooks,2011)
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/parent.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <title>Parent Resources</title>
</head>
<style>
    /* CSS for resource containers */
    .resource-container {
        text-align: left;
        border: 3px solid #caacd2;
        margin: 20px auto;
        padding: 20px;
        max-width: 700px;
        text-align: left;
    }

    /*styling the image*/
    .resource-container img {
        width: 90%;
        height: 500px;
        display: block;
        margin: 10px auto;
    }

    /*styling the h2*/
    .resource-container h2 {
        font-size: 24px;
        margin: 0 0 10px;
        color: #caacd2;
        text-align: center;
        text-decoration: underline;
    }
</style>
<body>
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->
<!--Top navigation bar-->
<div class="topnav">
    <a href="ParentHome.php">Home</a>
    <a href="ParentDiary.php">Diary</a>
    <a href="ParentResources.php">Resources</a>
    <a href="ParentEvents.php">Events</a>
    <a href="ParentImages.php">Images</a>
    <a href="ParentLogTicket.php">Ticket</a><!--(W3Schools,2023)-->
    <div class="dropdown">
        <button class="dropbtn">
            <i class="fa fa-fw fa-user" style="color: black"></i>
        </button><!--(W3Schools,2023)-->
        <div class="dropdown-content">
            <a href="index.php" style="width:100%">Log Out</a>
        </div><!--(W3Schools,2023)-->
    </div>
    <a href="javascript:void(0);" class="icon" onclick="toggleNav()">&#9776;</a><!--(W3Schools,2023)-->
</div>

<!--Main heading for the Resources page -->
<h1 style="color: black;"><u><b>RESOURCES</b></u></h1>
<br>
</body>
<?php
//Display resources and information
if (!empty($parentResources)) {
    //Loop through each resource and display its details
    foreach ($parentResources as $resource) {
        echo '<div class="resource-container">';
        echo '<h2>' . $resource['name_of_resource'] . '</h2>';
        echo '<p><b>Description:</b> ' . $resource['resource_name'] . '</p>';
        echo '<p><b>Date of resource:</b> ' . $resource['resource_date'] . '</p>';
        echo '<img src="' . $resource['resource_file'] . '" alt="Parent_Resource">';
        echo '</div>';
    }//(Gosselin, Kokoska and Easterbrooks,2011)
} else {
    //Display a message if no resources are available
    echo '<p>No resources are available.</p>';
}//(Gosselin, Kokoska and Easterbrooks,2011)
?>
<br>
<footer>

    <p style="text-align: center">44 Fourth Avenue, Newton Park, Port Elizabeth</p>
    <p style="text-align: center"><a href="tel:0413654013" style="color: black">0413654013</a></p>
    <div class="center">
        <div class="row">
            <div class="column">
                <a href="https://www.facebook.com/JustLoveLearnandPlay" target="blank"><img src="Images/Facebook.png"
                                                                                            alt="Facebook logo"
                                                                                            style="width:20%"></a>
            </div><!--(W3Schools,2023)-->
            <div class="column">
                <a href="mailto:jlplayandcentre@gmail.com" target="blank"><img src="Images/Email.png" alt="Email logo"
                                                                   style="width:20%"></a>
            </div><!--(W3Schools,2023)-->
            <div class="column">
                <a href="tel:0720186560>" target="blank"><img src="Images/Whatsapp.png" alt="Whatsapp logo"
                                                              style="width:20%"></a>
            </div><!--(W3Schools,2023)-->
        </div>
    </div>
    <br>
    <p style="text-align: center">@2023 RNK. All rights reserved.</p>
</footer>

<script>
    //Function to toggle the navigation bar for mobile view
    function toggleNav() {
        var nav = document.getElementsByClassName("topnav")[0];
        if (nav.className === "topnav") {
            nav.className += " responsive";
        } else {
            nav.className = "topnav";
        }
    }//(W3Schools,2023)

    //Showcasing active link
    document.addEventListener("DOMContentLoaded", function () {
        // Extract the current page's filename (without .php extension)
        const currentPage = window.location.pathname.split('/').pop().split('.php')[0];

        //Select all navigation links in the topnav
        const navLinks = document.querySelectorAll(".topnav a");

        //Loop through the links and add the "active" class to the current page's link
        for (const link of navLinks) {
            if (link.getAttribute("href") === currentPage + ".php") {
                link.classList.add("active");
            }
        }
    });//(W3Schools,2023)
</script>

</body>
</html>