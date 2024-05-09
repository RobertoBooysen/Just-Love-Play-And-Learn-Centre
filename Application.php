<?php
global $conn;
require_once 'DBConn.php';

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message16'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message16'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message16']);
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message17'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message17'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message17']);
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message18'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message18'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message18']);
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message19'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message19'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message19']);
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message21'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message21'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message21']);
}

//Function to check if a specific ID exists in the SQL database(Gosselin, Kokoska and Easterbrooks,2011)
function isIDExists($conn, $cid)
{
    $sql = "SELECT * FROM application WHERE child_id = '$cid'";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
}

//Function to submit an application to the SQL database(Gosselin, Kokoska and Easterbrooks,2011)
function submitApplication($conn, $cid, $data)
{
    //Prepare SQL query to insert application data into the request_applications table(Gosselin, Kokoska and Easterbrooks,2011)
    $admission_date = $data['admission_date'];
    $care_type = $data['care_type'];
    $child_name = $data['child_name'];
    $child_dob = $data['child_dob'];
    $child_age = $data['child_age'];
    $guardian_one_relationship = $data['guardian_one_relationship'];
    $guardian_one_name = $data['guardian_one_name'];
    $guardian_one_home_address = $data['guardian_one_home_address'];
    $guardian_one_id_number = $data['guardian_one_id_number'];
    $guardian_one_email = $data['guardian_one_email'];
    $guardian_one_home_tel = $data['guardian_one_home_tel'];
    $guardian_one_work_tel = $data['guardian_one_work_tel'];
    $guardian_one_cellphone = $data['guardian_one_cellphone'];
    $guardian_one_company = $data['guardian_one_company'];
    $guardian_one_work_address = $data['guardian_one_work_address'];
    $guardian_two_relationship = $data['guardian_two_relationship'];
    $guardian_two_name = $data['guardian_two_name'];
    $guardian_two_home_address = $data['guardian_two_home_address'];
    $guardian_two_id_number = $data['guardian_two_id_number'];
    $guardian_two_email = $data['guardian_two_email'];
    $guardian_two_home_tel = $data['guardian_two_home_tel'];
    $guardian_two_work_tel = $data['guardian_two_work_tel'];
    $guardian_two_cellphone = $data['guardian_two_cellphone'];
    $guardian_two_company = $data['guardian_two_company'];
    $guardian_two_work_address = $data['guardian_two_work_address'];
    $reasons = $data['reasons'];
    $application_date = $data['application_date'];
    $parent_signature = $data['parent_signature'];
    $child_id = $data['child_id'];
    $full_name = $data['full_name'];
    $date_of_birth = $data['date_of_birth'];
    $grade = $data['grade'];
    $home_language = $data['home_language'];
    $religion = $data['religion'];
    $marital_status = $data['marital_status'];
    $num_children = $data['num_children'];
    $other_children_ages = $data['other_children_ages'];
    $birth_problems = $data['birth_problems'];
    $contagious_illnesses = $data['contagious_illnesses'];
    $allergies = $data['allergies'];
    $family_doctor = $data['family_doctor'];
    $morning_bringer = $data['morning_bringer'];
    $afternoon_fetcher = $data['afternoon_fetcher'];
    $emergency_contact = $data['emergency_contact'];
    $other_information = $data['other_information'];
    $previous_school = $data['previous_school'];
    $school_telephone = $data['school_telephone'];
    $indemnity_child_name = $data['indemnity_child_name'];
    $yearly_fees_months = $data['yearly_fees_months'];

    //SQL query to insert into application(Gosselin, Kokoska and Easterbrooks,2011)
    $sql = "INSERT INTO application (admission_id, admission_date, care_type, child_name, child_dob, child_age, guardian_one_relationship,guardian_one_name, guardian_one_home_address, guardian_one_id_number, guardian_one_email, guardian_one_home_tel, guardian_one_work_tel, guardian_one_cellphone, guardian_one_company, guardian_one_work_address, guardian_two_relationship,guardian_two_name, guardian_two_home_address, guardian_two_id_number, guardian_two_email, guardian_two_home_tel, guardian_two_work_tel, guardian_two_cellphone, guardian_two_company, guardian_two_work_address, reasons, application_date, parent_signature, child_id, full_name, date_of_birth, grade ,home_language, religion, marital_status, num_children, other_children_ages, birth_problems, contagious_illnesses, allergies, family_doctor, morning_bringer, afternoon_fetcher, emergency_contact, other_information, previous_school, school_telephone, indemnity_child_name, yearly_fees_months, status) VALUES ('$cid', '$admission_date', '$care_type', '$child_name', '$child_dob', '$child_age', '$guardian_one_relationship','$guardian_one_name', '$guardian_one_home_address', '$guardian_one_id_number', '$guardian_one_email', '$guardian_one_home_tel', '$guardian_one_work_tel', '$guardian_one_cellphone', '$guardian_one_company', '$guardian_one_work_address', '$guardian_two_relationship','$guardian_two_name', '$guardian_two_home_address', '$guardian_two_id_number', '$guardian_two_email', '$guardian_two_home_tel', '$guardian_two_work_tel', '$guardian_two_cellphone', '$guardian_two_company', '$guardian_two_work_address', '$reasons', '$application_date', '$parent_signature', '$child_id', '$full_name', '$date_of_birth','$grade', '$home_language', '$religion', '$marital_status', '$num_children', '$other_children_ages', '$birth_problems', '$contagious_illnesses', '$allergies', '$family_doctor', '$morning_bringer', '$afternoon_fetcher', '$emergency_contact', '$other_information', '$previous_school', '$school_telephone', '$indemnity_child_name', '$yearly_fees_months', 'pending')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

//Function to generate a unique id(Gosselin, Kokoska and Easterbrooks,2011)
function generateUniqueID($child_name)
{
    $timestamp = time();
    $child_name = str_replace(' ', '', $child_name);
    return strtolower($child_name . '_' . $timestamp);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Generate a unique ID for the application based on the child's name(Gosselin, Kokoska and Easterbrooks,2011)
    $cid = generateUniqueID($_POST['child_name']);

    //Prepare the application data from the submitted form fields(Gosselin, Kokoska and Easterbrooks,2011)
    $data = array(
        'admission_date' => $_POST['admission_date'],
        'care_type' => $_POST['care_type'],
        'child_name' => $_POST['child_name'],
        'child_dob' => $_POST['child_dob'],
        'child_age' => $_POST['child_age'],
        'guardian_one_relationship' => $_POST['guardian_one_relationship'],
        'guardian_one_name' => $_POST['guardian_one_name'],
        'guardian_one_home_address' => $_POST['guardian_one_home_address'],
        'guardian_one_id_number' => $_POST['guardian_one_id_number'],
        'guardian_one_email' => $_POST['guardian_one_email'],
        'guardian_one_home_tel' => $_POST['guardian_one_home_tel'],
        'guardian_one_work_tel' => $_POST['guardian_one_work_tel'],
        'guardian_one_cellphone' => $_POST['guardian_one_cellphone'],
        'guardian_one_company' => $_POST['guardian_one_company'],
        'guardian_one_work_address' => $_POST['guardian_one_work_address'],
        'guardian_two_relationship' => $_POST['guardian_two_relationship'],
        'guardian_two_name' => $_POST['guardian_two_name'],
        'guardian_two_home_address' => $_POST['guardian_two_home_address'],
        'guardian_two_id_number' => $_POST['guardian_two_id_number'],
        'guardian_two_email' => $_POST['guardian_two_email'],
        'guardian_two_home_tel' => $_POST['guardian_two_home_tel'],
        'guardian_two_work_tel' => $_POST['guardian_two_work_tel'],
        'guardian_two_cellphone' => $_POST['guardian_two_cellphone'],
        'guardian_two_company' => $_POST['guardian_two_company'],
        'guardian_two_work_address' => $_POST['guardian_two_work_address'],
        'reasons' => $_POST['reasons'],
        'application_date' => $_POST['application_date'],
        'parent_signature' => $_POST['parent_signature'],
        'child_id' => $_POST['child_id'],
        'full_name' => $_POST['full_name'],
        'date_of_birth' => $_POST['date_of_birth'],
        'grade' => $_POST['grade'],
        'home_language' => $_POST['home_language'],
        'religion' => $_POST['religion'],
        'marital_status' => $_POST['marital_status'],
        'num_children' => $_POST['num_children'],
        'other_children_ages' => $_POST['other_children_ages'],
        'birth_problems' => $_POST['birth_problems'],
        'contagious_illnesses' => $_POST['contagious_illnesses'],
        'allergies' => $_POST['allergies'],
        'family_doctor' => $_POST['family_doctor'],
        'morning_bringer' => $_POST['morning_bringer'],
        'afternoon_fetcher' => $_POST['afternoon_fetcher'],
        'emergency_contact' => $_POST['emergency_contact'],
        'other_information' => $_POST['other_information'],
        'previous_school' => $_POST['previous_school'],
        'school_telephone' => $_POST['school_telephone'],
        'indemnity_child_name' => $_POST['indemnity_child_name'],
        'yearly_fees_months' => $_POST['yearly_fees_months'],
    );

    //Check if the ID already exists in the SQL database(Gosselin, Kokoska and Easterbrooks,2011)
    if (isIDExists($conn, $cid)) {
        //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
        $_SESSION['success_message16'] = 'Application already submitted';
    } else {
        //Submit the application data to the SQL database(Gosselin, Kokoska and Easterbrooks,2011)
        $result = submitApplication($conn, $cid, $data);
        if ($result === true) {
            //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
            $_SESSION['success_message15'] = 'Successfully Submitted Forms.';
            //Redirecting to the index.php page on successful submission(Gosselin, Kokoska and Easterbrooks,2011)
            header("Location: index.php");
            exit();
        } else {
            //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
            $_SESSION['success_message17'] = 'Failed to submit form. Error.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Define viewport settings for responsive design(W3Schools,2023) -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <!--Include Raleway font from Google Fonts(W3Schools,2023) -->
    <link rel="stylesheet" href="CSS/style.css"> <!--Include a custom style.css stylesheet(W3Schools,2023) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!--Include Bootstrap CSS(W3Schools,2023) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!--Include Font Awesome icons(W3Schools,2023) -->
    <title>Application</title>
    <style>
        :root {
            --primary-color: rgb(11, 78, 179); /*Define a custom CSS property for the primary color(W3Schools,2023) */
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box; /*Apply box-sizing to all elements for consistent box model(W3Schools,2023) */
        }

        label {
            display: block;
            margin-bottom: 0.5rem; /*Style for form labels with a margin(W3Schools,2023) */
        }

        input {
            display: block;
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            height: 50px; /*Style for form input elements(W3Schools,2023) */
        }

        /*Mark input boxes that get an error on validation(W3Schools,2023) */
        input.invalid {
            background-color: #ffdddd;
        }

        .width-50 {
            width: 50%; /*Style class for 50% width(W3Schools,2023) */
        }

        .ml-auto {
            margin-left: auto; /*Style class for auto margin-left(W3Schools,2023) */
        }

        /*Styling the textarea(W3Schools,2023) */
        textarea {
            resize: vertical;
        }

        /*(w3schools,2023)*/
        .form {
            max-width: 1000px;
            margin: 0 auto;
            border: none;
            border-radius: 10px !important;
            overflow: hidden;
            padding: 1.5rem;
            background-color: #fff;
            padding: 20px 30px; /*Style for the form container(W3Schools,2023) */
        }

        /*Hide all steps by default(W3Schools,2023) */
        .tab {
            display: none;
        }

        .btn {
            padding: 0.75rem;
            display: block;
            text-decoration: none;
            background-color: #77d4e3;
            color: black;
            text-align: center;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: 0.3s; /*Style for buttons with a hover effect(W3Schools,2023) */
        }

        .btn:hover {
            box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2; /*Button hover effect(W3Schools,2023) */
        }

        #prevBtn {
            background-color: #bbbbbb; /*Style for the "Previous" button(W3Schools,2023) */
        }

        button#clearRadio {
            background-color: #77d4e3; /* Background color(W3Schools,2023) */
            color: black; /* Text color */
            border: 1px #41c4d8; /* Border color */
            padding: 8px 16px; /* Padding for the button(W3Schools,2023) */
            cursor: pointer; /* Cursor type */
            transition: background-color 0.3s; /* Transition effect for color change(W3Schools,2023) */
        }

        /* Hover effect for the button */
        button#clearRadio:hover {
            box-shadow: 0 0 0 2px #fff, 0 0 0 3px #41c4d8; /* Background color on hover(W3Schools,2023) */
            /* Text color on hover */
        }

        /*Make circles that indicate the steps of the form(W3Schools,2023) */
        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5; /*Styling for form step indicators(W3Schools,2023) */
        }

        .step.active {
            opacity: 1; /*Style for the active step indicator(W3Schools,2023) */
        }

        /*Mark the steps that are finished and valid(W3Schools,2023) */
        .step.finish {
            background-color: #04AA6D; /*Style for completed steps(W3Schools,2023) */
        }

        /* The container(W3Schools,2023) */
        .container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 14px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox(W3Schools,2023) */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox(W3Schools,2023) */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border: 2px solid #000; /* Add a black border to the checkbox(W3Schools,2023) */
        }

        /* On mouse-over, add a grey background color(W3Schools,2023) */
        .container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background(W3Schools,2023) */
        .container input:checked ~ .checkmark {
            background-color: #41c4d8;
        }

        /* Create the checkmark/indicator (hidden when not checked)(W3Schools,2023) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked(W3Schools,2023) */
        .container input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator(W3Schools,2023) */
        .container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        /*Responsiveness(W3Schools,2023) */
        @media (max-width: 768px) {
            .form {
                padding: 10px;
            }

            .tab {
                padding: 10px;
            }

            .btn {
                padding: 5px 10px;
            }

            Checkbox {
                background-color: #77d4e3; /*Changing color on hover(W3Schools,2023) */
            }
    </style>
</head>
<body>
<!--Top navigation bar(W3Schools,2023)-->
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->
<div class="topnav">
    <a href="index.php">Home</a>
    <a href="AboutUs.php">About Us</a>
    <a href="ExtraMurals.php">Extra Murals</a>
    <a href="Application.php">Application</a>
    <a href="Gallery.php">Gallery</a>
    <a href="Tour.php">Schedule Tour</a>
    <a href="ContactUs.php">Contact Us</a>
    <div class="dropdown">
        <button class="dropbtn">
            <i class="fa fa-fw fa-user" style="color: black"></i>
        </button>
        <div class="dropdown-content">
            <a href="Parent.php">Parent</a>
            <a href="Admin.php">Admin</a>
        </div>
    </div>
    <a href="javascript:void(0);" class="icon" onclick="toggleNav()">&#9776;</a>
</div>
<h1 style="color: black;"><u><b>APPLICATION</b></u></h1>
<br><br>

<!--Multistep form(W3Schools,2023)-->
<form action="Application.php" method="post" class="form" id="applicationForm">
    <!--One "tab" for each step in the form(W3Schools,2023) -->
    <div class="tab">
        <h2 style="text-align: center;"><b>Admission Form</b></h2>
        <!--First Form(W3Schools,2023)-->
        <br>
        <fieldset>
            <legend style="color: #41c4d8"><b>Child Information</b></legend>
            <label for="admission_date">Date on which admission is required:</label><br>
            <input type="date" id="admission_date" name="admission_date" placeholder="" readonly><br>
            <label for="care_type">Will half day or full day care be required:</label><br>
            <select id="care_type" style="width: 100%;height: 40px;font-size: 14px;" name="care_type" required>
                <option value="Half Day">Half Day</option>
                <option value="Full Day">Full Day</option>
            </select>
            <br><br>
            <label for="child_name">Surname and full names of child:</label><br>
            <input type="text" id="child_name" name="child_name" required><br>
            <label for="child_dob">Date of birth:</label><br>
            <input type="date" id="child_dob" name="child_dob" placeholder="YYYY/MM/DD" required><br>
            <label for="child_age">Age:</label><br>
            <input type="text" id="child_age" name="child_age" required><br>
        </fieldset>
        <br>
        <br>
        <fieldset>
            <legend style="color: #77d4e3"><b>Guardian One Details</b></legend>
            <label for="guardian_one_relationship">Relationship:</label><br>
            <input type="text" id="guardian_one_relationship" name="guardian_one_relationship" required><br>
            <label for="guardian_one_name">Guardian One Name:</label><br>
            <input type="text" id="guardian_one_name" name="guardian_one_name" required><br>
            <label for="guardian_one_home_address">Guardian One Home address:</label><br>
            <input type="text" id="guardian_one_home_address" name="guardian_one_home_address" required><br>
            <label for="guardian_one_id_number">Guardian One I.D. number:</label><br>
            <input type="text" id="guardian_one_id_number" name="guardian_one_id_number" required
                   oninput="validateIDNumber('guardian_one_id_number')"><br>
            <p id="guardian_one_id_number_error" style="color: red;"></p>

            <!-- Guardian Two Email address(W3Schools,2023) -->
            <label for="guardian_one_email">Guardian One Email address:</label><br>
            <input type="email" id="guardian_one_email" name="guardian_one_email" required
                   pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Enter a valid email address"><br>
            <p id="guardian_one_tel_error" style="color: red;"></p>

            <label for="guardian_one_home_tel">Guardian One Home tel number:</label><br>
            <input type="tel" id="guardian_one_home_tel" name="guardian_one_home_tel" pattern="[0-9]{10}"
                   title="Please enter a 10-digit phone number" required><br>
            <p id="guardian_one_tel_error" style="color: red;"></p>

            <label for="guardian_one_work_tel">Guardian One Work tel number:</label><br>
            <input type="tel" id="guardian_one_work_tel" name="guardian_one_work_tel" pattern="[0-9]{10}"
                   title="Please enter a 10-digit phone number" required><br>
            <p id="guardian_one_tel_error" style="color: red;"></p>

            <label for="guardian_one_cellphone">Guardian One Cellphone number:</label><br>
            <input type="tel" id="guardian_one_cellphone" name="guardian_one_cellphone" pattern="[0-9]{10}"
                   title="Please enter a 10-digit phone number" required><br>
            <p id="guardian_one_tel_error" style="color: red;"></p>

            <label for="guardian_one_company">Guardian One Name of company:</label><br>
            <input type="text" id="guardian_one_company" name="guardian_one_company" required><br>
            <label for="guardian_one_work_address">Guardian One Work address:</label><br>
            <input type="text" id="guardian_one_work_address" name="guardian_one_work_address" required><br>
        </fieldset>
        <br>
        <fieldset>
            <legend style="color: #77d4e3"><b>Guardian Two Details</b></legend>
            <label for="guardianNA" class="container">Select if there is no second guardian present
                <input type="checkbox" id="guardianNA" onclick="handleGuardianNA(this)">
                <span class="checkmark"></span>
            </label>
            <br>
            <label for="guardian_two_relationship">Relationship:</label><br>
            <input type="text" id="guardian_two_relationship" name="guardian_two_relationship" required><br>
            <label for="guardian_two_name">Guardian Two Name:</label><br>
            <input type="text" id="guardian_two_name" name="guardian_two_name" required><br>
            <label for="guardian_two_home_address">Guardian Two Home address:</label><br>
            <input type="text" id="guardian_two_home_address" name="guardian_two_home_address" required><br>
            <label for="guardian_two_id_number">Guardian Two I.D. number:</label><br>
            <input type="text" id="guardian_two_id_number" name="guardian_two_id_number" required
                   oninput="validateIDNumber('guardian_two_id_number')"><br>
            <p id="guardian_two_id_number_error" style="color: red;"></p>

            <!-- Guardian Two Email address(W3Schools,2023) -->
            <label for="guardian_two_email">Guardian Two Email address:</label><br>
            <input type="email" id="guardian_two_email" name="guardian_two_email" required
                   pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Enter a valid email address"><br>
            <p id="guardian_two_email_error" style="color: red;"></p>

            <label for="guardian_two_home_tel">Guardian Two Home tel number:</label><br>
            <input type="tel" id="guardian_two_home_tel" name="guardian_two_home_tel" pattern="[0-9]{10}"
                   title="Please enter a 10-digit phone number" required><br>
            <p id="guardian_two_tel_error" style="color: red;"></p>

            <label for="guardian_two_work_tel">Guardian Two Work tel number:</label><br>
            <input type="tel" id="guardian_two_work_tel" name="guardian_two_work_tel" pattern="[0-9]{10}"
                   title="Please enter a 10-digit phone number" required><br>
            <p id="guardian_two_tel_error" style="color: red;"></p>

            <label for="guardian_two_cellphone">Guardian Two Cellphone number:</label><br>
            <input type="tel" id="guardian_two_cellphone" name="guardian_two_cellphone" pattern="[0-9]{10}"
                   title="Please enter a 10-digit phone number" required><br>
            <p id="guardian_two_tel_error" style="color: red;"></p>

            <label for="guardian_two_company">Guardian Two Name of company:</label><br>
            <input type="text" id="guardian_two_company" name="guardian_two_company" required><br>

            <label for="guardian_two_work_address">Guardian Two Work address:</label><br>
            <input type="text" id="guardian_two_work_address" name="guardian_two_work_address" required><br>
        </fieldset>
        <fieldset>
            <label for="reasons">Reasons for requiring day care:</label>
            <textarea id="reasons" name="reasons" rows="4" cols="48" style="width: 100%"
                      placeholder="E.g., Need child supervision during work hours"></textarea>
        </fieldset>
        <fieldset>
            <label for="application_date">Date of application:</label>
            <input type="date" id="application_date" name="application_date" placeholder="YYYY/MM/DD" readonly><br>
            <label for="parent_signature">Signature of parent:</label>
            <p>Sign in the canvas below and save your signature as an image!</p>
            <canvas id="sig-canvas" width="620" height="160"
                    style="border-top: 2px solid black; border-bottom: 2px solid black;">
                Get a better browser, bro.
            </canvas>
            <br>
            <div id="error-message" class="error-message" style="display: none; color: red;font-size: 15px"></div>
            <br>
            <div style=" display: flex; justify-content: space-between;">
                <button class="btn" id="sig-clearBtn">Clear Signature</button>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <textarea id="parent_signature" name="parent_signature" class="form-control" rows="5"
                              style="display: none;"
                    >Data URL for your signature will go here!</textarea>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <img id="sig-image" src="" alt="Your signature will go here!" style="display: none;"/>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="tab">
        <h2 style="text-align: center;"><b>Registration Form</b></h2>
        <!--Second Form(W3Schools,2023) -->
        <br>
        <fieldset>
            <label for="child_id">ID of Child:</label><br>
            <input type="text" id="child_id" name="child_id" required oninput="validateIDNumber('child_id')"><br>
            <p id="child_id_error" style="color: red;"></p>
            <label for="full_name">Full Name of Child:</label>
            <input type="text" id="full_name" name="full_name" required><br>
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" placeholder="YYYY/MM/DD" required><br>
            <label for="grade">Grade:</label><br>
            <select id="grade" name="grade" style="width: 100%;height: 40px;font-size: 14px;" required>
                <option value="Babies">Babies(0-12months)</option>
                <option value="TwoToThree">Two To Three</option>
                <option value="ThreeToFour">Three To Four</option>
                <option value="GradeR">Grade R</option>
                <option value="GradeOne">Grade 1</option>
                <option value="GradeTwo">Grade 2</option>
            </select>
            <br><br>
            <label for="home_language">Home Language:</label>
            <input type="text" id="home_language" name="home_language" required><br>
            <label for="religion">Religion:</label>
            <input type="text" id="religion" name="religion" required><br>
            <label for="marital_status">Parents Marital Status:</label><br>
            <select id="marital_status" name="marital_status" style="width: 100%;height: 40px;font-size: 14px;"
                    required>
                <option value="Married">Married</option>
                <option value="Single">Single</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
            </select>
            <br><br>
            <label for="num_children">Number of Children in the Family:</label>
            <input type="number" id="num_children" name="num_children" min="1" required><br>
            <label for="other_children_ages">Other Children's Ages:</label>
            <input type="text" id="other_children_ages" name="other_children_ages" placeholder="E.g., 7, 8, 5" required><br>
            <label for="birth_problems">Mention any Problems during Birth:</label>
            <textarea id="birth_problems" name="birth_problems" rows="4" cols="50" style="width: 100%"></textarea><br>
            <label for="contagious_illnesses">Which Contagious Illnesses has the Child had already:</label>
            <textarea id="contagious_illnesses" name="contagious_illnesses" rows="4" cols="50" required
                      style="width: 100%"></textarea><br>
            <label for="allergies">Allergies (if any):</label>
            <textarea id="allergies" name="allergies" rows="4" cols="50" placeholder="E.g., Peanut Butter, Bees, N/A"
                      style="width: 100%" required></textarea><br>
            <label for="family_doctor">Name and Telephone Number of Family Doctor:</label>
            <input type="text" id="family_doctor" name="family_doctor" required><br>
            <label for="morning_bringer">Who will bring your child in the morning:</label>
            <input type="text" id="morning_bringer" name="morning_bringer" required><br>
            <label for="afternoon_fetcher">Who will fetch your child in the afternoon:</label>
            <input type="text" id="afternoon_fetcher" name="afternoon_fetcher" required><br>
            <label for="emergency_contact">Name, Address, and Telephone Number of a person to contact in case of
                emergency:</label>
            <textarea id="emergency_contact" name="emergency_contact" rows="4" cols="48" style="width: 100%"
                      required></textarea><br>
            <label for="other_information">Any Other Important Information:</label>
            <textarea id="other_information" name="other_information" rows="4" cols="48" style="width: 100%"
                      placeholder="e.g., medical conditions such as autism and dyslexia" required></textarea><br>
            <label for="previous_school">Previous School Name:</label>
            <input type="text" id="previous_school" name="previous_school" required><br>
            <label for="school_telephone">Telephone Number:</label>
            <input type="tel" id="school_telephone" name="school_telephone" pattern="[0-9]{10}"
                   title="Please enter a 10-digit phone number" required><br>
        </fieldset>
    </div>
    <div class="tab">
        <h2 style="text-align: center;"><b>Indemnity Form</b></h2>
        <!--Third Form(W3Schools,2023)-->
        <br>
        <fieldset>
            <label for="indemnity_child_name">Name of Child:</label>
            <input type="text" id="indemnity_child_name" name="indemnity_child_name" required><br>
            <p style="text-align: justify; text-justify: inter-word;">I, the undersigned, hereby do agree that my
                child/children’s’ school fees will be paid in full by the 1st of each month.
                I also understand that should I wish to remove my child/children from Just Love, written notice of a
                minimum
                of two months is required. If notice is not tendered I am aware that the fees for the period will still
                be
                due.
                Whilst every care and attention will be given to the children and all the necessary precautions will be
                taken, Just Love cannot be held responsible for any injury to my child.
                I agree to my child being taken on excursions by Just Love and am fully aware that neither Just Love nor
                the
                person in charge can be held responsible for injury to my child.
                In the event that I cannot be reached, I hereby give my permission for my child to receive any necessary
                medical care or treatment. I understand that every effort will be made to contact my spouse or me before
                such action is taken. I will be responsible for the payment for such care or treatment.
                We endeavor to open all school holidays but go on demand over the festive season.
                I agree to allow any photos that are taken at school to be posted on our Facebook page and/or web
                page.</p>
            <label for="yearly_fees_months">Choose the number of months for yearly fees:</label>
            <select id="yearly_fees_months" name="yearly_fees_months" style="width: 100%;height: 40px;font-size: 14px;"
                    required>
                <option value="12">12 months</option>
                <option value="11">11 months</option>
                <option value="10">10 months</option>
            </select><br>
        </fieldset>
    </div>
    <div>
        <div style="float:right;">
            <button type="button" id="prevBtn" class="btn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" id="nextBtn" class="btn" onclick="nextPrev(1)">Next</button>
            <br><br>
            <input type="submit" value="Submit" id="submit-form" class="btn" style="display: none;">
        </div>
    </div>
    <!--Circles which indicate the steps of the form(W3Schools,2023) -->
    <div style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
</form>
<script>
    //Function to toggle navigation menu(W3Schools,2023)
    function toggleNav() {
        var nav = document.getElementsByClassName("topnav")[0];
        if (nav.className === "topnav") {
            nav.className += " responsive";
        } else {
            nav.className = "topnav";
        }
    }

    //Showcasing active link(W3Schools,2023)
    document.addEventListener("DOMContentLoaded", function () {
        const currentPage = window.location.pathname.split('/').pop().split('.php')[0];
        const navLinks = document.querySelectorAll(".topnav a");
        for (const link of navLinks) {
            if (link.getAttribute("href") === currentPage + ".php") {
                link.classList.add("active");
            }
        }
    });
    //Get the element with the ID 'child_dob' and store it in the dobInput variable(W3Schools,2023)
    const dobInput = document.getElementById('child_dob');
    //Get the element with the ID 'child_age' and store it in the ageField variable(W3Schools,2023)
    const ageField = document.getElementById('child_age');

    //Add an event listener to the 'dobInput' element that listens for 'input' events and calls the 'calculateAge' function(W3Schools,2023)
    dobInput.addEventListener('input', calculateAge);

    //Function to calculate age based on date of birth(W3Schools,2023)
    function calculateAge() {
        const dob = new Date(dobInput.value);
        const now = new Date();
        let ageInYears = now.getFullYear() - dob.getFullYear(); //Calculate age in years(W3Schools,2023)
        let ageInMonths = now.getMonth() - dob.getMonth(); //Calculate the difference in months(W3Schools,2023)
        if (now.getDate() < dob.getDate()) {
            ageInMonths--; //Adjust the months if the current day is before the birthdate day(W3Schools,2023)
        }
        //Check if the age is negative and adjust accordingly(W3Schools,2023)
        if (ageInMonths < 0 || (ageInMonths === 0 && ageInYears === 0)) {
            ageInYears = 0; //Set years to 0 if the calculated age is negative or zero(W3Schools,2023)
            ageInMonths = 0; //Set months to 0 if the calculated age is negative or zero(W3Schools,2023)
        }
        //Display the calculated age dynamically(W3Schools,2023)
        if (ageInYears === 0) {
            ageField.value = Math.max(0, ageInMonths) + " Months"; //Show 0 if months are negative(W3Schools,2023)
        } else {
            ageField.value = Math.max(0, ageInYears) + " Years"; //Show 0 if years are negative(W3Schools,2023)
        }
    }

    //Get the current year(W3Schools,2023)
    const currentYear = new Date().getFullYear();

    //Set the max attribute for the input field to the last day of the current year(W3Schools,2023)
    document.getElementById('child_dob').max = `${currentYear}-12-31`;

    //Get the current date(W3Schools,2023)
    var currentDate = new Date();

    //Format the date as YYYY-MM-DD(W3Schools,2023)
    var year = currentDate.getFullYear();
    var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
    var day = currentDate.getDate().toString().padStart(2, '0');
    var formattedDate = year + '-' + month + '-' + day;

    //Set the input value to the current date(W3Schools,2023)
    document.getElementById('admission_date').value = formattedDate;
    document.getElementById('application_date').value = formattedDate;

    //Get the element with the ID 'child_name' and store it in the 'childNameFieldForm1' variable(W3Schools,2023)
    const childNameFieldForm1 = document.getElementById('child_name');

    //Get the element with the ID 'full_name' and store it in the 'fullNameFieldForm2' variable(W3Schools,2023)
    const fullNameFieldForm2 = document.getElementById('full_name');

    //Get the element with the ID 'indemnity_child_name' and store it in the 'fullNameFieldForm2' variable(W3Schools,2023)
    const indemnityChildNameFieldForm3 = document.getElementById('indemnity_child_name');

    //Add an event listener to track changes in Form 1(W3Schools,2023)
    childNameFieldForm1.addEventListener('input', populateFields);

    //Function to populate the fields in Form 2 and Indemnity Form(W3Schools,2023)
    function populateFields() {
        const childNameValue = childNameFieldForm1.value; //Get the value from Form 1(W3Schools,2023)
        //Populate the Full Name field in Form 2(W3Schools,2023)
        fullNameFieldForm2.value = childNameValue;
        //Populate the Name of Child field in the Indemnity Form(W3Schools,2023)
        indemnityChildNameFieldForm3.value = childNameValue;
    }

    //Get the element with the ID 'child_dob' and store it in the 'DOBFieldForm1' variable(W3Schools,2023)
    const DOBFieldForm1 = document.getElementById('child_dob');
    //Get the element with the ID 'date_of_birth' and store it in the 'registrationFieldForm2' variable(W3Schools,2023)
    const registrationFieldForm2 = document.getElementById('date_of_birth');

    //Add an event listener to track changes in Form 1(W3Schools,2023)
    DOBFieldForm1.addEventListener('input', populateFields2);

    //Function to populate the fields in Form 2(W3Schools,2023)
    function populateFields2() {
        //Populate the Full Name field in Form 2 with the value of DOBFieldForm1(W3Schools,2023)
        registrationFieldForm2.value = DOBFieldForm1.value;
    }

    var currentTab = 0; //Current tab is set to be the first tab (0)(W3Schools,2023)
    showTab(currentTab); //Display the current tab(W3Schools,2023)

    //Function to show tabs(W3Schools,2023)
    function showTab(n) {
        //This function will display the specified tab of the form(W3Schools,2023)
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //Fix the Previous/Next buttons:
        if (n === 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n === (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //Run a function that will display the correct step indicator(W3Schools,2023)
        fixStepIndicator(n);
    }

    //Function to figure out which tab should be displayed(W3Schools,2023)
    function nextPrev(n) {
        //This function will figure out which tab to display(W3Schools,2023)
        var x = document.getElementsByClassName("tab");
        //Exit the function if any field in the current tab is invalid(W3Schools,2023)
        if (n === 1 && !validateForm()) return false;
        //Hide the current tab(W3Schools,2023)
        x[currentTab].style.display = "none";
        //Increase or decrease the current tab by 1(W3Schools,2023)
        currentTab = currentTab + n;
        //If one have reached the end of the form(W3Schools,2023)
        if (currentTab >= x.length) {
            //Form gets submitted(W3Schools,2023)
            document.getElementById("applicationForm").submit();
            return false;
        }
        //Otherwise, the correct tab will be displayed(W3Schools,2023)
        showTab(currentTab);
    }

    //Function to validate form(W3Schools,2023)
    function validateForm() {
        //This function deals with validation of the form fields(W3Schools,2023)
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        //Initialize an error message element
        var errorMessage = document.getElementById("error-message");
        //A loop that checks every input field in the current tab(W3Schools,2023)
        for (i = 0; i < y.length; i++) {
            // If a field is empty(W3Schools,2023)
            if (y[i].value === "") {
                //Add an "invalid" class to the field(W3Schools,2023)
                y[i].className += " invalid";
                //Set the current valid status to false(W3Schools,2023)
                valid = false;
            }
        }

        //Check if the signature field is empty(Guo, N/A)
        var sigImage = document.getElementById("sig-image");
        if (sigImage.getAttribute("src") === "") {
            //Display an error message
            errorMessage.style.display = "block";
            errorMessage.innerHTML = "Please provide your signature.";
            valid = false;
        } else {
            //Hide the error message if the signature is provided(Guo, N/A)
            errorMessage.style.display = "none";
        }
        //If the valid status is true, mark the step as finished and valid(Guo, N/A)
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; //Return the valid status(W3Schools,2023)
    }

    //Function to fix step indicator(W3Schools,2023)
    function fixStepIndicator(n) {
        //This function removes the "active" class of all steps(W3Schools,2023)
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //Adds the "active" class on the current step(W3Schools,2023)
        x[n].className += " active";
    }

    //Function for radio buttons guardian one and guardian two to populate those fields with N/A(W3Schools,2023)
    function handleGuardianNA(checkbox) {
        if (checkbox.checked) {
            // Replace 'guardian_two_' with the appropriate prefix for your Guardian Two fields in the database(W3Schools,2023)
            var guardianTwoFields = document.querySelectorAll("[id^='guardian_two_']");
            guardianTwoFields.forEach(function (element) {
                element.value = 'N/A';
            });
        } else {
            var guardianTwoFields = document.querySelectorAll("[id^='guardian_two_']");
            guardianTwoFields.forEach(function (element) {
                element.value = '';
            });
        }
    }

    //Function to clear check box(W3Schools,2023)
    function clearCheckboxSelection() {
        document.getElementById('guardianNA').checked = false;
        // Clear the Guardian Two fields when the checkbox is cleared
        var guardianTwoFields = document.querySelectorAll("[id^='guardian_two_']");
        guardianTwoFields.forEach(function (element) {
            element.value = '';
        });
    }

    //Creating an immediately-invoked function expression (IIFE) to encapsulate your code(Guo, N/A)
    (function () {
        //Defining the 'requestAnimFrame' function to request animation frames(Guo, N/A)
        window.requestAnimFrame = (function (callback) {
            return (
                window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                window.oRequestAnimationFrame ||
                window.msRequestAnimaitonFrame ||
                function (callback) {
                    window.setTimeout(callback, 1000 / 60);
                }
            );
        })();
        //Getting the canvas element with the ID 'sig-canvas' and its 2D rendering context(Guo, N/A)
        var canvas = document.getElementById("sig-canvas");
        var ctx = canvas.getContext("2d");
        //Setting the stroke style and line width for drawing on the canvas(Guo, N/A)
        ctx.strokeStyle = "#222222";
        ctx.lineWidth = 4;
        //Setting a white background(Guo, N/A)
        ctx.fillStyle = "#ffffff";
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        var drawing = false;
        var mousePos = {
            x: 0,
            y: 0
        };
        var lastPos = mousePos;
        canvas.addEventListener("mousedown", function (e) {
            drawing = true;
            lastPos = getMousePos(canvas, e);
        }, false);
        canvas.addEventListener("mouseup", function (e) {
            drawing = false;
        }, false);
        canvas.addEventListener("mousemove", function (e) {
            mousePos = getMousePos(canvas, e);
            renderCanvas();
        }, false);
        //Adding touch event support for mobile(Guo, N/A)
        canvas.addEventListener("touchstart", function (e) {
            drawing = true;
            mousePos = getTouchPos(canvas, e);
            var touch = e.touches[0];
            var me = new MouseEvent("mousedown", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(me);
        }, false);
        canvas.addEventListener("touchmove", function (e) {
            var touch = e.touches[0];
            var me = new MouseEvent("mousemove", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(me);
        }, false);
        canvas.addEventListener("touchend", function (e) {
            var me = new MouseEvent("mouseup", {});
            canvas.dispatchEvent(me);
        }, false);

        function getMousePos(canvasDom, mouseEvent) {
            var rect = canvasDom.getBoundingClientRect();
            return {
                x: mouseEvent.clientX - rect.left,
                y: mouseEvent.clientY - rect.top
            };
        }

        function getTouchPos(canvasDom, touchEvent) {
            var rect = canvasDom.getBoundingClientRect();
            return {
                x: touchEvent.touches[0].clientX - rect.left,
                y: touchEvent.touches[0].clientY - rect.top
            };
        }

        function renderCanvas() {
            if (drawing) {
                ctx.moveTo(lastPos.x, lastPos.y);
                ctx.lineTo(mousePos.x, mousePos.y);
                ctx.stroke();
                lastPos = mousePos;
                updateTextArea();
            }
        }

        //Function to update parent signature text area when canvas is signed(Guo, N/A)
        function updateTextArea() {
            var dataUrl = canvas.toDataURL("image/jpeg", 0.8);
            sigText.innerHTML = dataUrl;
            sigImage.setAttribute("src", dataUrl);
        }

        //Preventing scrolling when touching the canvas(Guo, N/A)
        document.body.addEventListener("touchstart", function (e) {
            if (e.target === canvas) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchend", function (e) {
            if (e.target === canvas) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchmove", function (e) {
            if (e.target === canvas) {
                e.preventDefault();
            }
        }, false);
        //Function to draw loop(Guo, N/A)
        (function drawLoop() {
            requestAnimFrame(drawLoop);
            renderCanvas();
        })();

        //Function to clear canvas(Guo, N/A)
        function clearCanvas() {
            canvas.width = canvas.width;
            //Setting a white background after clearing(Guo, N/A)
            ctx.fillStyle = "#ffffff";
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            sigText.innerHTML = "Data URL for your signature will go here!";
            sigImage.setAttribute("src", "");
        }

        //Setting up the UI(Guo, N/A)
        var sigText = document.getElementById("parent_signature");
        var sigImage = document.getElementById("sig-image");
        var clearBtn = document.getElementById("sig-clearBtn");
        var submitBtn = document.getElementById("sig-submitBtn");
        //Clear canvas button(Guo, N/A)
        clearBtn.addEventListener("click", function (e) {
            clearCanvas();
        }, false);
    })();

    function validateIDNumber(inputId) {
        var idNumberInput = document.getElementById(inputId);
        var errorElementId = inputId + '_error';
        var errorElement = document.getElementById(errorElementId);
        if (idNumberInput.value.length !== 13) {
            errorElement.textContent = 'ID number must be 13 characters long.';
        } else {
            errorElement.textContent = '';
        }
    }

    function setupEmailValidation(inputTel) {
        var emailInput = document.getElementById(inputTel);
        var errorElementId = inputTel + '_error';
        var errorElement = document.getElementById(errorElementId);
        emailInput.addEventListener('input', function () {
            if (emailInput.validity.valid) {
                errorElement.textContent = '';
            } else {
                errorElement.textContent = 'Enter a valid email address.';
            }
        });
    }

    //Set up email validation for Guardian One(W3Schools,2023)
    setupEmailValidation('guardian_one_email');
    //Set up email validation for Guardian Two(W3Schools,2023)
    setupEmailValidation('guardian_two_email');

    function validateTelNumber(inputTel) {
        var telInput = document.getElementById(inputTel);
        var errorElementTel = inputTel + '_error';
        var errorElement = document.getElementById(errorElementTel);
        if (telInput.value.length !== 10) {
            errorElement.textContent = 'Tel number must be 10-digits long.';
        } else {
            errorElement.textContent = '';
        }
    }

    function setupTelValidation(telInput) {
        var telInput = document.getElementById(telInput);
        var errorElementTel = telInput + '_error';
        var errorElement = document.getElementById(errorElementTel);
        telInput.addEventListener('input', function () {
            if (telInput.validity.valid) {
                errorElement.textContent = '';
            } else {
                errorElement.textContent = 'Enter a valid telephone number.';
            }
        });
    }

    //Set up tel validation for Guardian One(W3Schools,2023)
    setupEmailValidation('guardian_one_tel');
    //Set up tel validation for Guardian Two(W3Schools,2023)
    setupEmailValidation('guardian_two_tel');
</script>
</body>
</html>