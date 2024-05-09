<?php
// Include the database connection file
global $conn;
require_once 'DBConn.php';

// Check if the child_id session variable is set to determine if the parent is logged in
if (!isset($_SESSION['child_id'])) {
    // Redirect to the login page if not logged in
    header("Location: ParentLogin.php");
    exit();
}//(Gosselin, Kokoska and Easterbrooks,2011)

// Function to insert a ticket into the database
function insertTicket($data, $conn)
{
    // SQL query to insert ticket data into the database
    $sql = "INSERT INTO tickets (admin_response, parent_email, parent_first_name, parent_last_name, parent_phone, query) VALUES (?, ?, ?, ?, ?, ?)";//(Gosselin, Kokoska and Easterbrooks,2011)

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Check if the SQL statement preparation is successful
    if ($stmt === false) {
        // Handle any potential database errors
        die("Database error: " . $conn->error);
    }//(Gosselin, Kokoska and Easterbrooks,2011)

    // Bind the parameters
    $stmt->bind_param("ssssss", $data['admin_response'], $data['parent_email'], $data['parent_first_name'], $data['parent_last_name'], $data['parent_phone'], $data['query']);//(Gosselin, Kokoska and Easterbrooks,2011)

    // Execute the query
    if ($stmt->execute()) {
        // Get the ID of the inserted record
        $ticket_id = $stmt->insert_id;
        $stmt->close();
        return $ticket_id;
    } else {
        return false; // Insertion failed
    }//(Gosselin, Kokoska and Easterbrooks,2011)
}

// Check if the HTTP request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prepare ticket data from POST parameters
    $data = array(
        'admin_response' => '', // You can update this as needed
        'parent_email' => $_POST['parent_email'],
        'parent_first_name' => $_POST['parent_first_name'],
        'parent_last_name' => $_POST['parent_last_name'],
        'parent_phone' => $_POST['parent_phone'], // Assuming 'query' is the phone number
        'query' => $_POST['query'],
    );//(Gosselin, Kokoska and Easterbrooks,2011)

    // Insert data into the MySQL database and get the unique ticket ID
    $ticket_id = insertTicket($data, $conn); // Ensure you have a valid database connection
    //(Gosselin, Kokoska and Easterbrooks,2011)

    // Display appropriate alert based on the result of ticket insertion
    if ($ticket_id !== false) {
        echo '<script>alert("Ticket successfully added. Your Ticket ID is ' . $ticket_id . '")</script>';
    } else {
        echo '<script>alert("Failed to add ticket. Please try again.")</script>';
    }//(Gosselin, Kokoska and Easterbrooks,2011)
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Set the viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--(W3Schools,2023)-->

    <!-- Link to your custom stylesheet for parent.css -->
    <link rel="stylesheet" href="CSS/parent.css"><!--(W3Schools,2023)-->

    <!-- Link to Bootstrap stylesheet for additional styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"><!--(W3Schools,2023)-->

    <!-- Link to Font Awesome stylesheet for icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"><!--(W3Schools,2023)-->

    <!-- Set the title of the page -->
    <title>Parent Log Ticket</title><!--(W3Schools,2023)-->

</head>
<style>
    /*styling root */
    :root {
        --primary-color: rgb(11, 78, 179)
    }/*(W3Schools,2023)*/

    *,
    *::before,
    *::after {
        box-sizing: border-box
    }/*(W3Schools,2023)*/

    /*styling label*/
    label {
        display: block;
        margin-bottom: 0.5rem
    }/*(W3Schools,2023)*/

    /*styling input*/
    input {
        display: block;
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        height: 50px
    }/*(W3Schools,2023)*/

    /*styling width*/
    .width-50 {
        width: 50%
    }/*(W3Schools,2023)*/

    /*styling auto*/
    .ml-auto {
        margin-left: auto
    }/*(W3Schools,2023)*/

    /*styling form*/
    .form {
        max-width: 1000px;
        margin: 0 auto;
        border: none;
        border-radius: 10px !important;
        overflow: hidden;
        padding: 1.5rem;
        background-color: #fff;
        padding: 20px 30px; /*Style for the form container */
    }/*(W3Schools,2023)*/

    /*styling button*/
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
    }/*(W3Schools,2023)*/

    /*styling button hover*/
    .btn:hover {
        box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2
    }/*(W3Schools,2023)*/

    /*styling error message*/
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
    }/*(W3Schools,2023)*/
</style>
<body>
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->
<!--Top navigation bar-->
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

<!--Log Ticket form -->
<h1 style="color: black;"><u><b>LOG TICKET</b></u></h1><!--(W3Schools,2023)-->
<br>
<!--This is a form element with an action attribute that specifies where the form data will be sent -->
<form action="ParentLogTicket.php" method="post" class="form" id="forms">
    <br>

    <!--This is a container for input elements related to the first name of the parent -->
    <div class="group-inputs">
        <label for="parent_first_name">First Name of Parent</label>
        <!--This is a text input field for entering the parent's first name with a required attribute -->
        <input type="text" name="parent_first_name" id="parent_first_name" required/>
    </div><!--(W3Schools,2023)-->
    <br>

    <!--This is a container for input elements related to the last name of the parent -->
    <div class="group-inputs">
        <label for="parent_last_name">Last Name of Parent</label>
        <!--This is a text input field for entering the parent's last name with a required attribute -->
        <input type="text" name="parent_last_name" id="parent_last_name" required/>
    </div><!--(W3Schools,2023)-->
    <br>

    <!--This is a container for input elements related to the email address of the parent -->
    <div class="group-inputs">
        <label for "parent_email">Email Address of Parent</label>
        <!--This is an email input field for entering the parent's email address with a required attribute -->
        <input type="email" name="parent_email" id="parent_email" required/>
    </div><!--(W3Schools,2023)-->
    <br>

    <!--This is a container for input elements related to the phone number of the parent -->
    <div class="group-inputs">
        <label for="parent_phone">Phone Number of Parent</label>
        <!--This is a telephone input field for entering the parent's phone number with a required attribute -->
        <input type="tel" name="parent_phone" id="parent_phone" required/>
    </div><!--(W3Schools,2023)-->

    <!--This is a container for input elements related to the query -->
    <div class="group-inputs">
        <label for="query">Query</label>
        <!--This is a text area for entering a query with a required attribute -->
        <textarea id="query" name="query" rows="4" cols="43" style="width: 100%" required></textarea>
    </div><!--(W3Schools,2023)-->
    <br>

    <!--This is a container for the submit button -->
    <div class="group-inputs">
        <!--This is a submit button that will trigger the form submission -->
        <input type="submit" value="Submit Ticket" id="submit-form" class="btn"/>
    </div><!--(W3Schools,2023)-->
</form>


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
    //This function toggles the responsive class on the "topnav" element to show/hide the navigation menu on small screens
    function toggleNav() {
        var nav = document.getElementsByClassName("topnav")[0];
        if (nav.className === "topnav") {
            nav.className += " responsive";
        } else {
            nav.className = "topnav";
        }
    }//(W3Schools,2023)

    //This part of the code showcases the active link in the navigation menu
    document.addEventListener("DOMContentLoaded", function () {
        //Extract the current page name from the URL
        const currentPage = window.location.pathname.split('/').pop().split('.php')[0];//(W3Schools,2023)
        //Get all anchor elements within elements with the class "topnav"
        const navLinks = document.querySelectorAll(".topnav a");//(W3Schools,2023)

        //Loop through each link in the navigation menu
        for (const link of navLinks) {
            //Check if the href attribute of the link matches the current page name
            if (link.getAttribute("href") === currentPage + ".php") {
                //Add the "active" class to the link to highlight it as the active page
                link.classList.add("active");
            }
        }//(W3Schools,2023)
    });
</script>


</body>
</html>