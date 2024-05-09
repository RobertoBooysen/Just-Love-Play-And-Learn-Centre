<?php
global $conn;
require_once 'DBConn.php';

//Function to verify admin credentials(Gosselin, Kokoska and Easterbrooks,2011)
function verifyCredentials($conn, $username, $password)
{
    $username = $conn->real_escape_string($username);

    //Prepare a statement to select the hashed password from the database(Gosselin, Kokoska and Easterbrooks,2011)
    $stmt = $conn->prepare("SELECT password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $storedPasswordHash = $row['password'];

        //Use password_verify to compare the provided password with the hashed password(Gosselin, Kokoska and Easterbrooks,2011)
        if (password_verify($password, $storedPasswordHash)) {
            return true;
        }
    }

    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Get the admin username and password from POST data(Gosselin, Kokoska and Easterbrooks,2011)
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Verify admin credentials
    if (verifyCredentials($conn, $username, $password)) {
        // Store user authentication status in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
        $_SESSION['admin_authenticated'] = true;

        // Redirecting to the AdminHome.php page on successful authentication(Gosselin, Kokoska and Easterbrooks,2011)
        header("Location: AdminHome.php");
        exit();
    } else {
        echo "<script>alert('Invalid username or password.');</script>"; //Display an alert for invalid credentials(Gosselin, Kokoska and Easterbrooks,2011)
    }
}

// Close the database connection (if needed) at the end of your script(Gosselin, Kokoska and Easterbrooks,2011)
//$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <!--Set the viewport for responsive design (W3Schools, 2023) -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Link to custom stylesheet (W3Schools, 2023) -->
    <link rel="stylesheet" href="CSS/style.css">

    <!--Link to Bootstrap stylesheet (W3Schools, 2023) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!--Link to Font Awesome stylesheet (W3Schools, 2023) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!--Link to Google Fonts stylesheet (W3Schools, 2023) -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

    <!--Set the title of the page (W3Schools, 2023) -->
    <title>Admin Login</title>

</head>
<style>
    /*Set primary color variable (W3Schools, 2023) */
    :root {
        --primary-color: rgb(11, 78, 179)
    }

    /*Apply box-sizing to all elements (W3Schools, 2023) */
    *,
    *::before,
    *::after {
        box-sizing: border-box
    }

    /*Style for labels (W3Schools, 2023) */
    label {
        display: block;
        margin-bottom: 0.5rem
    }

    /*Style for input elements (W3Schools, 2023) */
    input {
        display: block;
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        height: 50px
    }

    /*Style for elements with class 'width-50' (W3Schools, 2023) */
    .width-50 {
        width: 50%
    }

    /*Style for elements with class 'ml-auto' (W3Schools, 2023) */
    .ml-auto {
        margin-left: auto
    }

    /*Styles for the form container (W3Schools, 2023) */
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

    /*Style for buttons (W3Schools, 2023) */
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
    }

    /*Hover effect for buttons (W3Schools, 2023) */
    .btn:hover {
        box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2
    }

    /*Styles for error messages (W3Schools, 2023) */
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

    /*Styles for the exit button (W3Schools, 2023) */
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

    /*Hover effect for the exit button (W3Schools, 2023) */
    .exit-button:hover {
        background-color: #41c4d8;
        color: black;
    }
</style>
<body>
<!--Exit button(W3Schools, 2023)-->
<button class="exit-button" onclick="exitPage()">Exit</button><!--(W3Schools,2023)-->

<br><br>
<h1 style="color: black;"><u><b>ADMIN PORTAL LOGIN</b></u></h1>
<br><br>

<!--Login form for admin(W3Schools, 2023)-->
<form action="AdminLogin.php" method="post" class="form" id="forms">
    <div class="group-inputs">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required/>
    </div>
    <div class="group-inputs">
        <label for="password">Password</label>
        <input type="text" name="password" id="password" required/>
    </div>
    <div>
        <br>
        <input type="submit" value="Login" id="submit-form" class="btn"/>
    </div>
</form>

<script>
    function toggleNav() {
        var nav = document.getElementsByClassName("topnav")[0];
        if (nav.className === "topnav") {
            nav.className += " responsive";
        } else {
            nav.className = "topnav";
        }
    }

    //Showcasing active link(W3Schools, 2023)
    document.addEventListener("DOMContentLoaded", function () {
        const currentPage = window.location.pathname.split('/').pop().split('.php')[0];
        const navLinks = document.querySelectorAll(".topnav a");

        for (const link of navLinks) {
            if (link.getAttribute("href") === currentPage + ".php") {
                link.classList.add("active");
            }
        }
    });

    //Adding event listener to the form submission(W3Schools, 2023)
    document.getElementById("submit-form").addEventListener("click", function () {
        validateAndSubmitForm();
    });

    //Adding event listeners to required input fields(W3Schools, 2023)
    const requiredInputs = document.querySelectorAll("input[required], textarea[required]");

    //Looping through each required input field and add event listeners for "input" and "blur" events(W3Schools, 2023)
    requiredInputs.forEach((input) => {
        //Event listener for "input" event: When the user types in the field, remove custom validity and error class(W3Schools, 2023)
        input.addEventListener("input", function () {
            this.setCustomValidity("");
            this.classList.remove("error");
        });

        //Event listener for "blur" event: When the field loses focus, check if it's empty and show custom error message if needed(W3Schools, 2023)
        input.addEventListener("blur", function () {
            if (!this.value.trim()) {
                this.setCustomValidity("Please fill in this field.");
                this.classList.add("error");
            }
        });
    });

    //Function to validate and submit the form(W3Schools, 2023)
    function validateAndSubmitForm() {
        const inputs = document.querySelectorAll("input[required], textarea[required]");
        let isValid = true;

        //Looping through each required input field to check if it's empty or not(W3Schools, 2023)
        inputs.forEach((input) => {
            if (!input.value.trim()) {
                //If the field is empty, add custom validity and error class to show the custom error message(W3Schools, 2023)
                input.setCustomValidity("Please fill in this field.");
                input.classList.add("error");
                isValid = false; //Mark the form as invalid(W3Schools, 2023)
            } else {
                //If the field is not empty, remove custom validity and error class(W3Schools, 2023)
                input.setCustomValidity("");
                input.classList.remove("error");
            }
        });

        //Checking if the form is valid or not(W3Schools, 2023)
        if (!isValid) {
            showErrorMessage("Please fill in all required fields before proceeding.");
        } else {
            submitForm(); //If the form is valid, submit it(W3Schools, 2023)
        }
    }

    //Function to show an error message dynamically(W3Schools, 2023)
    function showErrorMessage(message) {
        const errorMessage = document.createElement("div");
        errorMessage.classList.add("error-message");
        errorMessage.textContent = message;
        document.body.appendChild(errorMessage);

        //Removing the error message after 3 seconds(W3Schools, 2023)
        setTimeout(() => {
            errorMessage.remove();
        }, 3000);
    }

    //Function to handle form submission(W3Schools, 2023)
    function submitForm() {
        //Marking all progress steps as completed (if needed)(W3Schools, 2023)
        const progressSteps = document.querySelectorAll(".progress-step");
        progressSteps.forEach((progressStep, idx) => {
            progressStep.classList.add("progress-step-check");
        });
        //Optional: Scroll to the top of the page after submitting the form(W3Schools, 2023)
        window.scrollTo(0, 0);
    }

    //Function to exit the current page and navigate to "Index.php"(W3Schools, 2023)
    function exitPage() {
        window.location.href = "Admin.php";
    }<!--(W3Schools,2023)-->
</script>

</body>
</html>