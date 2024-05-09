<?php
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    header("Location: AdminLogin.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>View Application Details</title>
    <style>
        /*styling body(W3Schools,2023)*/
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }

        /*styling heading 1(W3Schools,2023)*/
        h1 {
            text-align: center;
        }

        /*styling heading 2(W3Schools,2023)*/
        h2 {
            margin-top: 20px;
            text-align: center;
            text-decoration: underline;
        }

        /*styling heading 3(W3Schools,2023)*/
        h3 {
            margin-top: 20px;
            text-decoration: underline;
        }

        /*styling label(W3Schools,2023)*/
        .bold-label {
            font-weight: bold;
        }

        /*styling paragraph(W3Schools,2023)*/
        p {
            margin-bottom: 10px;
        }

        /*styling the form container(W3Schools,2023)*/
        .form-container {
            border: 2px solid #000;
            width: 70%;
            margin: 0 auto;
            border-radius: 10px !important;
            overflow: hidden;
            background-color: #fff;
            padding: 60px 60px
        }

        /*styling child information*/
        .child-information {
            margin-top: 20px; /*Add spacing between the top heading and child information(W3Schools,2023) */
        }

        .download-pdf {
            background-color: #77d4e3;
            color: black;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            position: fixed;
            top: 80px; /* Position the download button below the exit button with 20px spacing(W3Schools,2023) */
            left: 20px;
        }

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

        /*styling exit button hover(W3Schools,2023)*/
        .exit-button:hover {
            background-color: #41c4d8;
            color: black;
        }

        /*styling download pdf button hover(W3Schools,2023)*/
        #download-pdf:hover {
            background-color: #77d4e3;
        }
    </style>
</head>
<body>
<!--exit button-->
<button class="exit-button" onclick="exitPage()">Exit</button>
<!--logo-->
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->
<!--Main Heading-->
<h1>Application For Admission</h1>

<br>
<!--Add a "Download PDF" button(W3Schools,2023) -->
<button id="download-pdf" class="download-pdf" onclick="downloadPDF()">Download PDF</button>

<br><br>
<?php
global $conn;
require_once 'DBConn.php';

// Check if the admission ID is provided in the query parameters
if (isset($_GET['admission_id'])) {
    $admissionId = $_GET['admission_id'];

// Fetch application details from the database based on the admission ID
    $query = "SELECT * FROM application WHERE admission_id = $admissionId"; // Replace 'your_application_table' with your actual table name
    $result = mysqli_query($conn, $query);

// Check if the query was successful
    if ($result) {
        $applicationData = mysqli_fetch_assoc($result);
        echo '<form>';

        //Form 1(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<div class="form-container">'; //Add a container for the form(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<br><h3>Child’s details</h3>';
        //Output the admission date(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<p class="bold-label">Date on which admission is required: <span style="font-weight:normal;">' . $applicationData['admission_date'] . '</span></p>';
        //Output whether half day or full day care is required(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<p class="bold-label">Will half day or full day care be required: <span style="font-weight:normal;">' . $applicationData['care_type'] . '</span></p>';
        //Output the child's name(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<p class="bold-label">Surname and full names of child: <span style="font-weight:normal;">' . $applicationData['child_name'] . '</span></p>';
        //Output the date of birth(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<p class="bold-label">Date of birth: <span style="font-weight:normal;">' . $applicationData['date_of_birth'] . '</span></p>';
        //Output the child's age(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<p class="bold-label">Age: <span style="font-weight:normal;">' . $applicationData['child_age'] . '</span></p>';


        echo '<br><h3>Guardian One’s details</h3>'; //Display a section heading for mother's details(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<p class="bold-label">Guardian One Relationship: <span style="font-weight:normal;">' . $applicationData['guardian_one_relationship'] . '</span></p>';
        echo '<p class="bold-label">Guardian One Name: <span style="font-weight:normal;">' . $applicationData['guardian_one_name'] . '</span></p>';
        echo '<p class="bold-label">Guardian One Home address: <span style="font-weight:normal;">' . $applicationData['guardian_one_home_address'] . '</span></p>';
        echo '<p class="bold-label">Guardian One I.D. number: <span style="font-weight:normal;">' . $applicationData['guardian_one_id_number'] . '</span></p>';
        echo '<p class="bold-label">Guardian One Email address: <span style="font-weight:normal;">' . $applicationData['guardian_one_email'] . '</span></p>';
        echo '<p class="bold-label">Guardian One Home tel number: <span style="font-weight:normal;">' . $applicationData['guardian_one_home_tel'] . '</span></p>';
        echo '<p class="bold-label">Guardian One Work tel number: <span style="font-weight:normal;">' . $applicationData['guardian_one_work_tel'] . '</span></p>';
        echo '<p class="bold-label">Guardian One Cellphone number: <span style="font-weight:normal;">' . $applicationData['guardian_one_cellphone'] . '</span></p>';
        echo '<p class="bold-label">Guardian One Name of company: <span style="font-weight:normal;">' . $applicationData['guardian_one_company'] . '</span></p>';
        echo '<p class="bold-label">Guardian One Work address: <span style="font-weight:normal;">' . $applicationData['guardian_one_work_address'] . '</span></p>';


        echo '<br><h3>Father’s details</h3>'; //Display a section heading for father's details(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<p class="bold-label">Guardian Two Relationship: <span style="font-weight:normal;">' . $applicationData['guardian_two_relationship'] . '</span></p>';
        echo '<p class="bold-label">Guardian Two Name: <span style="font-weight:normal;">' . $applicationData['guardian_two_name'] . '</span></p>';
        echo '<p class="bold-label">Guardian Two Home address if different to mother: <span style="font-weight:normal;">' . $applicationData['guardian_two_home_address'] . '</span></p>';
        echo '<p class="bold-label">Guardian Two I.D. number: <span style="font-weight:normal;">' . $applicationData['guardian_two_id_number'] . '</span></p>';
        echo '<p class="bold-label">Guardian Two Email address: <span style="font-weight:normal;">' . $applicationData['guardian_two_email'] . '</span></p>';
        echo '<p class="bold-label">Guardian Two Home tel number: <span style="font-weight:normal;">' . $applicationData['guardian_two_home_tel'] . '</span></p>';
        echo '<p class="bold-label">Guardian Two Work tel number: <span style="font-weight:normal;">' . $applicationData['guardian_two_work_tel'] . '</span></p>';
        echo '<p class="bold-label">Guardian Two Cellphone number: <span style="font-weight:normal;">' . $applicationData['guardian_two_cellphone'] . '</span></p>';
        echo '<p class="bold-label">Guardian Two Name of company: <span style="font-weight:normal;">' . $applicationData['guardian_two_company'] . '</span></p>';
        echo '<p class="bold-label">Guardian Two Work address: <span style="font-weight:normal;">' . $applicationData['guardian_two_work_address'] . '</span></p>';


        echo '<h3>Reasons for requiring day care:</h3>'; //Display a section heading for reasons for requiring day care(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<p>' . $applicationData['reasons'] . '</p>'; //Display the reasons for requiring day care(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<p class="bold-label">Date of application: <span style="font-weight:normal;">' . $applicationData['application_date'] . '</span></p>'; // Display the date of the application
        echo '<h3>Signature of parent:</h3>';

        //Check if the parent signature data is available(Gosselin, Kokoska and Easterbrooks,2011)
        if (!empty($applicationData['parent_signature'])) {
            $base64Data = $applicationData['parent_signature'];

            //Extract the data type and actual Base64 data(Gosselin, Kokoska and Easterbrooks,2011)
            list($type, $data) = explode(';', $base64Data);
            list(, $data) = explode(',', $data);

            //Decode the Base64 data(Gosselin, Kokoska and Easterbrooks,2011)
            $decodedData = base64_decode($data);

            //Generate a data URI for the image(Gosselin, Kokoska and Easterbrooks,2011)
            $dataUri = 'data:' . $type . ';base64,' . base64_encode($decodedData);

            //Display the image
            echo '<img src="' . $dataUri . '" alt="Parent Signature">';
        } else {
            //If the signature data is empty, you can display an alternative message or handle it as needed(Gosselin, Kokoska and Easterbrooks,2011)
            echo 'No signature available';
        }

        echo '</div>'; //Close the form-container(Gosselin, Kokoska and Easterbrooks,2011)

        echo '<br>'; //Add a line break for spacing(Gosselin, Kokoska and Easterbrooks,2011)


        //Form 2(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<div class="form-container">'; //Add a container for the registration form(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<h2>Registration form</h2><br>'; //Display a heading for the registration form(Gosselin, Kokoska and Easterbrooks,2011)

        //Display various details related to the child's registration(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<p class="bold-label">ID Number for child: <span style="font-weight:normal;">' . $applicationData['child_id'] . '</span></p>';
        echo '<p class="bold-label">Surname and full name of child: <span style="font-weight:normal;">' . $applicationData['full_name'] . '</span></p>';
        echo '<p class="bold-label">Date of birth: <span style="font-weight:normal;">' . $applicationData['date_of_birth'] . '</span></p>';
        echo '<p class="bold-label">Grade: <span style="font-weight:normal;">' . $applicationData['grade'] . '</span></p>';
        echo '<p class="bold-label">Home language: <span style="font-weight:normal;">' . $applicationData['home_language'] . '</span></p>';
        echo '<p class="bold-label">Religion: <span style="font-weight:normal;">' . $applicationData['religion'] . '</span></p>';
        echo '<p class="bold-label">Parents marital status: <span style="font-weight:normal;">' . $applicationData['marital_status'] . '</span></p>';
        echo '<p class="bold-label">Number of children in the family: <span style="font-weight:normal;">' . $applicationData['num_children'] . '</span></p>';
        echo '<p class="bold-label">Other children’s ages: <span style="font-weight:normal;">' . $applicationData['other_children_ages'] . '</span></p>';
        echo '<p class="bold-label">Mention any problems during birth: <span style="font-weight:normal;">' . $applicationData['birth_problems'] . '</span></p>';
        echo '<p class="bold-label">Which contagious illnesses has the child had already: <span style="font-weight:normal;">' . $applicationData['contagious_illnesses'] . '</span></p>';
        echo '<p class="bold-label">Allergies (if any): <span style="font-weight:normal;">' . $applicationData['allergies'] . '</span></p>';
        echo '<p class="bold-label">Name and telephone number of family Doctor: <span style="font-weight:normal;">' . $applicationData['family_doctor'] . '</span></p>';
        echo '<p class="bold-label">Who will bring your child in the morning: <span style="font-weight:normal;">' . $applicationData['morning_bringer'] . '</span></p>';
        echo '<p class="bold-label">Who will fetch your child in the afternoon: <span style="font-weight:normal;">' . $applicationData['afternoon_fetcher'] . '</span></p>';
        echo '<p class="bold-label">Name, address, and telephone number of a person who can be contacted should the parent not be available in case of emergency: <span style="font-weight:normal;">' . $applicationData['emergency_contact'] . '</span></p>';
        echo '<p class="bold-label">Any other important information: <span style="font-weight:normal;">' . $applicationData['other_information'] . '</span></p>';
        echo '<p class="bold-label">Previous school name: <span style="font-weight:normal;">' . $applicationData['previous_school'] . '</span></p>';
        echo '<p class="bold-label">Previous school telephone: <span style="font-weight:normal;">' . $applicationData['school_telephone'] . '</span></p>';
        echo '</div>'; //Close the registration form container(Gosselin, Kokoska and Easterbrooks,2011)

        echo '<br>'; //Add a line break for spacing(Gosselin, Kokoska and Easterbrooks,2011)


        //Form 3(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<div class="form-container">'; //Add a container for the indemnity form(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<h2>Indemnity Form</h2><br>'; //Display a heading for the indemnity form(Gosselin, Kokoska and Easterbrooks,2011)

        //Display the name of the child for whom the indemnity form is being completed(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<p class="bold-label">Name of child: <span style="font-weight:normal;">' . $applicationData['indemnity_child_name'] . '</span></p>';

        //Display various terms and conditions of the indemnity form(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<p class="bold-label">I, the undersigned, hereby do agree that my child/children’s school fees will be paid in full by the 1st of each month.</p>';
        echo '<p class="bold-label">I also understand that should I wish to remove my child/children from Just Love, written notice of a minimum of two months is required. If notice is not tendered, I am aware that the fees for the period will still be due.</p>';
        echo '<p class="bold-label">While every care and attention will be given to the children and all the necessary precautions will be taken, Just Love cannot be held responsible for any injury to my child.</p>';
        echo '<p class="bold-label">I agree to my child being taken on excursions by Just Love and am fully aware that neither Just Love nor the person in charge can be held responsible for injury to my child.</p>';
        echo '<p class="bold-label">In the event that I cannot be reached, I hereby give my permission for my child to receive any necessary medical care or treatment. I understand that every effort will be made to contact my spouse or me before such action is taken. I will be responsible for the payment for such care or treatment.</p>';
        echo '<p class="bold-label">We endeavor to open all school holidays but go on demand over the festive season.</p>';
        echo '<p class="bold-label">I agree to allow any photos that are taken at school to be posted on our Facebook page and/or web page.</p>';
        //Display the selected yearly fees months(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<p class="bold-label">Yearly fees months: <span style="font-weight:normal;">' . $applicationData['yearly_fees_months'] . '</span></p>';
        echo '</div>'; //Close the indemnity form container(Gosselin, Kokoska and Easterbrooks,2011)

        echo '<br>';

        //Form 4
        echo '<div class="form-container">'; //Add a container for the Fee Collection Procedures form(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<h2>Fees Collection Procedures</h2><br>'; //Fee CollectionProcedures(Gosselin, Kokoska and Easterbrooks,2011)

        //Display Fees Collection Procedures(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<p class="bold-label">1. If the account is outstanding you will be notified of your arrears and an account will be handed over to you. Interest will be charged on all outstanding fees.</p>';
        echo '<p class="bold-label">2. Should the account remain unpaid you will receive a letter requesting payment within a 7-day period.</p>';
        echo '<p class="bold-label">3. Should the account remain unpaid parents will receive a letter advising them that the learner will be excluded as a consequence of the breach of contract and that the learner should not return to school until the account has been fully settled.</p>';
        echo '<p class="bold-label">4. If the fees are still outstanding after these two letter the school will insist that the parents keep their child at home. If the child is sent to school, the principal will remove the child from class and place him/her under supervision. The parents will be phoned and asked to collect their child soonest.</p>';
        echo '<p class="bold-label">6. Should the account remain unpaid, notice will be given that the contract will be terminated and the school will award that place to any learners on the waiting list. Alternative arrangements should be made by the parents for the education of the learner in question.</p>';
        echo '<p class="bold-label">7. Once the contract has been cancelled and the learner excluded from school, the account will be handed over to a debt collection agency.</p>';
        echo '<br>';
        echo '<p class="bold-label">Guardian`s Name: <span style="font-weight:normal;">' . $applicationData['guardian_one_name'] . '</span></p>';
        echo '<p class="bold-label">Signature: </p>';
        //Check if the parent signature data is available(Gosselin, Kokoska and Easterbrooks,2011)
        if (!empty($applicationData['parent_signature'])) {
            $base64Data = $applicationData['parent_signature'];

            //Extract the data type and actual Base64 data(Gosselin, Kokoska and Easterbrooks,2011)
            list($type, $data) = explode(';', $base64Data);
            list(, $data) = explode(',', $data);

            //Decode the Base64 data(Gosselin, Kokoska and Easterbrooks,2011)
            $decodedData = base64_decode($data);

            //Generate a data URI for the image(Gosselin, Kokoska and Easterbrooks,2011)
            $dataUri = 'data:' . $type . ';base64,' . base64_encode($decodedData);

            //Display the image(Gosselin, Kokoska and Easterbrooks,2011)
            echo '<img src="' . $dataUri . '" alt="Parent-Signature">';
        } else {
            //If the signature data is empty, you can display an alternative message or handle it as needed(Gosselin, Kokoska and Easterbrooks,2011)
            echo 'No signature available';
        }
        echo '<p class="bold-label">Date: <span style="font-weight:normal;">' . $applicationData['admission_date'] . '</span></p>';

        echo '</div>'; //Close the fee collection container(Gosselin, Kokoska and Easterbrooks,2011)
        echo '</form>'; //Close the HTML form(Gosselin, Kokoska and Easterbrooks,2011)

    } else {
        echo "Error fetching application details: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Admission ID not provided in the query parameters.";
}
?>

<br><br>

<!--JavaScript for downloading a PDF by encoding application data and passing it to generate_pdf.php(W3Schools,2023) -->
<script>
    function downloadPDF() {
        // Get the admission ID from the URL
        const admissionId = <?php echo isset($_GET['admission_id']) ? $_GET['admission_id'] : 0; ?>;

        // Redirect to generate_pdf.php with the admission ID
        window.location.href = "Generate_pdf.php?admission_id=" + admissionId;
    }

    //Function to exit the current page and redirect to ApproveApplicationsTable.php(W3Schools,2023)
    function exitPage() {
        window.location.href = "ApproveApplicationsTable.php";
    }
</script>

</body>
</html>