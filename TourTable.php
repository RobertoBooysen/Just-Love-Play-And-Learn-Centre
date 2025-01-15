<?php
global $conn;
require_once 'DBConn.php';

use PHPMailer\PHPMailer\PHPMailer;

// Import PHPMailer library for sending emails(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
use PHPMailer\PHPMailer\Exception;

//Import Exception class from PHPMailer library(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
require 'PHPMAILER/src/Exception.php'; //Require PHPMailer's Exception class(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
require 'PHPMAILER/src/PHPMailer.php'; //Require PHPMailer's PHPMailer class(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
require 'PHPMAILER/src/SMTP.php'; //Require PHPMailer's SMTP class(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
//(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)

//Check if the user is authenticated
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    //Redirect to the AdminLogin.php page if not authenticated
    header("Location: AdminLogin.php");
    exit();
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message7'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message7'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message7']);
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message8'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message8'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message8']);
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message9'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message9'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message9']);
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message10'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message10'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message10']);
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message11'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message11'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message11']);
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message12'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message12'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message12']);
}

//Function to get all pending tour requests from the SQL database
function getAllPendingTourRequests($conn)
{
    $sql = "SELECT * FROM tour ";
    $result = $conn->query($sql);

    $pendingTourRequests = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pendingTourRequests[] = $row;
        }
    }

    return $pendingTourRequests;
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to update the status of the tour request to 'approved'
function updateTourStatus($conn, $tourId)
{
    $sql = "UPDATE tour SET status = 'approved' WHERE tour_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $tourId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to update the status of the tour request to 'declined'
function declineTourRequest($conn, $tourId)
{
    $sql = "UPDATE tour SET status = 'declined' WHERE tour_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $tourId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to remove a tour request from the 'Tour' table
function removeTourRequest($conn, $tourId)
{
    $sql = "DELETE FROM Tour WHERE tour_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $tourId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to send approval email to the requester(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
function sendApprovalEmail($tourData)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'your_mail_host'; // Replace with your actual mail host

        // Configure your SMTP settings here (see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP, 2021)
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email_address'; // Email address (see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP, 2021)
        $mail->Password = 'your_email_password'; // Email password (GENERATED APP PASSWORD) (see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP, 2021)
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        
        $mail->setFrom('your_email_address'); // Replace with the email address you want to send from        

        $requesterEmail = $tourData['email'];

        if (!empty($requesterEmail)) {
            $mail->addAddress($requesterEmail);
            $mail->Subject = 'Tour Request Approval';

            //Get the date and time from the database
            $tourDate = $tourData['date'];
            $tourTime = $tourData['time'];

            $mail->isHTML(true);

            //Set the HTML body with the logo included(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
            $mail->Body = "
        <html>
        <head></head>
        <body>
            <img src='cid:Logo.png' alt='Logo' style='max-width: 100%; height: auto;'><br>
            <p>Dear Visitor,<br><br>Your tour request has been <strong>approved</strong>.
            <b> Contact us for further information.</b><br> 
            <br>
            <u>Tour Details</u><br>
            Date: $tourDate<br>
            Time: $tourTime<br><br>
            Thank you.
            </p>
        </body>
        </html>
    ";

            //Use the CID (Content-ID) of the attached image in the image source(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
            $mail->addEmbeddedImage(__DIR__ . '/Images/Logo.png', 'Logo.png', 'Logo.png', 'base64', 'image/png');

            $mail->send();
        } else {
            echo "Error: Requester does not have an email address.";
        }
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}//(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)

//Checking database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Get all pending tour requests using the defined function
$pendingTourRequests = getAllPendingTourRequests($conn);//(Gosselin, Kokoska and Easterbrooks,2011)

//Checking if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Checking if the 'approve' button was clicked
    if (isset($_POST['approve'])) {
        $tourId = $_POST['tour_id'];
        //Checking if the tour request with the given ID exists in pending requests
        if ($tourId && in_array($tourId, array_column($pendingTourRequests, 'tour_id'))) {
            //Update the status of the selected tour request to 'approved'
            $result = updateTourStatus($conn, $tourId);
            if ($result) {
                //Send approval email to the requester
                sendApprovalEmail($pendingTourRequests[array_search($tourId, array_column($pendingTourRequests, 'tour_id'))]);

                //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
                $_SESSION['success_message7'] = 'Successfully approved tour.';

                //Redirect to refresh the page after approving
                header("Location: TourTable.php");
            } else {
                //Display an error message if the update fails
                //echo "Failed to update status.";
            }
        } else {
            //Display an error message if the ID or request is not found
            echo "Invalid ID or request not found.";
        }//(Gosselin, Kokoska and Easterbrooks,2011)
    } elseif (isset($_POST['decline'])) {
        //Handle the case when the 'decline' button was clicked
        $tourId = $_POST['tour_id'];
        //Checking if the tour request with the given ID exists in pending requests
        if ($tourId && in_array($tourId, array_column($pendingTourRequests, 'tour_id'))) {
            //Update the status of the selected tour request to 'declined'
            $result = declineTourRequest($conn, $tourId);
            if ($result) {
                //Remove the tour request from the 'Tour' table
                removeTourRequest($conn, $tourId);
                //Display a message indicating that the tour request was declined
                //echo "Tour request declined.";
                header("Location: TourTable.php");
            } else {
                //Display an error message if the update fails
                //echo "Failed to decline tour request.";
            }
        } else {
            //Display an error message if the ID or request is not found
            //echo "Invalid ID or request not found.";
        }
    }//(Gosselin, Kokoska and Easterbrooks,2011)
}

//Close the database connection at the end of your script
$conn->close();//(Gosselin, Kokoska and Easterbrooks,2011)
?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/admin.css">
    <title>Tour Table</title>
</head>
<style>
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

    /*styling table*/
    .btn {
        padding: 5px 12px;
        font-size: 15px;
        color: black;
        background: #77d4e3;
        border: none;
        border-radius: 5px;
        margin-left: 10px;
        width:100px;
    }

    /*(W3Schools,2023)*/

    /* Styling for the approve button */
    .approve-button {
        padding: 5px 12px;
        font-size: 15px;
        color: black;
        background: #77d4e3;
        border: none;
        border-radius: 5px;
        margin-left: 10px;
    }

    /* Styling for the delete button */
    .delete-button {
        padding: 5px 12px;
        font-size: 15px;
        color: black;
        background: #d03c2f;
        border: none;
        border-radius: 5px;
        margin-left: 10px; /* Adjust margin for spacing between buttons */
    }

    /*(W3Schools,2023)*/

    /* Styles for the exit button */
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

    /*styling exit button hover*/
    .exit-button:hover {
        background-color: #41c4d8;
        color: black;
    }

    /*(W3Schools,2023)*/

    /*styling button group*/
    .button-group {
        display: flex; /*Use flexbox for horizontal layout */
        align-items: center; /*Center items vertically */
    }

    /*(W3Schools,2023)*/
</style>
<body>
<button class="exit-button" onclick="exitPage()">Exit</button>
<br><br>
<!--Main heading-->
<h1>Tour Requests</h1>

<div style="overflow-x:auto;">
    <?php if (empty($pendingTourRequests)): ?>
        <!--Displaying a message when there are no pending tour requests -->
        <p>No pending tour requests.</p>
    <?php else: ?>
        <!--If there are pending tour requests, display them in a table -->
        <table>
            <thead>
            <tr>
                <th style="width: 20%">Date</th> <!--Displaying date column -->
                <th style="width: 20%">Email</th> <!--Displaying email column -->
                <th style="width: 20%">Name</th> <!--Displaying name column -->
                <th style="width: 20%">Time</th> <!--Displaying time column -->
                <th style="width: 20%">Action</th>
            </tr><!--(W3Schools,2023)-->
            </thead>
            <tbody>
            <?php foreach ($pendingTourRequests

            as $tour): ?><!--(Gosselin, Kokoska and Easterbrooks,2011)-->
            <!--Loop through each pending tour request and display its details -->
            <tr>
                <td><?php echo $tour['date']; ?></td> <!--Display the date of the tour request -->
                <!--(Gosselin, Kokoska and Easterbrooks,2011)-->
                <td><?php echo $tour['email']; ?></td> <!--Display the email of the requester -->
                <!--(Gosselin, Kokoska and Easterbrooks,2011)-->
                <td><?php echo $tour['name']; ?></td> <!--Display the name of the requester -->
                <!--(Gosselin, Kokoska and Easterbrooks,2011)-->
                <td><?php echo $tour['time']; ?></td> <!--Display the preferred time of the tour -->
                <!--(Gosselin, Kokoska and Easterbrooks,2011)-->
                <td><!--(W3Schools,2023)-->

                    <div class="button-group">
                        <!-- Create a form for submitting actions -->
                        <form method="post">
                            <!-- Hidden input field to store the tour ID for the action -->
                            <input type="hidden" name="tour_id" value="<?php echo $tour['tour_id']; ?>">

                            <?php
                            // Check if the tour has already been approved
                            if ($tour['status'] === 'approved') {
                                echo '<button type="button" class="approve-button" disabled>Approved</button>';
                            } else {
                                // Submit button for approving the tour request
                                echo '<input type="submit" name="approve" value="Approve" class="approve-button">';
                            }//(Gosselin, Kokoska and Easterbrooks,2011)
                            ?>
                        </form>
                        <a class="btn" href="EditTour.php?tour_id=<?php echo $tour['tour_id']; ?>"
                           style="color: black; text-decoration: none;">Reschedule</a>
                        <!--Link to edit/reschedule the tour request -->
                        <a class="delete-button" href="DeleteTour.php?tour_id=<?php echo $tour['tour_id']; ?>"
                           style="color: white; text-decoration: none;">Delete</a>
                        <!--Link to delete the tour request -->
                    </div><!--(W3Schools,2023)-->
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
    //Function to exit the current page and redirect to AdminHome.php
    function exitPage() {
        window.location.href = "AdminHome.php";
    }//(W3Schools,2023)
</script>

</body>
</html>