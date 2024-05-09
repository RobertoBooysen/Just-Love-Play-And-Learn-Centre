<?php
//(Gosselin, Kokoska and Easterbrooks,2011)
require_once 'DBConn.php';

//Check if the user is authenticated
//(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    //Redirect to the AdminLogin.php page if not authenticated
    header("Location: AdminLogin.php");
    exit();
}

global $conn;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission for editing a resource
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $resource_id_to_edit = $_POST['resource_id_to_edit'];
    $newResourceDate = $_POST['newResourceDate'];
    $newResourceName = $_POST['newResourceName'];

    // Handle uploaded file if available
    if (isset($_FILES['newResourceFile']) && $_FILES['newResourceFile']['error'] === UPLOAD_ERR_OK) {
        $newResourceFile = $_FILES['newResourceFile'];
        $uploadDirectory = 'Uploads/';
        $allowedFormats = ['image/png', 'image/jpeg', 'image/jpg'];
        $uniqueFilename = uniqid() . '_' . $newResourceFile['name'];
        $targetFile = $uploadDirectory . $uniqueFilename;
        $fileType = strtolower(pathinfo($newResourceFile['name'], PATHINFO_EXTENSION));

        // Check if the file has a valid extension
        if (!in_array($newResourceFile['type'], $allowedFormats)) {
            echo "Invalid file format. Allowed formats are PNG, JPEG, and JPG.";
            exit();
        }

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($newResourceFile['tmp_name'], $targetFile)) {
            // Update the resource image file path
            $updateFileSQL = "UPDATE resources SET resource_file = ? WHERE resource_id = ?";
            $stmt = $conn->prepare($updateFileSQL);
            $stmt->bind_param("si", $targetFile, $resource_id_to_edit);
            if ($stmt->execute()) {
                // File path updated successfully
            } else {
                echo "Failed to update the resource file path.";
                exit();
            }
            $stmt->close();
        } else {
            echo "Failed to upload the new resource image.";
            exit();
        }
    }

    // Update other resource information
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $updateResourceSQL = "UPDATE resources SET resource_date = ?, resource_name = ? WHERE resource_id = ?";
    $stmt = $conn->prepare($updateResourceSQL);
    $stmt->bind_param("ssi", $newResourceDate, $newResourceName, $resource_id_to_edit);

    if ($stmt->execute()) {
        // Redirect back to the resource list page after editing
        header("Location: ResourcesTable.php");
        exit();
    } else {
        // Update failed
        echo "Resource update failed.";
    }
    $stmt->close();
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['resource_id'])) {
    // Display the edit form for the resource
    $resource_id_to_edit = $_GET['resource_id'];

    // Prepare an SQL statement to fetch the resource by resource_id
    //(Gosselin, Kokoska and Easterbrooks,2011)
    $sql = "SELECT * FROM resources WHERE resource_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $resource_id_to_edit);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $resourceData = $result->fetch_assoc();

        if ($resourceData) {

            ?>

            <!DOCTYPE html>
            <html>
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <!-- Set the viewport for responsive design -->
                <!--(W3Schools,2023-->
                <link rel="stylesheet" href="CSS/admin.css"> <!-- Include a custom admin.css stylesheet -->
                <title>Edit Resource</title>
            </head>
            <style>
                /* Define CSS custom properties */
                /*(W3Schools,2023)*/
                :root {
                    --primary-color: rgb(11, 78, 179);
                }

                /* Apply box-sizing to all elements */
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
                /*(W3Schools,2023)*/
                .btn:hover {
                    box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2;
                }

                /* Style for error messages */
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
            <!--exit button that returns the user to ResourcesTable-->
            <button class="exit-button" onclick="exitPage()">Exit</button>
            <br>

            <h1>Edit Resource</h1>
            <form method="post" action="EditResource.php" class="form" enctype="multipart/form-data">
                <!--Displaying resources information on edit form-->
                <!--(W3Schools,2023)-->
                <input type="hidden" name="resource_id_to_edit" value="<?php echo $resource_id_to_edit; ?>">
                <label for="newResourceName">New Resource Name:</label>
                <input type="text" name="newResourceName" id="newResourceName"
                       value="<?php echo $resourceData['resource_name']; ?>">
                <br>
                <label for="newResourceDate">New Resource Date:</label>
                <input type="text" name="newResourceDate" id="newResourceDate"
                       value="<?php echo $resourceData['resource_date']; ?>">
                <input type="hidden" name="existingImageFile" value="<?php echo $resourceData['resource_file']; ?>">

                <!-- Display the existing image -->
                <!--(W3Schools,2023)-->
                <label>Existing Image:</label>
                <img src="<?php echo $resourceData['resource_file']; ?>" alt="Existing Image"
                     style="max-width: 100%; height: auto; margin-bottom: 10px;">

                <!-- Input for the new image file -->
                <!--(W3Schools,2023)-->
                <label for="newResourceFile"> Select New Image File:</label>
                <input type="file" name="newResourceFile" id="newResourceFile" accept=".png, .jpg, .jpeg">
                <p id="file-error-message" style="color: red;"></p>
                <br>
                <input type="submit" value="Save" class="btn">
            </form>
            </body>
            <script>

                // Function to validate the form before submission
                //(W3Schools,2023)
                function validateForm() {
                    // Get the file input and error message elements
                    var fileInput = document.getElementById('newResourceFile');
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
                        //(W3Schools,2023)
                        errorMessage.textContent = 'Please select an image file.';
                        return false;
                    }

                    // Return true if all validations pass
                    return true;
                }

                // Function to navigate away from the current page
                //(W3Schools,2023)
                function exitPage() {
                    // Redirect to the specified page (ResourcesTable.php)
                    window.location.href = "ResourcesTable.php";
                }
            </script>
            </html>
            <?php
        } else {
            //Resource not found or missing data
            //(W3Schools,2023)
            echo "Resource not found or missing data.";
        }
    }

    $stmt->close();
} else {
    //Invalid request
    //(Gosselin, Kokoska and Easterbrooks,2011)
    header("Location: ResourcesTable.php");
    exit();
}

//Close the database connection
$conn->close();
?>