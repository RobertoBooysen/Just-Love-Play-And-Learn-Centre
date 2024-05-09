<?php
//(Gosselin, Kokoska and Easterbrooks,2011)
global $conn;
require_once 'DBConn.php';

//Checking if the user is authenticated
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    //Redirecting to the AdminLogin.php page if not authenticated
    header("Location: AdminLogin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Handling form submission for editing and approving applications
    //Retrieving and sanitizing form data
    //(Gosselin, Kokoska and Easterbrooks,2011)

    $childName = mysqli_real_escape_string($conn, $_POST['child_name']);
    $admissionDate = mysqli_real_escape_string($conn, $_POST['admission_date']);
    $careType = mysqli_real_escape_string($conn, $_POST['care_type']);
    $childDOB = mysqli_real_escape_string($conn, $_POST['child_dob']);
    $childAge = mysqli_real_escape_string($conn, $_POST['child_age']);
    $guardianOneRelationship = mysqli_real_escape_string($conn, $_POST['guardian_one_relationship']);
    $guardianOneName = mysqli_real_escape_string($conn, $_POST['guardian_one_name']);
    $guardianOneHomeAddress = mysqli_real_escape_string($conn, $_POST['guardian_one_home_address']);
    $guardianOneIDNumber = mysqli_real_escape_string($conn, $_POST['guardian_one_id_number']);
    $guardianOneEmail = mysqli_real_escape_string($conn, $_POST['guardian_one_email']);
    $guardianOneHomeTel = mysqli_real_escape_string($conn, $_POST['guardian_one_home_tel']);
    $guardianOneWorkTel = mysqli_real_escape_string($conn, $_POST['guardian_one_work_tel']);
    $guardianOneCellphone = mysqli_real_escape_string($conn, $_POST['guardian_one_cellphone']);
    $guardianOneCompany = mysqli_real_escape_string($conn, $_POST['guardian_one_company']);
    $guardianOneWorkAddress = mysqli_real_escape_string($conn, $_POST['guardian_one_work_address']);
    $guardianTwoRelationship = mysqli_real_escape_string($conn, $_POST['guardian_two_relationship']);
    $guardianTwoName = mysqli_real_escape_string($conn, $_POST['guardian_two_name']);
    $guardianTwoHomeAddress = mysqli_real_escape_string($conn, $_POST['guardian_two_home_address']);
    $guardianTwoIDNumber = mysqli_real_escape_string($conn, $_POST['guardian_two_id_number']);
    $guardianTwoEmail = mysqli_real_escape_string($conn, $_POST['guardian_two_email']);
    $guardianTwoHomeTel = mysqli_real_escape_string($conn, $_POST['guardian_two_home_tel']);
    $guardianTwoWorkTel = mysqli_real_escape_string($conn, $_POST['guardian_two_work_tel']);
    $guardianTwoCellphone = mysqli_real_escape_string($conn, $_POST['guardian_two_cellphone']);
    $guardianTwoCompany = mysqli_real_escape_string($conn, $_POST['guardian_two_company']);
    $guardianTwoWorkAddress = mysqli_real_escape_string($conn, $_POST['guardian_two_work_address']);
    $reasons = mysqli_real_escape_string($conn, $_POST['reasons']);
    $applicationDate = mysqli_real_escape_string($conn, $_POST['application_date']);
    $parentSignature = mysqli_real_escape_string($conn, $_POST['parent_signature']);
    $childID = mysqli_real_escape_string($conn, $_POST['child_id']);
    $fullName = mysqli_real_escape_string($conn, $_POST['full_name']);
    $dateOfBirth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $homeLanguage = mysqli_real_escape_string($conn, $_POST['home_language']);
    $religion = mysqli_real_escape_string($conn, $_POST['religion']);
    $maritalStatus = mysqli_real_escape_string($conn, $_POST['marital_status']);
    $numChildren = mysqli_real_escape_string($conn, $_POST['num_children']);
    $otherChildrenAges = mysqli_real_escape_string($conn, $_POST['other_children_ages']);
    $birthProblems = mysqli_real_escape_string($conn, $_POST['birth_problems']);
    $contagiousIllnesses = mysqli_real_escape_string($conn, $_POST['contagious_illnesses']);
    $allergies = mysqli_real_escape_string($conn, $_POST['allergies']);
    $familyDoctor = mysqli_real_escape_string($conn, $_POST['family_doctor']);
    $morningBringer = mysqli_real_escape_string($conn, $_POST['morning_bringer']);
    $afternoonFetcher = mysqli_real_escape_string($conn, $_POST['afternoon_fetcher']);
    $emergencyContact = mysqli_real_escape_string($conn, $_POST['emergency_contact']);
    $otherInformation = mysqli_real_escape_string($conn, $_POST['other_information']);
    $previousSchool = mysqli_real_escape_string($conn, $_POST['previous_school']);
    $schoolTelephone = mysqli_real_escape_string($conn, $_POST['school_telephone']);
    $indemnityChildName = mysqli_real_escape_string($conn, $_POST['indemnity_child_name']);
    $yearlyFeesMonths = mysqli_real_escape_string($conn, $_POST['yearly_fees_months']);


    //Constructing and executing the SQL query to update the application data
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $sql = "UPDATE application SET
        admission_date = '$admissionDate',
        care_type = '$careType',
        child_dob = '$childDOB',
        child_age = '$childAge',
        guardian_one_relationship = '$guardianOneRelationship',
        guardian_one_name = '$guardianOneName',
        guardian_one_home_address = '$guardianOneHomeAddress',
        guardian_one_id_number = '$guardianOneIDNumber',
        guardian_one_email = '$guardianOneEmail',
        guardian_one_home_tel = '$guardianOneHomeTel',
        guardian_one_work_tel = '$guardianOneWorkTel',
        guardian_one_cellphone = '$guardianOneCellphone',
        guardian_one_company = '$guardianOneCompany',
        guardian_one_work_address = '$guardianOneWorkAddress',
        guardian_two_relationship = '$guardianTwoRelationship',
        guardian_two_name = '$guardianTwoName',
        guardian_two_home_address = '$guardianTwoHomeAddress',
        guardian_two_id_number = '$guardianTwoIDNumber',
        guardian_two_email = '$guardianTwoEmail',
        guardian_two_home_tel = '$guardianTwoHomeTel',
        guardian_two_work_tel = '$guardianTwoWorkTel',
        guardian_two_cellphone = '$guardianTwoCellphone',
        guardian_two_company = '$guardianTwoCompany',
        guardian_two_work_address = '$guardianTwoWorkAddress',
        reasons = '$reasons',
        application_date = '$applicationDate',
        parent_signature = '$parentSignature',
        child_id = '$childID',
        full_name = '$fullName',
        date_of_birth = '$dateOfBirth',
        home_language = '$homeLanguage',
        grade = '$grade',
        religion = '$religion',
        marital_status = '$maritalStatus',
        num_children = '$numChildren',
        other_children_ages = '$otherChildrenAges',
        birth_problems = '$birthProblems',
        contagious_illnesses = '$contagiousIllnesses',
        allergies = '$allergies',
        family_doctor = '$familyDoctor',
        morning_bringer = '$morningBringer',
        afternoon_fetcher = '$afternoonFetcher',
        emergency_contact = '$emergencyContact',
        other_information = '$otherInformation',
        previous_school = '$previousSchool',
        school_telephone = '$schoolTelephone',
        indemnity_child_name = '$indemnityChildName',
        yearly_fees_months = '$yearlyFeesMonths'
    WHERE child_name = '$childName'";

    if (mysqli_query($conn, $sql)) {
        //Redirect back to the application list page after editing and approving
        //(Gosselin, Kokoska and Easterbrooks,2011)
        header("Location: ApproveApplicationsTable.php");
        exit();
    } else {
        //Update failed
        echo "Application update failed: " . mysqli_error($conn);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['child_name'])) {
    //Get the child name from the query parameter
    $childName = mysqli_real_escape_string($conn, $_GET['child_name']);

    //Construct and execute the SQL query to fetch the application data
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $sql = "SELECT * FROM application WHERE child_name = '$childName'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $applicationData = mysqli_fetch_assoc($result);
    } else {
        //Application not found
        echo "Application not found.";
    }
} else {
    //Invalid request
    header("Location: ApproveApplicationsTable.php");
    exit();
}

//Close the database connection when done
//(Gosselin, Kokoska and Easterbrooks,2011)
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Set the viewport for responsive design -->
    <!--(W3Schools,2023-->
    <link rel="stylesheet" href="CSS/admin.css"> <!-- Include a custom admin.css stylesheet -->

    <title>Edit Approve Application</title>
</head>
<style>
    /* Define CSS custom properties */
    /*(W3Schools,2023)*/
    :root {
        --primary-color: rgb(11, 78, 179);
    }

    /* Apply box-sizing to all elements */
    /*(W3Schools,2023)*/
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
    input {
        display: block;
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        height: 50px;
    }

    /* CSS class for setting width to 50% */
    /*(W3Schools,2023)*/
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
    /*(W3Schools,2023)*/
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

    .exit-button:hover {
        background-color: #41c4d8;
        color: black;
    }
</style>
<body>
<!--(W3Schools,2023-->
<!--Exit Button that returns the user to the approve applications table-->
<button class="exit-button" onclick="exitPage()">Exit</button>
<br>

<h1 style="text-align: center">Edit Application</h1>

<form method="post" action="EditApproveApplication.php" class="form">
    <!--Displaying approved application details in form for admin to update-->
    <!--(W3Schools,2023-->
    <input type="hidden" name="child_name" value="<?php echo $applicationData['child_name']; ?>">
    <label for="admission_date">Admission Date:</label>
    <input type="text" name="admission_date" id="admission_date"
           value="<?php echo $applicationData['admission_date']; ?>">
    <br>

    <label for="care_type">Care Type:</label>
    <input type="text" name="care_type" id="care_type" value="<?php echo $applicationData['care_type']; ?>">
    <br>

    <label for="child_dob">Child Date of Birth:</label>
    <input type="text" name="child_dob" id="child_dob" value="<?php echo $applicationData['child_dob']; ?>">
    <br>

    <label for="child_age">Child Age:</label>
    <input type="text" name="child_age" id="child_age" value="<?php echo $applicationData['child_age']; ?>">
    <br>

    <label for="guardian_one_relationship">Guardian One's Relationship:</label>
    <input type="text" name="guardian_one_relationship" id="guardian_one_relationship"
           value="<?php echo $applicationData['guardian_one_relationship']; ?>">
    <br>

    <label for="guardian_one_name">Guardian One's Name:</label>
    <input type="text" name="guardian_one_name" id="guardian_one_name"
           value="<?php echo $applicationData['guardian_one_name']; ?>">
    <br>

    <label for="guardian_one_home_address">Guardian One's Home Address:</label>
    <input type="text" name="guardian_one_home_address" id="guardian_one_home_address"
           value="<?php echo $applicationData['guardian_one_home_address']; ?>">
    <br>

    <label for="guardian_one_id_number">Guardian One's ID Number:</label>
    <input type="text" name="guardian_one_id_number" id="guardian_one_id_number"
           value="<?php echo $applicationData['guardian_one_id_number']; ?>">
    <br>

    <label for="guardian_one_email">Guardian One's Email:</label>
    <input type="text" name="guardian_one_email" id="guardian_one_email"
           value="<?php echo $applicationData['guardian_one_email']; ?>">
    <br>
    <!--(W3Schools,2023-->
    <label for="guardian_one_home_tel">Guardian One's Home Telephone:</label>
    <input type="text" name="guardian_one_home_tel" id="guardian_one_home_tel"
           value="<?php echo $applicationData['guardian_one_home_tel']; ?>">
    <br>

    <label for="guardian_one_work_tel">Guardian One's Work Telephone:</label>
    <input type="text" name="guardian_one_work_tel" id="guardian_one_work_tel"
           value="<?php echo $applicationData['guardian_one_work_tel']; ?>">
    <br>

    <label for="guardian_one_cellphone">Guardian One's Cellphone:</label>
    <input type="text" name="guardian_one_cellphone" id="guardian_one_cellphone"
           value="<?php echo $applicationData['guardian_one_cellphone']; ?>">
    <br>

    <label for="guardian_one_company">Guardian One's Company:</label>
    <input type="text" name="guardian_one_company" id="guardian_one_company"
           value="<?php echo $applicationData['guardian_one_company']; ?>">
    <br>
    <!--(W3Schools,2023-->
    <label for="guardian_one_work_address">Guardian One's Work Address:</label>
    <input type="text" name="guardian_one_work_address" id="guardian_one_work_address"
           value="<?php echo $applicationData['guardian_one_work_address']; ?>">
    <br>

    <label for="guardian_two_relationship">Guardian Two's Relationship:</label>
    <input type="text" name="guardian_two_relationship" id="guardian_two_relationship"
           value="<?php echo $applicationData['guardian_two_relationship']; ?>">
    <br>

    <label for="guardian_two_name">Guardian Two's Name:</label>
    <input type="text" name="guardian_two_name" id="guardian_two_name"
           value="<?php echo $applicationData['guardian_two_name']; ?>">
    <br>

    <label for="guardian_two_home_address">Guardian Two's Home Address:</label>
    <input type="text" name="guardian_two_home_address" id="guardian_two_home_address"
           value="<?php echo $applicationData['guardian_two_home_address']; ?>">
    <br>

    <label for="guardian_two_id_number">Guardian Two's ID Number:</label>
    <input type="text" name="guardian_two_id_number" id="guardian_two_id_number"
           value="<?php echo $applicationData['guardian_two_id_number']; ?>">
    <br>

    <label for="guardian_two_email">Guardian Two's Email:</label>
    <input type="text" name="guardian_two_email" id="guardian_two_email"
           value="<?php echo $applicationData['guardian_two_email']; ?>">
    <br>

    <label for="guardian_two_home_tel">Guardian Two's Home Telephone:</label>
    <input type="text" name="guardian_two_home_tel" id="guardian_two_home_tel"
           value="<?php echo $applicationData['guardian_two_home_tel']; ?>">
    <br>

    <label for="guardian_two_work_tel">Guardian Two's Work Telephone:</label>
    <input type="text" name="guardian_two_work_tel" id="guardian_two_work_tel"
           value="<?php echo $applicationData['guardian_two_work_tel']; ?>">
    <br>

    <label for="guardian_two_cellphone">Guardian Two's Cellphone:</label>
    <input type="text" name="guardian_two_cellphone" id="guardian_two_cellphone"
           value="<?php echo $applicationData['guardian_two_cellphone']; ?>">
    <br>

    <label for="guardian_two_company">Guardian Two's Company:</label>
    <input type="text" name="guardian_two_company" id="guardian_two_company"
           value="<?php echo $applicationData['guardian_two_company']; ?>">
    <br>

    <label for="guardian_two_work_address">Guardian Two's Work Address:</label>
    <input type="text" name="guardian_two_work_address" id="guardian_two_work_address"
           value="<?php echo $applicationData['guardian_two_work_address']; ?>">
    <br>

    <label for="reasons">Reasons:</label>
    <input type="text" name="reasons" id="reasons" value="<?php echo $applicationData['reasons']; ?>">
    <br>

    <label for="application_date">Application Date:</label>
    <input type="text" name="application_date" id="application_date"
           value="<?php echo $applicationData['application_date']; ?>">
    <br>

    <label for="parent_signature">Parent Signature:</label>
    <input type="text" name="parent_signature" id="parent_signature"
           value="<?php echo $applicationData['parent_signature']; ?>">
    <br>

    <label for="child_id">Child ID:</label>
    <input type="text" name="child_id" id="child_id" value="<?php echo $applicationData['child_id']; ?>">
    <br>

    <label for="full_name">Full Name:</label>
    <input type="text" name="full_name" id="full_name" value="<?php echo $applicationData['full_name']; ?>">
    <br>

    <label for="date_of_birth">Date of Birth:</label>
    <input type="text" name="date_of_birth" id="date_of_birth"
           value="<?php echo $applicationData['date_of_birth']; ?>">
    <br>

    <label for="date_of_birth">Grade:</label>
    <input type="text" name="grade" id="grade"
           value="<?php echo $applicationData['grade']; ?>">
    <br>

    <label for="home_language">Home Language:</label>
    <input type="text" name="home_language" id="home_language"
           value="<?php echo $applicationData['home_language']; ?>">
    <br>

    <label for="religion">Religion:</label>
    <input type="text" name="religion" id="religion" value="<?php echo $applicationData['religion']; ?>">
    <br>

    <label for="marital_status">Marital Status:</label>
    <input type="text" name="marital_status" id="marital_status"
           value="<?php echo $applicationData['marital_status']; ?>">
    <br>

    <label for="num_children">Number of Children:</label>
    <input type="text" name="num_children" id="num_children"
           value="<?php echo $applicationData['num_children']; ?>">
    <br>

    <label for="other_children_ages">Other Children Ages:</label>
    <input type="text" name="other_children_ages" id="other_children_ages"
           value="<?php echo $applicationData['other_children_ages']; ?>">
    <br>

    <label for="birth_problems">Birth Problems:</label>
    <input type="text" name="birth_problems" id="birth_problems"
           value="<?php echo $applicationData['birth_problems']; ?>">
    <br>

    <label for="contagious_illnesses">Contagious Illnesses:</label>
    <input type="text" name="contagious_illnesses" id="contagious_illnesses"
           value="<?php echo $applicationData['contagious_illnesses']; ?>">
    <br>

    <label for="allergies">Allergies:</label>
    <input type="text" name="allergies" id="allergies" value="<?php echo $applicationData['allergies']; ?>">
    <br>

    <label for="family_doctor">Family Doctor:</label>
    <input type="text" name="family_doctor" id="family_doctor"
           value="<?php echo $applicationData['family_doctor']; ?>">
    <br>

    <label for="morning_bringer">Morning Bringer:</label>
    <input type="text" name="morning_bringer" id="morning_bringer"
           value="<?php echo $applicationData['morning_bringer']; ?>">
    <br>

    <label for="afternoon_fetcher">Afternoon Fetcher:</label>
    <input type="text" name="afternoon_fetcher" id="afternoon_fetcher"
           value="<?php echo $applicationData['afternoon_fetcher']; ?>">
    <br>

    <label for="emergency_contact">Emergency Contact:</label>
    <input type="text" name="emergency_contact" id="emergency_contact"
           value="<?php echo $applicationData['emergency_contact']; ?>">
    <br>

    <label for="other_information">Other Information:</label>
    <input type="text" name="other_information" id="other_information"
           value="<?php echo $applicationData['other_information']; ?>">
    <br>

    <label for="previous_school">Previous School:</label>
    <input type="text" name="previous_school" id="previous_school"
           value="<?php echo $applicationData['previous_school']; ?>">
    <br>

    <label for="school_telephone">School Telephone:</label>
    <input type="text" name="school_telephone" id="school_telephone"
           value="<?php echo $applicationData['school_telephone']; ?>">
    <br>

    <label for="indemnity_child_name">Indemnity Child Name:</label>
    <input type="text" name="indemnity_child_name" id="indemnity_child_name"
           value="<?php echo $applicationData['indemnity_child_name']; ?>">
    <br>
    <!--(W3Schools,2023-->
    <label for="yearly_fees_months">Choose the number of months for yearly fees:</label>
    <select style="width: 100%;height: 40px;font-size: 14px; " id="yearly_fees_months" name="yearly_fees_months" required>
        <option value="12">12 months</option>
        <option value="11">11 months</option>
        <option value="10">10 months</option>

    </select><br>
    <br>

    <input type="submit" value="Save Changes" class="btn">
</form>

</body>
<script>
    //(W3Schools,2023)
    function exitPage() {
        window.location.href = "ApproveApplicationsTable.php";
    }
</script>
</html>
