<?php
//Include the database connection file
global $conn;
require_once 'DBConn.php';

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message5'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message5'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message5']);
}

//Function to verify child credentials
function verifyCredentials($conn, $cid, $password)
{
    // Sanitize the child ID to prevent SQL injection
    $cid = $conn->real_escape_string($cid);//(Gosselin, Kokoska and Easterbrooks,2011)

    // Prepare and execute a SQL query to retrieve child information
    $stmt = $conn->prepare("SELECT c_name, password FROM parents WHERE id = ?");
    $stmt->bind_param("s", $cid);
    $stmt->execute();
    $result = $stmt->get_result();//(Gosselin, Kokoska and Easterbrooks,2011)

    // Check if a matching record is found
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $storedPasswordHash = $row['password'];

        // Verify the entered password against the stored password hash
        if (password_verify($password, $storedPasswordHash)) {
            return array(
                'c_name' => $row['c_name'],
                'id' => $cid
            );
        }
    }//(Gosselin, Kokoska and Easterbrooks,2011)

    //Return false if credentials are not valid
    return false;
}

//Function to check if a registration request is pending
function isRequestPending($conn, $cid)
{
    // Sanitize the child ID to prevent SQL injection
    $cid = $conn->real_escape_string($cid);

    // Query the database to check if the registration request is pending
    $sql = "SELECT status FROM parents WHERE id = '$cid'";
    $result = $conn->query($sql);

    // Check if a matching record is found
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        return $row['status'] === 'pending';
    }//(Gosselin, Kokoska and Easterbrooks,2011)

    // Return false if no matching record is found
    return false;
}//(Gosselin, Kokoska and Easterbrooks,2011)

// Check if the HTTP request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cid = $_POST['id']; // Get child ID from POST data
    $password = $_POST['password']; // Get password from POST data

    // Check if a registration request is pending
    if (isRequestPending($conn, $cid)) {
        echo "<script>alert('Your registration request is still pending approval.');</script>";
    } else {
        // Verify child credentials and get the child's name and ID on successful login
        $childData = verifyCredentials($conn, $cid, $password);

        if ($childData) {
            // Store child's name and ID in session variables
            $_SESSION['child_name'] = $childData['c_name'];
            $_SESSION['child_id'] = $childData['id'];

            // Redirect to the ParentHome.php page
            header("Location: ParentHome.php");
            exit();
        } else {
            // Display an alert for invalid credentials
            echo "<script>alert('Invalid child ID or password.')</script>";
        }
    }
}//(Gosselin, Kokoska and Easterbrooks,2011)

// Close the database connection (if needed) at the end of your script
//$conn->close();//(Gosselin, Kokoska and Easterbrooks,2011)
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

<br><br>
<h1 style="color: black;"><u><b>PARENT PORTAL LOGIN</b></u></h1>
<br><br>
<!-- Login form for the Parent Portal -->
<form action="ParentLogin.php" method="post" class="form" id="forms">
    <div class="group-inputs">
        <label for="id">Child ID Number</label>
        <!-- Input field for the child's ID number -->
        <input type="text" name="id" id="id" required pattern="[0-9]{13}" title="Please enter exactly 13 digits."/>
    </div><!--(W3Schools,2023)-->
    <div class="group-inputs">
        <label for="password">Password</label>
        <!-- Input field for the password -->
        <input type="text" name="password" id="password" required/>
    </div><!--(W3Schools,2023)-->
    <div>
        <br>
        <input type="submit" value="Login" id="submit-form" class="btn"/>
        <br>
        <!-- Link to the Parent Registration page for new users -->
        <p>Not registered yet? <a href="ParentRegister.php" class="btn">Sign up</a></p>
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
            }
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
        // Optional: Scroll to the top of the page after submitting the form
        window.scrollTo(0, 0);
    }//(W3Schools,2023)
    //Function to exit the current page and navigate to "Home.php"
    function exitPage() {
        window.location.href = "Parent.php";
    }//(W3Schools,2023)
</script>


</body>
</html>