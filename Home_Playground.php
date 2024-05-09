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
    <title>Home Playground</title>
</head>

<style>
    /*Styling for the box*/
    * {
        box-sizing: border-box;
    }

    /*(W3Schools,2023)*/

    /*Styling for the block*/
    .item {
        display: inline-block;
    }

    /*(W3Schools,2023)*/

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

    /*(W3Schools,2023)*/

    /*Styling for the exit button hover*/
    .exit-button:hover {
        background-color: #41c4d8;
        color: black;
    }

    /*(W3Schools,2023)*/

    /*Styling for the container*/
    .container {
        position: relative;
        width: 100%;
        max-width: 1600px;
        margin: 50px auto;
        background: white;
        overflow: hidden;
    }

    /*(W3Schools,2023)*/

    /*Styling for the container box*/
    .container .box {
        position: relative;
        width: 100%;
        max-width: 425px;
        height: 500px;
        background: white;
        float: left;
        margin: 30px;
    }

    /*(W3Schools,2023)*/

    /*Styling for the container box content*/
    .container .box .content {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 15px;
        height: 100%;
    }

    /*(W3Schools,2023)*/

    /*Styling for the container box content heading 3*/
    .container .box .content h3 {
        margin: 0;
        padding: 0;
        color: black;
        font-size: 30px;
        text-align: center;
    }

    /*(W3Schools,2023)*/

    /*Styling for the container box image*/
    .container .box .content img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /*(W3Schools,2023)*/

    /*Responsiveness for image and paragraph*/
    @media screen and (min-width: 550px) {
        .featured-image {
            float: left;
            width: 40%;
            padding-right: 5px;
        }

        .featured-image img {
            width: 60%;
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
<!--Exit button-->
<button class="exit-button" onclick="exitPage()">Exit</button><!--(W3Schools,2023)-->

<!--Displaying Daycare Logo-->
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->

<!--Playground Heading -->
<h1 style="color:#77d4e3;"><u><b>Playground </b></u></h1><!--(W3Schools,2023)-->

<br>
<div class="item">
    <!--Displaying Playground image-->
    <div class="featured-image">
        <img src="Images/Playground1.png" alt="Playground">
    </div><!--(W3Schools,2023)-->
    <br>
    <!--Playground content about the daycare-->
    <div class="description">
        <div><b>Discover Our Fun-Filled Playground!</b>
            <!--(W3Schools,2023)-->
            <p style="text-align: justify; text-justify: inter-word;">Welcome to our
                daycare's outdoor play area, where giggles fill the air,
                and the spirit of play knows no bounds! Our well equiped playground is a captivating
                space that beckons children to explore, learn, and create magical memories. Our goal is
                to ignite the spark of curiosity in every child’s heart with age-appropriate play structures,
                swings, slides and trampolines. Under the supervision of our staff our little adventurers
                can play freely while staying protected. As they climb, jump, and slide, children not only develop
                gross motor skills but also learn the importance of cooperation and sharing with their newfound
                friends.</p><!--(W3Schools,2023)-->
        </div>

        <br>

        <div><p style="text-align: justify; text-justify: inter-word;"> Our
                playground is a safe place where imaginations come alive and adventures unfold.
                Children can immerse themselves in a world of joy, fostering their creativity and sense of wonder
                through outdoor play. It is with great pleasure and enjoyment that we watch their eyes light up with
                delight and excitement as they embark on a journey of exploration, fantasy play and growth!".</p>
            <!--(W3Schools,2023)-->
        </div>
    </div>
</div>
<br><br>

<div class="container">

    <div class="box">
        <div class="content">
            <img src="Images/Playground2.png" alt="Image 2">
        </div>
    </div><!-- This is the first box with Image 2 (W3Schools, 2023) -->

    <div class="box">
        <div class="content">
            <img src="Images/Playground3.png" alt="Image 3">
        </div>
    </div><!-- This is the second box with Image 3 (W3Schools, 2023) -->

    <div class="box">
        <div class="content">
            <img src="Images/Playground4.png" alt="Image 4">
        </div>
    </div><!-- This is the third box with Image 4 (W3Schools, 2023) -->
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

            <!--Displaying social media Email icon-->
            <div class="column">
                <a href="mailto:jlplayandcentre@gmail.com" target="blank"><img src="Images/Email.png" alt="Email logo"
                                                                   style="width:20%"></a>
            </div><!--(W3Schools,2023)-->

            <!--Displaying social media WhatsApp icon-->
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

    //Function to exit the current page and navigate to "Home.php"
    function exitPage() {
        window.location.href = "index.php";
    }<!--(W3Schools,2023)-->
</script>

</body>
</html>