<?php
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    // Redirect to the AdminLogin.php page if not authenticated(Gosselin, Kokoska and Easterbrooks,2011)
    header("Location: AdminLogin.php");
    exit();
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Check if the "admission_id" is present in the URL(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_GET['admission_id'])) {
    $id = $_GET['admission_id'];

    //Fetch application details from the database based on "admission_id"(Gosselin, Kokoska and Easterbrooks,2011)
    $sql = "SELECT * FROM application WHERE admission_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        //Fetch and display the application details(Gosselin, Kokoska and Easterbrooks,2011)
        $row = $result->fetch_assoc();

        echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="CSS/style.css">
                <title>View Application Details</title>
                <style>
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

        /*styling child information(W3Schools,2023)*/
        .child-information {
            margin-top: 20px; /*Add spacing between the top heading and child information(W3Schools,2023) */
        }
        
        /* Styles for the exit button(W3Schools,2023) */
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

        /*styling download pdf button(W3Schools,2023)*/
        #download-pdf {
            background-color: #77d4e3;
            color: black;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer
        }
                </style>
            </head>
            <body>
            <!--exit button-->
<button class="exit-button" onclick="exitPage()">Exit</button>
                <div class="logo">
                    <img style="width: 70%" src="Images/Logo.png" alt="logo">
                </div>
                <h1>Application For Admission</h1>
                <br><br>';

        echo '<div class="form-container">'; //Container for application details(Gosselin, Kokoska and Easterbrooks,2011)
        echo '<h2>Application Details</h2>';

        //Loop through the fields and display them(Gosselin, Kokoska and Easterbrooks,2011)
        $fields = array(
            'admission_date', 'care_type', 'child_name', 'child_dob',
            'child_age', 'guardian_one_relationship', 'guardian_one_name', 'guardian_one_home_address', 'guardian_one_id_number', 'guardian_one_email', 'guardian_one_home_tel', 'guardian_one_work_tel', 'guardian_one_cellphone', 'guardian_one_company', 'guardian_one_work_address',
            'guardian_two_relationship', 'guardian_two_name', 'guardian_two_home_address', 'guardian_two_id_number', 'guardian_two_email', 'guardian_two_home_tel', 'guardian_two_work_tel', 'guardian_two_cellphone', 'guardian_two_company', 'guardian_two_work_address',
            'father_work_tel', 'father_cellphone', 'father_company', 'father_work_address', 'reasons',
            'application_date', 'parent_signature', 'child_id', 'full_name', 'date_of_birth', 'grade', 'home_language',
            'religion', 'marital_status', 'num_children', 'other_children_ages', 'birth_problems',
            'contagious_illnesses', 'allergies', 'family_doctor', 'morning_bringer', 'afternoon_fetcher',
            'emergency_contact', 'other_information', 'previous_school', 'school_telephone',
            'indemnity_child_name', 'yearly_fees_months', 'status'
        );

        foreach ($fields as $field) {
            if (isset($row[$field])) {
                if ($field === 'parent_signature') {
                    // Display the parent's signature if available(Gosselin, Kokoska and Easterbrooks,2011)
                    echo '<h4>Signature Of Parent:</h4>';
                    if (!empty($row['parent_signature'])) {
                        $base64Data = $row['parent_signature'];

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
                } else {
                    $label = ucwords(str_replace('_', ' ', $field)); //Capitalize the first letter of each word(Gosselin, Kokoska and Easterbrooks,2011)
                    echo '<p class="bold-label">' . $label . ': <span style="font-weight:normal;">' . $row[$field] . '</span></p>';
                }
            }
        }

        echo '</div>'; //Close the form-container(Gosselin, Kokoska and Easterbrooks,2011)(W3Schools,2023)

        echo '<br>';
        echo '</body>
            </html>';
    } else {
        echo "Application not found.";
    }
    $stmt->close();
} else {
    echo "Invalid request. Admission ID is missing.";
}

//Close the database connection(Gosselin, Kokoska and Easterbrooks,2011)
$conn->close();
?>

<script>
    //Function to exit the current page and redirect to RequestApplicationTable.php(Gosselin, Kokoska and Easterbrooks,2011)
    function exitPage() {
        window.location.href = "RequestApplicationTable.php";
    }
</script>
