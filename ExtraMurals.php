<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Stylesheet-->
    <link rel="stylesheet" href="CSS/style.css"><!--(W3Schools,2023)-->
    <!--Bootstrap files(Kgt,2016)-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!--Bootstrap files(Kgt,2016)-->
    <title>Extra Murals</title>
</head>

<style>

    /*(W3Schools,2023)*/

    html {
        box-sizing: border-box;
    }

    /*(W3Schools,2023)*/

    *, *:before, *:after {
        box-sizing: inherit;
    }

    /*(W3Schools,2023)*/

    .column1 {
        float: left;
        width: 33.3%;
        margin-bottom: 16px;
        padding: 0 8px;
    }

    /*(W3Schools,2023)*/

    /*Responsiveness for image and paragraph*/
    @media screen and (max-width: 650px) {
        .column1 {
            width: 100%;
            display: block;
        }
    }

    /*(W3Schools,2023)*/

    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        height: 400px;
    }

    /*(W3Schools,2023)*/

    .card img {
        width: 30%;
        object-fit: cover;
    }

    /*(W3Schools,2023)*/

    .container {
        padding: 0 16px;
    }

    /*(W3Schools,2023)*/

    .container::after, .row::after {
        content: "";
        clear: both;
        display: table;
    }

    /*(W3Schools,2023)*/
</style>
<body>

<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo">
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

<div>
    <h1 style="color: black;"><u><b>EXTRA MURALS</b></u></h1><br>

    <div class="row">
        <div class="column1">
            <div class="card" style="background-color: #77d4e3">
                <br>
                <img src="Images/Swimming.png" alt="Swimming">
                <br>
                <div class="container">
                    <h2>Swimming </h2>
                    <b>Phone:</b> <a href="tel:0648758054" target="_blank" style="color:black">0648758054</a><br>
                    <b>Email:</b> <a href="mailto:info@bayeagle.co.za" target="_blank" style="color:black">info@bayeagle.co.za</a><br>
                    <b>Website:</b> <a href="https://www.bayeagle.co.za/"
                                       target="_blank" style="color:black">https://www.bayeagle.co.za/</a><br>
                    <p>Please contact the instructor for more information.</p>
                </div>
            </div>
        </div>

        <div class="column1">
            <div class="card" style="background-color: #caacd2">
                <br>
                <img src="Images/Soccer.png" alt="Soccer">
                <br>
                <div class="container">
                    <h2>Soccer</h2>
                    <b>Phone:</b> <a href="tel:01118823428" target="_blank" style="color:black">01118823428</a><br>
                    <b>Email:</b> <a href="mailto:info@soccercise.co.za" target="_blank" style="color:black">info@soccercise.co.za</a><br>
                    <b>Website:</b> <a href="https://www.soccercise.co.za/" target="_blank" style="color:black">https://www.soccercise.co.za/</a><br>
                    <p>Please contact the instructor for more information.</p>
                </div>
            </div>
        </div>

        <div class="column1">
            <div class="card" style="background-color: #ccccff">
                <br>
                <img src="Images/Ballet.png" alt="BalletAndDance">
                <br>
                <div class="container">
                    <h2>Ballet & Dance</h2>
                    <b>Phone:</b> <a href="tel:0614174986" target="_blank" style="color:black">0614174986</a><br>
                    <b>Email:</b> <a href="mailto:admin@dancekids.co.za" target="_blank" style="color:black">admin@dancekids.co.za</a><br>
                    <b>Website:</b> <a href="https://www.dancekids.co.za/"
                                       target="_blank" style="color:black">https://www.dancekids.co.za/</a><br>
                    <p>Please contact the instructor for more information.</p>
                </div>
            </div>
        </div>
    </div>

    <br><br>

    <footer>
        <p style="text-align: center">44 Fourth Avenue, Newton Park, Port Elizabeth</p>
        <p style="text-align: center"><a href="tel:0413654013" style="color: black">0413654013</a></p>
        <div class="center">
            <div class="row"> <!--(W3Schools,2021)-->
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