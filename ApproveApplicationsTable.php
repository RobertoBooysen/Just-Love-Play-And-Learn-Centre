<?php
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    // Redirect to the AdminLogin.php page if not authenticated
    header("Location: AdminLogin.php");
    exit();
}

//Function to get approved applications from the SQL database(Gosselin, Kokoska and Easterbrooks,2011)
function getApplicationFields($conn)
{
    $sql = "SELECT * FROM application WHERE status='approved'";
    $result = $conn->query($sql);

    $applicationFields = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //Extract application fields and add them to the $applicationFields array(Gosselin, Kokoska and Easterbrooks,2011)
            $applicationFields[] = array(
                'admission_id' => $row['admission_id'],
                'admission_date' => $row['admission_date'],
                'care_type' => $row['care_type'],
                'child_name' => $row['child_name'],
                'child_dob' => $row['child_dob'],
                'child_age' => $row['child_age'],
                'guardian_one_relationship' => $row['guardian_one_relationship'],
                'guardian_one_name' => $row['guardian_one_name'],
                'guardian_one_home_address' => $row['guardian_one_home_address'],
                'guardian_one_id_number' => $row['guardian_one_id_number'],
                'guardian_one_email' => $row['guardian_one_email'],
                'guardian_one_home_tel' => $row['guardian_one_home_tel'],
                'guardian_one_work_tel' => $row['guardian_one_work_tel'],
                'guardian_one_cellphone' => $row['guardian_one_cellphone'],
                'guardian_one_company' => $row['guardian_one_company'],
                'guardian_one_work_address' => $row['guardian_one_work_address'],
                'guardian_two_relationship' => $row['guardian_two_relationship'],
                'guardian_two_name' => $row['guardian_two_name'],
                'guardian_two_home_address' => $row['guardian_two_home_address'],
                'guardian_two_id_number' => $row['guardian_two_id_number'],
                'guardian_two_email' => $row['guardian_two_email'],
                'guardian_two_home_tel' => $row['guardian_two_home_tel'],
                'guardian_two_work_tel' => $row['guardian_two_work_tel'],
                'guardian_two_cellphone' => $row['guardian_two_cellphone'],
                'guardian_two_company' => $row['guardian_two_company'],
                'guardian_two_work_address' => $row['guardian_two_work_address'],
                'reasons' => $row['reasons'],
                'application_date' => $row['application_date'],
                'parent_signature' => $row['parent_signature'],
                'child_id' => $row['child_id'],
                'full_name' => $row['full_name'],
                'date_of_birth' => $row['date_of_birth'],
                'grade' => $row['grade'],
                'home_language' => $row['home_language'],
                'religion' => $row['religion'],
                'marital_status' => $row['marital_status'],
                'num_children' => $row['num_children'],
                'other_children_ages' => $row['other_children_ages'],
                'birth_problems' => $row['birth_problems'],
                'contagious_illnesses' => $row['contagious_illnesses'],
                'allergies' => $row['allergies'],
                'family_doctor' => $row['family_doctor'],
                'morning_bringer' => $row['morning_bringer'],
                'afternoon_fetcher' => $row['afternoon_fetcher'],
                'emergency_contact' => $row['emergency_contact'],
                'other_information' => $row['other_information'],
                'previous_school' => $row['previous_school'],
                'school_telephone' => $row['school_telephone'],
                'indemnity_child_name' => $row['indemnity_child_name'],
                'yearly_fees_months' => $row['yearly_fees_months'],
            );
        }
    }
    //Returning the extracted application fields(Gosselin, Kokoska and Easterbrooks,2011)
    return $applicationFields;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Get all application fields using the defined function(Gosselin, Kokoska and Easterbrooks,2011)
$applicationFields = getApplicationFields($conn);

//Close the database connection (if needed) at the end of your script(Gosselin, Kokoska and Easterbrooks,2011)
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Define the viewport for responsive design(W3Schools,2023) -->
    <link rel="stylesheet" href="CSS/admin.css">
    <!--Include a custom admin.css stylesheet(W3Schools,2023) -->
    <title>Approved Applications Table</title>
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

    /*Styles for the search container(W3Schools,2023) */
    #searchContainer {
        display: flex; /*Use flexbox for layout(W3Schools,2023) */
        justify-content: space-between; /*Space elements evenly(W3Schools,2023) */
        align-items: center; /*Center items vertically(W3Schools,2023) */
        margin: 10px auto; /*Center the container and add margin(W3Schools,2023) */
        max-width: 80%; /*Limit the maximum width(W3Schools,2023) */
    }

    /*Add styles for the search input(W3Schools,2023) */
    #searchInput {
        width: 80%; /*Set the width of the input(W3Schools,2023) */
        font-size: 15px;/*Set the font size(W3Schools,2023) */
        padding: 10px; /*Add padding to the input(W3Schools,2023) */
        margin: 10px auto; /*Center the input and add margin(W3Schools,2023) */
        display: block; /*Display as block to take full width(W3Schools,2023) */
        box-sizing: border-box; /*Include padding and border in the element's total width and height(W3Schools,2023) */
    }

    /*Styles for the refresh button(W3Schools,2023) */
    #refreshButton {
        padding: 10px; /*Padding to the button(W3Schools,2023)*/
        background-color: #77d4e3; /*Background color for the button(W3Schools,2023) */
        font-size: 15px;/*Set the font size(W3Schools,2023) */
        border: none; /*Remove button border(W3Schools,2023) */
        border-radius: 5px; /*Apply border-radius to the button(W3Schools,2023) */
        color: black; /*Text color for the button(W3Schools,2023) */
        cursor: pointer; /*Change cursor to pointer on hover(W3Schools,2023) */
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

    /*Button styling(W3Schools,2023) */
    .delete-button {
        padding: 5px 12px;
        font-size: 15px;
        color: black;
        background: #d03c2f;
        border: none;
        border-radius: 5px;
        margin-left: 58px;
    }

    /*styling button group(W3Schools,2023)*/
    .button-group {
        display: flex; /*Use flexbox for horizontal layout(W3Schools,2023) */
        align-items: center; /*Center items vertically(W3Schools,2023) */
    }

    .add-button {
        background-color: #77d4e3;
        color: black;
        border: none;
        padding: 10px 20px;
        margin: 20px;
        border-radius: 5px;
        cursor: pointer;
        top: 80px; /* Position the download button below the exit button with 20px spacing(W3Schools,2023) */
        left: 20px;
    }

    /*Button styling(W3Schools,2023) */
    .delete-button {
        padding: 5px 12px;
        font-size: 15px;
        color: black;
        background: #d03c2f;
        border: none;
        border-radius: 5px;
        margin-left: 58px;
    }

    /*Styles for the exit button(W3Schools,2023) */
    .exit-button {
        position: fixed; /*Set the button's position to fixed(W3Schools,2023) */
        top: 20px; /*Distance from the top of the viewport(W3Schools,2023) */
        left: 20px; /*Distance from the left of the viewport(W3Schools,2023) */
        background-color: #d03c2f; /*Background color for the exit button(W3Schools,2023) */
        color: #ffffff; /*Text color for the exit button(W3Schools,2023) */
        padding: 10px 20px; /*Padding for the button(W3Schools,2023) */
        border: none; /*Remove button border(W3Schools,2023) */
        border-radius: 5px; /*Apply border-radius to the button(W3Schools,2023) */
        font-size: 16px; /*Set font size for the button(W3Schools,2023) */
        cursor: pointer; /*Change cursor to a pointer on hover(W3Schools,2023) */

    }

    .exit-button:hover {
        background-color: #41c4d8; /*Change background color on hover(W3Schools,2023) */
        color: black; /*Change text color on hover(W3Schools,2023) */
    }

    /*Styles for smaller screens/*(W3Schools,2023) */
    @media only screen and (max-width: 600px) {
        #searchContainer {
            flex-direction: column;
            align-items: stretch;
        }

        #searchInput {
            width: 100%;
        }

        #refreshButton {
            margin-top: 10px;
        }
    }

</style>
<body>

<button class="exit-button" onclick="exitPage()">Exit</button>

<br><br><br><br><br>

<a href="Application.php" type="button" class="add-button" style="text-decoration:none;">Add New
    Application</a>
<br><br>

<h1>Approved Applications</h1>

<!--Search container with the new styles(W3Schools,2023)-->
<div id="searchContainer">
    <!--Search input with the new styles(W3Schools,2023)-->
    <input type="text" id="searchInput" placeholder="Search by Child Name" oninput="searchTable()">

    <!--Refresh button with the new styles(W3Schools,2023)-->
    <button id="refreshButton" onclick="refreshTable()">Refresh</button>
</div>

<br><br>


<div style="overflow-x:auto;">
    <?php if (empty($applicationFields)): ?>
        <!--Displaying a message when there are no approved applications found(Gosselin, Kokoska and Easterbrooks,2011) -->
        <p>No approved applications found.</p>
    <?php else: ?>
        <!--Creating a table to display approved applications(Gosselin, Kokoska and Easterbrooks,2011) -->
        <table>
            <thead>
            <tr>
                <th style="width: 20%">Admission Date</th>
                <th style="width: 20%">Care Type</th>
                <th style="width: 20%">Child Name</th>
                <th style="width: 20%">Child DOB</th>
                <th style="width: 20%">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($applicationFields as $application): ?>
                <tr>
                    <td><?php echo $application['admission_date']; ?></td>
                    <td><?php echo $application['care_type']; ?></td>
                    <td><?php echo $application['child_name']; ?></td>
                    <td><?php echo $application['child_dob']; ?></td>
                    <td>
                        <div class="button-group">
                            <a style="text-decoration: none;"
                               href="View_application_details.php?admission_id=<?php echo $application['admission_id']; ?>"
                               class="btn">View</a><!--(Gosselin, Kokoska and Easterbrooks,2011)-->

                            <button class="btn" data-child-name="<?php echo $application['child_name']; ?>">
                                <a href="EditApproveApplication.php?child_name=<?php echo $application['child_name']; ?>"
                                   style="color: black; text-decoration: none;">Edit</a>
                            </button>
                            <button class="delete-button" data-child-name="<?php echo $application['child_name']; ?>">
                                <a href="DeleteApproveApplication.php?child_name=<?php echo $application['child_name']; ?>"
                                   style="color: white; text-decoration: none;">Delete</a>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
    //JavaScript function to handle search(W3Schools,2023)
    function searchTable() {
        //Get the input value(W3Schools,2023)
        var searchValue = document.getElementById("searchInput").value.toUpperCase();

        //Get the table rows(W3Schools,2023)
        var rows = document.querySelector("table tbody").rows;

        //Loop through all table rows(W3Schools,2023)
        for (var i = 0; i < rows.length; i++) {
            //Get the child name column value for each row(W3Schools,2023)
            var childName = rows[i].cells[2].textContent || rows[i].cells[2].innerText;

            //Convert the child name to uppercase for case-insensitive search(W3Schools,2023)
            childName = childName.toUpperCase();

            //Check if the search value is present in the child name(W3Schools,2023)
            if (childName.indexOf(searchValue) > -1) {
                //Display the row if the search value is found(W3Schools,2023)
                rows[i].style.display = "";
            } else {
                // ide the row if the search value is not found(W3Schools,2023)
                rows[i].style.display = "none";
            }
        }
    }

    //JavaScript function to handle refresh(W3Schools,2023)
    function refreshTable() {
        //Clear the search input(W3Schools,2023)
        document.getElementById("searchInput").value = "";

        //Get the table rows(W3Schools,2023)
        var rows = document.querySelector("table tbody").rows;

        //Loop through all table rows and display them(W3Schools,2023)
        for (var i = 0; i < rows.length; i++) {
            rows[i].style.display = "";
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

    //For clicking the view button in the application table(W3Schools,2023)
    const viewButtons = document.querySelectorAll('.view-button');

    viewButtons.forEach(button => {
        button.addEventListener('click', () => {
            const applicationData = JSON.parse(button.getAttribute('data-application'));
            //Redirect to the new page with the application data as a query parameter(W3Schools,2023)
            window.location.href = `view_application_details.php?data=${encodeURIComponent(JSON.stringify(applicationData))}`;
        });
    });

    //Function to exit the page(W3Schools,2023)
    function exitPage() {
        window.location.href = "AdminHome.php";
    }
</script>

</body>
</html>