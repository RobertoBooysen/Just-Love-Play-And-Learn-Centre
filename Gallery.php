<!DOCTYPE html>
<html>
<head>
    <!--Setting the ViewPort-->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--(W3Schools,2023)-->
    <!--Stylesheet-->
    <link rel="stylesheet" href="CSS/style.css"><!--(W3Schools,2023)-->
    <!--Link to external styling(W3Schools,2023)-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!--Bootstrap files(Kgt,2016)-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!--Bootstrap files(Kgt,2016)-->
    <title>Gallery</title>
</head>
<style>
    div.gallery {
        border: 1px solid #ccc;
    }

    div.gallery:hover {
        border: 2px solid #41c4d8;
    }

    div.gallery img {
        width: 100%;
        height: auto;
    }

    div.desc {
        padding: 15px;
        text-align: center;
    }

    * {
        box-sizing: border-box;
    }

    .responsive {
        padding: 6px 6px;
        float: left;
        width: 24.99999%;
    }

    @media only screen and (max-width: 700px) {
        .responsive {
            width: 49.99999%;
            margin: 6px 0;
        }
    }

    @media only screen and (max-width: 500px) {
        .responsive {
            width: 100%;
        }
    }

    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }
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
        </div><!--(W3Schools,2023)-->
    </div>
    <a href="javascript:void(0);" class="icon" onclick="toggleNav()">&#9776;</a><!--(W3Schools,2023)-->
</div>

<!--Gallery page Heading -->
<div style="text-align: center">
    <h1><u><b>GALLERY</b></u></h1><!--(W3Schools,2023)-->
</div>

<br>

    <!--Image 1-->
    <div class="responsive">
        <div class="gallery">
            <a target="_blank" href="Images/DaycareImage1.jpg">
                <img src="Images/DaycareImage1.jpg" alt="DaycareImage1" width="600" height="400">
            </a>
        </div>
    </div>


<div class="responsive">
    <div class="gallery">
        <a target="_blank" href="Images/DaycareImage2.jpg">
            <img src="Images/DaycareImage2.jpg" alt="DaycareImage2" width="600" height="400">
        </a>
    </div>
</div>

<div class="responsive">
    <div class="gallery">
        <a target="_blank" href="Images/DaycareImage2.jpg">
            <img src="Images/DaycareImage3.jpg" alt="DaycareImage3" width="600" height="400">
        </a>
    </div>
</div>

<div class="responsive">
    <div class="gallery">
        <a target="_blank" href="Images/DaycareImage4.jpg">
            <img src="Images/DaycareImage4.jpg" alt="DaycareImage4" width="600" height="400">
        </a>
    </div>
</div>

<div class="responsive">
    <div class="gallery">
        <a target="_blank" href="Images/DaycareImage5.jpg">
            <img src="Images/DaycareImage5.jpg" alt="DaycareImage5" width="600" height="400">
        </a>
    </div>
</div>

<div class="responsive">
    <div class="gallery">
        <a target="_blank" href="Images/DaycareImage6.jpg">
            <img src="Images/DaycareImage6.jpg" alt="DaycareImage6" width="600" height="400">
        </a>
    </div>
</div>

<div class="responsive">
    <div class="gallery">
        <a target="_blank" href="Images/DaycareImage7.jpg">
            <img src="Images/DaycareImage7.jpg" alt="DaycareImage7" width="600" height="400">
        </a>
    </div>
</div>

<div class="responsive">
    <div class="gallery">
        <a target="_blank" href="Images/DaycareImage8.jpg">
            <img src="Images/DaycareImage8.jpg" alt="DaycareImage8" width="600" height="400">
        </a>
    </div>
</div>

<div class="responsive">
    <div class="gallery">
        <a target="_blank" href="Images/DaycareImage9.jpg">
            <img src="Images/DaycareImage9.jpg" alt="DaycareImage9" width="600" height="400">
        </a>
    </div>
</div>

<div class="responsive">
    <div class="gallery">
        <a target="_blank" href="Images/DaycareImage10.jpg">
            <img src="Images/DaycareImage10.jpg" alt="DaycareImage10" width="600" height="400">
        </a>
    </div>
</div>

<div class="responsive">
    <div class="gallery">
        <a target="_blank" href="Images/DaycareImage11.jpg">
            <img src="Images/DaycareImage11.jpg" alt="DaycareImage11" width="600" height="400">
        </a>
    </div>
</div>

<div class="responsive">
    <div class="gallery">
        <a target="_blank" href="Images/DaycareImage12.png">
            <img src="Images/DaycareImage12.png" alt="DaycareImage12" width="600" height="400">
        </a>
    </div>
</div>

<div class="clearfix"></div>
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