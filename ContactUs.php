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
    <!--Bootstrap files(Kgt,2016)-->
    <title>Contact Us</title>
</head>
<body>
<style>
    /*Styling the container*/
    .container {
        position: relative;
        width: 80%;
        overflow: hidden;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
    }

    /*(W3Schools,2023)*/

    /*Styling responsive iframe*/
    .responsive-iframe {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    /*(W3Schools,2023)*/

    /*Styling container*/
    .contact-container {
        padding-left: 10%;
        padding-right: 10%;
    }

    /*(W3Schools,2023)*/

    /* This media query applies styles only when the screen width is less than or equal to 768px */
    @media only screen and (max-width: 768px) {
        .contact-container {
            padding-left: 5%;
            padding-right: 5%;
        }
    }

    /*(W3Schools,2023)*/
</style>

<!--Displaying Daycare Logo-->
<div class="logo">
    <img style="width:70%"src="Images/Logo.png" alt="logo">
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

<div class="contact-container">
    <!--Contact Us page Heading -->
    <h1 style="color: black;"><u><b>CONTACT US</b></u></h1>

    <br><br>
    <!--Contact Us content of daycare-->
    <p style="text-align: justify;"> Thank you for your interest in Just Love Play And Learn Centre! We would be
        delighted to assist you with any inquiries or feedback you may have.</p><!--(W3Schools,2023)-->

    <p style="text-align: justify;"> Please feel free to reach out to us using any of the following contact details:<br>
        <b>Address:</b> 44 Fourth Avenue, Newton Park, Port Elizabeth.<br>
        <b>Email:</b> <a href="mailto:jlplayandlearncentre@gmail.com" target="_blank">jlplayandlearncentre@gmail.com</a><br>
        <b>Phone:</b> <a href="tel:0413654013" target="_blank">0413654013</a>
    </p><!--(W3Schools,2023)-->

    <p style="text-align: justify;"> Our dedicated team is committed to providing exceptional service and support.
        Whether you have questions about our programs, enrollment, or any other aspect of our center, we are here to
        help.
        We strive to respond promptly to all inquiries and provide the information you need in a timely manner.
        We also encourage you to stay connected with us through our social media Facebook channel, where you can find
        updates, news, and engaging content related to our center and early childhood education.
        <br><br>
        The link to our Facebook page is as follows:
        <a href="https://www.facebook.com/JustLoveLearnandPlay" target="_blank">Visit our FaceBook !</a>
    </p><!--(W3Schools,2023)-->

    <p style="text-align: justify;">Thank you for considering Just Love Play And Learn Centre. We look forward to
        hearing from you and assisting you in any way we can. Hoping to have you part of the "just love" family! God
        bless.</p><br><!--(W3Schools,2023)-->
</div>

<br>

<!--Embed map-->
<div class="container">
    <iframe class="responsive-iframe"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3309.8094194118457!2d25.563662176504636!3d-33.946029523064595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e7ad17d0fa0a25d%3A0xdeed28d800af86a0!2sJust%20Love%20Day%20Care%20Centre!5e0!3m2!1sen!2sza!4v1690206973075!5m2!1sen!2sza"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
</div><!--(W3Schools,2023)-->

<br>

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