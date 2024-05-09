<?php
global $conn;
require_once 'DBConn.php';

//Check if the child_id session variable is set to determine if the parent is logged in
if (isset($_SESSION['child_id'])) {
    //Retrieve child's name and ID from session
    $childName = $_SESSION['child_name'];
    $childID = $_SESSION['child_id'];//(Gosselin, Kokoska and Easterbrooks,2011)

    //Query to fetch diary entries of the currently logged-in user
    $query = "SELECT * FROM diary WHERE c_name = CONCAT('$childName', ' (', '$childID', ')')";//(Gosselin, Kokoska and Easterbrooks,2011)

    //Execute the query and retrieve the results
    $result = mysqli_query($conn, $query);//(Gosselin, Kokoska and Easterbrooks,2011)

    //Check if the query was executed successfully
    if ($result) {
        //Initialize an array to store the child's diary entries
        $childrenDiaryEntries = [];

        //Loop through the query results and store them in the array
        while ($row = mysqli_fetch_assoc($result)) {
            $childrenDiaryEntries[] = $row;
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

    <!-- Link to your custom stylesheet -->
    <link rel="stylesheet" href="CSS/parent.css"><!--(W3Schools,2023)-->

    <!-- Include Bootstrap stylesheet for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"><!--(W3Schools,2023)-->

    <!-- Include Font Awesome stylesheet for icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"><!--(W3Schools,2023)-->

    <!-- Set the title of the page -->
    <title>Parent Diary</title><!--(W3Schools,2023)-->
</head>
<style>
    /*Styling timeline container */
    .timeline {
        list-style: none;
        padding: 0;
    }/*(W3Schools,2023)*/

    /*Styling timeline item */
    .timeline-item {
        display: flex;
        margin: 20px 0;
        padding: 15px;
        border: 2px solid #ccc;
        border-radius: 10px;
        background-color: #f5f5f5;
    }/*(W3Schools,2023)*/

    /*Styling timeline item content */
    .timeline-content {
        margin-left: 20px;
    }/*(W3Schools,2023)*/

    /*Styling timeline item date */
    .timeline-date {
        font-weight: bold;
        color: #333;
    }/*(W3Schools,2023)*/

    /*Added a bit of margin */
    .timeline-content p {
        margin: 10px 0;
    }/*(W3Schools,2023)*/

    /*Highlight current day entry with a different color */
    .current-day {
        background-color: #EBF094; /* Use a different color for the current day */
    }/*(W3Schools,2023)*/
</style>
<body>
<!--Displaying Logo-->
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo"><!--(W3Schools,2023)-->
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

<h1 style="color:black;"><u><b>DIARY ENTRIES</b></u></h1>
<br>

<ul class="timeline">
    <?php
    //Get the current date
    $currentDate = date("Y-m-d");//(Gosselin, Kokoska and Easterbrooks,2011)

    //Display parent diary entries and information as a timeline
    if (!empty($childrenDiaryEntries)) {
        //Sort diary entries by date in descending order
        usort($childrenDiaryEntries, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });//(Gosselin, Kokoska and Easterbrooks,2011)

        //Loop through each diary entry in the childrenDiaryEntries array
        foreach ($childrenDiaryEntries as $entry) {
            //Get the date, diary description, and child name from the entry
            $date = date("F j, Y", strtotime($entry['date']));
            $diaryDescription = $entry['diary_description'];
            $childName = $entry['c_name'];

            //Determine if the entry's date is the current date
            $isCurrentDay = $entry['date'] === $currentDate;
            $cssClass = $isCurrentDay ? 'current-day' : '';

            //Create a timeline item for each diary entry
            echo '<li class="timeline-item ' . $cssClass . '">';
            echo '<div class="timeline-content">';
            echo '<p class="timeline-date">' . $date . '</p>';
            echo '<p><b>Child Name and ID:</b> ' . $childName . '</p>';
            echo '<p><b>Diary Description:</b> ' . $diaryDescription . '</p>';
            echo '</div>';
            echo '</li>';
        }//(Gosselin, Kokoska and Easterbrooks,2011)
    } else {
        //Display a message if no diary entries are available
        echo '<li class="timeline-item">';
        echo '<div class="timeline-content">';
        echo '<p>No diary entries available.</p>';
        echo '</div>';
        echo '</li>';
    }//(Gosselin, Kokoska and Easterbrooks,2011)
    ?>
</ul>

<br><br>

<footer>
    <p style="text-align: center">44 Fourth Avenue, Newton Park, Port Elizabeth</p> <!--(W3Schools,2021)-->
    <p style="text-align: center"><a href="tel:0413654013" style="color: black">0413654013</a></p> <!--(W3Schools,2021)-->
    <div class="center">
        <div class="row"> <!--(W3Schools,2021)-->
            <div class="column"><!--Facebook-->
                <a href="https://www.facebook.com/JustLoveLearnandPlay" target="blank"><img src="Images/Facebook.png"
                                                                                            alt="Facebook logo"
                                                                                            style="width:20%"></a>
            </div> <!--(W3Schools,2021)-->
            <div class="column"><!--Email-->
                <a href="mailto:jlplayandcentre@gmail.com" target="blank"><img src="Images/Email.png" alt="Email logo"
                                                                   style="width:20%"></a>
            </div> <!--(W3Schools,2021)-->
            <div class="column"><!--WhatsApp-->
                <a href="tel:0720186560>" target="blank"><img src="Images/Whatsapp.png" alt="Whatsapp logo"
                                                              style="width:20%"></a>
            </div> <!--(W3Schools,2021)-->
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
        }
    });//(W3Schools,2023)
</script>
</body>
</html>
