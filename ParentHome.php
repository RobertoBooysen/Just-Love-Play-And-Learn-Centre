<?php
session_start();

//Check if the child_id session variable is set to determine if the parent is logged in
if (!isset($_SESSION['child_id'])) {
    //Redirect to the login page if not logged in
    header("Location: ParentLogin.php");
    exit();
}//(Gosselin, Kokoska and Easterbrooks,2011)
?>
<!DOCTYPE html>
<html>
<head>
    <!--Setting the ViewPort-->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--(W3Schools,2023)-->
    <!--Stylesheet-->
    <link rel="stylesheet" href="CSS/parent.css"><!--(W3Schools,2023)-->
    <!--Link to external styling-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!--Bootstrap files(Kgt,2016)-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!--Bootstrap files(Kgt,2016)-->
    <title>Parent Home</title>
    <style>
        /* Additional styling for the main headings */
        h2 {
            text-align: left;
        }

        /*(W3Schools,2023)*/

        /* CSS for the steps */
        ol {
            counter-reset: step;
            list-style: none;
        }

        /*(W3Schools,2023)*/

        /*styling table*/
        table, td, th {
            border: 1px solid #ddd;
            text-align: center;
        }

        /*(W3Schools,2023)*/

        /*styling table*/
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #caacd2;
        }

        /*(W3Schools,2023)*/

        /*styling table*/
        th, td {
            padding: 15px;
        }

        /*(W3Schools,2023)*/

        /* Add margin to paragraphs to move them away from the margin */
        p {
            margin: 10px 0; /* Adjust the top and bottom margin as needed */
        }

        /*(W3Schools,2023)*/

    </style>

<body>
<!--Displaying Daycare Logo-->
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->

<!-- Navigation bar within the parent portal -->
<div class="topnav">
    <a href="ParentHome.php">Home</a>
    <a href="ParentDiary.php">Diary</a>
    <a href="ParentResources.php">Resources</a>
    <a href="ParentEvents.php">Events</a>
    <a href="ParentImages.php">Images</a>
    <a href="ParentLogTicket.php">Ticket</a><!--(W3Schools,2023)-->

    <!--Dropdown to login to parent and admin portal-->
    <div class="dropdown">
        <button class="dropbtn">
            <i class="fa fa-fw fa-user" style="color: black"></i>
        </button>
        <div class="dropdown-content">
            <a href="index.php" style="width:100%">Log Out</a>
        </div>
    </div><!--(W3Schools,2023)-->
    <a href="javascript:void(0);" class="icon" onclick="toggleNav()">&#9776;</a>
</div>
<div class="container">
    <h1 style="color: black;"><u><b>HOME</b></u></h1>
    <br>
    <!-- Welcome Message -->
    <p>Welcome to <b>Just Love Play And Learn Centre</b> ! We're thrilled to have you on board, and we're here to
        enhance your parenting journey, making it more convenient and enjoyable. Our application is designed with you
        and your child in mind, offering a seamless and engaging experience.
        With our application, you can easily access all the essential information about your child's day at the daycare
        with just a few taps. </p>
    <p>We're excited to welcome you on board and partner with you in caring for your child. If you have any questions or
        need assistance, please don't hesitate to log a support ticket. Thank you for choosing us to be a part of your
        child's growth and development journey!</p>
    <br>

    <!-- Diary Section -->
    <h2>Diary</h2>
    <hr style="border-color: #77d4e3; border-width: 2px;">
    <p>From the navigation bar or menu, locate and click on the "Diary" option. This will take you to the page where you
        can access incident and behaviour reports for your child.</p>
    <ol>
        <li><b>Step 1:Review Incidents</b></li>
        <p>The incident or behaviour reports for that day will be displayed on the page. Each incident should be
            accompanied by a description of what occurred and the date of the incident.</p>
        <li><b>Step 2:Respond to Incident Report</b></li>
        <ul>
            <li>Access the Ticket page by clicking 'Ticket' in the navigation bar to complete the Log ticket form, where
                you can enter your questions, concerns, or comments related to the incident report. Provide as much
                detail as necessary.
            </li>
            <li>After filling out the query form, review the information, and when you're ready, click the "Submit
                Ticket" button to send your inquiry to the daycare.
            </li>
            <li>Once you've submitted your query, the daycare will receive it and respond. The response will typically
                be sent to your registered email address. This email should include information regarding the incident
                and any actions taken or planned.
            </li>
            <li>Keep an eye on your email for responses from the daycare. It's important to monitor your inbox,
                including spam and junk folders, to ensure you don't miss any updates regarding your ticket.
            </li>
        </ul><!--(W3Schools,2023)-->
    </ol>
    <br>

    <!-- Resources Section -->
    <h2>Resources</h2>
    <hr style="border-color: #77d4e3; border-width: 2px;">
    <p>From the navigation bar or menu, locate and click on the "Resources" option. This will take you to the page where
        you can access various resources provided by the daycare.</p>
    <ol>
        <li><b>Step 1:Browse Available Resources</b></li>
        <p>A list of available resources tailored to specific age groups will be displayed. These resources may include
            homework, educational materials, newsletters, and more.</p>
        <li><b>Step 2:Access the Resource Details</b></li>
        <p>You can find information such as the description of the resource, any attachments, date of the resource, and
            other relevant details.</p>
    </ol><!--(W3Schools,2023)-->
    <br>

    <!-- Events Section -->
    <h2>Events</h2>
    <hr style="border-color: #77d4e3; border-width: 2px;">
    <p>From the navigation bar or menu, locate and click on the "Events" option. This will take you to the page where
        you can view upcoming events on a calendar.</p>
    <ol>
        <li><b>Step 1:View Upcoming Events</b></li>
        <p>On the "Events" page, you'll see a calendar displaying the current month with highlighted dates indicating
            upcoming events. Click or tap on any of these highlighted dates to view event details.</p>
        <li><b>Step 2:Navigate to Previous Months</b></li>
        <p>To see events from previous months, you can use the left arrow button. Clicking this button will redirect you
            to the previous month's view on the calendar.</p>
        <li><b>Step 3:View Previous Month's Events</b></li>
        <p>After navigating to the previous month, you can click on dates with events to view event details for that
            month.</p>
        <li><b>Step 4:Navigate to Upcoming Month's Events</b></li>
        <p>To check upcoming events, use the arrow button on your right. Clicking this button will direct you to the
            calendar view for the upcoming month.</p>
        <li><b>Step 5:View Upcoming Month's Events</b></li>
        <p>Once you're on the calendar for the upcoming month, you can click on dates with highlighted events to view
            the details of those events.</p>
        <li><b>Step 6:Enlarge Images</b></li>
        <p>Within the event details, you may find images related to the event. To make an image larger and get a closer
            view, simply click on the image. The image will then display in a larger size, allowing you to view it more
            closely.</p>
        <li><b>Step 6:Repeat Steps as Needed</b></li>
        <p>Continue navigating between previous and upcoming months as required to view events on the calendar. You can
            explore event details, check dates, and stay informed about daycare events.</p>
    </ol><!--(W3Schools,2023)-->
    <br>

    <!-- Images Section -->
    <h2>Images</h2>
    <hr style="border-color: #77d4e3; border-width: 2px;">
    <p>From the navigation bar or menu, locate and click on the "Images" option. This will take you to the page where
        you can view and download your child's images.</p>
    <ol>
        <li><b>Step 1:Identify Your Child</b></li>
        <p>Upon entering the "Images" page, the application should automatically filter and display images related only
            to your child. This is done by associating your child's profile with your account during registration.</p>
        <li><b>Step 2:Browse the Images</b></li
        <p>You'll now see a gallery or a list of images of your child. You can scroll through these images to view
            them. </p>
        <li><b>Step 3:Select an Image to Download</b></li>
        <p>To download a specific image, select the download button underneath the image.The image will be saved to your
            device's storage or gallery.</p>
        <li><b>Step 4:Return to Image Gallery</b></li>
        <p>If you wish to download more images or continue browsing, use the provided navigation buttons or gestures to
            return to the image gallery.</p>
    </ol><!--(W3Schools,2023)-->
    <br>

    <!-- Ticket Section -->
    <h2>Ticket</h2>
    <hr style="border-color: #77d4e3; border-width: 2px;">
    <p>From the navigation bar or menu, locate and click on the "Ticket" option. This will take you to the page where
        you can provide the necessary information to log a ticket.</p>
    <ol>
        <li><b>Step 1:Fill Out the Ticket Form</b></li>
        <p>The form typically includes fields like:</p>
        <ul>
            <li>Parent's Name</li>
            <li>Last Name</li>
            <li>Email Address</li>
            <li>Phone Number</li>
            <li>A description or message explaining the details of your query, request, or response to an incident
                report.
            </li>
        </ul><!--(W3Schools,2023)-->
        <br>
        <li><b>Step 2:Review Your Information</b></li>
        <p>Before submitting your ticket, take a moment to review the information you've provided to ensure accuracy and
            completeness. This will help the daycare staff address your query or request effectively.</p>

        <li><b>Step 3:Submit Your Ticket</b></li>
        <p>After confirming the information, click the "Submit Ticket" button. Your ticket will be sent to the daycare
            for processing.</p>

        <li><b>Step 4:Wait for a Response</b></li>
        <p>The daycare will review your ticket and respond to your query or request as necessary. They will use the
            contact information you provided, typically via email, to communicate with you.</p>

        <li><b>Step 5:Check Your Email for Responses</b></li>
        <p>Keep an eye on your email for responses from the daycare. It's important to monitor your inbox, including
            spam and junk folders, to ensure you don't miss any updates regarding your ticket.</p>
    </ol><!--(W3Schools,2023)-->
</div>
<br>

<footer>
    <!-- This paragraph contains the address and is centered -->
    <p style="text-align: center">44 Fourth Avenue, Newton Park, Port Elizabeth</p>
    <!-- This paragraph contains a phone number link with black text color-->
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
    //Function to toggle the navigation menu
    function toggleNav() {
        var nav = document.getElementsByClassName("topnav")[0];
        if (nav.className === "topnav") {
            nav.className += " responsive";
        } else {
            nav.className = "topnav";
        }
    }//(W3Schools,2023)

    //Showcasing the active link in the navigation menu
    document.addEventListener("DOMContentLoaded", function () {
        //Extract the current page name from the URL
        const currentPage = window.location.pathname.split('/').pop().split('.php')[0];
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