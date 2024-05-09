<?php
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    header("Location: AdminLogin.php"); //Redirect to AdminLogin.php if not authenticated
    exit();
}

//Fetch events from the MySQL database and format them for FullCalendar(Gosselin, Kokoska and Easterbrooks,2011)
$tour = array(); //Initialize an array to store event data for FullCalendar(Gosselin, Kokoska and Easterbrooks,2011)

$result = $conn->query("SELECT date, email, name, time FROM tour where status='approved'"); //Query the database to retrieve event data(Gosselin, Kokoska and Easterbrooks,2011)

while ($row = $result->fetch_assoc()) {
    $tourDate = $row['date'];
    $tourTime = $row['time'];
    $start = $tourDate . 'T' . $tourTime; //Combine date and time for FullCalendar format(Gosselin, Kokoska and Easterbrooks,2011)
    $tour[] = array(
        'title' => $row['name'], //Set the event title(Gosselin, Kokoska and Easterbrooks,2011)
        'start' => $start, //Set the event start time(Gosselin, Kokoska and Easterbrooks,2011)
        'email' => $row['email'], //Store email information for the event(Gosselin, Kokoska and Easterbrooks,2011)
    );
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Define the viewport for responsive design(W3Schools,2023) -->
    <link rel="stylesheet" href="CSS/admin.css"> <!--Include a custom admin.css stylesheet(W3Schools,2023) -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet'/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Include Font Awesome icons(W3Schools,2023) -->
    <!--Include FullCalendar CSS(W3Schools,2023) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!--Include Font Awesome icons(W3Schools,2023) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!--Include jQuery library(W3Schools,2023) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <!--Include Bootstrap JavaScript(W3Schools,2023) -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
    <!--Include Moment.js library(W3Schools,2023) -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <!--Include FullCalendar JavaScript(W3Schools,2023) -->
    <title>Admin Tour</title>

</head>
<style>
    :root {
        --primary-color: rgb(11, 78, 179); /*Define a CSS custom property for primary color(W3Schools,2023) */
    }

    *,
    *::before,
    *::after {
        box-sizing: border-box; /*Apply box-sizing to all elements(W3Schools,2023) */
    }

    label {
        display: block;
        margin-bottom: 0.5rem; /*Style for form labels(W3Schools,2023) */
    }

    input {
        display: block;
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        height: 50px; /*Style for form input elements(W3Schools,2023) */
    }

    .width-50 {
        width: 50%; /*Style class for 50% width(W3Schools,2023) */
    }

    .ml-auto {
        margin-left: auto; /*Style class for auto margin left(W3Schools,2023) */
    }

    .btn {
        padding: 0.75rem;
        display: block;
        text-decoration: none;
        background-color: #77d4e3;
        color: black;
        text-align: center;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: 0.3s; /*Style for buttons with hover effect(W3Schools,2023) */
    }

    .btn:hover {
        box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2; /*Button hover effect with box-shadow(W3Schools,2023) */
    }

    .error-message {
        position: fixed;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        padding: 10px 15px;
        background-color: rgba(255, 0, 0, 0.8);
        color: #fff;
        border-radius: 5px;
        font-size: 16px;
        z-index: 9999; /*Style for displaying error messages(W3Schools,2023) */
    }
</style>
<body>
<!--Top navigation bar-->
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

<br>
<h1><u><b>ADMIN TOUR</b></u></h1>
<br>

<div id='calendar'></div>

<!--Modal for displaying tour details(W3Schools,2023) -->
<div class="modal fade" id="tourModal" tabindex="-1" role="dialog" aria-labelledby="tourModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tourModalLabel">Tour Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="tourModalBody">
                <!--Tour details will be displayed here(W3Schools,2023) -->
            </div>
        </div>
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
            </div>
            <div class="column">
                <a href="mailto:jlplayandcentre@gmail.com" target="blank"><img src="Images/Email.png" alt="Email logo"
                                                                               style="width:20%"></a>
            </div>
            <div class="column">
                <a href="tel:0720186560>" target="blank"><img src="Images/Whatsapp.png" alt="Whatsapp logo"
                                                              style="width:20%"></a>
            </div>
        </div>
    </div>
    <br>
    <p style="text-align: center">@2023 RNK. All rights reserved.</p>
</footer>

<script>
    // Initialize FullCalendar(W3Schools,2023)
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            events: <?php echo json_encode($tour); ?>,
            eventClick: function (tour) {
                // Open the modal and display tour details(W3Schools,2023)
                var modal = $('#tourModal');
                var modalBody = $('#tourModalBody');

                var htmlContent = '<strong>Name:</strong> ' + tour.title + '<br>' +
                    '<strong>Date:</strong> ' + tour.start.format('YYYY-MM-DD') + '<br>' +
                    '<strong>Time:</strong> ' + tour.start.format('HH:mm') + '<br>' +
                    '<strong>Email:</strong> ' + tour.email;

                modalBody.html(htmlContent);
                modal.modal('show');
            }
        });
    });

    // Function to toggle navigation(W3Schools,2023)
    function toggleNav() {
        var nav = document.getElementsByClassName("topnav")[0];
        if (nav.className === "topnav") {
            nav.className += " responsive";
        } else {
            nav.className = "topnav";
        }
    }

    //Function to set the active link(W3Schools,2023)
    function setActiveLink() {
        const currentPage = window.location.pathname.split('/').pop().split('.php')[0];
        const navLinks = document.querySelectorAll(".topnav a");

        for (const link of navLinks) {
            if (link.getAttribute("href") === currentPage + ".php") {
                link.classList.add("active");
            }
        }
    }

    //Showcasing active link(W3Schools,2023)
    document.addEventListener("DOMContentLoaded", setActiveLink);
</script>

</body>
</html>