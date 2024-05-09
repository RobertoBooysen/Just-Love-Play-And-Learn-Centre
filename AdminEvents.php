<?php
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    //Redirect to the AdminLogin.php page if not authenticated(Gosselin, Kokoska and Easterbrooks,2011)
    header("Location: AdminLogin.php");
    exit();
}

//Function to check if id exists(Gosselin, Kokoska and Easterbrooks,2011)
function isIDExists($conn, $eid)
{
    //Ensure that $eid is properly escaped and enclosed in single quotes in the SQL query(Gosselin, Kokoska and Easterbrooks,2011)
    $escapedEID = $conn->real_escape_string($eid);

    //SQL query to check if the event_id exists in the Events table(Gosselin, Kokoska and Easterbrooks,2011)
    $sql = "SELECT * FROM events WHERE event_id = '$escapedEID'";
    $result = $conn->query($sql);

    return $result->num_rows > 0;
}


//Function to insert an event into the SQL database(Gosselin, Kokoska and Easterbrooks,2011)
function insertEvent($conn, $data)
{
    $event_name = $data['event_name'];
    $event_description = $data['event_description'];
    $events_file = $data['events_file'];
    $event_date = $data['event_date'];

    //SQL query to insert event data into the Events table(Gosselin, Kokoska and Easterbrooks,2011)
    $sql = "INSERT INTO events (event_name, event_description, events_file, event_date) 
            VALUES ('$event_name', '$event_description', '$events_file', '$event_date')";

    if ($conn->query($sql) === TRUE) {
        return true;//Return true if the event data is successfully inserted(Gosselin, Kokoska and Easterbrooks,2011)
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

//Function to generate a unique event ID(Gosselin, Kokoska and Easterbrooks,2011)
function generateUniqueID()
{
    return uniqid();
}

//Check if the form was submitted via POST(Gosselin, Kokoska and Easterbrooks,2011)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Generate a unique event ID
    $eid = generateUniqueID(); //This function generates a unique ID for the event(Gosselin, Kokoska and Easterbrooks,2011)

    //Handle image upload and get the relative Events path(Gosselin, Kokoska and Easterbrooks,2011)
    $eventPath = handleEventsUpload(); //This function handles image upload and returns the relative path to the uploaded image(Gosselin, Kokoska and Easterbrooks,2011)

    if (!$eventPath) {
        echo "<script>alert('Failed to upload the image. Please try again.')</script>"; //Display an alert if image upload fails(Gosselin, Kokoska and Easterbrooks,2011)
    } else {
        $data = array(
            'event_name' => $_POST['event_name'],
            'event_description' => $_POST['event_description'],
            'events_file' => $eventPath,
            'event_date' => $_POST['event_date']
        );

        //Check if the event ID already exists(Gosselin, Kokoska and Easterbrooks,2011)
        if (isIDExists($conn, $eid)) {
            echo "<script>alert('Failed to add images. Event ID already exists.')</script>"; //Display an alert if the event ID already exists(Gosselin, Kokoska and Easterbrooks,2011)
        } else {
            //Insert the event data into the SQL database(Gosselin, Kokoska and Easterbrooks,2011)
            $result = insertEvent($conn, $data);

            if ($result === true) {
                //Store the entered data in a session variable for reference(Gosselin, Kokoska and Easterbrooks,2011)
                $_SESSION['event_data'] = $data;

                //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
                $_SESSION['success_message8'] = 'Successfully approved tour.';

                header("Location: AdminHome.php"); //Redirect to AdminHome.php(Gosselin, Kokoska and Easterbrooks,2011)
                exit();
            } else {
                echo "Failed to add images. Error: " . $result; //Display an error message if event addition fails(Gosselin, Kokoska and Easterbrooks,2011)
            }
        }
    }
}


// Function to handle event upload and return the relative event path(Gosselin, Kokoska and Easterbrooks,2011)
function handleEventsUpload()
{
    if (
        isset($_FILES['events_file']) &&
        $_FILES['events_file']['error'] === UPLOAD_ERR_OK
    ) {
        $allowedFormats = ['image/png', 'image/jpeg', 'image/jpg'];

        $fileType = $_FILES['events_file']['type'];

        // Check if the uploaded file is of an allowed image format(Gosselin, Kokoska and Easterbrooks,2011)
        if (in_array($fileType, $allowedFormats)) {
            $uploadDirectory = 'Uploads/';
            $uniqueFilename =
                uniqid() . '_' . $_FILES['events_file']['name'];
            $targetFile = $uploadDirectory . $uniqueFilename;

            // Move the uploaded file to the target directory(Gosselin, Kokoska and Easterbrooks,2011)
            if (move_uploaded_file(
                $_FILES['events_file']['tmp_name'],
                $targetFile
            )) {
                return $targetFile;
            }
        }
    }
    return false;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Set the viewport for responsive design(W3Schools,2023) -->
    <link rel="stylesheet" href="CSS/admin.css"> <!--Include a custom admin.css stylesheet(W3Schools,2023) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <title>Admin Events</title>
    <!--Include Font Awesome icons(W3Schools,2023) -->
</head>
<style>
    :root {
        --primary-color: rgb(11, 78, 179); /*Define a CSS custom property for primary color(W3Schools,2023) */
    }

    *, *::before, *::after {
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

    .form {
        max-width: 1000px;
        margin: 0 auto;
        border: none;
        border-radius: 10px !important;
        overflow: hidden;
        padding: 1.5rem;
        background-color: #fff;
        padding: 20px 30px; /*Style for the form container(W3Schools,2023) */
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
        transition: 0.3s; /*Style for buttons(W3Schools,2023) */
    }

    .btn:hover {
        box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2; /*Style for button hover effect(W3Schools,2023) */
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
        z-index: 9999; /*Style for error message display(W3Schools,2023) */
    }
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

<h1><u><b>ADMIN EVENTS</b></u></h1> <!--Heading for Admin Events (W3Schools,2023)-->
<br><br>

<!--Form to add events(W3Schools,2023)-->
<form action="AdminEvents.php" method="post" class="form" id="forms" enctype="multipart/form-data">
    <br>
    <div class="group-inputs">
        <label for="event_name">Name Of Event</label> <!--Label and input for Event Name(W3Schools,2023) -->
        <input type="text" name="event_name" id="event_name" required/>
    </div>
    <br>
    <div class="group-inputs">
        <label for="event_description">Description Of Event</label>
        <!--Label and input for Event Description(W3Schools,2023) -->
        <input type="text" name="event_description" id="event_description" required/>
    </div>
    <br>
    <div class="group-inputs">
        <label for="event_date">Date Of Event</label> <!--Label and input for Event Date(W3Schools,2023) -->
        <input type="date" id="event_date" name="event_date" required>
    </div>
    <br>
    <div>
        <input type="file" id="events_file" name="events_file" accept=".png, .jpg, .jpeg" required>
        <!--Add the "accept" attribute to specify allowed file formats(W3Schools,2023) -->
        <br>
        <input type="submit" value="Add Event" id="submit-form" class="btn"/>
        <!--Submit button for adding an event(W3Schools,2023) -->
        <br>
    </div>
</form>

<footer>
    <p style="text-align: center">44 Fourth Avenue, Newton Park, Port Elizabeth</p>
    <p style="text-align: center"><a href="tel:0413654013" style="color: black">0413654013</a></p>
    <div class="center">
        <div class="row"> <!--(W3Schools,2023)-->
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
    function toggleNav() {
        var nav = document.getElementsByClassName("topnav")[0];
        if (nav.className === "topnav") {
            nav.className += " responsive";
        } else {
            nav.className = "topnav";
        }
    }

    //Showcasing active link(W3Schools,2023)
    document.addEventListener("DOMContentLoaded", function () {
        const currentPage = window.location.pathname.split('/').pop().split('.php')[0];
        const navLinks = document.querySelectorAll(".topnav a");

        for (const link of navLinks) {
            if (link.getAttribute("href") === currentPage + ".php") {
                link.classList.add("active");
            }
        }
    });

    //Adding event listener to the form submission(W3Schools,2023)
    document.getElementById("submit-form").addEventListener("click", function () {
        validateAndSubmitForm();
    });

    //Adding event listeners to required input fields(W3Schools,2023)
    const requiredInputs = document.querySelectorAll("input[required], textarea[required]");

    //Looping through each required input field and add event listeners for "input" and "blur" events(W3Schools,2023)
    requiredInputs.forEach((input) => {
        //Event listener for "input" event: When the user types in the field, remove custom validity and error class(W3Schools,2023)
        input.addEventListener("input", function () {
            this.setCustomValidity("");
            this.classList.remove("error");
        });

        //Event listener for "blur" event: When the field loses focus, check if it's empty and show custom error message if needed(W3Schools,2023)
        input.addEventListener("blur", function () {
            if (!this.value.trim()) {
                this.setCustomValidity("Please fill in this field.");
                this.classList.add("error");
            }
        });
    });

    //Function to validate and submit the form(W3Schools,2023)
    function validateAndSubmitForm() {
        const inputs = document.querySelectorAll("input[required], textarea[required]");
        let isValid = true;

        //Looping through each required input field to check if it's empty or not(W3Schools,2023)
        inputs.forEach((input) => {
            if (!input.value.trim()) {
                //If the field is empty, add custom validity and error class to show the custom error message(W3Schools,2023)
                input.setCustomValidity("Please fill in this field.");
                input.classList.add("error");
                isValid = false; // Mark the form as invalid(W3Schools,2023)
            } else {
                //If the field is not empty, remove custom validity and error class(W3Schools,2023)
                input.setCustomValidity("");
                input.classList.remove("error");
            }
        });

        //Checking if the form is valid or not(W3Schools,2023)
        if (!isValid) {
            showErrorMessage("Please fill in all required fields before proceeding.");
        } else {
            submitForm(); //If the form is valid, submit it(W3Schools,2023)
        }
    }

    //Function to show an error message dynamically(W3Schools,2023)
    function showErrorMessage(message) {
        const errorMessage = document.createElement("div");
        errorMessage.classList.add("error-message");
        errorMessage.textContent = message;
        document.body.appendChild(errorMessage);

        //Removing the error message after 3 seconds(W3Schools,2023)
        setTimeout(() => {
            errorMessage.remove();
        }, 3000);
    }

    //Function to handle form submission(W3Schools,2023)
    function submitForm() {
        //Marking all progress steps as completed (if needed)(W3Schools,2023)
        const progressSteps = document.querySelectorAll(".progress-step");
        progressSteps.forEach((progressStep, idx) => {
            progressStep.classList.add("progress-step-check");
        });
        //Optional: Scroll to the top of the page after submitting the form(W3Schools,2023)
        window.scrollTo(0, 0);
    }

    document.getElementById('events_file').addEventListener('change', function () {
        var fileInput = this;
        var errorMessage = document.getElementById('file-error-message');
        var allowedFormats = ['image/png', 'image/jpeg', 'image/jpg'];

        if (fileInput.files.length > 0) {
            var fileType = fileInput.files[0].type.toLowerCase(); //Convert to lowercase for case-insensitive comparison(W3Schools,2023)

            if (!allowedFormats.includes(fileType)) {
                errorMessage.textContent = 'Invalid file format. Please select a PNG, JPEG, or JPG file.';
                fileInput.value = ''; // Clear the file input
            } else {
                errorMessage.textContent = '';
            }
        }
    });
</script>

</body>
</html>