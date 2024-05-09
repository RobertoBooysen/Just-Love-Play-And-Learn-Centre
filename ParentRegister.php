<?php
// Include the database connection file
global $conn;
require_once 'DBConn.php';

// Function to check if an ID exists in the SQL database
function isIDExists($conn, $cid)
{
    // SQL query to check if the ID exists in the parents table
    $sql = "SELECT * FROM parents WHERE id = ?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("s", $cid);

    // Execute the query
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Return true if the ID exists, false otherwise
    return $result->num_rows > 0;
}//(Gosselin, Kokoska and Easterbrooks,2011)

// Function to insert data into the SQL database
function insertRequest($conn, $cid, $data)
{
    // Extract data from the $data array
    $id = $data['id'];
    $p_name = $data['p_name'];
    $p_email = $data['p_email'];
    $password = $data['password'];
    $c_name = $data['c_name'];
    $status = $data['status'];//(Gosselin, Kokoska and Easterbrooks,2011)

    // Prepare SQL statement for inserting data into the parents table
    $stmt = $conn->prepare("INSERT INTO parents (id, p_name, p_email, password, c_name, status) VALUES (?, ?, ?, ?, ?, ?)");//(Gosselin, Kokoska and Easterbrooks,2011)

    // Bind parameters
    $stmt->bind_param("ssssss", $id, $p_name, $p_email, $password, $c_name, $status);//(Gosselin, Kokoska and Easterbrooks,2011)

    // Execute the query
    if ($stmt->execute()) {
        // Return true on success
        return true;
    } else {
        // Return an error message on failure
        return "Error: " . $stmt->error;
    }//(Gosselin, Kokoska and Easterbrooks,2011)
}

// Check if the HTTP request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data and create an array with the necessary information
    $cid = $conn->real_escape_string($_POST['id']);
    $data = array(
        'id' => $cid,
        'p_name' => $conn->real_escape_string($_POST['p_name']),
        'p_email' => $conn->real_escape_string($_POST['p_email']),
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'c_name' => $conn->real_escape_string($_POST['c_name']),
        'status' => 'pending'
    );//(Gosselin, Kokoska and Easterbrooks,2011)

    // Check if the ID already exists
    if (isIDExists($conn, $cid)) {
        echo "<script>alert('ID already exists. Please choose a different ID.')</script>";
    } else {
        // Insert the registration request into the database
        $result = insertRequest($conn, $cid, $data);

        // Check the result of the registration attempt
        if ($result === true) {
            //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
            $_SESSION['success_message5'] = 'Successfully Registered. Your request is pending approval.';
            // Redirect to the login page after successful registration
            header("Location: ParentLogin.php");
            exit();
        } else {
            // Display an error message if the registration fails
            echo "Failed to insert data. Error: " . $result;
        }
    }//(Gosselin, Kokoska and Easterbrooks,2011)
}

// Close the database connection (if needed) at the end of your script
//$conn->close();
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
    <title>Parent Login</title><!--(W3Schools,2023)-->
</head>
<style>
    /*Styling root*/
    :root {
        --primary-color: rgb(11, 78, 179)
    }/*(W3Schools,2023)*/

    *,
    *::before,
    *::after {
        box-sizing: border-box
    }/*(W3Schools,2023)*/

    /*Styling label*/
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

    /*Styling for the exit button hover*/
    .exit-button:hover {
        background-color: #41c4d8;
        color: black;
    }/*(W3Schools,2023)*/
</style>
<body>
<!--Exit button-->
<button class="exit-button" onclick="exitPage()">Exit</button><!--(W3Schools,2023)-->

<h1 style="color: black;"><u><b>PARENT PORTAL REGISTRATION</b></u></h1>
<br><br>
<!-- Registration form for the Parent Portal -->
<form action="ParentRegister.php" method="post" class="form" id="forms">
    <div class="group-inputs">
        <label for="id">Child ID Number</label>
        <!-- Input field for the child's ID number -->
        <input type="text" name="id" id="id" required pattern="[0-9]{13}" title="Please enter exactly 13 digits."/>
    </div><!--(W3Schools,2023)-->
    <div class="group-inputs">
        <label for="p_email">Email</label>
        <!-- Input field for the parent's email address -->
        <input type="email" name="p_email" id="p_email" required/>
    </div><!--(W3Schools,2023)-->
    <div class="group-inputs">
        <label for="p_name">Parent Name</label>
        <!-- Input field for the parent's name -->
        <input type="text" name="p_name" id="p_name" required/>
    </div><!--(W3Schools,2023)-->
    <div class="group-inputs">
        <label for="c_name">Child Name</label>
        <!-- Input field for the child's name -->
        <input type="text" name="c_name" id="c_name" required/> <!-- Added child's name field -->
    </div><!--(W3Schools,2023)-->
    <div class="group-inputs">
        <label for="password">Password</label>
        <!-- Input field for the parent's password -->
        <input type="text" name="password" id="password" required pattern="[0-9]{8}" title="Please enter a 8 character long password."/>
    </div><!--(W3Schools,2023)-->
    <div>
        <br>
        <input type="submit" value="Register" id="submit-form" class="btn"/>
        <br>
        <!-- Link to the Parent Login page if already registered -->
        <p>Already registered? <a href="ParentLogin.php" class="btn">Sign in</a></p>
    </div><!--(W3Schools,2023)-->
</form>
<script>
    // Function to toggle the navigation menu on smaller screens
    function toggleNav() {
        var nav = document.getElementsByClassName("topnav")[0];
        if (nav.className === "topnav") {
            nav.className += " responsive";
        } else {
            nav.className = "topnav";
        }
    }//(W3Schools,2023)

    // Adding an event listener to the form submission button
    document.getElementById("submit-form").addEventListener("click", function () {
        validateAndSubmitForm();
    });//(W3Schools,2023)

    // Adding event listeners to required input fields
    const requiredInputs = document.querySelectorAll("input[required], textarea[required]");//(W3Schools,2023)

    // Looping through each required input field and adding event listeners for "input" and "blur" events
    requiredInputs.forEach((input) => {
        // Event listener for "input" event: Remove custom validity and error class when the user types in the field
        input.addEventListener("input", function () {
            this.setCustomValidity("");
            this.classList.remove("error");
        });//(W3Schools,2023)

        // Event listener for "blur" event: Check if the field is empty and show a custom error message if needed
        input.addEventListener("blur", function () {
            if (!this.value.trim()) {
                this.setCustomValidity("Please fill in this field.");
                this.classList.add("error");
            }
        });//(W3Schools,2023)
    });

    // Function to validate and submit the form
    function validateAndSubmitForm() {
        const inputs = document.querySelectorAll("input[required], textarea[required]");
        let isValid = true;//(W3Schools,2023)

        // Looping through each required input field to check if it's empty or not
        inputs.forEach((input) => {
            if (!input.value.trim()) {
                // If the field is empty, add custom validity and error class to show the custom error message
                input.setCustomValidity("Please fill in this field.");
                input.classList.add("error");
                isValid = false; // Mark the form as invalid
            } else {
                // If the field is not empty, remove custom validity and error class
                input.setCustomValidity("");
                input.classList.remove("error");
            }//(W3Schools,2023)
        });//(W3Schools,2023)

        // Checking if the form is valid or not
        if (!isValid) {
            showErrorMessage("Please fill in all required fields before proceeding.");
        } else {
            submitForm(); // If the form is valid, submit it
        }//(W3Schools,2023)
    }

    // Function to show an error message dynamically
    function showErrorMessage(message) {
        const errorMessage = document.createElement("div");
        errorMessage.classList.add("error-message");
        errorMessage.textContent = message;
        document.body.appendChild(errorMessage);

        // Removing the error message after 3 seconds
        setTimeout(() => {
            errorMessage.remove();
        }, 3000);
    }//(W3Schools,2023)

    // Function to handle form submission
    function submitForm() {
        // Marking all progress steps as completed (if needed)
        const progressSteps = document.querySelectorAll(".progress-step");
        progressSteps.forEach((progressStep, idx) => {
            progressStep.classList.add("progress-step-check");
        });
        //Optional: Scroll to the top of the page after submitting the form
        window.scrollTo(0, 0);
    }//(W3Schools,2023)
    //Function to exit the current page and navigate to "Home.php"
    function exitPage() {
        window.location.href = "Parent.php";
    }//(W3Schools,2023)
</script>


</body>
</html>