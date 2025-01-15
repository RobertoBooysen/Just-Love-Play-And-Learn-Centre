<?php
global $conn;
//(Gosselin, Kokoska and Easterbrooks,2011)

//Include PHPMailer classes for sending emails

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMAILER/src/Exception.php';
require 'PHPMAILER/src/PHPMailer.php';
require 'PHPMAILER/src/SMTP.php';
//(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)

//Function to send an email
function sendEmailToUser($to, $subject, $message)
{
    //Gmail SMTP server settings
    $smtpServer = "your_smtp_server"; // Replace with your actual SMTP server
    $smtpUsername = "your_email_address"; // Replace with your actual email address
    $smtpPassword = "your_email_password"; // Replace with your actual email password
    $smtpPort = 465;

    //Configure email
    $headers = "From: " . $smtpUsername;
    $mailSent = sendEmail($to, $subject, $message, $smtpServer, $smtpPort, $smtpUsername, $smtpPassword);

    if ($mailSent) {
        return true;
    } else {
        return false;
    }
}

//Function to send an email using PHPMailer
//(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
function sendEmail($to, $subject, $message, $smtpServer, $smtpPort, $smtpUsername, $smtpPassword)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = $smtpServer;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = $smtpPort;

        $mail->setFrom($smtpUsername);
        $mail->addAddress($to);
        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $message;

        //Use the CID (Content-ID) of the attached image in the image source(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
        $mail->addEmbeddedImage(__DIR__ . '/Images/Logo.png', 'Logo.png', 'Logo.png', 'base64', 'image/png');

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

//Include the database connection file.
//(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
require_once 'DBConn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission for editing tour information
    // Add debugging to check POST data
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $tourId = $_POST['tourId'];
    $newEmail = $_POST['newEmail'];
    $newName = $_POST['newName'];
    $newDate = $_POST['newDate'];
    $newTime = $_POST['newTime'];

    if ($conn === false) {
        die("Database connection error: " . mysqli_connect_error());
    }

    //Prepare a SQL statement to fetch the current tour data
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $sql = "SELECT email, name, date, time FROM tour WHERE tour_id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $tourId);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            $currentTourData = mysqli_fetch_assoc($result);

            if ($currentTourData) {
                //Check if date or time has changed
                //(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
                if ($newDate != $currentTourData['date'] || $newTime != $currentTourData['time']) {
                    // The date or time has changed, send an email
                    $emailSubject = "Changed Tour Time Slot for Just Love Play And Learn Center";
                    $emailMessage = "
        <html>
        <head></head>
        <body>
            <img src='cid:Logo.png' alt='Logo' style='max-width: 100%; height: auto;'><br>
            Your tour time slot has been changed due to unavailability. Please contact the day-care for any information or queries.<br><br>
            Scheduled Tour for: $newName<br>
            New Scheduled Date: $newDate<br>
            New Scheduled Time: $newTime<br><br>
            Thank you
        </body>
        </html>
    ";

                    $userEmail = $newEmail; // Use the updated email address

                    $emailSent = sendEmailToUser($userEmail, $emailSubject, $emailMessage);

                    if ($emailSent) {
                        //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
                        $_SESSION['success_message8'] = 'Tour details updated, and an email has been sent to the user.';
                    } else {
                        //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
                        $_SESSION['success_message9'] = 'Tour details updated, but the email sending failed.';
                    }
                } else {
                    //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
                    $_SESSION['success_message10'] = 'Tour details updated, but no email sent because the name or email has changed.';
                }
            } else {
                //Tour not found or missing data
                //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
                $_SESSION['success_message11'] = 'Tour not found or missing data.';
            }
        }
    }

    //Close the prepared statement
    //(Gosselin, Kokoska and Easterbrooks,2011)
    mysqli_stmt_close($stmt);

    //Update the tour information
    $sql = "UPDATE tour SET email = ?, name = ?, date = ?, time = ? WHERE tour_id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssss", $newEmail, $newName, $newDate, $newTime, $tourId);

        if (mysqli_stmt_execute($stmt)) {
            //Redirect back to the tour list page after editing
            header("Location: TourTable.php");
            exit();
        } else {
            // Update failed
            //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
            $_SESSION['success_message12'] = 'Tour update failed.';
        }

        //Close the prepared statement
        mysqli_stmt_close($stmt);
    }

    //Close the database connection
    mysqli_close($conn);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['tour_id'])) {
    //Display the edit form for the tour
    $tourId = $_GET['tour_id'];

    if ($conn === false) {
        die("Database connection error: " . mysqli_connect_error());
    }

    //Prepare a SQL statement to fetch the tour by ID
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $sql = "SELECT * FROM tour WHERE tour_id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $tourId);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if ($tourData = mysqli_fetch_assoc($result)) {

                ?>

                <!DOCTYPE html>
                <html>
                <head>
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <!-- Set the viewport for responsive design -->
                    <!--(W3Schools,2023-->
                    <link rel="stylesheet" href="CSS/admin.css"><!-- Include a custom admin.css stylesheet -->
                    <title>Edit Tour</title>
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
                    label {
                        display: block;
                        margin-bottom: 0.5rem;
                    }

                    /* Style for form input elements */
                    /*(W3Schools,2023)*/
                    input {
                        display: block;
                        width: 100%;
                        padding: 0.75rem;
                        border: 1px solid #ccc;
                        border-radius: 0.25rem;
                        height: 50px;
                    }

                    /* CSS class for setting width to 50% */
                    .width-50 {
                        width: 50%;
                    }

                    /* CSS class for setting margin-left to auto */
                    .ml-auto {
                        margin-left: auto;
                    }

                    /* Style for form container with responsive width */
                    /*(W3Schools,2023)*/
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

                    /*(W3Schools,2023)*/
                    .exit-button:hover {
                        background-color: #41c4d8;
                        color: black;
                    }
                </style>
                <body>
                <!--(W3Schools,2023)-->
                <!--exit button that returns the user to TourTable-->
                <button class="exit-button" onclick="exitPage()">Exit</button>
                <br>


                <h1 style="text-align: center">Edit Tour</h1>

                <form method="post" action="EditTour.php" class="form">
                    <!-- Display tour information on the edit form -->
                    <!--(W3Schools,2023)-->
                    <input type="hidden" name="tourId" value="<?php echo $tourId; ?>">
                    <label for="newEmail">Email:</label>
                    <input type="text" name="newEmail" id="newEmail" value="<?php echo $tourData['email']; ?>">
                    <br>
                    <label for="newName">Name:</label>
                    <input type="text" name="newName" id="newName" value="<?php echo $tourData['name']; ?>">
                    <br>
                    <label for="newDate">Date:</label>
                    <input type="text" name="newDate" id="newDate" value="<?php echo $tourData['date']; ?>">
                    <br>
                    <label for="newTime">Time:</label>
                    <input type="text" name="newTime" id="newTime" value="<?php echo $tourData['time']; ?>">
                    <br>
                    <input type="submit" value="Save" class="btn">
                </form>

                </body>
                <script>
                    //(W3Schools,2023)
                    function exitPage() {
                        window.location.href = "TourTable.php";
                    }
                </script>
                </html>

                <?php
            } else {
                // Tour not found or missing data
                //(Gosselin, Kokoska and Easterbrooks,2011)
                echo "Tour not found or missing data.";
            }
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    }

    // Close the database connection
    //(Gosselin, Kokoska and Easterbrooks,2011)
    mysqli_close($conn);
} else {
    // Invalid request
    //(Gosselin, Kokoska and Easterbrooks,2011)
    header("Location: TourTable.php");
    exit();
}
?>