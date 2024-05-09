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
    <title>Home Classroom</title>
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
            float: left;
            width: 60%;
            padding-right: 12%;
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
        }
    }

    /*(W3Schools,2023)*/
</style>

<body>
<!--Exit button-->
<button class="exit-button" onclick="exitPage()">Exit</button><!--(W3Schools,2023)-->

<!--Displaying an image of the daycare-->
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->

<!--Classroom Heading-->
<h1 style="color:#b58bc1;"><u><b>Classroom</b></u></h1><!--(W3Schools,2023)-->

<br>
<div class="item">
    <!--Displaying Classroom image-->
    <div class="featured-image">
        <img src="Images/Classroom2.png" alt="Classroom">
    </div><!--(W3Schools,2023)-->

    <br>
    <!--Classroom content about the daycare-->
    <div class="description">
        <div><b style="padding-right: 5%;padding-left: 5%;">Discover Our Fun-Filled Classrooms!</b>
            <!--(W3Schools,2023)-->
            <p style="text-align: justify; text-justify: inter-word; padding-right: 5%;padding-left: 5%;">Our pre-school
                classroom is a place where young minds
                blossom and discover the joy of learning. With a caring and experienced team, we create a nurturing
                environment
                that fosters creativity, curiosity, and social growth. At Just Love Play And Learn Centre, we believe
                that every
                child is a unique individual, and we strive to provide a stimulating atmosphere that encourages their
                natural
                talents and interests to flourish.</p><!--(W3Schools,2023)-->
        </div>

        <br>

        <div><p style="text-align: justify; text-justify: inter-word; padding-right: 5%;padding-left: 5%;"> Our engaging
                curriculum is thoughtfully designed to cater to the diverse needs of each child,
                blending play-based activities with structured learning. Through hands-on experiences, interactive play,
                and
                imaginative storytelling, we instill a love for knowledge while developing essential skills that prepare
                them for
                the years ahead.</p><!--(W3Schools,2023)-->
        </div>

        <br>

        <div><p style="text-align: justify; text-justify: inter-word; padding-right: 5%;padding-left: 5%;"> Safety is of
                utmost importance to us. Our classroom is a secure space where children can freely
                explore and learn under the watchful eyes of our dedicated educators. We maintain a low
                student-to-teacher ratio
                to ensure personalized attention, creating an environment where your child can thrive with confidence.
                Beyond
                academics, we place significant emphasis on social and emotional development. Our little learners are
                encouraged
                to communicate, collaborate, and build meaningful relationships with their peers, helping them grow into
                well-rounded
                individuals with strong values.</p><!--(W3Schools,2023)-->
        </div>
    </div>
</div>

<br><br>
<div class="container">

    <div class="box">
        <div class="content">
            <img src="Images/Classroom1.png" alt="Image 2">
        </div>
    </div><!--(W3Schools,2023)-->

    <div class="box">
        <div class="content">
            <img src="Images/Classroom3.png" alt="Image 3">
        </div>
    </div><!--(W3Schools,2023)-->

    <div class="box">
        <div class="content">
            <img src="Images/Classroom4.png" alt="Image 4">
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
            <!--Display social media Facebook icon-->
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

            <!--Display social media Whatsapp icon-->
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