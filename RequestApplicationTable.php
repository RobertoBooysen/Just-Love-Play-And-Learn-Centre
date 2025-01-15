<?php
global $conn;
require_once 'DBConn.php';

use PHPMailer\PHPMailer\PHPMailer;

// Import the PHPMailer class
use PHPMailer\PHPMailer\Exception;

//Import the Exception class//(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)

require 'PHPMAILER/src/Exception.php'; //Include the PHPMailer Exception file
require 'PHPMAILER/src/PHPMailer.php'; //Include the PHPMailer file
require 'PHPMAILER/src/SMTP.php'; //Include the PHPMailer SMTP file
//(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)

//Check if the user is authenticated
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    //Redirect to the AdminLogin.php page if not authenticated
    header("Location: AdminLogin.php");
    exit();
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message14'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message14'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message14']);
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message20'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message20'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message20']);
}

//Function to get all pending application requests from the SQL database
function getAllPendingApplicationRequests($conn)
{
    $sql = "SELECT * FROM application WHERE status = 'pending'"; //SQL query to select pending application requests
    $result = $conn->query($sql); //Execute the SQL query

    $pendingApplicationRequests = []; //Initialize an empty array to store pending requests

    if ($result->num_rows > 0) { //Check if there are rows in the result
        while ($row = $result->fetch_assoc()) {
            //Iterate through the rows and store them in the array using admission_id as the key
            $pendingApplicationRequests[$row['admission_id']] = $row;
        }
    }//(Gosselin, Kokoska and Easterbrooks,2011)

    return $pendingApplicationRequests; //Return the array of pending requests
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to update the status of the application request to 'approved'
function updateApplicationStatus($conn, $id)
{
    $sql = "UPDATE application SET status = 'approved' WHERE admission_id = ?"; //SQL query to update the status
    $stmt = $conn->prepare($sql); //Prepare the SQL statement
    $stmt->bind_param("s", $id); //Bind the admission_id parameter
    $result = $stmt->execute(); //Execute the SQL statement
    $stmt->close(); //Close the prepared statement

    return $result; //Return the execution result
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to remove an application request from the 'request_applications' table
function removeApplicationRequest($conn, $id)
{
    $sql = "DELETE FROM application WHERE admission_id = ?"; //SQL query to delete an application
    $stmt = $conn->prepare($sql); //Prepare the SQL statement
    $stmt->bind_param("s", $id); //Bind the admission_id parameter
    $result = $stmt->execute(); //Execute the SQL statement
    $stmt->close(); //Close the prepared statement

    return $result; // Return the execution result
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to send approval email(s) to parents
function sendApprovalEmails($parentData)
{
    $mail = new PHPMailer(true); //Create a new PHPMailer instance

    try {
        $mail->isSMTP(); //Set the mailer to use SMTP(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
        $mail->Host = 'your_mail_host'; // Replace with your actual mail host

        // Configure your SMTP settings here (see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP, 2021)
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email_address'; // Email address (see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP, 2021)
        $mail->Password = 'your_email_password'; // Email password (GENERATED APP PASSWORD) (see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP, 2021)
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        
        $mail->setFrom('your_email_address'); // Replace with the email address you want to send from        

        $guardianOneEmail = $parentData['guardian_one_email']; //Get guardian one's email from parent data(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
        $guardianTwoEmail = $parentData['guardian_two_email']; //Get guardian two's email from parent data(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)


        if (!empty($guardianOneEmail) && !empty($guardianTwoEmail)) {
            //If both guardians have email addresses, send emails to both(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
            $mail->addAddress($guardianOneEmail); //Add guardian one's email as a recipient(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
            $mail->Subject = 'Just Love Play And Learn Centre Application Approval (Guardian One)'; //Set email subject(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
            $mail->isHTML(true); //Set email as HTML(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
            $mail->Body = "
        <html>
        <head></head>
        <body>
            <img src='cid:Logo.png' alt='Logo' style='max-width: 100%; height: auto;'><br>
            Dear {$parentData['guardian_one_name']},<br><br>Your application request for Just Love Play And Learn Centre has been <strong>approved</strong>.<br><br>
            Register to the parent portal by clicking on the link below: <a href=https://www.justloveplayandlearncentre.co.za/ParentRegister.php>Click here to register</a><br><br>
            <b>Contact daycare for further information.</b><br><br>Thank you.
        </body>
        </html>
    "; //Set email content(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)

            //Use the CID (Content-ID) of the attached image in the image source(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
            $mail->addEmbeddedImage(__DIR__ . '/Images/Logo.png', 'Logo.png', 'Logo.png', 'base64', 'image/png');

            $mail->send(); //Send the email(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)

        } elseif (!empty($guardianOneEmail)) {
            //If only guardian one has an email address, send email to guardian one(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
            $mail->addAddress($guardianOneEmail);
            $mail->Subject = 'Just Love Play And Learn Centre Application Approval'; //Set email subject(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
            $mail->isHTML(true); //Set email as HTML(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
            $mail->Body = "
        <html>
        <head></head>
        <body>
            <img src='cid:Logo.png' alt='Logo' style='max-width: 100%; height: auto;'><br>
            Dear {$parentData['guardian_one_name']},<br><br>Your application request for Just Love Play And Learn Centre has been <strong>approved</strong>.<br><br>
            Register to the parent portal by clicking on the link below: <a href=https://www.justloveplayandlearncentre.co.za/ParentRegister.php>Click here to register</a><br><br>
            <b>Contact daycare for further information.</b><br><br>Thank you.
        </body>
        </html>
    "; //Set email content(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)

            //Use the CID (Content-ID) of the attached image in the image source(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
            $mail->addEmbeddedImage(__DIR__ . '/Images/Logo.png', 'Logo.png', 'Logo.png', 'base64', 'image/png');

            $mail->send(); // Send the email(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)

        } elseif (!empty($guardianTwoEmail)) {
            //If only guardian two has an email address, send email to guardian two(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
            $mail->addAddress($guardianTwoEmail); // Add father's email as a recipient(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
            $mail->Subject = 'Just Love Play And Learn Centre Application Approval'; //Set email subject(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
            $mail->isHTML(true); //Set email as HTML(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
            $mail->Body = "
        <html>
        <head></head>
        <body>
            <img src='cid:Logo.png' alt='Logo' style='max-width: 100%; height: auto;'><br>
            Dear {$parentData['father_name']},<br><br>Your application request for Just Love Play And Learn Centre has been <strong>approved</strong>.<br><br>
            Register to the parent portal by clicking on the link below: <a href=https://www.justloveplayandlearncentre.co.za/ParentRegister.php>Click here to register</a><br><br>
            <b>Contact daycare for further information.</b><br><br>Thank you.
        </body>
        </html>
    "; //Set email content(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)

            //Use the CID (Content-ID) of the attached image in the image source(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
            $mail->addEmbeddedImage(__DIR__ . '/Images/Logo.png', 'Logo.png', 'Logo.png', 'base64', 'image/png');

            $mail->send(); //Send the email(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
        } else {
            //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
            $_SESSION['success_message21'] = 'Error: Both guardians do not have email addresses.';
        }
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}"; //Display an error message if email sending fails(Gosselin, Kokoska and Easterbrooks,2011)
    }
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); //Terminate the script with an error message if the database connection fails(Gosselin, Kokoska and Easterbrooks,2011)
}

//Get all pending application requests using the defined function(Gosselin, Kokoska and Easterbrooks,2011)
$pendingApplicationRequests = getAllPendingApplicationRequests($conn);

//Check if the request method is POST(Gosselin, Kokoska and Easterbrooks,2011)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Check if the 'approve2' button was clicked(Gosselin, Kokoska and Easterbrooks,2011)
    if (isset($_POST['approve2'])) {
        $id = $_POST['id']; //Get the ID of the selected application request
        //Check if the application request with the given ID exists in pending requests
        if (isset($pendingApplicationRequests[$id])) {
            //Update the status of the selected application request to 'approved'
            $result = updateApplicationStatus($conn, $id);
            if ($result) {
                //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
                $_SESSION['success_message14'] = 'Successfully approved registration.';

                //Send approval emails to parents
                sendApprovalEmails($pendingApplicationRequests[$id]);

                //Redirect to refresh the page after approving
                header("Location: RequestApplicationTable.php");
            } else {
                //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
                $_SESSION['success_message18'] = 'Failed to update status.';
            }
        } else {
            //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
            $_SESSION['success_message19'] = 'Invalid ID or request not found.';
        }//(Gosselin, Kokoska and Easterbrooks,2011)
    } elseif (isset($_POST['reject2'])) {
        //Handle the case when the 'reject2' button was clicked
        $id = $_POST['id']; //Get the ID of the selected application request

        //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
        $_SESSION['success_message20'] = 'Application request rejected.';

        //Remove the application request from the 'request_applications' table
        removeApplicationRequest($conn, $id);

        header("Location: RequestApplicationTable.php");
    }//(Gosselin, Kokoska and Easterbrooks,2011)
}

//Close the database connection at the end of your script
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--(W3Schools,2023)-->
    <link rel="stylesheet" href="CSS/admin.css"><!--(W3Schools,2023)-->

    <!-- Set the title of the page -->
    <title>Request Application Table</title><!--(W3Schools,2023)-->
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

    /*styling button*/
    .btn {
        padding: 5px 12px;
        font-size: 15px;
        color: black;
        background: #77d4e3;
        border: none;
        border-radius: 5px;
        margin-left: 58px;
    }

    /*(W3Schools,2023)*/

    /*Button styling */
    .reject-button {
        padding: 5px 12px;
        font-size: 15px;
        color: white;
        background: #d03c2f;
        border: none;
        border-radius: 5px;
        margin-left: 58px;
    }

    /*(W3Schools,2023)*/

    /*styling button group*/
    .button-group {
        display: flex; /*Use flexbox for horizontal layout */
        align-items: center; /*Center items vertically */
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

</style>
<body>
<!--exit button-->
<button class="exit-button" onclick="exitPage()">Exit</button><!--(W3Schools,2023)-->

<br><br>
<!--Main heading-->
<h1>Application Requests</h1><!--(W3Schools,2023)-->

<div style="overflow-x:auto;">
    <?php if (empty($pendingApplicationRequests)): ?><!--(Gosselin, Kokoska and Easterbrooks,2011)-->
    <!--Displaying a message when there are no pending application requests -->
    <p>No pending application requests.</p><!--(W3Schools,2023)-->
    <?php else: ?>
        <table>
            <thead>
            <tr>
                <th style="width: 33.3%">Child ID</th> <!--Displaying Child ID -->
                <th style="width: 33.3%">Child Name</th> <!--Displaying Child Name -->
                <th style="width: 33.3%">Action</th> <!--Displaying Action column -->
            </tr><!--(W3Schools,2023)-->
            </thead>
            <tbody>
            <?php foreach ($pendingApplicationRequests

            as $cid2 => $applicationData): ?><!--(Gosselin, Kokoska and Easterbrooks,2011)-->
            <tr>
                <!--Displaying the Child ID of the application request -->
                <td><?php echo $applicationData['child_id']; ?></td><!--(Gosselin, Kokoska and Easterbrooks,2011)-->

                <!--Displaying the Child Name of the application request -->
                <td><?php echo $applicationData['full_name']; ?></td><!--(Gosselin, Kokoska and Easterbrooks,2011)-->

                <!--Form for approving or rejecting the application with a view button to view the entire form -->
                <td>
                    <form method="post" action="RequestApplicationTable.php">
                        <!--Hidden input field containing the application ID -->
                        <input type="hidden" name="id" value="<?php echo $cid2; ?>" class="btn">
                        <!--(Gosselin, Kokoska and Easterbrooks,2011)-->

                        <div class="button-group">
                            <!--Submit button for viewing the application details -->
                            <a style="text-decoration: none;"
                               href="ViewPendingApplication.php?admission_id=<?php echo $applicationData['admission_id']; ?>"
                               class="btn">View</a><!--(Gosselin, Kokoska and Easterbrooks,2011)-->


                            <!--Submit button for approving the application -->
                            <input type="submit" name="approve2" value="Approve" class="btn"><!--(W3Schools,2023)-->

                            <!--Submit button for rejecting the application -->
                            <input type="submit" name="reject2" value="Reject" class="reject-button">
                            <!--(W3Schools,2023)-->
                        </div>
                    </form>
                </td><!--(W3Schools,2023)-->
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