<!DOCTYPE html>
<html>
<head>
    <!--Setting the ViewPort-->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--(W3Schools,2023)-->
    <!--Stylesheets-->
    <link rel="stylesheet" href="CSS/style.css"><!--(W3Schools,2023)-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"><!--(W3Schools,2023)-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <title>Admin</title><!--(W3Schools,2023)-->
</head>
<style>
    /*CSS styles for the buttons */
    .button-container {
        text-align: center;
        margin: 20px 0;
    }

    .button {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #77d4e3;
        color: black;
        border: none;
        border-radius: 5px;
        margin: 5px;
        cursor: pointer;
    }

    .button:hover {
        box-shadow: 0 0 0 2px #fff, 0 0 0 3px #caacd2
    }

</style>
<body>
<div class="logo">
    <img style="width:70%"src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->
<div class="topnav">
    <a href="index.php">Home</a>
    <a href="AboutUs.php">About Us</a>
    <a href="ExtraMurals.php">Extra Murals</a>
    <a href="Application.php">Application</a>
    <a href="Gallery.php">Gallery</a>
    <a href="Tour.php">Schedule Tour</a>
    <a href="ContactUs.php">Contact Us</a>
    <div class="dropdown">
        <button class="dropbtn">
            <i class="fa fa-fw fa-user" style="color: black"></i>
        </button>
        <div class="dropdown-content">
            <a href="Parent.php">Parent</a>
            <a href="Admin.php">Admin</a>
        </div>
    </div>
    <a href="javascript:void(0);" class="icon" onclick="toggleNav()">&#9776;</a>
</div>

<div style="padding-left:16px">
    <h1 style="color: black;"><u><b>ADMIN PORTAL</b></u></h1>
    <br><br><br><br><br><br><br><br>
    <p style="text-align: center">Please select the Login button to login as an Administrator.</p>
    <!--Login button to login(W3Schools,2023)-->
    <div class="button-container">
        <button class="button">
            <a href="AdminLogin.php" style="color: black; text-decoration:none;">Login</a>
        </button>
    </div>
</div>

<br><br><br><br>
<br><br><br><br><br><br><br><br>
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
</script>

</body>
</html>