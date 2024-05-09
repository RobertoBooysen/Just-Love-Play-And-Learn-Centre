<!DOCTYPE html>
<html>
<head>
    <!-- Set the viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--(W3Schools,2023)-->

    <!-- Link to your custom stylesheet -->
    <link rel="stylesheet" href="CSS/style.css"><!--(W3Schools,2023)-->

    <!-- Link to Bootstrap stylesheet for additional styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"><!--(W3Schools,2023)-->

    <!-- Link to Font Awesome for icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"><!--(W3Schools,2023)-->

    <!-- Set the title of the page -->
    <title>Parent</title>
</head>

<style>
    /* CSS styles for the buttons */
    .button-container {
        text-align: center;
        margin: 20px 0;
    }/*(W3Schools,2023)*/

    /*styling button*/
    .button {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #77d4e3;
        color: black;
        border: none;
        border-radius: 5px;
        margin: 5px;
        cursor: pointer;
    }/*(W3Schools,2023)*/

    /*styling button hover*/
    .button:hover {
        box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2
    }/*(W3Schools,2023)*/
</style>
<body>

<!--Displaying logo-->
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->

<!--Top navigation bar-->
<div class="topnav">
    <a href="index.php">Home</a>
    <a href="AboutUs.php">About Us</a>
    <a href="ExtraMurals.php">Extra Murals</a>
    <a href="Application.php">Application</a>
    <a href="Gallery.php">Gallery</a>
    <a href="Tour.php">Schedule Tour</a>
    <a href="ContactUs.php">Contact Us</a><!--(W3Schools,2023)-->
    <div class="dropdown">
        <button class="dropbtn">
            <i class="fa fa-fw fa-user" style="color: black"></i>
        </button><!--(W3Schools,2023)-->
        <div class="dropdown-content">
            <a href="Parent.php">Parent</a>
            <a href="Admin.php">Admin</a>
        </div><!--(W3Schools,2023)-->
    </div>
    <a href="javascript:void(0);" class="icon" onclick="toggleNav()">&#9776;</a>
</div>
<div style="padding-left:16px">
    <!--Parent portal heading-->
    <h1 style="color: black;"><u><b>PARENT PORTAL</b></u></h1>
    <br><br><br><br><br><br><br><br>
    <p style="text-align: center">Please select a button to either register or login.</p>
    <div class="button-container">
        <button class="button">
            <a href="ParentRegister.php" style="color: black; text-decoration:none;">Register</a>
        </button><!--(W3Schools,2023)-->
        <button class="button">
            <a href="ParentLogin.php" style="color: black; text-decoration:none;">Login</a>
        </button><!--(W3Schools,2023)-->
    </div>
</div>
<br><br><br><br>
<!--footer-->
<br><br><br><br><br><br><br><br>
<footer>
    <p style="text-align: center">44 Fourth Avenue, Newton Park, Port Elizabeth</p><!--(W3Schools,2023)-->
    <p style="text-align: center"><a href="tel:0413654013" style="color: black">0413654013</a></p><!--(W3Schools,2023)-->
    <div class="center">
        <div class="row"><!--(W3Schools,2021)-->
            <div class="column"><!--Facebook-->
                <a href="https://www.facebook.com/JustLoveLearnandPlay" target="blank"><img src="Images/Facebook.png"
                                                                                            alt="Facebook logo"
                                                                                            style="width:20%"></a>
            </div><!--(W3Schools,2023)-->
            <div class="column"><!--email-->
                <a href="mailto:jlplayandcentre@gmail.com" target="blank"><img src="Images/Email.png" alt="Email logo"
                                                                   style="width:20%"></a>
            </div><!--(W3Schools,2023)-->
            <div class="column"><!--WhatsApp-->
                <a href="tel:0720186560>" target="blank"><img src="Images/Whatsapp.png" alt="Whatsapp logo"
                                                              style="width:20%"></a>
            </div><!--(W3Schools,2023)-->
        </div>
    </div>
    <br>
    <p style="text-align: center">@2023 RNK. All rights reserved.</p>
</footer>
<script>
    //Function to toggle the navigation menu
    function toggleNav() {
        //Get the navigation menu element with the "topnav" class
        var nav = document.getElementsByClassName("topnav")[0];
        //Check if the navigation menu's class is currently "topnav"
        if (nav.className === "topnav") {
            //If the menu is not responsive, add the "responsive" class to make it responsive
            nav.className += " responsive";
        } else {
            //If the menu is already responsive, remove the "responsive" class to hide it on small screens
            nav.className = "topnav";
        }
    }//(W3Schools,2023)
</script>

</body>
</html>