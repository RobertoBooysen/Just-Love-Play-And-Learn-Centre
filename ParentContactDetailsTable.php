<?php
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    // Redirect to the AdminLogin.php page if not authenticated
    header("Location: AdminLogin.php");
    exit();
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Function to get contact details of guardians from the SQL database
function getParentContactFields($conn)
{
    $sql = "SELECT child_name,guardian_one_name,guardian_one_home_tel,guardian_one_work_tel,guardian_one_cellphone,guardian_two_name,guardian_two_home_tel,guardian_two_work_tel,guardian_two_cellphone FROM application WHERE status = 'approved';";
    $result = $conn->query($sql);

    $applicationContactFields = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //Extract application contact fields and add them to the $applicationContactFields array
            $applicationContactFields[] = array(
                'child_name' => $row['child_name'],
                'guardian_one_name' => $row['guardian_one_name'],
                'guardian_one_home_tel' => $row['guardian_one_home_tel'],
                'guardian_one_work_tel' => $row['guardian_one_work_tel'],
                'guardian_one_cellphone' => $row['guardian_one_cellphone'],
                'guardian_two_name' => $row['guardian_two_name'],
                'guardian_two_home_tel' => $row['guardian_two_home_tel'],
                'guardian_two_work_tel' => $row['guardian_two_work_tel'],
                'guardian_two_cellphone' => $row['guardian_two_cellphone'],
            );
        }
    }
    //Returning the extracted application fields
    return $applicationContactFields;
}//(Gosselin, Kokoska and Easterbrooks,2011)

//If there is a connection error, terminate the script and display an error message
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}//(Gosselin, Kokoska and Easterbrooks,2011)

//Get all application contact fields using the defined function
$applicationContactFields = getParentContactFields($conn);//(Gosselin, Kokoska and Easterbrooks,2011)

//Close the database connection (if needed) at the end of your script
$conn->close();//(Gosselin, Kokoska and Easterbrooks,2011)
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Set the viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--(W3Schools,2023)-->

    <!--Define the viewport for responsive design -->
    <link rel="stylesheet" href="CSS/admin.css"><!--(W3Schools,2023)-->

    <!--Include a custom admin.css stylesheet -->
    <title>Parent Contact Information</title><!--(W3Schools,2023)-->
</head>
<style>
    /*styling table*/
    table, td, th {
        border: 1px solid #ddd; /*Border style for table elements */
        text-align: center; /*Center-align text in table cells */
    }/*(W3Schools,2023)*/

    /*styling table*/
    table {
        border-collapse: collapse; /*Collapse table borders */
        border-spacing: 0; /*Remove spacing between table cells */
        width: 100%; /*Set table width to 100% of its container */
        border: 1px solid #caacd2; /*Set the border style for the table */
    }/*(W3Schools,2023)*/

    /*styling table*/
    th, td {
        padding: 15px; /*Add padding to table header and data cells */
    }/*(W3Schools,2023)*/

    .btn {
        padding: 5px 12px; /*Define button padding */
        font-size: 15px; /*Set font size for buttons */
        color: black; /*Text color for buttons */
        background: #77d4e3; /*Background color for buttons */
        border: none; /*Remove button border */
        border-radius: 5px; /*Apply border-radius to buttons */
        margin-left: 58px; /*Add left margin to buttons */
    }/*(W3Schools,2023)*/

    /*styling button group*/
    .button-group {
        display: flex; /*Use flexbox for horizontal layout */
        align-items: center; /*Center items vertically */
    }/*(W3Schools,2023)*/

    /*styling the pdf download button*/
    .download-pdf {
        background-color: #77d4e3;
        color: black;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        position: fixed;
        top: 80px; /* Position the download button below the exit button with 20px spacing */
        left: 20px;
    }/*(W3Schools,2023)*/

    /*styling exit button*/
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
    }/*(W3Schools,2023)*/

    /*styling exit button hover*/
    .exit-button:hover {
        background-color: #41c4d8; /*Change background color on hover */
        color: black; /*Change text color on hover */
    }/*(W3Schools,2023)*/

</style>
<body>

<button class="exit-button" onclick="exitPage()">Exit</button>

<br><br><br><br><br>

<!--Add a "Download PDF" button -->
<button class="download-pdf" id="download-pdf">Download PDF</button><!--(W3Schools,2023)-->

<br><br>

<h1>Parent Contact Information</h1>

<div style="overflow-x:auto;">
    <?php if (empty($applicationContactFields)): ?><!--(Gosselin, Kokoska and Easterbrooks,2011)-->
        <!--Displaying a message when there are no approved applications found -->
        <p>No approved applications found for parent contact information.</p>
    <?php else: ?>
        <!--Creating a table to display approved applications guardian contact details -->
        <table>
            <thead>
            <tr>
                <th style="width: 11.11%">Child Name</th>
                <th style="width: 11.11%">Guardian One Name</th>
                <th style="width: 11.11%">Guardian One Home Tel</th>
                <th style="width: 11.11%">Guardian One Work Tel</th>
                <th style="width: 11.11%">Guardian One Cellphone</th>
                <th style="width: 11.11%">Guardian Two Name</th>
                <th style="width: 11.11%">Guardian Two Home Tel</th>
                <th style="width: 11.11%">Guardian Two Work Tel</th>
                <th style="width: 11.11%">Guardian Two Cellphone</th>
            </tr><!--(W3Schools,2023)-->
            </thead>
            <tbody>
            <?php foreach ($applicationContactFields as $applicationContactInformation): ?><!--(Gosselin, Kokoska and Easterbrooks,2011)-->
                <tr>
                    <td><?php echo $applicationContactInformation['child_name']; ?></td>
                    <td><?php echo $applicationContactInformation['guardian_one_name']; ?></td>
                    <td><?php echo $applicationContactInformation['guardian_one_home_tel']; ?></td>
                    <td><?php echo $applicationContactInformation['guardian_one_work_tel']; ?></td>
                    <td><?php echo $applicationContactInformation['guardian_one_cellphone']; ?></td>
                    <td><?php echo $applicationContactInformation['guardian_two_name']; ?></td>
                    <td><?php echo $applicationContactInformation['guardian_two_home_tel']; ?></td>
                    <td><?php echo $applicationContactInformation['guardian_two_work_tel']; ?></td>
                    <td><?php echo $applicationContactInformation['guardian_two_cellphone']; ?></td>
                </tr><!--(Gosselin, Kokoska and Easterbrooks,2011)-->
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
    const applicationContactInformation = <?php echo json_encode($applicationContactFields); ?>;//(W3Schools,2023)

    //Showcasing active link
    document.addEventListener("DOMContentLoaded", function () {
        const currentPage = window.location.pathname.split('/').pop().split('.php')[0];
        const navLinks = document.querySelectorAll(".topnav a");

        for (const link of navLinks) {
            if (link.getAttribute("href") === currentPage + ".php") {
                link.classList.add("active");
            }
        }
    });//(W3Schools,2023)

    //Attach a click event listener to the element with id "download-pdf"
    document.getElementById("download-pdf").addEventListener("click", function () {
        //Construct a URL to 'generate_pdf.php' with the application data encoded as a query parameter
        window.location.href = 'Generate_Contact_Details_pdf.php?data=' + encodeURIComponent(JSON.stringify(applicationContactInformation));
    });//(W3Schools,2023)

    //Redirect the user to the "PdfReports.php" page
    function exitPage() {
        window.location.href = "PdfReports.php";
    }//(W3Schools,2023)
</script>
</body>
</html>