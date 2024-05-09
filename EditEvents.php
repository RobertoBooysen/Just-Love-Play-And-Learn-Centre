<?php
//(Gosselin, Kokoska and Easterbrooks,2011)
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    // Redirect to the AdminLogin.php page if not authenticated
    header("Location: AdminLogin.php");
    exit();
}

//Function to handle image upload and return the relative image path
//(Gosselin, Kokoska and Easterbrooks,2011)
function handleImageUpload()
{
    $uploadDirectory = 'Uploads/'; //Specifying the upload directory
    $uniqueFilename = uniqid() . '_' . $_FILES['newEventImage']['name'];
    $targetFile = $uploadDirectory . $uniqueFilename;

    //Move the uploaded file to the specified directory
    if (move_uploaded_file($_FILES['newEventImage']['tmp_name'], $targetFile)) {
        return $targetFile; //Returning the relative image path
    } else {
        return false;
    }
}
//(Gosselin, Kokoska and Easterbrooks,2011)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Handle form submission for editing an event
    $event_id_to_edit = $_POST['event_id_to_edit'];
    $newEventName = $_POST['event_name_to_edit'];
    $newEventDate = $_POST['newEventDate'];
    $newEventDescription = $_POST['newEventDescription'];

    //Check if a new image file has been uploaded
    $newEventImageFile = handleImageUpload();

    //Prepare a SQL statement to update the event by event_id
    if (!empty($newEventImageFile)) {
        //If a new image is uploaded, update the image along with other fields
        $sql = "UPDATE events SET event_name = ?, event_date = ?, event_description = ?, events_file = ? WHERE event_id = ?";
        $bindParams = "ssssi";
    } else {
        //If no new image is uploaded, update only the non-image fields
        $sql = "UPDATE events SET event_name = ?, event_date = ?, event_description = ? WHERE event_id = ?";
        $bindParams = "sssi";
    }

    if ($stmt = mysqli_prepare($conn, $sql)) {
        //Bind parameters based on whether a new image is uploaded or not
        //(Gosselin, Kokoska and Easterbrooks,2011)
        if (!empty($newEventImageFile)) {
            mysqli_stmt_bind_param($stmt, $bindParams, $newEventName, $newEventDate, $newEventDescription, $newEventImageFile, $event_id_to_edit);
        } else {
            mysqli_stmt_bind_param($stmt, $bindParams, $newEventName, $newEventDate, $newEventDescription, $event_id_to_edit);
        }

        if (mysqli_stmt_execute($stmt)) {
            //Redirect back to the event list page after editing
            //(Gosselin, Kokoska and Easterbrooks,2011)
            header("Location: EventsTable.php");
            exit();
        } else {
            //Update failed
            echo "Event update failed.";
        }

        //Close the prepared statement
        mysqli_stmt_close($stmt);
    }

    //Close the database connection
    //(Gosselin, Kokoska and Easterbrooks,2011)
    mysqli_close($conn);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['event_id'])) {
    //Display the edit form for the event
    $event_id_to_edit = $_GET['event_id'];

    //Prepare a SQL statement to fetch the event by event_id
    $sql = "SELECT * FROM events WHERE event_id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $event_id_to_edit);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if ($eventData = mysqli_fetch_assoc($result)) {
                ?>
                <?php
            } else {
                // Event not found or missing data
                echo "Event not found or missing data.";
            }
        }

        //Close the prepared statement
        mysqli_stmt_close($stmt);
    }

    //Close the database connection
    //(Gosselin, Kokoska and Easterbrooks,2011)
    mysqli_close($conn);
} else {
    //Invalid request
    header("Location: EventsTable.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Set the viewport for responsive design -->
    <!--(W3Schools,2023-->
    <link rel="stylesheet" href="CSS/admin.css"> <!-- Include a custom admin.css stylesheet -->
    <title>Edit Events</title>
</head>
<style>
    /* Define CSS custom properties */
    /*(W3Schools,2023)*/
    :root {
        --primary-color: rgb(11, 78, 179);
    }

    /* Apply box-sizing to all elements */
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    /* Style for form labels */
    /*(W3Schools,2023)*/
    label {
        display: block;
        margin-bottom: 0.5rem;
    }

    /* Style for form input elements */
    input {
        display: block;
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        height: 50px;
    }

    /* CSS class for setting width to 50% */
    /*(W3Schools,2023)*/
    .width-50 {
        width: 50%;
    }

    /* CSS class for setting margin-left to auto */
    .ml-auto {
        margin-left: auto;
    }

    /* Style for form container with responsive width */
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

    /* Style for buttons */
    /*(W3Schools,2023)*/
    .btn {
        padding: 0.75rem;
        display: block;
        text-decoration: none;
        background-color: #77d4e3;
        color: black;
        text-align: center;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: 0.3s;
    }

    /* Hover effect for buttons */
    .btn:hover {
        box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2;
    }

    /* Style for error messages */
    /*(W3Schools,2023)*/
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
    }

    /*Styles for the exit button */
    /*(W3Schools,2023)*/
    .exit-button {
        position: fixed;
        top: 20px;
        left: 20px;
        background-color: #d03c2f;
        color: #ffffff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .exit-button:hover {
        background-color: #41c4d8;
        color: black;
    }
</style>
<body>
<!--(W3Schools,2023)-->
<!--exit button that returns the user to the Events Table-->
<button class="exit-button" onclick="exitPage()">Exit</button>
<br>

<h1>Edit Event</h1>
<form method="post" action="EditEvents.php" class="form" enctype="multipart/form-data">
    <!-- Include hidden input field for event_id -->
    <!--(W3Schools,2023)-->
    <input type="hidden" name="event_id_to_edit" value="<?php echo $event_id_to_edit; ?>">

    <!-- New input field for event name -->
    <!--(W3Schools,2023)-->
    <label for="event_name_to_edit">Event Name:</label>
    <input type="text" name="event_name_to_edit" id="event_name_to_edit" value="<?php echo $eventData['event_name']; ?>">
    <br>

    <!-- Displaying events information on edit form -->
    <!--(W3Schools,2023)-->
    <label for="newEventDate">New Event Date:</label>
    <input type="text" name="newEventDate" id="newEventDate"
           value="<?php echo $eventData['event_date']; ?>">
    <br>

    <!-- New input field for event description -->
    <label for="newEventDescription">New Event Description:</label>
    <input type="text" name="newEventDescription" id="newEventDescription"
           value="<?php echo $eventData['event_description']; ?>">
    <br>

    <!--Display the existing image -->
    <!--(W3Schools,2023)-->
    <label>Existing Image:</label>
    <img src="<?php echo $eventData['events_file']; ?>" alt="Existing Image" style="max-width: 100%; height: auto; margin-bottom: 10px;">
    <br>

    <label for="newEventImage">New Image File:</label>
    <input type="file" name="newEventImage" id="newEventImage" accept=".png, .jpg, .jpeg">
    <p id="file-error-message" style="color: red;"></p>
    <br>

    <input type="submit" value="Save" class="btn">
</form>
</body>
<script>
    //(W3schools,2023)
    // Function to validate the form before submission
    function validateForm() {
        // Get the file input and error message elements
        var fileInput = document.getElementById('newEventImage');
        var errorMessage = document.getElementById('file-error-message');

        // Array of allowed image formats
        var allowedFormats = ['image/png', 'image/jpeg', 'image/jpg'];

        // Check if a file has been selected
        if (fileInput.files.length > 0) {
            // Get the type of the selected file and convert it to lowercase
            var fileType = fileInput.files[0].type.toLowerCase();

            // Check if the file type is among the allowed formats
            if (!allowedFormats.includes(fileType)) {
                // Display an error message for invalid file format
                errorMessage.textContent = 'Invalid file format. Please select a PNG, JPEG, or JPG file.';
                return false;
            } else {
                // Clear the error message if the file format is valid
                errorMessage.textContent = '';
            }
        } else {
            // Display an error message if no file is selected
            errorMessage.textContent = 'Please select an image file.';
            return false;
        }

        // Return true if all validations pass
        return true;
    }

    // Function to navigate away from the current page
    function exitPage() {
        // Redirect to the specified page (EventsTable.php)
        window.location.href = "EventsTable.php";
    }

</script>
</html>