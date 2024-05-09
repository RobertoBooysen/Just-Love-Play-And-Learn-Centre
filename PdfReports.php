<?php
session_start();

//Check if the user is authenticated
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    header("Location: AdminLogin.php");
    exit();
}//(Gosselin, Kokoska and Easterbrooks,2011)
?>

<!DOCTYPE html>
<html>
<head>
    <!--Setting the ViewPort-->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--(W3Schools,2023)-->
    <!--Stylesheet-->
    <link rel="stylesheet" href="CSS/admin.css"><!--(W3Schools,2023)-->
    <!--Link to external styling-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!--Bootstrap files(Kgt,2016)-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!--Bootstrap files(Kgt,2016)-->
    <title>PDF Reports</title>
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
    }/*(W3Schools,2023)*/

    /*Styling for learn more buttons*/
    .learn-more-button {
        display: inline-block;
        padding: 14px 94px; /* Adjust padding as needed */
        font-size: 16px;
        width: 100%;
        color: white;
        border: none;
        cursor: pointer;
        text-align: center;
    }

    /*(W3Schools,2023)*/

    /*Styling for block hover*/
    .learn-more-button:hover {
        background-color: #ddd;
        color: black;
    }/*(W3Schools,2023)*/

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
    }/*(W3Schools,2023)*/

    /*styling exit button hover*/
    .exit-button:hover {
        background-color: #41c4d8;
        color: black;
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
<button class="exit-button" onclick="exitPage()">Exit</button><!--(W3Schools,2023)-->
<br><br>
<!--Top navigation bar-->
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->

<h1><u><b>PDF Reports</b></u></h1><!--(W3Schools,2023)-->

<br><br>

<div class="container">
    <!--Parent contact details-->
    <div1 class="box">
        <div1 class="content">
            <br>
            <h3 style="font-size:18px"><u><b>Parent Contact Details</b></u></h3>
            <div1>
                <p>View parent contact details.</p>
            </div1><!--(W3Schools,2023)-->
        </div1><!--(W3Schools,2023)-->
        <div1 class="button-container">
            <a href="ParentContactDetailsTable.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background: #41c4d8">View Table</button>
            </a>
        </div1><!--(W3Schools,2023)-->
    </div1>

    <!--Allergy details-->
    <div1 class="box" style=" background: #caacd2;">
        <div1 class="content">
            <br>
            <h3 style="font-size:18px"><u><b>Allergy Details</b></u></h3>
            <div1>
                <p>View allergy details.</p>
            </div1>
        </div1><!--(W3Schools,2023)-->
        <div1 class="button-container">
            <a href="AllergiesTable.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background: #b58bc1">View Table</button>
            </a>
        </div1><!--(W3Schools,2023)-->
    </div1>

    <!--Children details-->
    <div1 class="box" style=" background: #ccccff;">
        <div1 class="content">
            <br>
            <h3 style="font-size:18px"><u><b>Children Details</b></u></h3>
            <div1>
                <p>View children details.</p>
            </div1>
        </div1><!--(W3Schools,2023)-->
        <div1 class="button-container">
            <a href="ChildrenTable.php" style="text-decoration: none;">
                <button class="learn-more-button" style="background: #9999ff">View Table</button>
            </a>
        </div1><!--(W3Schools,2023)-->
    </div1>
</div>

<br><br>
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
    //Function to exit the current page and redirect to AdminHome.php
    function exitPage() {
        window.location.href = "AdminHome.php";
    }//(W3Schools,2023)
</script>

</body>
</html>