<!DOCTYPE html>
<html>
<head>
    <!--Setting the ViewPort-->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--(W3Schools,2023)-->
    <!--Stylesheet-->
    <link rel="stylesheet" href="CSS/style.css">
    <!--(W3Schools,2023)-->
    <title>Our Staff</title>
</head>
<style>
    /*Styling div*/
    div.a {
        text-align: center;
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
    /*Styling exit button hover*/
    .exit-button:hover {
        background-color: #41c4d8;
        color: black;
    }
    /*(W3Schools,2023)*/
    /*Styling html*/
    html {
        box-sizing: border-box;
    }
    /*(W3Schools,2023)*/
    /* Set the box-sizing property to "inherit" for all elements, pseudo-elements, and pseudo-classes */
    *, *:before, *:after {
        box-sizing: inherit;
    }
    /*(W3Schools,2023)*/
    /*Styling column1*/
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
    /*Apply a box shadow to the elements with the class "card" */
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }
    /*(W3Schools,2023)*/
    /*Set the width, height, and object-fit for images inside elements with the class "card" */
    .card img {
        width: 100%;
        height: 600px;
        object-fit: cover;
    }
    /*(W3Schools,2023)*/
    /*Add padding to elements with the class "container" */
    .container {
        padding: 0 16px;
    }
    /*(W3Schools,2023)*/
    /*Create a clearfix by adding content, clearing floats, and displaying as a table */
    .container::after, .row::after {
        content: "";
        clear: both;
        display: table;
    }
    /*(W3Schools,2023)*/
    /*Set the text color for elements with the class "title" to grey */
    .title {
        color: grey;
    }
    /*(W3Schools,2023)*/
    /*Set the text color for elements with the class "title" to grey */
    .qualifications {
        color: grey;
    }
    /*(W3Schools,2023)*/
</style>
<body>
<!--Exit button-->
<button class="exit-button" onclick="exitPage()">Exit</button>
<!--Displaying Daycare Logo-->
<div class="logo">
    <img style="width:70%"src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->
<!--Our Staff Heading-->
<h1 style="color:#caacd2;"><u><b>Our Staff</b></u></h1>
<br>
<!--Our Staff content about the staff members-->
<div class="a" style="text-align: justify">
    <p style="text-align: center"> Our staff is passionate about teaching and treat the learners with kindness and compassion.
        “Just love” is shown to every little one and teachers are willing to go the extra mile! </p>
</div><!--(W3Schools,2023)-->
<br><br>
<!--Heading 2-->
<h2 style="text-align: center">Our staff is as follows:</h2>
<div class="row">
    <!-- Staff Member 1 -->
    <div class="column1">
        <div class="card">
            <img src="Images/StaffMember1.jpg" alt="Lydia" style="width:100%">
            <div class="container">
                <h2>Lydia Oosthuizen</h2>
                <p class="title">Principal</p>
                <p class="qualifications">National Professionals Diploma in Education in Foundation Phase</p>
            </div>
        </div>
    </div><!--(W3Schools,2023)-->
    <!-- Staff Member 2 -->
    <div class="column1">
        <div class="card">
            <img src="Images/StaffMember2.jpg" alt="Tracey" style="width:100%">
            <div class="container">
                <h2>Tracey Blundell</h2>
                <p class="title">Teacher</p>
                <p class="qualifications">National N6 Diploma</p>
                <br>
            </div>
        </div>
    </div><!--(W3Schools,2023)-->
    <!-- Staff Member 3 -->
    <div class="column1">
        <div class="card">
            <img src="Images/StaffMember4.jpg" alt="Jane" style="width:100%">
            <div class="container">
                <h2>Rosaline Asia</h2>
                <p class="title">Teacher</p>
                <p class="qualifications">N5 Certificate in ECD</p>
                <br>
            </div>
        </div>
    </div><!--(W3Schools,2023)-->
    <!-- Staff Member 4 -->
    <div class="column1">
        <div class="card">
            <img src="Images/StaffMember8.png" alt="Maxine" style="width:100%">
            <div class="container">
                <h2>Maxine Rademeyer</h2>
                <p class="title">Teacher</p>
                <p class="qualifications">N4 Certificate in ECD</p>
            </div>
        </div>
    </div><!--(W3Schools,2023)-->
    <!-- Staff Member 5 -->
    <div class="column1">
        <div class="card">
            <img src="Images/StaffMember5.jpg" alt="Meghan" style="width:100%">
            <div class="container">
                <h2>Meghan Rousseau</h2>
                <p class="title">Substitute Teacher</p>
                <p class="qualifications">Intermediate Educare Teacher Assistant</p>
            </div>
        </div>
    </div><!--(W3Schools,2023)-->
    <!-- Staff Member 6 -->
    <div class="column1">
        <div class="card">
            <img src="Images/StaffMember3.jpg" alt="Raylene" style="width:100%">
            <div class="container">
                <h2>Raylene Fletcher</h2>
                <p class="title">Teacher</p>
                <br><br>
            </div>
        </div>
    </div><!--(W3Schools,2023)-->
    <!-- Staff Member 7 -->
    <div class="column1">
        <div class="card">
            <img src="Images/StaffMember6.jpg" alt="Chantel" style="width:100%">
            <div class="container">
                <h2>Chantel Jones</h2>
                <p class="title">Assistant</p>
                <br><br>
            </div>
        </div>
    </div><!--(W3Schools,2023)-->
    <!-- Staff Member 8 -->
    <div class="column1">
        <div class="card">
            <img src="Images/StaffMember7.jpg" alt="Loretta" style="width:100%">
            <div class="container">
                <h2>Loretta Williams</h2>
                <p class="title">Kitchen staff</p>
                <br><br>
            </div>
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
    //Function to toggle navigation menu
    function toggleNav() {
        var nav = document.getElementsByClassName("topnav")[0];
        if (nav.className === "topnav") {
            nav.className += " responsive";
        } else {
            nav.className = "topnav";
        }
    }<!--(W3Schools,2023)-->
    //Function to exit the current page and navigate to "AboutUs.php"
    function exitPage() {
        window.location.href = "AboutUs.php";
    }<!--(W3Schools,2023)-->
</script>
</body>
</html>