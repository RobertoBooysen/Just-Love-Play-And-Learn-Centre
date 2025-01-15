<?php
global $conn;
require_once 'DBConn.php';

//Include PHPMailer classes for sending emails(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMAILER/src/Exception.php';
require 'PHPMAILER/src/PHPMailer.php';
require 'PHPMAILER/src/SMTP.php';


//Check if the user is authenticated as an admin(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    // Redirect to the AdminLogin.php page if not authenticated
    header("Location: AdminLogin.php");
    exit();
}

//Function to fetch a specific ticket from the database by ticket_id(Gosselin, Kokoska and Easterbrooks,2011)
function getTicketFromDatabase($ticket_id, $db)
{
    $query = "SELECT * FROM tickets WHERE ticket_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $ticket = $result->fetch_assoc();
    $stmt->close();

    return $ticket;
}

//Function to update admin response in the database(Gosselin, Kokoska and Easterbrooks,2011)
function updateAdminResponseInDatabase($ticket_id, $adminResponse, $conn)
{
    //SQL query to update admin_response in tickets table for a specific ticket_id(Gosselin, Kokoska and Easterbrooks,2011)
    $query = "UPDATE tickets SET admin_response = ? WHERE ticket_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $adminResponse, $ticket_id);
    $stmt->execute();
    $stmt->close();
}

//Function to send an approval email(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
function sendApprovalEmail($toEmail, $parentName, $adminResponse)
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


        $mail->Subject = 'Response to Your Ticket';
        $mail->Body = "
    <html>
    <head></head>
    <body>
        <img src='cid:Logo.png' alt='Logo' style='max-width: 100%; height: auto;'><br>
        Dear $parentName,<br><br>Your ticket has received a response from the admin:<br><br>$adminResponse<br><br>Thank you.
    </body>
    </html>
"; //Set email content(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)

        //Use the CID (Content-ID) of the attached image in the image source(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)
        $mail->addEmbeddedImage(__DIR__ . '/Images/Logo.png', 'Logo.png', 'Logo.png', 'base64', 'image/png');

        $mail->send(); //Send the email(see PHP Form Submit To Send Email Contact Form Submit to Email Using PHP,2021)

        $mail->send();
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

//Checking if ticket_id is provided in the URL(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_GET['ticket_id'])) {
    $ticket_id = $_GET['ticket_id'];
    // Get ticket details by ticket_id(Gosselin, Kokoska and Easterbrooks,2011)
    $ticket = getTicketFromDatabase($ticket_id, $conn);

    if (!$ticket) {
        echo "Ticket not found.";
        exit();
    }

    //Handle form submission for admin response(Gosselin, Kokoska and Easterbrooks,2011)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get admin response from the form
        $adminResponse = $_POST['admin_response'];

        //Updating the admin response in the database(Gosselin, Kokoska and Easterbrooks,2011)
        updateAdminResponseInDatabase($ticket_id, $adminResponse, $conn);

        //Sending an email to the parent with the admin response(Gosselin, Kokoska and Easterbrooks,2011)
        sendApprovalEmail($ticket['parent_email'], $ticket['parent_first_name'], $adminResponse);

        //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
        $_SESSION['success_message18'] = 'Successfully responded to parent query.';

        //Redirecting back to the ticket list page(Gosselin, Kokoska and Easterbrooks,2011)
        header("Location: AdminTicket.php");
        exit();
    }
} else {
    echo "Ticket ID not provided.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Define the viewport for responsive design(W3Schools,2023) -->
    <link rel="stylesheet" href="CSS/admin.css">
    <title>Admin Respond</title> <!--Include a custom admin.css stylesheet(W3Schools,2023) -->
</head>
<style>
    :root {
        --primary-color: rgb(11, 78, 179); /*Define a CSS custom property for primary color(W3Schools,2023)*/
    }

    *,
    *::before,
    *::after {
        box-sizing: border-box; /*Apply box-sizing to all elements(W3Schools,2023)*/
    }

    label {
        display: block;
        margin-bottom: 0.5rem; /*Style for form labels(W3Schools,2023)*/
    }

    input {
        display: block;
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        height: 50px; /*Style for form input elements(W3Schools,2023)*/
    }

    .width-50 {
        width: 50%; /*Style class for 50% width(W3Schools,2023)*/
    }

    .ml-auto {
        margin-left: auto; /*Style class for auto margin left(W3Schools,2023)*/
    }

    .form {
        width: clamp(320px, 30%, 430px);
        margin: 0 auto;
        border: none;
        border-radius: 10px !important;
        overflow: hidden;
        padding: 2.5rem;
        background-color: #fff;
        padding: 50px 50px;
        text-align: center; /*Style for forms and center alignment(W3Schools,2023)*/
    }

    table, td, th {
        border: 1px solid #ddd;
        text-align: center; /*Style for tables(W3Schools,2023)*/
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #caacd2;
        table-layout: fixed; /*Style for table layout(W3Schools,2023)*/
    }

    th, td {
        padding: 15px;
        width: 20%;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden; /*Style for table cells(W3Schools,2023)*/
    }

    .btn {
        padding: 5px 12px;
        font-size: 15px;
        color: black;
        background: #77d4e3;
        border: none;
        border-radius: 5px;
        margin: 10px auto; /*Style for buttons(W3Schools,2023)*/
    }
</style>
<body>

<h1><u><b>Ticket Details</u></b></h1>
<br>

<!--Display ticket details(Gosselin, Kokoska and Easterbrooks,2011) -->
<table>
    <tr>
        <td>Parent First Name:</td>
        <td><?php echo $ticket['parent_first_name']; ?></td>
    </tr>
    <tr>
        <td>Parent Last Name:</td>
        <td><?php echo $ticket['parent_last_name']; ?></td>
    </tr>
    <tr>
        <td>Parent Email:</td>
        <td><?php echo $ticket['parent_email']; ?></td>
    </tr>
    <tr>
        <td>Parent Phone:</td>
        <td><?php echo $ticket['parent_phone']; ?></td>
    </tr>
    <tr>
        <td>Query:</td>
        <td><?php echo $ticket['query']; ?></td>
    </tr>
    <tr>
        <td>Admin Response:</td>
        <td><?php echo $ticket['admin_response']; ?></td>
    </tr>
</table>

<!--Admin response form(W3Schools,2023) -->
<form method="post" class="form">
    <label for="admin_response">Admin Response:</label><br>
    <textarea name="admin_response" id="admin_response" rows="10"
              cols="42" style="width: 100%"><?php echo $ticket['admin_response']; ?></textarea><br>
    <input type="submit" value="Submit Response" class="btn">
</form>

</body>
</html>