<?php
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    // Redirect to the AdminLogin.php page if not authenticated
    header("Location: AdminLogin.php");
    exit();
}

//Function to check if a resource ID exists(Gosselin, Kokoska and Easterbrooks,2011)
function isIDExists($conn, $rid)
{
    //SQL query to check if the resource_id exists in the Resources table(Gosselin, Kokoska and Easterbrooks,2011)
    $sql = "SELECT * FROM resources WHERE resource_id = '$rid'";
    $result = $conn->query($sql);

    return $result->num_rows > 0;
}

//Function to insert a resource into the SQL database(Gosselin, Kokoska and Easterbrooks,2011)
function insertResource($conn, $data)
{
    $name_of_resource = $data['name_of_resource'];
    $resource_date = $data['resource_date'];
    $resource_file = $data['resource_file'];
    $resource_name = $data['resource_name'];

    //SQL query to insert resource data into the Resources table(Gosselin, Kokoska and Easterbrooks,2011)
    $sql = "INSERT INTO resources (name_of_resource, resource_date, resource_file, resource_name) 
            VALUES ('$name_of_resource', '$resource_date', '$resource_file', '$resource_name')";

    if ($conn->query($sql) === TRUE) {
        return true; //Return true if the resource data is successfully inserted(Gosselin, Kokoska and Easterbrooks,2011)
    } else {
        return "Error: " . $sql . "<br>" . $conn->error; //Return an error message if there's an issue during execution(Gosselin, Kokoska and Easterbrooks,2011)
    }
}


//Function to generate a unique resource ID(Gosselin, Kokoska and Easterbrooks,2011)
function generateUniqueID()
{
    return uniqid();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Generate a unique resource ID(Gosselin, Kokoska and Easterbrooks,2011)
    $rid = generateUniqueID(); //This function generates a unique ID for the resource(Gosselin, Kokoska and Easterbrooks,2011)

    //Handle resource upload and get the relative resource path(Gosselin, Kokoska and Easterbrooks,2011)
    $resourcePath = handleResourcesUpload(); //This function handles the resource file upload and returns the relative path to the uploaded resource(Gosselin, Kokoska and Easterbrooks,2011)

    if (!$resourcePath) {
        echo "<script>alert('Failed to upload the resource. Please try again.')</script>"; //Display an alert if the resource upload fails(Gosselin, Kokoska and Easterbrooks,2011)
    } else {
        $data = array(
            'name_of_resource' => $_POST['name_of_resource'],
            'resource_date' => $_POST['resource_date'],
            'resource_file' => $resourcePath,
            'resource_name' => $_POST['resource_name']
        );

        if (isIDExists($conn, $rid)) {
            echo "<script>alert('Failed to add resource. Please try again.')</script>"; //Display an alert if the resource ID already exists(Gosselin, Kokoska and Easterbrooks,2011)
        } else {
            $result = insertResource($conn, $data); //Attempt to insert the resource data(Gosselin, Kokoska and Easterbrooks,2011)

            if ($result === true) {
                //Store the entered data in a session variable for reference(Gosselin, Kokoska and Easterbrooks,2011)
                $_SESSION['resource_data'] = $data;

                //Store a success message in a session variable(Gosselin, Kokoska and Easterbrooks,2011)
                $_SESSION['success_message'] = 'Successfully added resources.';

                header("Location: AdminHome.php"); //Redirect to AdminHome.php(Gosselin, Kokoska and Easterbrooks,2011)

                echo "<script>alert('Successfully Added resources.')</script>"; //Display an alert for successful resource addition(Gosselin, Kokoska and Easterbrooks,2011)

                exit();
            } else {
                echo "Failed to add resources. Error: " . $result; //Display an error message if resource addition fails(Gosselin, Kokoska and Easterbrooks,2011)
            }
        }
    }
}

//Function to handle resource upload and return the relative resource path(Gosselin, Kokoska and Easterbrooks,2011)
function handleResourcesUpload()
{
    if (
        isset($_FILES['resource_file']) &&
        $_FILES['resource_file']['error'] === UPLOAD_ERR_OK
    ) {
        $allowedFormats = ['image/png', 'image/jpeg', 'image/jpg'];

        $fileType = $_FILES['resource_file']['type'];

        // Check if the uploaded file is of an allowed image format(Gosselin, Kokoska and Easterbrooks,2011)
        if (in_array($fileType, $allowedFormats)) {
            $uploadDirectory = 'Uploads/';
            $uniqueFilename =
                uniqid() . '_' . $_FILES['resource_file']['name'];
            $targetFile = $uploadDirectory . $uniqueFilename;

            // Move the uploaded file to the target directory(Gosselin, Kokoska and Easterbrooks,2011)
            if (move_uploaded_file(
                $_FILES['resource_file']['tmp_name'],
                $targetFile
            )) {
                return $targetFile;
            }
        }
    }
    return false;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Define the viewport for responsive design(W3Schools,2023) -->
    <link rel="stylesheet" href="CSS/admin.css"> <!--Include a custom admin.css stylesheet(W3Schools,2023) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!--Include Font Awesome icons(W3Schools,2023) -->
    <title>Admin Resources</title>

</head>
<style>
    :root {
        --primary-color: rgb(11, 78, 179); /*Define a CSS custom property for primary color(W3Schools,2023) */
    }

    /*Box-sizing for all elements and pseudo-elements(W3Schools,2023) */
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    /*Styling for form labels(W3Schools,2023) */
    label {
        display: block;
        margin-bottom: 0.5rem;
    }

    /*Styling for form input elements(W3Schools,2023) */
    input {
        display: block;
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        height: 50px;
    }

    /*Style classes for specific element widths and margin(W3Schools,2023) */
    .width-50 {
        width: 50%;
    }

    .ml-auto {
        margin-left: auto;
    }

    /*Styling for the form container(W3Schools,2023) */
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

    /*Styling for buttons(W3Schools,2023) */
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

    /*Button hover effect(W3Schools,2023) */
    .btn:hover {
        box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2;
    }

    /*Styling for error messages(W3Schools,2023) */
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
</style>
<body>
<!--Top navigation ba(W3Schools,2023)r-->
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

<h1><u><b>ADMIN RESOURCES </b></u></h1> <!--Heading for the page(W3Schools,2023) -->
<br>

<!--Form to add resources(W3Schools,2023)-->
<form action="AdminResources.php" method="post" class="form" id="forms" enctype="multipart/form-data">
    <br>
    <div class="group-inputs">
        <label for="name_of_resource">Name of resource</label>
        <input type="text" name="name_of_resource" id="name_of_resource" required/>
    </div>
    <br>
    <div class="group-inputs">
        <label for="resource_name">Description of resources</label>
        <input type="text" name="resource_name" id="resource_name" required/>
    </div>
    <br>
    <div class="group-inputs">
        <label for="resource_date">Date of resource due</label>
        <input type="date" id="resource_date" name="resource_date"
               required>
    </div>
    <br>
    <div class="group-inputs">
        <input type="file" id="resource_file" name="resource_file" accept=".png, .jpeg, .jpg" required>
        <!--Add the "accept" attribute to specify allowed file formats(W3Schools,2023) -->
        <span class="file-error-message" id="file-error-message"></span>
        <br>
        <input type="submit" value="Add Resource" id="submit-form" class="btn"/>
        <!--Submit button for the form(W3Schools,2023) -->
    </div>
</form>

<br><br>

<footer>
    <p style="text-align: center">44 Fourth Avenue, Newton Park, Port Elizabeth</p>
    <p style="text-align: center"><a href="tel:0413654013" style="color: black">0413654013</a></p>
    <div class="center">
        <div class="row"> <!--(W3Schools,2023)-->
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

    //Error handling to upload valid image(W3Schools,2023)
    document.getElementById('resource_file').addEventListener('change', function () {
        var fileInput = this;
        var errorMessage = document.getElementById('file-error-message');
        var allowedFormats = ['image/png', 'image/jpeg', 'image/jpg'];

        if (fileInput.files.length > 0) {
            var fileType = fileInput.files[0].type.toLowerCase(); //Convert to lowercase for case-insensitive comparison(W3Schools,2023)

            if (!allowedFormats.includes(fileType)) {
                errorMessage.textContent = 'Invalid file format. Please select a PNG, JPEG, or JPG file.';
                fileInput.value = ''; // Clear the file input(W3Schools,2023)
            } else {
                errorMessage.textContent = '';
            }
        }
    });
</script>
</body>
</html>