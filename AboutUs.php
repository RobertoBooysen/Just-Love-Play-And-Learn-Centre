<!DOCTYPE html>
<html>
<head>
    <!--Setting the ViewPort-->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--(W3Schools,2023)-->
    <!--Stylesheet-->
    <link rel="stylesheet" href="CSS/style.css"><!--(W3Schools,2023)-->
    <!--Link to external styling-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!--Bootstrap files(Kgt,2016)-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <title>About Us</title>
    <!--Bootstrap files(Kgt,2016)-->
</head>

<style>
    /*Styling heading 2*/
    h2 {
        color: #caacd2;
        text-align: center;
        margin-left: 40px;
    }

    /*(W3Schools,2023)*/

    /*Styling paragraph*/
    p {
        text-align: center;
    }

    /*(W3Schools,2023)*/

    /*Styling container*/
    .container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    /*(W3Schools,2023)*/

    /*Styling container box*/
    .container .box {
        width: calc(25% - 20px);
        margin: 10px;
        height: 340px;
        background: #77d4e3;
        box-sizing: border-box;
        overflow: hidden;
        border-radius: 5px;
    }

    /*(W3Schools,2023)*/

    /*Styling button*/
    button {
        margin-top: auto;
        text-align: center;
        background-color: #ccccff;
        border: none;
        text-decoration: none;
    }

    /*(W3Schools,2023)*/

    /*Styling box*/
    .box {
        display: flex;
        flex-direction: column;
    }

    /*(W3Schools,2023)*/

    /*Styling container button*/
    .button-container {
        margin-top: auto; /*Moving the button to the bottom in block*/
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /*(W3Schools,2023)*/

    /*Styling content*/
    .content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /*(W3Schools,2023)*/

    /*Styling div*/
    div1 {
        border-radius: 6px;
        color: black;
        font-family: Arial;
    }

    /*(W3Schools,2023)*/

    /*Styling image container*/
    .image-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /*(W3Schools,2023)*/

    /*Styling image container image*/
    .image-container img {
        max-width: 300px;
        margin-right: 20px;
    }

    /*(W3Schools,2023)*/

    /*Styling block*/
    .block {
        display: block;
        width: 100%;
        border: none;
        background-color: #04AA6D;
        color: white;
        padding: 14px 158px;
        font-size: 16px;
        cursor: pointer;
        text-align: center;
    }

    /*(W3Schools,2023)*/

    /*Styling block hover*/
    .block:hover {
        background-color: #ddd;
        color: black;
    }

    /* Styling for learn more buttons */
    .learn-more-button {
        display: inline-block;
        padding: 14px 91px;
        font-size: 16px;
        width: 100%;
        color: white;
        background-color: #41c4d8;
        border: none;
        cursor: pointer;
        text-align: center;
        box-sizing: border-box;
    }

    /*Styling for block hover */
    .learn-more-button:hover {
        background-color: #ddd;
        color: black;
    }

    /*Responsiveness for learn more button on smaller screens */
    @media screen and (max-width: 768px) {
        .learn-more-button {
            padding: 14px 128px;
        }
    }

    @media screen and (max-width: 550px) {
        .learn-more-button {
            padding: 14px 128px;
        }
    }

    @media screen and (max-width: 480px) {
        .learn-more-button {
            padding: 14px 128px;
        }
    }

    /*(W3Schools,2023)*/

    /*Responsiveness for blocks*/
    @media screen and (max-width: 768px) {
        .container .box {
            width: calc(50% - 20px);
        }
    }

    /*(W3Schools,2023)*/

    /* Media query for screens with a maximum width of 480px */
    @media screen and (max-width: 480px) {
        .container .box {
            width: 100%;
        }
    }

    /*(W3Schools,2023)*/
</style>

<body>

<!--Displaying Daycare Logo-->
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->

<!--Navigation bar for users to navigate to the websites pages with ease-->
<div class="topnav">
    <a href="index.php">Home</a>
    <a href="AboutUs.php">About Us</a>
    <a href="ExtraMurals.php">Extra Murals</a>
    <a href="Application.php">Application</a>
    <a href="Gallery.php">Gallery</a>
    <a href="Tour.php">Schedule Tour</a>
    <a href="ContactUs.php">Contact Us</a>
    <!--(W3Schools,2023)-->

    <!--Dropdown to login to parent and admin portal-->
    <div class="dropdown">
        <button class="dropbtn">
            <i class="fa fa-fw fa-user" style="color: black"></i>
        </button>
        <div class="dropdown-content">
            <a href="Parent.php">Parent</a>
            <a href="Admin.php">Admin</a>
        </div>
    </div><!--(W3Schools,2023)-->

    <a href="javascript:void(0);" class="icon" onclick="toggleNav()">&#9776;</a><!--(W3Schools,2023)-->
</div>

<!--About Us page Heading -->
<h1 style="color: black;"><u><b>ABOUT US</b></u></h1><!--(W3Schools,2023)-->

<br><br>

<div1 class="container">
    <!-- Box 1: Our History -->
    <div1 class="box">
        <div1 class="icon" style="display: flex; justify-content: center; align-items: center;">
            <i class="fa fa-history" aria-hidden="true"
               style="font-size: 100px;align-items: center;margin-top: 20px;"></i>
        </div1>
        <div1 class="content">
            <br>
            <h3><u><b>Our History</b></u></h3>
            <div1>
                <p>Discover more about out history.</p>
            </div1>
        </div1>
        <div1 class="button-container">
            <a href="OurHistory.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background: #41c4d8">Learn More</button>
            </a>
        </div1>
    </div1><!--(W3Schools,2023)-->

    <!-- Box 2: Our Staff -->
    <div1 class="box" style=" background: #caacd2;">
        <div1 class="icon" style="display: flex; justify-content: center; align-items: center;">
            <i class="fa fa-users" aria-hidden="true"
               style="font-size: 100px;align-items: center;margin-top: 20px;"></i>
        </div1>
        <div1 class="content">
            <br>
            <h3><u><b>Our Staff</b></u></h3>
            <div1>
                <p>Discover more about out staff.</p>
            </div1>
        </div1>
        <div1 class="button-container">
            <a href="OurStaff.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background: #b58bc1">Learn More</button>
            </a>
        </div1>
    </div1><!--(W3Schools,2023)-->

    <!-- Box 3: Curriculum -->
    <div1 class="box" style=" background: #ccccff;">
        <div1 class="icon" style="display: flex; justify-content: center; align-items: center;">
            <i class="fa fa-file-text" aria-hidden="true"
               style="font-size: 100px;align-items: center;margin-top: 20px;"></i>
        </div1>
        <div1 class="content">
            <br>
            <h3><u><b>Curriculum</b></u></h3>
            <div1>
                <p>Discover more about our curriculum.</p>
            </div1>
        </div1>
        <div1 class="button-container">
            <a href="Curriculum.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background: #9999ff">Learn More</button>
            </a>
        </div1>
    </div1><!--(W3Schools,2023)-->

    <!-- Box 4: Trading Hours -->
    <div1 class="box">
        <div1 class="icon" style="display: flex; justify-content: center; align-items: center;">
            <i class="fa fa-clock-o" aria-hidden="true"
               style="font-size: 100px;align-items: center;margin-top: 20px;"></i>
        </div1>
        <div1 class="content">
            <br>
            <h3><u><b>Trading Hours</b></u></h3>
            <div1>
                <p>Discover more about our trading hours.</p>
            </div1>
        </div1>
        <div1 class="button-container">
            <a href="Trading_Hours.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background: #41c4d8">Learn More</button>
            </a>
        </div1>
    </div1><!--(W3Schools,2023)-->
</div1>

<br><br>

<footer>
    <!-- This paragraph contains the address and is centered -->
    <p style="text-align: center">44 Fourth Avenue, Newton Park, Port Elizabeth</p>
    <!-- This paragraph contains a phone number link with black text color-->
    <p style="text-align: center"><a href="tel:0413654013" style="color: black">0413654013</a></p>
    <!--(W3Schools,2023)-->

    <div class="center">
        <div class="row">
            <!--Displaying social media Facebook icon-->
            <div class="column">
                <a href="https://www.facebook.com/JustLoveLearnandPlay" target="blank"><img src="Images/Facebook.png"
                                                                                            alt="Facebook logo"
                                                                                            style="width:20%"></a>
            </div><!--(W3Schools,2023)-->

            <!--Display social media Email icon-->
            <div class="column">
                <a href="mailto:jlplayandcentre@gmail.com" target="blank"><img src="Images/Email.png" alt="Email logo"
                                                                               style="width:20%"></a>
            </div><!--(W3Schools,2023)-->

            <!--Display social media WhatsApp icon-->
            <div class="column">
                <a href="tel:0720186560>" target="blank"><img src="Images/Whatsapp.png" alt="Whatsapp logo"
                                                              style="width:20%"></a>
            </div><!--(W3Schools,2023)-->
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