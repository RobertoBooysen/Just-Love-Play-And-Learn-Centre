<?php
global $conn;
require_once 'DBConn.php';

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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Include Bootstrap CSS for responsive design -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"><!--(W3Schools,2023)-->

    <!--Include custom CSS stylesheet for parent-specific styling -->
    <link rel="stylesheet" href="CSS/parent.css"><!--(W3Schools,2023)-->

    <!--Include FullCalendar CSS for calendar display -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet'><!--(W3Schools,2023)-->

    <!--Include stylesheet -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"><!--(W3Schools,2023)-->

    <!--Include jQuery library for JavaScript functionality -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script><!--(W3Schools,2023)-->

    <!--Include Bootstrap JavaScript for enhanced functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script><!--(W3Schools,2023)-->

    <!--Include Moment.js library for date and time manipulation -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script><!--(W3Schools,2023)-->

    <!--Include FullCalendar JavaScript for the calendar component -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script><!--(W3Schools,2023)-->

    <!-- Set the title of the page -->
    <title>Parent Events</title><!--(W3Schools,2023)-->
    <style>
        /*Calendar styling */
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            grid-gap: 10px;
        }/*(W3Schools,2023)*/

        /*calendar styling*/
        .calendar-cell {
            border: 1px solid #ccc;
            padding: 10px;
            min-height: 150px;
            text-align: left;
        }/*(W3Schools,2023)*/

        /*calendar styling*/
        .day-label {
            font-weight: bold;
        }/*(W3Schools,2023)*/

        /*Position the modal above the calendar for pop-up display */
        .modal {
            z-index: 9999;
        }/*(W3Schools,2023)*/

        /*Add a CSS class for the enlarged image */
        .enlarged {
            width: 100%; /*Adjust this value for the desired enlargement */
        }/*(W3Schools,2023)*/
    </style>

</head>

<body>
<!--Displaying logo-->
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo"><!--(W3Schools,2023)-->
</div>

<!--Top navigation bar -->
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

<br>

<h1><u><b>EVENTS</b></u></h1>

<div id='calendar'></div>

<!--Modal for displaying event details -->
<div class="modal fade" id="eventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="eventDetailsModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--Modal title -->
                <h5 class="modal-title" id="eventDetailsModalLabel"></h5>
                <!--Close button to dismiss the modal -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button><!--(W3Schools,2023)-->
            </div>
            <div class="modal-body">
                <!--Event details will be displayed here -->
                <img id="popupImage" src="" alt="Events_File">
            </div><!--(W3Schools,2023)-->
        </div>
    </div>
</div><!--(W3Schools,2023)-->

<footer>
    <p style="text-align: center">44 Fourth Avenue, Newton Park, Port Elizabeth</p><!--(W3Schools,2023)-->
    <p style="text-align: center"><a href="tel:0413654013" style="color: black">0413654013</a></p><!--(W3Schools,2023)-->
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
    //Initialize FullCalendar
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            events: {
                url: 'Get_events.php', //Use a separate PHP script to fetch events
                color: '#77d4e3', //Event color
                textColor: 'black', //Event text color
            },//(W3Schools,2023)
            eventRender: function (event, element) {
                //Customize event rendering to display only the event name
                element.find('.fc-title').html(event.title);
            },//(W3Schools,2023)
            eventClick: function (event, jsEvent, view) {
                //Show a pop-up with event details when an event is clicked
                $('#eventDetailsModal .modal-title').html(event.title);
                $('#eventDetailsModal .modal-body').html(
                    '<p><b>Description:</b> ' + event.event_description + '</p>' +
                    '<p><b>Date of Event:</b> ' + moment(event.start).format('YYYY-MM-DD') + '</p>' +
                    '<img id="popupImage" src="' + event.events_file + '" alt="Events_File">'
                );

                // Add an event listener to the image
                $('#popupImage').on('click', function () {
                    $(this).toggleClass('enlarged');
                });

                $('#eventDetailsModal').modal('show');
            },
        });//(W3Schools,2023)
    });

    //Function to toggle navigation
    function toggleNav() {
        var nav = document.getElementsByClassName("topnav")[0];
        if (nav.className === "topnav") {
            nav.className += " responsive";
        } else {
            nav.className = "topnav";
        }
    }//(W3Schools,2023)

    //Function to set the active link
    function setActiveLink() {
        const currentPage = window.location.pathname.split('/').pop().split('.php')[0];
        const navLinks = document.querySelectorAll(".topnav a");

        for (const link of navLinks) {
            if (link.getAttribute("href") === currentPage + ".php") {
                link.classList.add("active");
            }
        }
    }//(W3Schools,2023)

    //Showcasing active link
    document.addEventListener("DOMContentLoaded", setActiveLink);//(W3Schools,2023)
</script>

</body>
</html>
