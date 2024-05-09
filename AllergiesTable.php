<?php
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    // Redirect to the AdminLogin.php page if not authenticated(Gosselin, Kokoska and Easterbrooks,2011)
    header("Location: AdminLogin.php");
    exit();
}

//Function to get approved children's allergies from the SQL database(Gosselin, Kokoska and Easterbrooks,2011)
function getAllergiesFields($conn)
{
    $sql = "SELECT child_name,allergies FROM application WHERE status='approved'";
    $result = $conn->query($sql);

    $allergiesFields = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //Extract application fields and add them to the $applicationFields array(Gosselin, Kokoska and Easterbrooks,2011)
            $allergiesFields[] = array(
                'child_name' => $row['child_name'],
                'allergies' => $row['allergies'],
            );
        }
    }
    //Returning the extracted application fields(Gosselin, Kokoska and Easterbrooks,2011)
    return $allergiesFields;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Get all application fields using the defined function(Gosselin, Kokoska and Easterbrooks,2011)
$allergiesFields = getAllergiesFields($conn);

//Close the database connection (if needed) at the end of your script(Gosselin, Kokoska and Easterbrooks,2011)
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <!--Set the viewport for responsive design (W3Schools, 2023) -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Link to custom stylesheet (W3Schools, 2023) -->
    <link rel="stylesheet" href="CSS/admin.css">

    <!--Set the title of the page (W3Schools, 2023) -->
    <title>Allergies Table</title>
</head>
<style>
    /*Styles for table, td, th elements (W3Schools, 2023) */
    table, td, th {
        border: 1px solid #ddd;
        text-align: center;
    }

    /*Styles for the table (W3Schools, 2023) */
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #caacd2;
    }

    /*Styles for th, td elements (W3Schools, 2023) */
    th, td {
        padding: 15px;
    }

    /*Styles for buttons with class 'btn' (W3Schools, 2023) */
    .btn {
        padding: 5px 12px;
        font-size: 15px;
        color: black;
        background: #77d4e3;
        border: none;
        border-radius: 5px;
        margin-left: 58px;
    }

    /*Styles for the download-pdf button (W3Schools, 2023) */
    .download-pdf {
        background-color: #77d4e3;
        color: black;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        position: fixed;
        top: 80px; /*Position the download button below the exit button with 20px spacing(W3Schools, 2023) */
        left: 20px;
    }

    /*Styles for the exit-button (W3Schools, 2023) */
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

    /*Hover effect for the exit-button (W3Schools, 2023) */
    .exit-button:hover {
        background-color: #41c4d8;
        color: black;
    }
</style>
<body>

<button class="exit-button" onclick="exitPage()">Exit</button>

<br><br><br><br><br>

<!--Add a "Download PDF" button(W3Schools, 2023) -->
<button class="download-pdf" id="download-pdf">Download PDF</button>

<br>

<h1>Allergies Report</h1>
<br>
<br><br>

<?php if (empty($allergiesFields)): ?>
    <!--Displaying a message when there are no approved children's allergies found(Gosselin, Kokoska and Easterbrooks,2011) -->
    <p>No approved allergies report found.</p>
<?php else: ?>
    <!--Creating a table to display approved children's allergies(Gosselin, Kokoska and Easterbrooks,2011) -->
    <table>
        <thead>
        <tr>
            <th style="width: 50%">Child Name</th>
            <th style="width: 50%">Allergies</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($allergiesFields as $allergiesInformation): ?>
            <tr>
                <td><?php echo $allergiesInformation['child_name']; ?></td>
                <td><?php echo $allergiesInformation['allergies']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<script>
    const $allergiesInformation = <?php echo json_encode($allergiesFields); ?>;

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
        window.location.href = 'Generate_Allergies_pdf.php?data=' + encodeURIComponent(JSON.stringify($allergiesInformation));
    });

    //Function to exit the page(W3Schools,2023)
    function exitPage() {
        window.location.href = "PdfReports.php";
    }
</script>

</body>
</html>