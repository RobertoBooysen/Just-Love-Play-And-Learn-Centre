<?php
session_start();

//Check if a success message is set in the session(Gosselin, Kokoska and Easterbrooks,2011)
if (isset($_SESSION['success_message15'])) {
    // Display the success message
    echo "<script>alert('" . $_SESSION['success_message15'] . "')</script>";

    //Unset the session variable to avoid displaying the message again on refresh(Gosselin, Kokoska and Easterbrooks,2011)
    unset($_SESSION['success_message15']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <!--Responsiveness(W3Schools,2023)-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--Title(W3Schools,2023)-->
    <title>Home</title>

    <!--Meta Tags required for Progressive Web App -->
    <meta name="apple-mobile-web-app-status-bar" content="#aa7700">
    <meta name="theme-color" content="#77d4e3">
    <!--Manifest File link -->
    <link rel="manifest" href="manifest.json">
    <!--Stylesheet-->
    <link rel="stylesheet" href="CSS/style.css"><!--(W3Schools,2023)-->
    <!--Link to external styling(W3Schools,2023)-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!--Bootstrap files(Kgt,2016)-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!--Bootstrap files(Kgt,2016)-->

</head>

<style>
    /*Styling for Heading 2*/
    h2 {
        color: #caacd2;
        text-align: center;
        margin-left: 40px;
    }

    /*(W3Schools,2023)*/

    /*Styling for container*/
    .container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    /*(W3Schools,2023)*/

    /*Styling for container box*/
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

    /*Styling for button*/
    button {
        margin-top: auto;
        text-align: center;
        background-color: #ccccff;
        border: none;
    }

    /*(W3Schools,2023)*/

    /*Styling for box*/
    .box {
        display: flex;
        flex-direction: column;
    }

    /*(W3Schools,2023)*/

    /*Styling for the container button*/
    .button-container {
        margin-top: auto; /*Moving the button to the bottom in block*/
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /*(W3Schools,2023)*/

    /*Styling for content*/
    .content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /*(W3Schools,2023)*/

    /*Styling for box*/
    * {
        box-sizing: border-box;
    }

    /*(W3Schools,2023)*/

    /*Styling for block*/
    .item {
        display: inline-block;
    }

    /*(W3Schools,2023)*/

    /*Styling for blocks*/
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

    /*Styling for block hover*/
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

    /*Responsiveness for blocks*/
    @media screen and (max-width: 480px) {
        .container .box {
            width: 100%;
        }
    }

    /*(W3Schools,2023)*/

    /*Responsiveness for image and paragraph*/
    @media screen and (min-width: 550px) {
        .featured-image {
            width: 80%;
            padding-right: 5px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .featured-image img {
            width: 80%;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .description {
            width: 100%;
            padding-right: 18%;
            padding-left: 18%;
        }
    }

    /*(W3Schools,2023)*/

    /*Responsiveness for image and paragraph*/
    @media screen and (max-width: 550px) {
        .featured-image {
            width: 100%;
            padding-right: 5%;
            padding-left: 5%;
        }

        .featured-image img {
            width: 100%;
        }

        .description {
            width: 100%;
            padding-right: 5%;
            padding-left: 5%;
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

<!--Home page Heading -->
<h1 style="color: black;"><u><b>HOME</b></u></h1>

<br><br>

<!--Heading 3-->
<h3 style="text-align: center; text-justify: inter-word; color:black;padding-right: 1.5%;
            padding-left: 1.5%;">Welcome to
    Just Love Play And Learn Centre!</h3><!--(W3Schools,2023)-->

<br><br>
<!--Home page content about the website-->
<div class="description">
    <p style="text-align: justify; text-justify: inter-word;"><b>Just
            Love</b> where caring
        and learning comes together! We are thrilled to have you here as we embark on an
        exciting journey of nurturing young minds and providing a safe, stimulating, and loving environment
        for your precious little ones. It is essential to choose the right early childhood education program
        for your children. We hope the information below, and throughout the website helps you clarify some of
        your concerns and reduces the number of child care options available to you.</p><!--(W3Schools,2023)-->
</div>

    <!--Displaying an image of the daycare-->
    <div class="featured-image">
        <img src="Images/DaycareHome.png" alt="DaycareHome">
    </div><!--(W3Schools,2023)-->
    <br>
    <!--Home page content about the website-->
        <div class="description">
            <p style="text-align: justify; text-justify: inter-word;">This webpage
                gives you a general overview of our institution and lists available programs. You will
                find a wealth of information about our programs, facilities, and educational philosophy. We invite
                you to explore our galleries, testimonials, and resources that showcase the wonderful experiences of
                our little learners. Call us if you'd like more information or to schedule a visit to the school. We
                appreciate your consideration of and interest in our early childcare programs. We are eager to
                introduce you to our school.</p><!--(W3Schools,2023)-->
        </div>

<!--Home page container sections: Playground, Classrooms, and Activities-->
<div class="container">
    <!-- Box 1: Playground -->
    <div class="box">
        <div class="icon" style="display: flex; justify-content: center; align-items: center;">
            <i class="fa fa-child" aria-hidden="true"
               style="font-size: 100px;align-items: center;margin-top: 20px;"></i>
        </div>
        <div class="content">
            <br>
            <h3><u><b>Playground</b></u></h3>
            <div>
                <p> Discover Our Fun-Filled Playground.</p>
            </div>
        </div>
        <div class="button-container">
            <a href="Home_Playground.php">
                <button class="learn-more-button" style="background: #41c4d8">Learn More</button>
            </a>
        </div>
    </div><!--(W3Schools,2023)-->

    <!-- Box 2: Classroom -->
    <div class="box" style=" background: #caacd2;">
        <div class="icon" style="display: flex; justify-content: center; align-items: center;">
            <i class="fa fa-book" aria-hidden="true" style="font-size: 100px;align-items: center;margin-top: 20px;"></i>
        </div>
        <div class="content">
            <br>
            <h3><u><b>Classroom</b></u></h3>
            <div>
                <p>Welcome to our Classrooms.</p>
            </div>
        </div>
        <div class="button-container">
            <a href="Home_Classroom.php">
                <button class="learn-more-button" style="background: #b58bc1">Learn More</button>
            </a>
        </div>
    </div><!--(W3Schools,2023)-->

    <!-- Box 3: Activities -->
    <div class="box" style=" background: #ccccff;">
        <div class="icon" style="display: flex; justify-content: center; align-items: center;">
            <i class="fa fa-futbol-o" aria-hidden="true"
               style="font-size: 100px;align-items: center;margin-top: 20px;"></i>
        </div>
        <div class="content">
            <br>
            <h3><u><b>Activities</b></u></h3>
            <div>
                <p>Welcome to our Activities.</p>
            </div>
        </div>
        <div class="button-container">
            <a href="Home_Activities.php">
                <button class="learn-more-button" style="background: #9999ff">Learn More</button>
            </a>
        </div>
    </div><!--(W3Schools,2023)-->
</div>

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

    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('../serviceWorker.js').then(() => {
                console.log('Service Worker Registered')
            })
        })
    }

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
