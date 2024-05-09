<?php
global $conn;
require_once 'DBConn.php';

//Check if the child_id session variable is set to determine if the parent is logged in
if (isset($_SESSION['child_id'])) {
    //Retrieve child's name and ID from session
    $childName = $_SESSION['child_name'];
    $childID = $_SESSION['child_id'];//(Gosselin, Kokoska and Easterbrooks,2011)

    //Query to fetch images of the currently logged-in user
    $query = "SELECT * FROM images WHERE c_name = CONCAT('$childName', ' (', '$childID', ')')";//(Gosselin, Kokoska and Easterbrooks,2011)

    //Execute the query and retrieve the results
    $result = mysqli_query($conn, $query);//(Gosselin, Kokoska and Easterbrooks,2011)

    //Check if the query was executed successfully
    if ($result) {
        //Initialize an array to store the child's images
        $ChildrenImages = [];

        //Loop through the query results and store them in the array
        while ($row = mysqli_fetch_assoc($result)) {
            $ChildrenImages[] = $row;
        }
    }//(Gosselin, Kokoska and Easterbrooks,2011)

    //Close the database connection
    mysqli_close($conn);
} else {
    //If the child_id session variable is not set, redirect to the login page
    header("Location: ParentLogin.php");
    exit(); //Exit to prevent further script execution
}//(Gosselin, Kokoska and Easterbrooks,2011)
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Set the viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--(W3Schools,2023)-->

    <!-- Link to your custom stylesheet for parent.css -->
    <link rel="stylesheet" href="CSS/parent.css"><!--(W3Schools,2023)-->

    <!-- Link to Bootstrap stylesheet for additional styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"><!--(W3Schools,2023)-->

    <!-- Link to Font Awesome stylesheet for icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"><!--(W3Schools,2023)-->

    <!-- Set the title of the page -->
    <title>Parent Images</title><!--(W3Schools,2023)-->
</head>
<style>
    /*styling image container*/
    .image-container {
        background-color: white;
        border: 1px solid #ddd;
        margin: 10px;
        padding: 10px;
        text-align: center;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        max-width: 300px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        height: 400px;
    }/*(W3Schools,2023)*/

    /**styling image wrapper*/
    .image-wrapper {
        flex-grow: 1;
        overflow: hidden;
        display: flex;
        align-items: center;
    }/*(W3Schools,2023)*/

    /* Styling for the custom download button */
    .custom-download-button {
        background-color: #77d4e3;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }/*(W3Schools,2023)*/

    /* Hover effect for the custom download button */
    .custom-download-button:hover {
        background-color: #77d4e3;
        color:black;
        text-decoration: none;
    }/*(W3Schools,2023)*/

    /*styling download button*/
    .download-button {
        text-align: center;
        margin-top: auto;
    }/*(W3Schools,2023)*/

    /*styling image container p*/
    .image-container p {
        margin: 10px 0;
    }/*(W3Schools,2023)*/

    /*styling container image*/
    .image-container img {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
    }/*(W3Schools,2023)*/

    /*Add a break between images for screens smaller than 600px */
    @media screen and (max-width: 600px) {
        .col-md-6 {
            width: 100%;
        }

        .image-container {
            margin-bottom: 20px;
        }
    }/*(W3Schools,2023)*/
</style>
<body>
<!--Displaying logo-->
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

<h1 style="color: black;"><u><b>IMAGES</b></u></h1>
<br>

<div class="container">
    <div class="row">
        <?php
        //Display parent images and information
        if (!empty($ChildrenImages)) {
            //Get the currently logged-in child's name from the session
            $childName = $_SESSION['child_name'];//(Gosselin, Kokoska and Easterbrooks,2011)
            //Get the currently logged-in child's ID from the session
            $childID = $_SESSION['child_id'];//(Gosselin, Kokoska and Easterbrooks,2011)

            //Loop through each image in the ChildrenImages array
            foreach ($ChildrenImages as $image) {
                //Check if 'c_name' contains the currently logged-in child's name and ID
                if (isset($image['c_name']) && strpos($image['c_name'], $childName) !== false && strpos($image['c_name'], $childID) !== false) {
                    //Display the image and information within a container
                    echo '<div class="col-md-6">';
                    echo '<div class="image-container">';
                    echo '<p><b>Child Name and ID:</b> ' . $image['c_name'] . '</p>';
                    echo '<p><b>Description:</b> ' . $image['image_description'] . '</p>';
                    echo '<div class="image-wrapper">';
                    echo '<img src="' . $image['image_file'] . '" alt="Parent Image">';
                    echo '</div>';
                    echo '<div class="download-button">';
                    echo '<br><a href="' . $image['image_file'] . '" download class="custom-download-button">Download</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }//(Gosselin, Kokoska and Easterbrooks,2011)
        } else {
            //Display a message if no parent images are available
            echo '<div class="col-md-12">';
            echo '<p>No parent images available.</p>';
            echo '</div>';
        }//(Gosselin, Kokoska and Easterbrooks,2011)
        ?>

    </div>
</div>

<br><br>

<footer>
    <p style="text-align: center">44 Fourth Avenue, Newton Park, Port Elizabeth</p>
    <p style="text-align: center"><a href="tel:0413654013" style="color: black">0413654013</a></p>
    <div class="center">
        <div class="row"> <!--(W3Schools,2021)-->
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
    //This function toggles the responsive class on the "topnav" element to show/hide the navigation menu on small screens
    function toggleNav() {
        var nav = document.getElementsByClassName("topnav")[0];
        if (nav.className === "topnav") {
            nav.className += " responsive";
        } else {
            nav.className = "topnav";
        }
    }//(W3Schools,2023)

    //Showcasing active link in the navigation menu
    document.addEventListener("DOMContentLoaded", function () {
        //Extract the current page name from the URL
        const currentPage = window.location.pathname.split('/').pop().split('.php')[0];
        //Get all anchor elements within elements with the class "topnav"
        const navLinks = document.querySelectorAll(".topnav a");

        //Loop through each link in the navigation menu
        for (const link of navLinks) {
            //Check if the href attribute of the link matches the current page name with ".php" extension
            if (link.getAttribute("href") === currentPage + ".php") {
                //Add the "active" class to the link to highlight it as the active page
                link.classList.add("active");
            }
        }//(W3Schools,2023)
    });//(W3Schools,2023)
</script>


</body>
</html>