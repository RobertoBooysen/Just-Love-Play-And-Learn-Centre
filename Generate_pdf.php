<?php
//Include necessary files and initialize the session if not already done(Gosselin, Kokoska and Easterbrooks,2011)
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    header("Location: AdminLogin.php");
    exit();
}

//Check if the admission ID is provided in the query parameters(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_GET['admission_id'])) {
    $admissionId = $_GET['admission_id'];

    //Fetch application details from the database based on the admission ID(Gosselin, Kokoska and Easterbrooks,2011)
    $query = "SELECT * FROM application WHERE admission_id = $admissionId";
    $result = mysqli_query($conn, $query);

    //Check if the query was successful(Gosselin, Kokoska and Easterbrooks,2011)
    if ($result) {
        $applicationData = mysqli_fetch_assoc($result);

        //Include the library for PDF generation(Gosselin, Kokoska and Easterbrooks,2011)
        require_once('TCPDF/tcpdf.php');

        //Create a new PDF document(Damodaran,2013)
        $pdf = new TCPDF();

        // Set document properties(Damodaran,2013)
        $pdf->SetCreator('Just Love Play And Learn Centre');
        $pdf->SetAuthor('RNK');
        $pdf->SetTitle('Application Details');
        $pdf->SetSubject('Application Details');

        //Remove the default header and footer(Damodaran,2013)
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        //Output application details to the PDF (similar to how you output to HTML)(Damodaran,2013)

        //Output HTML content for the PDF with a line break(Damodaran,2013)
        $htmlForm1 = '<h1 style="text-align: center"></h1>';
        $htmlForm1 .= '<p style="text-align: center;"><img src="Images/DaycareLogo.jpg" alt="Logo" style="width: 400px;"></p>';

        $htmlForm1 .= '<br><br><br><br><br><br><br><br><br><br><br><br><h1 style="text-align: center">Application For Admission</h1>';

        //Form 1(Damodaran,2013)
        $htmlForm1 .= '<h1 style="text-align: center; text-decoration: underline;margin-top: 10px;"></h1>';
        $htmlForm1 .= '<h3 style="text-align: center; text-decoration: underline;margin-top: 10px;">Child’s details</h3>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date on which admission is required: <span style="font-weight: normal;">' . $applicationData['admission_date'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Will half day or full day care be required: <span style="font-weight: normal;">' . $applicationData['care_type'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Surname and full names of child: <span style="font-weight: normal;">' . $applicationData['child_name'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of birth: <span style="font-weight: normal;">' . $applicationData['date_of_birth'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Age: <span style="font-weight: normal;">' . $applicationData['child_age'] . '</span></p>';

        $htmlForm1 .= '<h3 style="text-align: center; text-decoration: underline;">Guardian One’s details</h3>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian One Relationship: <span style="font-weight: normal;">' . $applicationData['guardian_one_relationship'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian One Name: <span style="font-weight: normal;">' . $applicationData['guardian_one_name'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian One Home address: <span style="font-weight: normal;">' . $applicationData['guardian_one_home_address'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian One I.D. number: <span style="font-weight: normal;">' . $applicationData['guardian_one_id_number'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian One Email address: <span style="font-weight: normal;">' . $applicationData['guardian_one_email'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian One Home tel number: <span style="font-weight: normal;">' . $applicationData['guardian_one_home_tel'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian One Work tel number: <span style="font-weight: normal;">' . $applicationData['guardian_one_work_tel'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian One Cellphone number: <span style="font-weight: normal;">' . $applicationData['guardian_one_cellphone'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian One Name of company: <span style="font-weight: normal;">' . $applicationData['guardian_one_company'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian One Work address: <span style="font-weight: normal;">' . $applicationData['guardian_one_work_address'] . '</span></p>';

        $htmlForm1 .= '<h1 style="text-align: center; text-decoration: underline;margin-top: 10px;"></h1>';
        $htmlForm1 .= '<h3 style="text-align: center; text-decoration: underline;">Guardian Two’s details</h3>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian Two Relationship: <span style="font-weight: normal;">' . $applicationData['guardian_two_relationship'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian Two Name: <span style="font-weight: normal;">' . $applicationData['guardian_two_name'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian Two Home address if different from mother: <span style="font-weight: normal;">' . $applicationData['guardian_two_home_address'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian Two I.D. number: <span style="font-weight: normal;">' . $applicationData['guardian_two_id_number'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian Two Email address: <span style="font-weight: normal;">' . $applicationData['guardian_two_email'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian Two Home tel number: <span style="font-weight: normal;">' . $applicationData['guardian_two_home_tel'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian Two Work tel number: <span style="font-weight: normal;">' . $applicationData['guardian_two_work_tel'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian Two Cellphone number: <span style="font-weight: normal;">' . $applicationData['guardian_two_cellphone'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian Two Name of company: <span style="font-weight: normal;">' . $applicationData['guardian_two_company'] . '</span></p>';
        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardian Two Work address: <span style="font-weight: normal;">' . $applicationData['guardian_two_work_address'] . '</span></p>';

        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reasons for requiring day care:</p>';
        $htmlForm1 .= '<p>          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $applicationData['reasons'] . '</p>';

        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of application: <span style="font-weight: normal;">          ' . $applicationData['application_date'] . '</span></p>';

        $htmlForm1 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature of parent:</p>';
        $htmlForm1 .= '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . '<img src="' . $applicationData['parent_signature'] . '" />' . '</p>';

        $pdf->AddPage();
        $pdf->writeHTML($htmlForm1, true, false, true);

        //Form 2(Damodaran,2013)
        $htmlForm2 = '<h3 style="text-align: center; text-decoration: underline;">Registration form</h3>';
        $htmlForm2 .= '<h1 style="text-align: center; text-decoration: underline;margin-top: 10px;"></h1>';
        $htmlForm2 .= '<h1 style="text-align: center; text-decoration: underline;margin-top: 10px;"></h1>';
        $htmlForm2 .= '<h1 style="text-align: center; text-decoration: underline;margin-top: 10px;"></h1>';
        $htmlForm2 .= '<h1 style="text-align: center; text-decoration: underline;margin-top: 10px;"></h1>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ID Number for child: <span style="font-weight: normal;">' . $applicationData['child_id'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Surname and full name of child: <span style="font-weight: normal;">' . $applicationData['full_name'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of birth: <span style="font-weight: normal;">' . $applicationData['date_of_birth'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grade: <span style="font-weight: normal;">' . $applicationData['grade'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Home language: <span style="font-weight: normal;">' . $applicationData['home_language'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Religion: <span style="font-weight: normal;">' . $applicationData['religion'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Parents marital status: <span style="font-weight: normal;">' . $applicationData['marital_status'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Number of children in the family: <span style="font-weight: normal;">' . $applicationData['num_children'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Other childrens’ ages: <span style="font-weight: normal;">' . $applicationData['other_children_ages'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mention any problems during birth: <span style="font-weight: normal;">' . $applicationData['birth_problems'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Which contagious illnesses has the child had already: <span style="font-weight: normal;">' . $applicationData['contagious_illnesses'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Allergies (if any): <span style="font-weight: normal;">' . $applicationData['allergies'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name and telephone number of family Doctor: <span style="font-weight: normal;">' . $applicationData['family_doctor'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Who will bring your child in the morning: <span style="font-weight: normal;">' . $applicationData['morning_bringer'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Who will fetch your child in the afternoon: <span style="font-weight: normal;">' . $applicationData['afternoon_fetcher'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Emergency Contact: <span style="font-weight: normal;">' . $applicationData['emergency_contact'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Any other important information: <span style="font-weight: normal;">' . $applicationData['other_information'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Previous school name: <span style="font-weight: normal;">' . $applicationData['previous_school'] . '</span></p>';
        $htmlForm2 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Previous school telephone: <span style="font-weight: normal;">' . $applicationData['school_telephone'] . '</span></p>';

        $htmlForm2 .= '<br>';

        $pdf->AddPage();
        $pdf->writeHTML($htmlForm2, true, false, true);

        //Form 3(Damodaran,2013)
        $htmlForm3 = '<h3 style="text-align: center; text-decoration: underline;">Indemnity Form</h3>';
        $htmlForm3 .= '<h1 style="text-align: center; text-decoration: underline;margin-top: 10px;"></h1>';
        $htmlForm3 .= '<h1 style="text-align: center; text-decoration: underline;margin-top: 10px;"></h1>';
        $htmlForm3 .= '<h1 style="text-align: center; text-decoration: underline;margin-top: 10px;"></h1>';
        $htmlForm3 .= '<h1 style="text-align: center; text-decoration: underline;margin-top: 10px;"></h1>';
        $htmlForm3 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name of child: <span style="font-weight: normal;">' . $applicationData['indemnity_child_name'] . '</span></p>';
        $htmlForm3 .= '<table>';
        $htmlForm3 .= '<tr><td style="width: 48px;"></td>';
        $htmlForm3 .= '<td style="text-align: justify; width: 440px;">';
        $htmlForm3 .= 'I, the undersigned, hereby do agree that my child/children’s school fees will be paid in full by the 1st of each month. ';
        $htmlForm3 .= 'I also understand that should I wish to remove my child/children from Just Love, written notice of a minimum of two months is required. If notice is not tendered, I am aware that the fees for the period will still be due. ';
        $htmlForm3 .= 'While every care and attention will be given to the children and all the necessary precautions will be taken, Just Love cannot be held responsible for any injury to my child. ';
        $htmlForm3 .= 'I agree to my child being taken on excursions by Just Love and am fully aware that neither Just Love nor the person in charge can be held responsible for injury to my child. ';
        $htmlForm3 .= 'In the event that I cannot be reached, I hereby give my permission for my child to receive any necessary medical care or treatment. I understand that every effort will be made to contact my spouse or me before such action is taken. I will be responsible for the payment for such care or treatment. ';
        $htmlForm3 .= 'We endeavor to open all school holidays but go on demand over the festive season. ';
        $htmlForm3 .= 'I agree to allow any photos that are taken at school to be posted on our Facebook page and /or web page.';
        $htmlForm3 .= '</td></tr>';
        $htmlForm3 .= '</table>';
        $htmlForm3 .= '<p style="font-weight: bold;">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yearly fees months: <span style="font-weight: normal;">' . $applicationData['yearly_fees_months'] . '</span></p>';

        $htmlForm3 .= '<br>';

        $pdf->AddPage();
        $pdf->writeHTML($htmlForm3, true, false, true);

        //Form 4(Damodaran,2013)
        $htmlForm4 = '<h3 style="text-align: center; text-decoration: underline;">Fee Collection Procedures</h3>';
        $htmlForm4 .= '<h1 style="text-align: center; text-decoration: underline;margin-top: 10px;"></h1>';
        $htmlForm4 .= '<h1 style="text-align: center; text-decoration: underline;margin-top: 10px;"></h1>';
        $htmlForm4 .= '<h1 style="text-align: center; text-decoration: underline;margin-top: 10px;"></h1>';
        $htmlForm4 .= '<h1 style="text-align: center; text-decoration: underline;margin-top: 10px;"></h1>';
        $htmlForm4 .= '<table>';
        $htmlForm4 .= '<tr><td style="width: 48px;"></td>';
        $htmlForm4 .= '<td style="text-align: justify; width: 440px;">';
        $htmlForm4 .= '1. If the account is outstanding you will be notified of your arrears and an account will be handed over to you. Interest will be charged on all outstanding fees.';
        $htmlForm4 .= '<br>';
        $htmlForm4 .= '<br>';
        $htmlForm4 .= '2. Should the account remain unpaid you will receive a letter requesting payment within a 7-day period.';
        $htmlForm4 .= '<br>';
        $htmlForm4 .= '<br>';
        $htmlForm4 .= '3. Should the account remain unpaid parents will receive a letter advising them that the learner will be excluded as a consequence of the breach of contract and that the learner should not return to school until the account has been fully settled.';
        $htmlForm4 .= '<br>';
        $htmlForm4 .= '<br>';
        $htmlForm4 .= '4. If the fees are still outstanding after these two letters, the school will insist that the parents keep their child at home. If the child is sent to school, the principal will remove the child from class and place him/her under supervision. The parents will be phoned and asked to collect their child soonest.';
        $htmlForm4 .= '<br>';
        $htmlForm4 .= '<br>';
        $htmlForm4 .= '6. Should the account remain unpaid, notice will be given that the contract will be terminated and the school will award that place to any learners on the waiting list. Alternative arrangements should be made by the parents for the education of the learner in question.';
        $htmlForm4 .= '<br>';
        $htmlForm4 .= '<br>';
        $htmlForm4 .= '7. Once the contract has been cancelled and the learner excluded from school, the account will be handed over to a debt collection agency.';
        $htmlForm4 .= '<br>';
        $htmlForm4 .= '<br>';
        $htmlForm4 .= '<p style="font-weight: bold;">Guardians Name: <span style="font-weight:normal;">' . $applicationData['guardian_one_name'] . '</span></p>';
        $htmlForm4 .= '<p style="font-weight: bold;">Signature of guardian:</p>';
        $htmlForm4 .= '<p>' . '<img src="' . $applicationData['parent_signature'] . '" />' . '</p>';
        $htmlForm4 .= '<p style="font-weight: bold;">Date: <span style="font-weight:normal;">' . $applicationData['admission_date'] . '</span></p>';
        $htmlForm4 .= '</td></tr>';
        $htmlForm4 .= '</table>';

        $pdf->AddPage();
        $pdf->writeHTML($htmlForm4, true, false, true);

        //Save the PDF file(Damodaran,2013)
        $pdfFileName = 'ApplicationDetails_' . $admissionId . '.pdf';
        $pdf->Output($pdfFileName, 'D');
    } else {
        echo "Error fetching application details: " . mysqli_error($conn);
    }

    //Close the database connection(Gosselin, Kokoska and Easterbrooks,2011)
    mysqli_close($conn);
} else {
    echo "Admission ID not provided in the query parameters.";
}
?>

