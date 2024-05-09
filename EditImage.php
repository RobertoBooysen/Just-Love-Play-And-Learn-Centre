<?php
//(Gosselin, Kokoska and Easterbrooks,2011)
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    // Redirect to the AdminLogin.php page if not authenticated
    header("Location: AdminLogin.php");
    exit();
}

//Function to handle image upload and return the relative image path
//(Gosselin, Kokoska and Easterbrooks,2011)
function handleImageUpload()
{
    $uploadDirectory = 'Uploads/'; // Specify the upload directory
    $uniqueFilename = uniqid() . '_' . $_FILES['newImageFile']['name'];
    $targetFile = $uploadDirectory . $uniqueFilename;

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($_FILES['newImageFile']['tmp_name'], $targetFile)) {
        return $targetFile; // Returning the relative image path
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission for editing an image
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $child_id_to_edit = $_POST['child_id_to_edit'];
    $newImageDescription = $_POST['newImageDescription'];
    $newImageDate = $_POST['newImageDate'];

    // Check if a new image file has been uploaded
    if (!empty($_FILES['newImageFile']['name'])) {
        $newImageFile = handleImageUpload();

        if (!$newImageFile) {
            echo "Failed to upload the new image.";
            exit();
        }
    } else {
        // No new image file uploaded, use the existing image file
        $newImageFile = $_POST['existingImageFile'];
    }

    // Prepare a SQL statement to update the image by c_id
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $sql = "UPDATE images SET image_description = ?, image_file = ?, image_date= ? WHERE c_id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $newImageDescription, $newImageFile, $newImageDate, $child_id_to_edit);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect back to the image list page after editing
            header("Location: ImagesTable.php");
            exit();
        } else {
            // Update failed
            echo "Image update failed.";
        }

        // Close the prepared statement
        //(Gosselin, Kokoska and Easterbrooks,2011)
        mysqli_stmt_close($stmt);
    }

    // Close the database connection
    //(Gosselin, Kokoska and Easterbrooks,2011)
    mysqli_close($conn);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['c_id'])) {
    // Display the edit form for the image
    $child_id_to_edit = $_GET['c_id'];

    // Prepare a SQL statement to fetch the image by c_id
    $sql = "SELECT * FROM images WHERE c_id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $child_id_to_edit);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if ($imageData = mysqli_fetch_assoc($result)) {
                ?>

                <?php
            } else {
                // Image not found
                echo "Image not found.";
            }
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    }

    // Close the database connection
    //(Gosselin, Kokoska and Easterbrooks,2011)
    mysqli_close($conn);
} else {
    // Invalid request
    header("Location: ImagesTable.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Set the viewport for responsive design -->
    <!--(W3Schools,2023-->
    <link rel="stylesheet" href="CSS/admin.css"> <!-- Include a custom admin.css stylesheet -->
    <title>Edit Image</title>
</head>
<style>
    /* Define CSS custom properties */
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
    /*(W3Schools,2023)*/
    input {
        display: block;
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        height: 50px;
    }

    /* CSS class for setting width to 50% */
    .width-50 {
        width: 50%;
    }

    /* CSS class for setting margin-left to auto */
    /*(W3Schools,2023)*/
    .ml-auto {
        margin-left: auto;
    }

    /* Style for form container with responsive width */
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
<!--(W3Schools,2023)-->
<!--exit button that returns the user to the Images Table-->

<button class="exit-button" onclick="exitPage()">Exit</button>
<br>

<h1>Edit Image</h1>
<form method="post" action="EditImage.php" class="form" enctype="multipart/form-data">
    <!--Displaying image information on edit form -->
    <!--(W3Schools,2023)-->
    <label for="child_id_to_edit">Image ID:</label>
    <input type="text" name="child_id_to_edit" id="child_id_to_edit"
           value="<?php echo $imageData['c_id'] ?>" readonly>
    <br>
    <label for="child_name_to_edit">Child Name:</label>
    <input type="text" name="child_name_to_edit" id="child_name_to_edit"
           value="<?php echo $imageData['c_name'] ?>" readonly>
    <br>
    <label for="newImageDate">New Date:</label>
    <input type="text" name="newImageDate" id="newImageDate"
           value="<?php echo $imageData['image_date'] ?>">
    <br>
    <label for="newImageDescription">New Image Description:</label>
    <input type="text" name="newImageDescription" id="newImageDescription"
           value="<?php echo $imageData['image_description']; ?>">
    <br>
    <input type="hidden" name="existingImageFile" value="<?php echo $imageData['image_file']; ?>">

    <!-- Display the existing image -->
    <!--(W3Schools,2023)-->
    <label>Existing Image:</label>
    <img src="<?php echo $imageData['image_file']; ?>" alt="Existing Image"
         style="max-width: 100%; height: auto; margin-bottom: 10px;">

    <!-- Input for the new image file -->
    <!--(W3Schools,2023)-->
    <label for="newImageFile"> Select New Image File:</label>
    <input type="file" name="newImageFile" id="newImageFile" accept=".png, .jpg, .jpeg">
    <p id="file-error-message" style="color: red;"></p>
    <br>

    <input type="submit" value="Save" class="btn">
</form>
</body>
<script>
    //(W3Schools,2023)
    // Function to validate the form before submission
    function validateForm() {
        // Get the file input and error message elements
        var fileInput = document.getElementById('newImageFile');
        var errorMessage = document.getElementById('file-error-message');

        // Array of allowed image formats
        var allowedFormats = ['image/png', 'image/jpeg', 'image/jpg'];

        // Check if a file has been selected
        if (fileInput.files.length > 0) {
            // Get the type of the selected file and convert it to lowercase
            var fileType = fileInput.files[0].type.toLowerCase();

            // Check if the file type is among the allowed formats
            if (!allowedFormats.includes(fileType)) {
                // Display an error message for invalid file format
                errorMessage.textContent = 'Invalid file format. Please select a PNG, JPEG, or JPG file.';
                return false;
            } else {
                // Clear the error message if the file format is valid
                errorMessage.textContent = '';
            }
        } else {
            // Display an error message if no file is selected
            errorMessage.textContent = 'Please select an image file.';
            return false;
        }

        // Return true if all validations pass
        return true;
    }

    // Function to navigate away from the current page
    function exitPage() {
        // Redirect to the specified page (ImagesTable.php)
        window.location.href = "ImagesTable.php";
    }

</script>
</html>