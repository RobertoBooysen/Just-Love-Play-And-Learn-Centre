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
    <title>Our History</title>
</head>

<style>
    /*Styling box*/
    * {
        box-sizing: border-box;
    }

    /*(W3Schools,2023)*/

    /*Styling item*/
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

    /*Styling exit button hover*/
    .exit-button:hover {
        background-color: #41c4d8;
        color: black;
    }

    /*(W3Schools,2023)*/

    /*Styling div*/
    .div1 {
        border: 5px solid #41c4d8;
        margin: 0 auto; /* Center the div horizontally */
        max-width: 1280px; /* Set a maximum width for the content */
        padding: 20px; /* Add padding for spacing from the edges */
    }

    /*(W3Schools,2023)*/

    /*Styling heading 1*/
    h1 {
        text-align: center;
        text-transform: uppercase;
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
            width: 70%;
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

<!--Displaying Daycare Logo-->
<div class="logo">
    <img style="width:70%" src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->

<!--History Heading-->
<h1 style="color:#77d4e3;"><u><b>Our History</b></u></h1><!--(W3Schools,2023)-->

<br>
<div class="item">
    <!--Displaying History image-->
    <div class="featured-image">
        <img src="Images/HistoryDaycare.jpg" alt="History">
    </div><!--(W3Schools,2023)-->
    <br>
    <!--Description of Our History-->
    <div class="description">
        <div>
            <p style="text-align: justify; text-justify: inter-word; padding-right: 5%;padding-left: 5%;">Just Love Play
                and Learn center was formed in Newton Park,
                Port Elizabeth by Lydia. With a rich history spanning over 33 years, Just Love Play And Learn Centre has
                stood
                as a beacon of excellence and a trusted provider of high-quality day care services. Through the decades,
                we have
                been committed to fostering a nurturing and stimulating environment, where children are encouraged to
                explore,
                play, learn, and grow to their fullest potential. Our dedication to early childhood education has
                allowed us to
                touch the lives of countless young minds, leaving a lasting impact on their development and preparing
                them for a
                successful journey ahead.</p>
        </div>

        <br>

        <div><p style="text-align: justify; text-justify: inter-word; padding-right: 5%;padding-left: 5%;"> At Just Love
                Play And Learn Centre, we take great pride in our journey, and we look
                forward to continuing our legacy of love and learning for many years to come. At the heart of our
                company, lies a strong foundation built upon our vision and mission. These
                principles drive us every day and serve as a commitment to our children, families, and team members. Our
                focus
                is entirely on children and, more specifically, your child. Our Vision is to collaborate with families
                in
                building a better world, while our Mission is to deliver top-notch care and education to every child and
                family
                we serve, each and every day. </p>
        </div>

        <br>

        <div><p style="text-align: justify; text-justify: inter-word; padding-right: 5%;padding-left: 5%;">We understand
                that selecting the right childcare is a pivotal choice for your family.</p></div>
    </div>
</div>

<br><br>

<!--About Us (History) content about the daycare-->
<div class="div1">
    <!--vision of the daycare-->
    <h1 style="color: #41c4d8;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">Vision</h1>
    <!--(W3Schools,2023)-->
    <p style="padding-right: 5%;padding-left: 5%; text-align: justify;letter-spacing: 3px;">It is the vision of Just
        Love to educate
        children about the world God created, how our faith rooted
        in Christ is woven into each area of learning. “To love one another, as God loved us. John 13 : 34”
        Whatever our background, our culture or doctrine.</p>

    <br><br>

    <!--mission of the daycare-->
    <h1 style="color: #41c4d8;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">Mission</h1>
    <!--(W3Schools,2023)-->
    <p style="padding-right: 5%;padding-left: 5%; text-align: justify;letter-spacing: 3px;">It is the
        mission of Just Love to provide a Christ-centered and high quality education. To have a holistic
        approach by nurturing our students' intellectual, spiritual, social, emotional, and physical growth</p>

    <br><br>

    <!--goals of the daycare-->
    <h1 style="color: #41c4d8;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">Goals</h1>
    <!--(W3Schools,2023)-->
    <p style="padding-right: 5%;padding-left: 5%; text-align: justify;letter-spacing: 3px;">It is the goal of Just Love
        to prepare our learners to be responsible and to find purpose and meaning through God's will for their lives.
        We understand that selecting the right childcare is a pivotal choice for your family. At Just Love Play and
        Learn Centre, we take great pride in our journey, and we look forward to continuing our legacy of “just love”
        and learning for many years to come.
    </p>
</div>

<br><br>

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