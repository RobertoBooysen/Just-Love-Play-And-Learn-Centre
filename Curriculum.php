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
    <title>Curriculum</title>
</head>
<style>
    /*Styling the box*/
    * {
        box-sizing: border-box;
    }
    /*(W3Schools,2023)*/
    /*Styling the block*/
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
    .exit-button:hover {
        background-color: #41c4d8;
        color: black;
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
            width: 72%;
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
<!--Exit button-->
<button class="exit-button" onclick="exitPage()">Exit</button><!--(W3Schools,2023)-->
<!--Displaying Daycare Logo-->
<div class="logo">
    <img style="width:70%"src="Images/Logo.png" alt="logo">
</div><!--(W3Schools,2023)-->
<!--Curriculum Heading-->
<h1 style="color:#77d4e3;"><u><b>Curriculum</b></u></h1><!--(W3Schools,2023)-->
<br>
<div class="description">
    <div>
        <p style="text-align: justify; text-justify: inter-word;">Curriculum:
            At Just Love Play and Learn Centre, we take great pride in our comprehensive and carefully
            crafted curriculum that lays the groundwork for your child's educational journey. Our curriculum
            is thoughtfully designed to align seamlessly with the Foundation Phase and is fully registered with
            the esteemed Curriculum Assessment Policy Statement (CAPS). By adhering to this esteemed framework,
            we ensure that our students receive a well-rounded and developmentally appropriate education that
            prepares them for a successful transition into higher learning. Our commitment to excellence extends
            beyond curriculum design to encompass a diverse and inclusive approach to education. We cater to
            children
            across various age groups, recognizing that each developmental stage requires a tailored approach to
            learning.
            Our dedicated age-specific programs are tailored to meet the unique needs, interests, and milestones of
            each
            group, ensuring that every child receives the individualized attention and support they deserve.</p>
        <!--(W3Schools,2023)-->
        <br>
    </div></div>
<div class="item">
    <!--Displaying Activity image-->
    <div class="featured-image">
        <img src="Images/curriculum.png" alt="Curriculum">
    </div><!--(W3Schools,2023)-->
    <br>
    <!--Curriculum content of the daycare-->
    <div class="description">
        <div>
            <p style="text-align: justify; text-justify: inter-word;">For our
                youngest learners, the <b>“Baby”</b> program provides a nurturing and safe environment
                where they can explore and discover the world around them. Our trained caregivers foster a warm and
                loving atmosphere, laying the foundation for essential social, emotional, and cognitive development.
            </p><!--(W3Schools,2023)-->
            <br>
            <p style="text-align: justify; text-justify: inter-word;">The <b>"2-3-year-olds"</b>
                and “3-4-year-olds” programs focus on cultivating early learning
                skills and promoting curiosity and creativity. Through engaging activities and interactive experiences,
                children in these age groups are encouraged to develop their language, fine motor, and problem-solving
                skills, setting the stage for future academic success.</p><!--(W3Schools,2023)-->
            <br>
            <p style="text-align: justify; text-justify: inter-word;">Our <b>"Grade
                    R"</b> program is designed to bridge the gap between early childhood education and
                formal schooling. Here, children are exposed to a structured learning environment that promotes
                independence,
                self-confidence, and a love for learning. We strive to equip them with the foundational skills necessary
                to
                thrive in the transition to formal education.</p><!--(W3Schools,2023)-->
            <br>
            <p style="text-align: justify; text-justify: inter-word;">For those
                embarking on the exciting journey of <b>"Grade 1"</b>, our program provides a smooth and confident
                start to formal schooling. We continue to nurture their love for learning, emphasizing critical
                thinking,
                literacy, numeracy, and social skills, ensuring they enter primary school with enthusiasm and readiness.
            </p><!--(W3Schools,2023)-->
        </div>
        <br>
        <br>
    </div>
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
    //Function to exit the current page and navigate to "Home.php"
    function exitPage() {
        window.location.href = "AboutUs.php";
    }<!--(W3Schools,2023)-->
</script>
</body>
</html>