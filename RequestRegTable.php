<?php
global $conn;
require_once 'DBConn.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMAILER/src/Exception.php';
require 'PHPMAILER/src/PHPMailer.php';
require 'PHPMAILER/src/SMTP.php';
//(Gosselin, Kokoska and Easterbrooks,2011)

//Check if the user is authenticated
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    header("Location: AdminLogin.php");
    exit();
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message13'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message13'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message13']);
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message22'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message22'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message22']);
}

//Function to send approval email(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
function sendApprovalEmail($toEmail, $parentName)
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
                
        $mail->addAddress($toEmail);
        $mail->isHTML(true);

        $mail->Subject = 'Just Love Play And Learn Centre Mobile Application Registration Approval';
        $mail->isHTML(true);
        $mail->Body = "
    <html>
    <head></head>
    <body>
        <img src='cid:Logo.png' alt='Logo' style='max-width: 100%; height: auto;'><br>
        Dear $parentName,<br><br>Your registration request for Just Love Play And Learn Centre mobile applications parent portal has been approved.<br><br>
        <b>Please do not reply to this email contact daycare for further information.</b><br><br> Thank you.
    </body>
    </html>
"; //Set email content(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)

        //Use the CID (Content-ID) of the attached image in the image source(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
        $mail->addEmbeddedImage(__DIR__ . '/Images/Logo.png', 'Logo.png', 'Logo.png', 'base64', 'image/png');

        $mail->send(); //Send the email(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)

    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}//(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)

//Function to send rejection email
function sendRejectionEmail($toEmail, $parentName)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'your_smtp_host'; // Replace with your actual SMTP server

        // Configure your SMTP settings here (see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP, 2021)
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email_address'; // Email address (see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP, 2021)
        $mail->Password = 'your_email_password'; // Email password (GENERATED APP PASSWORD) (see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP, 2021)
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        
        $mail->setFrom('your_email_address'); // Replace with the email address you want to send from
        
        $mail->addAddress($toEmail);
        $mail->isHTML(true);

        $mail->Subject = 'Just Love Play And Learn Centre Mobile Application Registration Rejection';
        $mail->Body = "Dear $parentName,<br>Your registration request for Just Love Play And Learn Centre mobile applications parent portal has been rejected.<br>
                        <b>Please do not reply to this email contact daycare for further information</b><br> Thank you.";

        $mail->send();
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to get all pending registration requests
function getAllPendingRequests($conn)
{
    $sql = "SELECT * FROM parents WHERE status = 'pending'";
    $result = $conn->query($sql);

    $pendingRequests = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pendingRequests[$row['id']] = $row;
        }
    }

    return $pendingRequests;
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to update registration request status to "approved" and send email
function approveRequest($conn, $cid, $parentData)
{
    $cid = $conn->real_escape_string($cid);

    //Update the status to "approved" in the SQL database
    $sql = "UPDATE parents SET status = 'approved' WHERE id = '$cid'";
    $conn->query($sql);

    //Send an approval email to the parent
    sendApprovalEmail($parentData['p_email'], $parentData['p_name']);

    //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
    $_SESSION['success_message13'] = 'Successfully approved registration.';

    //Redirect to refresh the page after approving
    header("Location: RequestRegTable.php");
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to delete a rejected registration request
function deleteRequest($conn, $cid)
{
    $cid = $conn->real_escape_string($cid);

    //Delete the request from the SQL database
    $sql = "DELETE FROM parents WHERE id = '$cid'";
    $conn->query($sql);
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Get all pending registration requests
$pendingRequests = getAllPendingRequests($conn); //Assuming $conn is your database connection
//(Gosselin, Kokoska and Easterbrooks,2011)
// Check if the HTTP request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['approve'])) {
        $cid = $_POST['id'];

        //Approve the request
        if (isset($pendingRequests[$cid])) {
            $parentData = $pendingRequests[$cid];
            approveRequest($conn, $cid, $parentData);
        } else {
            echo "Invalid id or request not found.";
        }//(Gosselin, Kokoska and Easterbrooks,2011)
    } elseif (isset($_POST['reject'])) {
        $cid = $_POST['id'];

        //Delete the rejected request
        if (isset($pendingRequests[$cid])) {
            $parentData = $pendingRequests[$cid];
            //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
            $_SESSION['success_message22'] = 'Successfully rejected registration.';
            deleteRequest($conn, $cid);
            sendRejectionEmail($parentData['p_email'], $parentData['p_name']);
        } else {
            echo "Invalid id or request not found.";
        }
    }//(Gosselin, Kokoska and Easterbrooks,2011)

    //Redirect to refresh the page after approving or rejecting
    header("Location: RequestRegTable.php");
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Close the database connection (if needed) at the end of your script
//$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Set the viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--(W3Schools,2023)-->

    <!-- Link to your custom stylesheet for admin.css -->
    <link rel="stylesheet" href="CSS/admin.css"><!--(W3Schools,2023)-->

    <!-- Set the title of the page -->
    <title>Request Register Table</title><!--(W3Schools,2023)-->

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

    /*Styles for the search container(W3Schools,2023) */
    #searchContainer {
        display: flex; /*Use flexbox for layout(W3Schools,2023) */
        justify-content: space-between; /*Space elements evenly(W3Schools,2023) */
        align-items: center; /*Center items vertically(W3Schools,2023) */
        margin: 10px auto; /*Center the container and add margin(W3Schools,2023) */
        max-width: 80%; /*Limit the maximum width(W3Schools,2023) */
    }

    /*Add styles for the search input(W3Schools,2023) */
    #searchInput {
        width: 80%; /*Set the width of the input(W3Schools,2023) */
        font-size: 15px;/*Set the font size(W3Schools,2023) */
        padding: 10px; /*Add padding to the input(W3Schools,2023) */
        margin: 10px auto; /*Center the input and add margin(W3Schools,2023) */
        display: block; /*Display as block to take full width(W3Schools,2023) */
        box-sizing: border-box; /*Include padding and border in the element's total width and height(W3Schools,2023) */
    }

    /*Styles for the refresh button(W3Schools,2023) */
    #refreshButton {
        padding: 10px; /*Padding to the button(W3Schools,2023)*/
        background-color: #77d4e3; /*Background color for the button(W3Schools,2023) */
        font-size: 15px;/*Set the font size(W3Schools,2023) */
        border: none; /*Remove button border(W3Schools,2023) */
        border-radius: 5px; /*Apply border-radius to the button(W3Schools,2023) */
        color: black; /*Text color for the button(W3Schools,2023) */
        cursor: pointer; /*Change cursor to pointer on hover(W3Schools,2023) */
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

    /*Styles for smaller screens/*(W3Schools,2023) */
    @media only screen and (max-width: 600px) {
        #searchContainer {
            flex-direction: column;
            align-items: stretch;
        }

        #searchInput {
            width: 100%;
        }

        #refreshButton {
            margin-top: 10px;
        }
    }
</style>
<body>

<button class="exit-button" onclick="exitPage()">Exit</button>

<br><br><br><br>

<h1>Portal Registration Request</h1>

<!--Search container with the new styles(W3Schools,2023)-->
<div id="searchContainer">
    <!--Oninput event to the search input(W3Schools,2023)-->
    <input type="text" id="searchInput" placeholder="Search by Parent Name" oninput="searchTable()">

    <!--Refresh button with the new styles(W3Schools,2023)-->
    <button id="refreshButton" onclick="refreshTable()">Refresh</button>
</div>

<br><br>

<div style="overflow-x:auto;">
    <?php if (empty($pendingRequests)): ?><!--(Gosselin, Kokoska and Easterbrooks,2011)-->
    <!--Displaying a message when there are no pending requests -->
    <p>No pending requests.</p><!--(W3Schools,2023)-->
    <?php else: ?>
        <table>
            <thead>
            <tr>
                <th style="width: 33.3%">ID</th> <!--Displaying ID -->
                <th style="width: 33.3%">Parent Name</th> <!--Displaying Parent Name -->
                <th style="width: 33.3%">Action</th> <!--Displaying Action column -->
            </tr><!--(W3Schools,2023)-->
            </thead>
            <tbody>
            <?php foreach ($pendingRequests as $cid => $record): ?>
                <tr>
                    <!--Displaying the ID of the registration request -->
                    <td><?php echo $record['id']; ?></td><!--(Gosselin, Kokoska and Easterbrooks,2011)-->
                    <!--Displaying the parent's name -->
                    <td><?php echo $record['p_name']; ?></td><!--(Gosselin, Kokoska and Easterbrooks,2011)-->
                    <td>
                        <!--Form for approving or rejecting the registration request -->
                        <form method="post">
                            <div class="button-group">
                                <!--Hidden input field to store the request ID -->
                                <input type="hidden" name="id" value="<?php echo $cid; ?>">
                                <!--(Gosselin, Kokoska and Easterbrooks,2011)-->
                                <!--Button to submit the form and approve the request -->
                                <input type="submit" name="approve" value="Approve" class="btn">
                                <!--Button to submit the form and reject the request -->
                                <input type="submit" name="reject" value="Reject" class="reject-button">
                            </div>
                        </form>
                    </td><!--(W3Schools,2023)-->
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table><!--(W3Schools,2023)-->
    <?php endif; ?>
</div>

<script>
    //JavaScript function to handle search(W3Schools,2023)
    function searchTable() {
        //Get the input value(W3Schools,2023)
        var searchValue = document.getElementById("searchInput").value.toUpperCase();

        //Get the table rows(W3Schools,2023)
        var rows = document.querySelector("table tbody").rows;

        //Loop through all table rows(W3Schools,2023)
        for (var i = 0; i < rows.length; i++) {
            //Get the parent name column value for each row(W3Schools,2023)
            var parentName = rows[i].cells[1].textContent || rows[i].cells[1].innerText;

            //Convert the parent name to uppercase for case-insensitive search(W3Schools,2023)
            parentName = parentName.toUpperCase();

            //Check if the search value is present in the parent name(W3Schools,2023)
            if (parentName.indexOf(searchValue) > -1) {
                //Display the row if the search value is found(W3Schools,2023)
                rows[i].style.display = "";
            } else {
                // Hide the row if the search value is not found(W3Schools,2023)
                rows[i].style.display = "none";
            }
        }
    }

    //JavaScript function to handle refresh(W3Schools,2023)
    function refreshTable() {
        //Clear the search input(W3Schools,2023)
        document.getElementById("searchInput").value = "";

        //Get the table rows(W3Schools,2023)
        var rows = document.querySelector("table tbody").rows;

        //Loop through all table rows and display them(W3Schools,2023)
        for (var i = 0; i < rows.length; i++) {
            rows[i].style.display = "";
        }
    }

    //JavaScript function to navigate to "AdminHome.php" when the Exit button is clicked
    function exitPage() {
        window.location.href = "AdminHome.php";
    }//(W3Schools,2023)
</script>

</body>
</html>
