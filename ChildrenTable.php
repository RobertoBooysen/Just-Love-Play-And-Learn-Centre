<?php
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    // Redirect to the AdminLogin.php page if not authenticated
    header("Location: AdminLogin.php");
    exit();
}

//Function to get children details from the SQL database(Gosselin, Kokoska and Easterbrooks,2011)
function getChildrenFields($conn)
{
    $sql = "SELECT care_type,child_id,full_name,child_dob,child_age,home_language,religion FROM application WHERE status = 'approved';";
    $result = $conn->query($sql);

    $applicationChildrenFields = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //Extract application contact fields and add them to the $applicationContactFields array(Gosselin, Kokoska and Easterbrooks,2011)
            $applicationChildrenFields[] = array(
                'care_type' => $row['care_type'],
                'child_id' => $row['child_id'],
                'child_dob' => $row['child_dob'],
                'child_age' => $row['child_age'],
                'home_language' => $row['home_language'],
                'religion' => $row['religion'],
            );
        }
    }
    //Returning the extracted application fields(Gosselin, Kokoska and Easterbrooks,2011)
    return $applicationChildrenFields;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Get all application children fields using the defined function(Gosselin, Kokoska and Easterbrooks,2011)
$applicationChildrenFields = getChildrenFields($conn);

//Close the database connection (if needed) at the end of your script(Gosselin, Kokoska and Easterbrooks,2011)
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Define the viewport for responsive design(W3Schools,2023) -->
    <link rel="stylesheet" href="CSS/admin.css">
    <title>Children Information</title> <!--Include a custom admin.css stylesheet(W3Schools,2023) -->
</head>
<style>
    table, td, th {
        border: 1px solid #ddd; /*Border style for table elements(W3Schools,2023) */
        text-align: center; /*Center-align text in table cells(W3Schools,2023) */
    }

    table {
        border-collapse: collapse; /*Collapse table borders(W3Schools,2023) */
        border-spacing: 0; /*Remove spacing between table cells(W3Schools,2023) */
        width: 100%; /*Set table width to 100% of its container(W3Schools,2023) */
        border: 1px solid #caacd2; /*Set the border style for the table(W3Schools,2023) */
    }

    th, td {
        padding: 15px; /*Add padding to table header and data cells(W3Schools,2023) */
    }

    .btn {
        padding: 5px 12px; /*Define button padding(W3Schools,2023) */
        font-size: 15px; /*Set font size for buttons(W3Schools,2023) */
        color: black; /*Text color for buttons(W3Schools,2023) */
        background: #77d4e3; /*Background color for buttons(W3Schools,2023) */
        border: none; /*Remove button border(W3Schools,2023) */
        border-radius: 5px; /*Apply border-radius to buttons(W3Schools,2023) */
        margin-left: 58px; /*Add left margin to buttons(W3Schools,2023) */
    }

    /*styling button group(W3Schools,2023)*/
    .button-group {
        display: flex; /*Use flexbox for horizontal layout(W3Schools,2023) */
        align-items: center; /*Center items vertically(W3Schools,2023) */
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


    .exit-button:hover {
        background-color: #41c4d8; /*Changing background color on hover(W3Schools,2023) */
        color: black; /*Change text color on hover(W3Schools,2023) */
    }

</style>
<body>

<button class="exit-button" onclick="exitPage()">Exit</button>

<br><br><br><br><br>

<!--Add a "Download PDF" button(W3Schools,2023) -->
<button class="download-pdf" id="download-pdf">Download PDF</button>

<br><br>

<h1>Children Information</h1>

<div style="overflow-x:auto;">
    <?php if (empty($applicationChildrenFields)): ?>
        <!--Displaying a message when there are no approved applications found(Gosselin, Kokoska and Easterbrooks,2011) -->
        <p>No approved applications found for children information.</p>
    <?php else: ?>
        <!--Creating a table to display approved applications children details(Gosselin, Kokoska and Easterbrooks,2011) -->
        <table>
            <thead>
            <tr>
                <th style="width: 16.66%">Care Type</th>
                <th style="width: 16.66%">Child ID</th>
                <th style="width: 16.66%">Child DOB</th>
                <th style="width: 16.66%">Child Age</th>
                <th style="width: 16.66%">Home Language</th>
                <th style="width: 16.66%">Religion</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($applicationChildrenFields as $applicationChildrenFieldInformation): ?>
                <tr>
                    <td><?php echo $applicationChildrenFieldInformation['care_type']; ?></td>
                    <td><?php echo $applicationChildrenFieldInformation['child_id']; ?></td>
                    <td><?php echo $applicationChildrenFieldInformation['child_dob']; ?></td>
                    <td><?php echo $applicationChildrenFieldInformation['child_age']; ?></td>
                    <td><?php echo $applicationChildrenFieldInformation['home_language']; ?></td>
                    <td><?php echo $applicationChildrenFieldInformation['religion']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
    const applicationChildrenInformation = <?php echo json_encode($applicationChildrenFields); ?>;

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

    //Attach a click event listener to the element with id "download-pdf"(W3Schools,2023)
    document.getElementById("download-pdf").addEventListener("click", function () {
        //Construct a URL to 'generate_pdf.php' with the application data encoded as a query parameter(W3Schools,2023)
        window.location.href = 'Generate_Children_Details_pdf.php?data=' + encodeURIComponent(JSON.stringify(applicationChildrenInformation));
    });

    //Function to exit the page(W3Schools,2023)
    function exitPage() {
        window.location.href = "PdfReports.php";
    }
</script>


</body>
</html>