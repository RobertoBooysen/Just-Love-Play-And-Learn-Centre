<?php
global $conn;
require_once 'DBConn.php';

//Checking if the user is authenticated as an admin(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    // Redirecting to the AdminLogin.php page if not authenticated(Gosselin, Kokoska and Easterbrooks,2011)
    header("Location: AdminLogin.php");
    exit();
}

//Function to check if a specific child ID exists in the SQL table(Gosselin, Kokoska and Easterbrooks,2011)
function isIDExists($cid, $conn)
{
    $query = "SELECT c_id FROM diary WHERE c_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $cid);
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;
    $stmt->close();

    return $count > 0;
}

//Function to insert diary entries with a child's name and ID into the SQL table(Gosselin, Kokoska and Easterbrooks,2011)
function insertDiaryEntry($cid, $cname, $diaryDescription, $date, $conn)
{
    //Define the SQL query for inserting diary data(Gosselin, Kokoska and Easterbrooks,2011)
    $query = "INSERT INTO diary (c_id, c_name, diary_description, date) VALUES (?, ?, ?, ?)";

    //Prepare the SQL statement with placeholders to prevent SQL injection(Gosselin, Kokoska and Easterbrooks,2011)
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $cid, $cname, $diaryDescription, $date);

    //Execute the prepared statement(Gosselin, Kokoska and Easterbrooks,2011)
    $result = $stmt->execute();

    //Close the prepared statement(Gosselin, Kokoska and Easterbrooks,2011)
    $stmt->close();

    return $result; //Return true if the diary data is successfully inserted, otherwise return false(Gosselin, Kokoska and Easterbrooks,2011)
}

//Function to retrieve child names and IDs from the SQL table(Gosselin, Kokoska and Easterbrooks,2011)
function getChildNamesAndIDs($conn)
{
    $query = "SELECT id, c_name FROM parents"; //SQL query to select child IDs and names(Gosselin, Kokoska and Easterbrooks,2011)
    $result = $conn->query($query); //Execute the SQL query(Gosselin, Kokoska and Easterbrooks,2011)

    $childNamesAndIDs = []; //Initialize an array to store child names and IDs(Gosselin, Kokoska and Easterbrooks,2011)

    if ($result->num_rows > 0) {
        //Loop through the query result and create an array with child names and IDs(Gosselin, Kokoska and Easterbrooks,2011)
        while ($row = $result->fetch_assoc()) {
            $childNamesAndIDs[] = [
                'c_name' => $row['c_name'] . ' (' . $row['id'] . ')', //Combine child name and ID for display(Gosselin, Kokoska and Easterbrooks,2011)
                'c_id' => $row['id'] //Store the child ID separately(Gosselin, Kokoska and Easterbrooks,2011)
            ];
        }
    }

    return $childNamesAndIDs; //Return the array containing child names and IDs(Gosselin, Kokoska and Easterbrooks,2011)
}

//Function to generate a unique ID based on an age group(Gosselin, Kokoska and Easterbrooks,2011)
function generateUniqueID($ageGroup)
{
    $timestamp = time();
    $ageGroup = str_replace(' ', '', $ageGroup);
    return strtolower($ageGroup . '_' . $timestamp);
}

//Check if the HTTP request method is POST(Gosselin, Kokoska and Easterbrooks,2011)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Generate a unique ID for the diary entry based on the child's name(Gosselin, Kokoska and Easterbrooks,2011)
    $eid = generateUniqueID($_POST['child_name']);

    //Get the selected child's name and ID from POST data(Gosselin, Kokoska and Easterbrooks,2011)
    $selectedChildName = $_POST['child_name'];
    $selectedChildID = $_POST['child_id'];

    //Handle the diary entry submission(Gosselin, Kokoska and Easterbrooks,2011)
    $diaryDescription = $_POST['diary_description'];
    $date = $_POST['diary_date']; // You should add a date field in your HTML form(Gosselin, Kokoska and Easterbrooks,2011)

    //Check if the unique ID already exists in the SQL table(Gosselin, Kokoska and Easterbrooks,2011)
    if (isIDExists($eid, $conn)) {
        echo "<script>alert('Failed to add diary entry. Please try again.')</script>";
    } else {
        //Insert the diary data into the SQL table(Gosselin, Kokoska and Easterbrooks,2011)
        $result = insertDiaryEntry($eid, $selectedChildName, $diaryDescription, $date, $conn);

        if ($result) {
            //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
            $_SESSION['success_message2'] = 'Successfully Added Diary Entry.';

            //Redirect to the AdminHome.php page on successful addition(Gosselin, Kokoska and Easterbrooks,2011)
            header("Location: AdminHome.php");
            exit();
        } else {
            echo "Failed to add diary entry.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!--Set the viewport for responsive design(W3Schools,2023) -->
    <link rel="stylesheet" href="CSS/admin.css"> <!--Include a custom admin.css stylesheet(W3Schools,2023) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <title>Admin Diary</title>
    <!--Include Font Awesome icons(W3Schools,2023) -->
</head>
<style>
    :root {
        --primary-color: rgb(11, 78, 179); /*Define a CSS custom property for primary color(W3Schools,2023) */
    }

    *, *::before, *::after {
        box-sizing: border-box; /*Apply box-sizing to all elements(W3Schools,2023) */
    }

    label {
        display: block;
        margin-bottom: 0.5rem; /*Style for form labels(W3Schools,2023) */
    }

    input {
        display: block;
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        height: 50px; /*Style for form input elements(W3Schools,2023) */
    }

    .width-50 {
        width: 50%; /*Style class for 50% width(W3Schools,2023) */
    }

    .ml-auto {
        margin-left: auto; /*Style class for auto margin left(W3Schools,2023) */
    }

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

    .btn {
        padding: 0.75rem;
        display: block;
        text-decoration: none;
        background-color: #77d4e3;
        color: black;
        text-align: center;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: 0.3s; /*Style for buttons(W3Schools,2023) */
    }

    .btn:hover {
        box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2; /*Style for button hover effect(W3Schools,2023) */
    }

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
        z-index: 9999; /*Style for error message display(W3Schools,2023) */
    }
</style>
<body>
<!--Top navigation bar(W3Schools,2023)-->
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->
<div class="topnav">
    <a href="AdminHome.php">Home</a>
    <a href="AdminDiary.php">Diary</a>
    <a href="AdminResources.php">Resources</a>
    <a href="AdminEvents.php">Events</a>
    <a href="AdminImages.php">Images</a>
    <a href="AdminTour.php">Tour</a>
    <a href="AdminTicket.php">Ticket</a>
    <div class="dropdown">
        <button class="dropbtn">
            <i class="fa fa-fw fa-user" style="color: black"></i>
        </button>
        <div class="dropdown-content">
            <a href="index.php" style="width:100%">Log Out</a>
        </div>
    </div>
    <a href="javascript:void(0);" class="icon" onclick="toggleNav()">&#9776;</a>
</div>

<h1><u><b>ADMIN DIARY</b></u></h1> <!--Heading for Admin Diary section(W3Schools,2023) -->
<br>
<form action="AdminDiary.php" method="post" class="form" id="forms" enctype="multipart/form-data">
    <div class="group-inputs">
        <label for="grade">Grade:</label>
        <select id="grade" name="grade" style="width: 100%;height: 40px;font-size: 14px;" required>
            <option value="">Select a grade</option>
            <option value="Babies">Babies(0-12months)</option>
            <option value="TwoToThree">Two To Three</option>
            <option value="ThreeToFour">Three To Four</option>
            <option value="GradeR">Grade R</option>
            <option value="GradeOne">Grade 1</option>
            <option value="GradeTwo">Grade 2</option>
        </select>
    </div>
    <br>

    <div class="group-inputs">
        <label for="child_name">Select a child</label>
        <select name="child_name" id="child_name" style="width: 100%;height: 40px;font-size: 14px;" required>
            <option value="">Select a child</option>
            <?php
            //Get an array of child names and IDs using the getChildNamesAndIDs() function(Gosselin, Kokoska and Easterbrooks,2011)
            $childNamesAndIDs = getChildNamesAndIDs($conn);

            //Loop through each child in the array(Gosselin, Kokoska and Easterbrooks,2011)
            foreach ($childNamesAndIDs as $child) {
                // Create an option element for each child with a value and data-child-id attribute(Gosselin, Kokoska and Easterbrooks,2011)
                echo "<option value='{$child['c_name']}' data-child-id='{$child['c_id']}'>{$child['c_name']}</option>";
            }

            //Close the database connection(Gosselin, Kokoska and Easterbrooks,2011)
            $conn->close();
            ?>
        </select>
    </div>
    <div>
        <input type="hidden" name="child_id" id="child_id" value="">
        <br>
        <div class="group-inputs">
            <label for="diary_date">Diary Date</label>
            <input type="date" id="diary_date" name="diary_date" value="<?php echo date('Y-m-d'); ?>" readonly required>
            <br>
        </div>
        <div class="group-inputs">
            <label for="diary_description">Diary Description</label>
            <textarea name="diary_description" id="diary_description" rows="4" cols="48" style="width: 100%;" required></textarea>
            <!--Textarea for diary description(Gosselin, Kokoska and Easterbrooks,2011) -->
        </div>
        <br>
    </div>
    <input type="submit" value="Add Diary Entry" id="submit-form" class="btn"/>
    <!--Submit button for adding a diary entry(Gosselin, Kokoska and Easterbrooks,2011) -->
</form>

<br><br>

<footer>
    <p style="text-align: center">44 Fourth Avenue, Newton Park, Port Elizabeth</p>
    <p style="text-align: center"><a href="tel:0413654013" style="color: black">0413654013</a></p>
    <div class="center">
        <div class="row"> <!--(W3Schools,2021)-->
            <div class="column">
                <a href="https://www.facebook.com/JustLoveLearnandPlay" target="blank"><img src="Images/Facebook.png"
                                                                                            alt="Facebook logo"
                                                                                            style="width:20%"></a>
            </div>
            <div class="column">
                <a href="mailto:jlplayandcentre@gmail.com" target="blank"><img src="Images/Email.png" alt="Email logo"
                                                                   style="width:20%"></a>
            </div>
            <div class="column">
                <a href="tel:0720186560>" target="blank"><img src="Images/Whatsapp.png" alt="Whatsapp logo"
                                                              style="width:20%"></a>
            </div>
        </div>
    </div>
    <br>
    <p style="text-align: center">@2023 RNK. All rights reserved.</p>
</footer>


<script>
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

    //Displaying childrens names based on the selected grade dropdown(W3Schools,2023)
    document.getElementById("grade").addEventListener("change", function () {
        const selectedGrade = this.value;
        const childNameDropdown = document.getElementById("child_name");

        childNameDropdown.innerHTML = '<option value="">Select a grade first</option>';

        if (selectedGrade) {
            fetch('get_child_names.php?grade=' + selectedGrade)
                .then(response => response.json())
                .then(data => {
                    data.forEach(child => {
                        const option = document.createElement("option");
                        option.value = child.c_name;
                        option.dataset.childId = child.c_id;
                        option.textContent = child.c_name;
                        childNameDropdown.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>

</body>
</html>
