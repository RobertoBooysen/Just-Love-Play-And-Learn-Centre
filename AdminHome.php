<?php
session_start();

//Check if the user is authenticated(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    header("Location: AdminLogin.php");
    exit();
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message']);
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message2'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message2'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message2']);
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message3'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message3'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message3']);
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message4'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message4'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message4']);
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message6'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message6'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message6']);
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message7'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message7'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message7']);
}

?>

<!DOCTYPE html>
<html>
<head>
    <!--Setting the ViewPort-->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--(W3Schools,2023)-->
    <!--Stylesheet-->
    <link rel="stylesheet" href="CSS/admin.css"><!--(W3Schools,2023)-->
    <!--Link to external styling-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!--Bootstrap files(Kgt,2016)-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <title>Admin Home</title>
    <!--Bootstrap files(Kgt,2016)-->
</head>

<style>
    /*Styling heading 2*/
    h2 {
        color: #caacd2;
        text-align: center;
        margin-left: 40px;
    }

    /*(W3Schools,2023)*/

    /*Styling paragraph*/
    p {
        text-align: center;
    }

    /*(W3Schools,2023)*/

    /*Styling container*/
    .container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    /*(W3Schools,2023)*/

    /*Styling container box*/
    .container .box {
        width: calc(25% - 20px);
        margin: 10px;
        height: 340px;
        background: #77d4e3;
        box-sizing: border-box;
        overflow: hidden;
        border-radius: 5px;
    }

    /*(W3Schools,2023)*/

    /*Styling button*/
    button {
        margin-top: auto;
        text-align: center;
        background-color: #ccccff;
        border: none;
        text-decoration: none;
    }

    /*(W3Schools,2023)*/

    /*Styling box*/
    .box {
        display: flex;
        flex-direction: column;
    }

    /*(W3Schools,2023)*/

    /*Styling container button*/
    .button-container {
        margin-top: auto; /*Moving the button to the bottom in block*/
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /*(W3Schools,2023)*/

    /*Styling content*/
    .content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /*(W3Schools,2023)*/

    /*Styling div*/
    div1 {
        border-radius: 6px;
        color: black;
        font-family: Arial;
    }

    /*(W3Schools,2023)*/

    /*Styling image container*/
    .image-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /*(W3Schools,2023)*/

    /*Styling image container image*/
    .image-container img {
        max-width: 300px;
        margin-right: 20px;
    }

    /*(W3Schools,2023)*/

    /*Styling block*/
    .block {
        display: block;
        width: 100%;
        border: none;
        background-color: #04AA6D;
        color: white;
        padding: 14px 158px;
        font-size: 16px;
        cursor: pointer;
        text-align: center;
    }

    /*(W3Schools,2023)*/

    /*Styling block hover*/
    .block:hover {
        background-color: #ddd;
        color: black;
    }

    /* Styling for learn more buttons(W3Schools,2023) */
    .learn-more-button {
        display: inline-block;
        padding: 14px 94px;
        font-size: 16px;
        width: 100%;
        color: white;
        background-color: #41c4d8;
        border: none;
        cursor: pointer;
        text-align: center;
        box-sizing: border-box;
    }

    /*Styling for block hover(W3Schools,2023) */
    .learn-more-button:hover {
        background-color: #ddd;
        color: black;
    }

    /*Responsiveness for learn more button on smaller screens(W3Schools,2023) */
    @media screen and (max-width: 768px) {
        .learn-more-button {
            padding: 14px 128px;
        }
    }

    @media screen and (max-width: 550px) {
        .learn-more-button {
            padding: 14px 128px;
        }
    }

    @media screen and (max-width: 480px) {
        .learn-more-button {
            padding: 14px 128px;
        }
    }

    /*(W3Schools,2023)*/

    /*Responsiveness for blocks(W3Schools,2023)*/
    @media screen and (max-width: 768px) {
        .container .box {
            width: calc(50% - 20px);
        }
    }

    /*(W3Schools,2023)*/

    /* Media query for screens with a maximum width of 480px(W3Schools,2023) */
    @media screen and (max-width: 480px) {
        .container .box {
            width: 100%;
        }
    }

    /*(W3Schools,2023)*/
</style>

<body>

<!--Top navigation bar(W3Schools,2023)-->
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->
<div class="topnav">
    <a href="AdminHome.php">Home</a>
    <a href="AdminDiary.php">Diary</a>
    <a href="AdminResources.php">Resources</a>
    <a href="AdminEvents.php">Events</a>
    <a href="AdminImages.php">Images</a>
    <a href="AdminTour.php">Tour</a>
    <a href="AdminTicket.php">Ticket</a>
    <div class="dropdown">
        <button class="dropbtn">
            <i class="fa fa-fw fa-user" style="color: black"></i>
        </button>
        <div class="dropdown-content">
            <a href="index.php" style="width:100%">Log Out</a>
        </div>
    </div>
    <a href="javascript:void(0);" class="icon" onclick="toggleNav()">&#9776;</a>
</div>

<h1 style="color: black;"><u><b>ADMIN HOME</b></u></h1>

<br><br>

<!--Admin(W3Schools,2023)-->
<div1 class="container">
    <div1 class="box">
        <div1 class="content">
            <br>
            <h3 style="font-size:18px"><u><b>Admin</b></u></h3>
            <div1>
                <p>View all administrators.</p>
            </div1>
        </div1>
        <div1 class="button-container">
            <a href="AdminTable.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background: #41c4d8">View Table</button>
            </a>
        </div1>
    </div1>

    <!--Request Application(W3Schools,2023)-->
    <div1 class="box" style=" background: #caacd2;">
        <div1 class="icon" style="display: flex; justify-content: center; align-items: center;">
        </div1>
        <div1 class="content">
            <br>
            <h3 style="font-size:18px"><u><b>Requested Applications</b></u></h3>
            <div1>
                <p>Explore the latest incoming applications, where applications are viewed, approved and rejected.</p>
            </div1>

        </div1>
        <div1 class="button-container">
            <a href="RequestApplicationTable.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background: #b58bc1">View Table</button>
            </a>
        </div1>
    </div1>

    <!--Approved applications(W3Schools,2023)-->
    <div1 class="box" style=" background: #ccccff;">
        <div1 class="content">
            <br>
            <h3 style="font-size:18px"><u><b>Approved Applications</b></u></h3>
            <div1>
                <p>View Approved Enrollments with the option to download additional information as PDFs.</p>
            </div1>
        </div1>
        <div1 class="button-container">
            <a href="ApproveApplicationsTable.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background: #9999ff">View Table</button>
            </a>
        </div1>
    </div1>

    <!--Request Registration(W3Schools,2023)-->
    <div1 class="box">
        <div1 class="icon" style="display: flex; justify-content: center; align-items: center;">
        </div1>
        <div1 class="content">
            <br>
            <h3 style="font-size:18px"><u><b>Portal Registration Request</b></u></h3>
            <div1>
                <p>Review new parent portal registrations and approve or decline to grant parent portal access to
                    registered parents
                </p>
            </div1>
        </div1>
        <div1 class="button-container">
            <a href="RequestRegTable.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background: #41c4d8">View Table</button>
            </a>
        </div1>
    </div1>

    <!--Parents(W3Schools,2023)-->
    <div1 class="box" style=" background: #caacd2">
        <div1 class="icon" style="display: flex; justify-content: center; align-items: center;">
        </div1>
        <div1 class="content">
            <br>
            <h3 style="font-size:18px"><u><b>Approved Parent Portal Users</b></u></h3>
            <div1>
                <p>View all approved parent portal users.</p>
            </div1>

        </div1>
        <div1 class="button-container">
            <a href="ParentsTable.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background: #b58bc1">View Table</button>
            </a>
        </div1>
    </div1>

    <!--Diary(W3Schools,2023)-->
    <div1 class="box" style=" background: #ccccff;">
        <div1 class="icon" style="display: flex; justify-content: center; align-items: center;">
        </div1>
        <div1 class="content">
            <br>
            <h3 style="font-size:18px"><u><b>Diary</b></u></h3>
            <div1>
                <p>View All Diary Entries: Admins can add, edit, and delete entries.</p>
            </div1>
        </div1>
        <div1 class="button-container">
            <a href="DiaryTable.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background:#9999ff">View Table</button>
            </a>
        </div1>
    </div1>

    <!--Resources(W3Schools,2023)-->
    <div1 class="box">
        <div1 class="icon" style="display: flex; justify-content: center; align-items: center;">
        </div1>
        <div1 class="content">
            <br>
            <h3 style="font-size:18px"><u><b>Resources</b></u></h3>
            <div1>
                <p>View All Resources: Admins can add, edit, and delete resources.</p>
            </div1>
        </div1>
        <div1 class="button-container">
            <a href="ResourcesTable.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background: #41c4d8">View Table</button>
            </a>
        </div1>
    </div1>

    <!--Events(W3Schools,2023)-->
    <div1 class="box" style=" background: #caacd2;">
        <div1 class="icon" style="display: flex; justify-content: center; align-items: center;">
        </div1>
        <div1 class="content">
            <br>
            <h3 style="font-size:18px"><u><b>Events</b></u></h3>
            <div1>
                <p>View All Events: Admins can add, edit, and delete Events.</p>
            </div1>
        </div1>
        <div1 class="button-container">
            <a href="EventsTable.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background: #b58bc1">View Table</button>
            </a>
        </div1>
    </div1>

    <!--Images(W3Schools,2023)-->
    <div1 class="box" style="background: #ccccff;">
        <div1 class="icon" style="display: flex; justify-content: center; align-items: center;">
        </div1>
        <div1 class="content">
            <br>
            <h3 style="font-size:18px"><u><b>Images</b></u></h3>
            <div1>
                <p>View all images for specific children.</p>
            </div1>

        </div1>
        <div1 class="button-container">
            <a href="ImagesTable.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background: #9999ff">View Table</button>
            </a>
        </div1>
    </div1>


    <!--Tour(W3Schools,2023)-->
    <div1 class="box" style=" background: #77d4e3;">
        <div1 class="icon" style="display: flex; justify-content: center; align-items: center;">
        </div1>
        <div1 class="content">
            <br>
            <h3 style="font-size:18px"><u><b>Tour</b></u></h3>
            <div1>
                <p>View requested tours, where administrators have the authority to approve, reschedule, or delete tours
                    as needed.</p>
            </div1>
        </div1>
        <div1 class="button-container">
            <a href="TourTable.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background:#41c4d8">View Table</button>
            </a>
        </div1>
    </div1>

    <!--PDF Reports(W3Schools,2023)-->
    <div1 class="box" style=" background: #caacd2;">
        <div1 class="content">
            <br>
            <h3 style="font-size:18px"><u><b>PDF Reports</b></u></h3>
            <div1>
                <p>View and download PDF reports containing parent contact details, allergy information, and a list of
                    children.</p>
            </div1>
        </div1>
        <div1 class="button-container">
            <a href="PdfReports.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background: #b58bc1">View Table</button>
            </a>
        </div1>
    </div1>
</div1>

<br><br>
<br><br>

<footer>
    <!-- This paragraph contains the address and is centered(W3Schools,2023) -->
    <p style="text-align: center">44 Fourth Avenue, Newton Park, Port Elizabeth</p>
    <!-- This paragraph contains a phone number link with black text color(W3Schools,2023)-->
    <p style="text-align: center"><a href="tel:0413654013" style="color: black">0413654013</a></p>
    <!--(W3Schools,2023)-->

    <div class="center">
        <div class="row">
            <!--Displaying social media Facebook icon-->
            <div class="column">
                <a href="https://www.facebook.com/JustLoveLearnandPlay" target="blank"><img src="Images/Facebook.png"
                                                                                            alt="Facebook logo"
                                                                                            style="width:20%"></a>
            </div><!--(W3Schools,2023)-->

            <!--Display social media Email icon-->
            <div class="column">
                <a href="mailto:jlplayandcentre@gmail.com" target="blank"><img src="Images/Email.png" alt="Email logo"
                                                                               style="width:20%"></a>
            </div><!--(W3Schools,2023)-->

            <!--Display social media WhatsApp icon-->
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
    //Function to toggle navigation menu
    function toggleNav() {
        var nav = document.getElementsByClassName("topnav")[0];
        if (nav.className === "topnav") {
            nav.className += " responsive";
        } else {
            nav.className = "topnav";
        }
    }<!--(W3Schools,2023)-->

    //Showcasing active link
    document.addEventListener("DOMContentLoaded", function () {
        const currentPage = window.location.pathname.split('/').pop().split('.php')[0];
        const navLinks = document.querySelectorAll(".topnav a");

        for (const link of navLinks) {
            if (link.getAttribute("href") === currentPage + ".php") {
                link.classList.add("active");
            }
        }
    });<!--(W3Schools,2023)-->
</script>

</body>
</html>