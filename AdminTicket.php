<?php
global $conn;
require_once 'DBConn.php';

//Check if the user is authenticated as an admin(Gosselin, Kokoska and Easterbrooks,2011)
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    // Redirect to the AdminLogin.php page if not authenticated(Gosselin, Kokoska and Easterbrooks,2011)
    header("Location: AdminLogin.php");
    exit();
}

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message18'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message18'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message18']);
}

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Function to fetch all tickets from the MySQL database(Gosselin, Kokoska and Easterbrooks,2011)
function getAllTicketsFromMySQL($conn)
{
    $sql = "SELECT * FROM tickets"; //Define the SQL query to select all data from the 'tickets' table (replace with your actual table name)(Gosselin, Kokoska and Easterbrooks,2011)
    $result = mysqli_query($conn, $sql); //Execute the SQL query using the provided database connection(Gosselin, Kokoska and Easterbrooks,2011)

    $data = array(); //Initialize an array to store the retrieved ticket data(Gosselin, Kokoska and Easterbrooks,2011)

    if (mysqli_num_rows($result) > 0) {
        //If there are rows in the query result, loop through each row and store it in the 'data' array(Gosselin, Kokoska and Easterbrooks,2011)
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row; //Append the current row to the 'data' array(Gosselin, Kokoska and Easterbrooks,2011)
        }
    }

    return $data; //Return the array containing all the ticket data(Gosselin, Kokoska and Easterbrooks,2011)
}

//Get all tickets from MySQL(Gosselin, Kokoska and Easterbrooks,2011)
$tickets = getAllTicketsFromMySQL($conn);
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--Define the viewport for responsive design(W3Schools,2023) -->
        <link rel="stylesheet" href="CSS/admin.css"> <!--Include a custom admin.css stylesheet(W3Schools,2023) -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> <!--Include Font Awesome icons(W3Schools,2023) -->
        <title>Admin Ticket</title>

    </head>
    <style>
        /*Define CSS styles for tables and table cells(W3Schools,2023) */
        table, td, th {
            border: 1px solid #ddd;
            text-align: center;
        }

        /*Style for the entire table(W3Schools,2023) */
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #caacd2;
        }

        /*Style for table headers and cells(W3Schools,2023) */
        th, td {
            padding: 15px;
        }

        /*Style for navigation links in a top navigation bar(W3Schools,2023) */
        .topnav a {
            float: left;
            color: black;
            text-align: center;
            padding: 16px 16px;
            text-decoration: none;
            font-size: 17px;
            display: block;
            width: 10.7%;
        }

        /*Style for buttons(W3Schools,2023) */
        .btn {
            padding: 5px 12px;
            font-size: 15px;
            color: black;
            background: #77d4e3;
            border: none;
            border-radius: 5px;
            margin-left: 58px;
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


    <h1><u><b>ADMIN TICKETS</b></u></h1>

    <div style="overflow-x:auto;">
        <?php if (empty($tickets)): ?>
            <!--Displaying a message when there are no tickets found(Gosselin, Kokoska and Easterbrooks,2011) -->
            <p>No tickets found.</p>
        <?php else: ?>
            <table>
                <thead>
                <tr>
                    <th>Parent First Name</th>
                    <th>Parent Last Name</th>
                    <th>Parent Email</th>
                    <th>Parent Phone</th>
                    <th>Query</th>
                    <th>Admin Response</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tickets as $ticket_id => $ticket): ?>
                    <!--Iterating through the list of tickets(Gosselin, Kokoska and Easterbrooks,2011) -->
                    <tr>
                        <td><?php echo $ticket['parent_first_name']; ?></td>
                        <td><?php echo $ticket['parent_last_name']; ?></td>
                        <td><?php echo $ticket['parent_email']; ?></td>
                        <td><?php echo $ticket['parent_phone']; ?></td>
                        <td><?php echo $ticket['query']; ?></td>
                        <td><?php echo $ticket['admin_response']; ?></td>
                        <td>
                            <a href="AdminRespond.php?ticket_id=<?php echo $ticket['ticket_id']; ?>"
                               style="color: black; text-decoration: none;" class="btn">Respond</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <br><br>

    <footer>
        <p style="text-align: center">44 Fourth Avenue, Newton Park, Port Elizabeth</p>
        <p style="text-align: center"><a href="tel:0413654013" style="color: black">0413654013</a></p>
        <div class="center">
            <div class="row"> <!--(W3Schools,2023)-->
                <div class="column">
                    <a href="https://www.facebook.com/JustLoveLearnandPlay" target="blank"><img
                                src="Images/Facebook.png"
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
        //Function to toggle navigation menu
        function toggleNav() {
            var nav = document.getElementsByClassName("topnav")[0];
            if (nav.className === "topnav") {
                nav.className += " responsive";
            } else {
                nav.className = "topnav";
            }
        }<!--(W3Schools,2023)-->

        //Showcasing active link
        document.addEventListener("DOMContentLoaded", function () {
            const currentPage = window.location.pathname.split('/').pop().split('.php')[0];
            const navLinks = document.querySelectorAll(".topnav a");

            for (const link of navLinks) {
                if (link.getAttribute("href") === currentPage + ".php") {
                    link.classList.add("active");
                }
            }
        });<!--(W3Schools,2023)-->
    </script>

    </body>
    </html>
<?php
// Close the MySQL connection(Gosselin, Kokoska and Easterbrooks,2011)
mysqli_close($conn);
?>