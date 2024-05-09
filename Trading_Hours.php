<!DOCTYPE html>
<html>
<head>
    <!-- Setting the ViewPort -->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!-- (W3Schools,2023) -->
    <!-- Stylesheet -->
    <link rel="stylesheet" href="CSS/style.css">
    <!-- (W3Schools,2023) -->
    <title>Trading Hours</title>
</head>
<style>
    /* Styling table */
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 80%; /* Reduce the table width to 80% */
        border: 1px solid #caacd2;
        font-size: 14px; /* Reduce the font size */
    }

    /* Styling table */
    th, td {
        text-align: center;
        padding: 6px; /* Reduce the padding */
    }

    /* Styling table */
    tr:nth-child(even) {
        background-color: #77d4e3;
    }

    /* Styling div */
    div.a {
        text-align: center;
    }

    /* Styles for the exit button */
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

    /* Styling the exit button hover */
    .exit-button:hover {
        background-color: #41c4d8;
        color: black;
    }
    /* Add this specific style for the "Open on demand" cell */
    .on-demand {
        white-space: nowrap; /* Prevent breaking of text */
    }
</style>
<body>
<!-- Exit button -->
<button class="exit-button" onclick="exitPage()">Exit</button><!-- (W3Schools,2023) -->
<!-- Displaying Daycare Logo -->
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo">
</div><!-- (W3Schools,2023) -->
<!-- Trading Hours Heading -->
<h1 style="color:#77d4e3;"><u><b>Trading Hours</b></u></h1><!-- (W3Schools,2023) -->
<br>
<!-- This table provides information about operating hours -->
<div class="a" style="padding-right: 5%; padding-left: 20%; text-align: justify">
    <div style="overflow-x:auto;">
        <table>
            <tr>
                <th>Days</th>
                <th>Time</th>
            </tr>
            <tr style="background-color: #caacd2;">
                <td>Monday</td>
                <td>7:00am-5:30pm</td>
            </tr>
            <tr>
                <td>Tuesday</td>
                <td>7:00am-5:30pm</td>
            </tr>
            <tr style="background-color:#ccccff">
                <td>Wednesday</td>
                <td>7:00am-5:30pm</td>
            </tr>
            <tr>
                <td>Thursday</td>
                <td>7:00am-5:30pm</td>
            </tr>
            <tr>
                <td>Friday</td>
                <td>7:00am-5:30pm</td>
            </tr>
            <tr>
                <td>Saturday</td>
                <td>Closed</td>
            </tr>
            <tr style="background-color:#ccccff">
                <td>Sunday</td>
                <td>Closed</td>
            </tr>
            <tr>
                <td>Public Holidays</td>
                <td>Closed</td>
            </tr>
            <tr style="background-color: #caacd2;">
                <td >School Holidays</td>
                <td class="on-demand">Open:Term 1<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Term 2<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Term 3<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Term 4:Open on demand</b></td>
            </tr>
        </table><!-- (W3Schools,2023) -->
    </div>
</div>
<br><br>
<footer>
    <!-- This paragraph contains the address and is centered -->
    <p style="text-align: center">44 Fourth Avenue, Newton Park, Port Elizabeth</p>
    <!-- This paragraph contains a phone number link with black text color -->
    <p style="text-align: center"><a href="tel:0413654013" style="color: black">0413654013</a></p><!-- (W3Schools,2023) -->
    <div class="center">
        <div class="row">
            <!-- Displaying social media Facebook icon -->
            <div class="column">
                <a href="https://www.facebook.com/JustLoveLearnandPlay" target="_blank"><img src="Images/Facebook.png"
                                                                                             alt="Facebook logo"
                                                                                             style="width:20%"></a>
            </div><!-- (W3Schools,2023) -->
            <!-- Display social media Email icon -->
            <div class="column">
                <a href="mailto:jlplayandcentre@gmail.com" target="_blank"><img src="Images/Email.png" alt="Email logo"
                                                                    style="width:20%"></a>
            </div><!-- (W3Schools,2023) -->
            <!-- Display social media WhatsApp icon -->
            <div class="column">
                <a href="tel:0720186560" target="_blank"><img src="Images/Whatsapp.png" alt="Whatsapp logo"
                                                              style="width:20%"></a>
            </div><!-- (W3Schools,2023) -->
        </div>
    </div>
    <br>
    <p style="text-align: center">@2023 RNK. All rights reserved.</p>
</footer>

<script>
    // Function to toggle navigation menu
    function toggleNav() {
        var nav = document.getElementsByClassName("topnav")[0];
        if (nav.className === "topnav") {
            nav.className += " responsive";
        } else {
            nav.className = "topnav";
        }
    }<!--(W3Schools,2023)-->
    // Function to exit the current page and navigate to "AboutUs.php"
    function exitPage() {
        window.location.href = "AboutUs.php";
    }<!--(W3Schools,2023)-->
</script>
</body>
</html>