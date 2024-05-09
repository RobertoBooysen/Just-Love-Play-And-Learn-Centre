<?php
global $conn;
require_once 'DBConn.php';

//Function to check if a given tour ID exists in the database
function isIDExistsTour($cid, $conn)
{
    $sql = "SELECT COUNT(*) as count FROM tour WHERE tour_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$cid]);
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to insert a new tour record into the database
function insertTour($cid, $data, $conn)
{
    //SQL query to insert tour data, setting the status to 'pending' by default
    $sql = "INSERT INTO tour (tour_id, email, name, date, time, status) VALUES (?, ?, ?, ?, ?, 'pending')";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$cid, $data['email'], $data['name'], $data['date'], $data['time']]);
    return $result;
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to generate a unique tour ID based on timestamp
function generateUniqueID()
{
    $timestamp = time();
    return strtolower($timestamp);
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to check if the selected time is within allowed booking hours (8 AM to 5 PM)
function isTimeValid($time)
{
    $startTime = strtotime("08:00:00"); //10 AM
    $endTime = strtotime("17:00:00"); //5 PM
    $bookingTime = strtotime($time);

    return ($bookingTime >= $startTime && $bookingTime <= $endTime);
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to check if the selected date is a Saturday or Sunday (weekend)
function isWeekend($date)
{
    $dayOfWeek = date('w', strtotime($date));
    return ($dayOfWeek == 0 || $dayOfWeek == 6); //0 is Sunday, 6 is Saturday
}//(Gosselin, Kokoska and Easterbrooks,2011)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Generate a unique tour ID
    $cid = generateUniqueID();

    //Retrieve tour data from the POST request
    $data = array(
        'email' => $_POST['email'],
        'name' => $_POST['name'],
        'date' => $_POST['date'],
        'time' => $_POST['time']
    );//(Gosselin, Kokoska and Easterbrooks,2011)

    //Check if the tour ID already exists in the database
    if (isIDExistsTour($cid, $conn)) {
        echo "<script>alert('ID already exists. Please choose a different ID.')</script>";
    } //Check if the selected time is valid (within booking hours)
    elseif (!isTimeValid($data['time'])) {
        echo "<script>alert('Booking is only allowed between 8 AM and 5 PM.')</script>";
    } //Check if the selected date is a weekend
    elseif (isWeekend($data['date'])) {
        echo "<script>alert('Please select a working day (Monday to Friday) for the tour.')</script>";
    } //Insert the tour data into the database
    else {
        $result = insertTour($cid, $data, $conn);
        if ($result !== false) {
            echo "<script>alert('Tour scheduled successfully. Please wait for a follow-up email regarding the availability for the time slot.')</script>";
        } else {
            echo "Failed to insert data.";
        }
    }
}//(Gosselin, Kokoska and Easterbrooks,2011)
?>


<!DOCTYPE html>
<html>
<head>
    <!-- Set the viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--(W3Schools,2023)-->

    <!-- Link to your custom stylesheet -->
    <link rel="stylesheet" href="CSS/style.css"><!--(W3Schools,2023)-->

    <!-- Link to Bootstrap stylesheet for additional styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"><!--(W3Schools,2023)-->

    <!-- Link to Font Awesome stylesheet for icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"><!--(W3Schools,2023)-->

    <!-- Link to Google Fonts for the Raleway font -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"><!--(W3Schools,2023)-->

    <!-- Set the title of the page -->
    <title>Tour</title><!--(W3Schools,2023)-->

    <style>

        /*Adding colour*/
        :root {
            --primary-color: rgb(11, 78, 179)
        }

        /*(W3Schools,2023)*/

        /*Styling the form box*/
        *,
        *::before,
        *::after {
            box-sizing: border-box
        }

        /*(W3Schools,2023)*/

        /*Styling the label*/
        label {
            display: block;
            margin-bottom: 0.5rem
        }

        /*(W3Schools,2023)*/

        /*Styling the form input*/
        input {
            display: block;
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            height: 50px
        }

        /*(W3Schools,2023)*/

        /*Styling the width*/
        .width-50 {
            width: 50%
        }

        /*(W3Schools,2023)*/

        /*Styling the margins*/
        .ml-auto {
            margin-left: auto
        }

        /*(W3Schools,2023)*/

        /*Styling the form*/
        .form {
            max-width: 1000px;
            margin: 0 auto;
            border: none;
            border-radius: 10px !important;
            overflow: hidden;
            padding: 1.5rem;
            background-color: #fff;
            padding: 20px 30px; /*Style for the form container */
        }

        /*(W3Schools,2023)*/

        /*Styling the button*/
        .btn {
            padding: 0.75rem;
            display: block;
            text-decoration: none;
            background-color: #77d4e3;
            color: black;
            text-align: center;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: 0.3s
        }

        /*(W3Schools,2023)*/

        /*Styling the button hover*/
        .btn:hover {
            box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2
        }

        /*(W3Schools,2023)*/

        /*Styling the error message*/
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
            z-index: 9999;
        } /*(W3Schools,2023)*/

        /* Add this style to center and add padding to the paragraph */
        .invitation-paragraph {
            text-align: center;
            padding: 20px;
        }

        /*(W3Schools,2023)*/

    </style>

</head>
<body>
<!--logo-->
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->
<!--Top navigation bar-->
<div class="topnav">
    <a href="index.php">Home</a>
    <a href="AboutUs.php">About Us</a>
    <a href="ExtraMurals.php">Extra Murals</a>
    <a href="Application.php">Application</a>
    <a href="Gallery.php">Gallery</a>
    <a href="Tour.php">Schedule Tour</a>
    <a href="ContactUs.php">Contact Us</a><!--(W3Schools,2023)-->
    <div class="dropdown">
        <button class="dropbtn">
            <i class="fa fa-fw fa-user" style="color: black"></i>
        </button><!--(W3Schools,2023)-->
        <div class="dropdown-content">
            <a href="Parent.php">Parent</a>
            <a href="Admin.php">Admin</a>
        </div><!--(W3Schools,2023)-->
    </div>
    <a href="javascript:void(0);" class="icon" onclick="toggleNav()">&#9776;</a><!--(W3Schools,2023)-->
</div>
<h1 style="color: black;"><u><b>SCHEDULE TOUR</b></u></h1><!--(W3Schools,2023)-->
<br><br>
<p class="invitation-paragraph"><b>Welcome to Just Love, Learn, and Play's Tour Page!</b><br>

    We are delighted to invite you to experience our learning environment firsthand.
    Scheduling a tour provides you with the opportunity to <br> explore our facilities, meet our dedicated
    staff, and witness the engaging activities that make our center unique. During the tour, you'll<br> gain
    valuable insights into our curriculum, facilities, and the warm atmosphere we cultivate for your child's
    growth and development.</p>
<form action="Tour.php" method="post" class="form" id="forms">
    <!--Start of the form with an action attribute pointing to "Tour.php" and using the POST method. -->
    <!--The class "form" and the ID "forms" are assigned for styling or JavaScript reference. -->

    <div class="group-inputs">
        <!-- Start of a div container for a group of input fields. -->
        <label for="email">Email</label>
        <!-- Label for the email input field. The "for" attribute links to the input field's ID. -->
        <input type="email" name="email" id="email" required/>
        <!-- Email input field with the "email" type, name "email," and the ID "email." The "required" attribute makes it mandatory. -->
        <p id="email-error-message" style="color: red;"></p>
        <!-- Display error message for invalid email -->
    </div><!--(W3Schools,2023)-->
    <br>

    <div class="group-inputs">
        <!--Start of a div container for another group of input fields. -->
        <label for="name">Name</label>
        <!--Label for the name input field. The "for" attribute links to the input field's ID. -->
        <input type="text" name="name" id="name" required/>
        <!--Text input field for a name with the "text" type, name "name," and the ID "name." The "required" attribute makes it mandatory. -->
    </div><!--(W3Schools,2023)-->
    <br>

    <div class="group-inputs">
        <!--Start of a div container for another group of input fields. -->
        <label for="date">Date to have a scheduled tour</label>
        <!--Label for the date input field. The "for" attribute links to the input field's ID. -->
        <input type="Date" name="date" id="date" required/>
        <!--Date input field for selecting a tour date with the "Date" type, name "date," and the ID "date." The "required" attribute makes it mandatory. -->
    </div><!--(W3Schools,2023)-->
    <br>

    <div class="group-inputs">
        <!--Start of a div container for another group of input fields. -->
        <label for="time">Preferred time of scheduled tour</label>
        <!--Label for the time input field. The "for" attribute links to the input field's ID. -->
        <input type="Time" name="time" id="time" required/>
        <!--Time input field for selecting a preferred tour time with the "Time" type, name "time," and the ID "time." The "required" attribute makes it mandatory. -->
    </div><!--(W3Schools,2023)-->
    <br>

    <div>
        <br>
        <!--Start of a div container for additional content, including a line break. -->
        <input type="submit" value="Schedule Tour" id="submit-form" class="btn"/>
        <!--Submit button with the text "Schedule Tour," the ID "submit-form," and the class "btn" for styling. -->
        <br>
    </div><!--(W3Schools,2023)-->

</form>
<!--footer-->
<footer>
    <p style="text-align: center">44 Fourth Avenue, Newton Park, Port Elizabeth</p>
    <p style="text-align: center"><a href="tel:0413654013" style="color: black">0413654013</a></p>
    <div class="center">
        <div class="row">
            <div class="column">
                <a href="https://www.facebook.com/JustLoveLearnandPlay" target="blank"><img src="Images/Facebook.png"
                                                                                            alt="Facebook logo"
                                                                                            style="width:20%; border:none;"></a>
            </div><!--(W3Schools,2023)-->
            <div class="column">
                <a href="mailto:jlplayandcentre@gmail.com" target="blank"><img src="Images/Email.png" alt="Email logo"
                                                                               style="width:20%; border:none;"></a>
            </div><!--(W3Schools,2023)-->
            <div class="column">
                <a href="tel:0720186560" target="blank"><img src="Images/Whatsapp.png" alt="Whatsapp logo"
                                                             style="width:20%; border:none;"></a>
            </div><!--(W3Schools,2023)-->
        </div>
    </div>
    <br>
    <p style="text-align: center">@2023 RNK. All rights reserved.</p>
</footer>
<script>
    //Function to toggle the navigation menu for smaller screens
    function toggleNav() {
        var nav = document.getElementsByClassName("topnav")[0];
        if (nav.className === "topnav") {
            nav.className += " responsive";
        } else {
            nav.className = "topnav";
        }
    }//(W3Schools,2023)

    //Showcasing active link based on the current page
    document.addEventListener("DOMContentLoaded", function () {
        //Get the name of the current page from the URL
        const currentPage = window.location.pathname.split('/').pop().split('.php')[0];
        //Get all navigation links
        const navLinks = document.querySelectorAll(".topnav a");

        //Loop through navigation links to find and mark the active link
        for (const link of navLinks) {
            if (link.getAttribute("href") === currentPage + ".php") {
                link.classList.add("active");
            }
        }
    });//(W3Schools,2023)

    //Adding an event listener to the form submission button
    document.getElementById("submit-form").addEventListener("click", function () {
        validateAnd
        submitForm(); // Call the form validation and submission function
    });//(W3Schools,2023)

    //Adding event listeners to required input fields
    const requiredInputs = document.querySelectorAll("input[required], textarea[required]");//(W3Schools,2023)

    //Loop through each required input field and add event listeners for "input" and "blur" events
    requiredInputs.forEach((input) => {
        //Event listener for "input" event: Remove custom validity and error class when the user types in the field
        input.addEventListener("input", function () {
            this.setCustomValidity(""); //Remove custom validity message
            this.classList.remove("error"); //Remove error class
        });//(W3Schools,2023)

        //Event listener for "blur" event: Check if the field is empty and show a custom error message if needed
        input.addEventListener("blur", function () {
            if (!this.value.trim()) {
                this.setCustomValidity("Please fill in this field.");
                this.classList.add("error"); //Add error class to highlight the field
            }
        });//(W3Schools,2023)
    });

    // Function to validate and submit the form
    function validateAndSubmitForm() {
        const inputs = document.querySelectorAll("input[required], textarea[required]");
        let isValid = true;

        //Loop through each required input field to check if it's empty or not
        inputs.forEach((input) => {
            if (!input.value.trim()) {
                input.setCustomValidity("Please fill in this field.");
                input.classList.add("error"); //Add error class to highlight the field
                isValid = false; //Mark the form as invalid
            } else {
                input.setCustomValidity(""); //Remove custom validity message
                input.classList.remove("error"); //Remove error class
            }
        });//(W3Schools,2023)

        //Check if the form is valid or not
        if (!isValid) {
            showErrorMessage("Please fill in all required fields before proceeding.");
        } else {
            submitForm(); //If the form is valid, submit it
        }//(W3Schools,2023)
    }

    //Function to show a dynamically created error message
    function showErrorMessage(message) {
        const errorMessage = document.createElement("div");
        errorMessage.classList.add("error-message");
        errorMessage.textContent = message;
        document.body.appendChild(errorMessage);

        //Remove the error message after 3 seconds
        setTimeout(() => {
            errorMessage.remove();
        }, 3000);
    }//(W3Schools,2023)

    //Function to handle form submission
    function submitForm() {
        //Marking all progress steps as completed (if needed)
        const progressSteps = document.querySelectorAll(".progress-step");
        progressSteps.forEach((progressStep, idx) => {
            progressStep.classList.add("progress-step-check");
        });
        //Optional: Scroll to the top of the page after submitting the form
        window.scrollTo(0, 0);
    }//(W3Schools,2023)

    document.getElementById('email').addEventListener('input', function () {
        var emailInput = this;
        var errorElement = document.getElementById('email-error-message');

        if (emailInput.validity.valid) {
            errorElement.textContent = '';
        } else {
            errorElement.textContent = 'Enter a valid email address.';
        }
    });//(W3Schools,2023)
</script>
</body>
</html>