<?php
include("fearless_admin/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Fearless Strokes | Home Junction</title>
    <link rel="icon" href="assets/images/logo.png" type="image/png" sizes="16x16">


    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <style>
        .drpdwn{
            width: 100%;
            height:30px;
            border-radius: 4%;
            margin-bottom: 10px;
        }
        .drpdwn option{
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php include("header.php"); ?>

<div class="container" style="min-height:420px;">


    <div class="row clearfix">
        <div class="col-sm-12 bar2 ">
            Find your favourite arts here
            <div class="divider"></div>
        </div>
    </div>

    <div class="row" style="margin-top:15px;">


        <div class="col-md-12">
            <div class="col-md-12 col-sm-12 creative">
                <h1 class="heading" style="">FAQ</h1>

            </div>

            <div class="clearfix"></div>

            <div class="col-md-11 col-md-offset-1" style="margin-bottom: 25px; margin-top: 10px;">
                <p><b>Order & Shipping related FAQ's:</b></p> <br>
                <p><b>In How many days shall the products ordered be shipped?</b></p>
                <p>Every art is printed and crafted on demand, thus the entire printing, making & curing time varies from <b> 7 days to 10days </b> at max. </p>
                <br>

                <p><b>What is your return policy?</b></p>
                <p>We offer a <b>Return Policy</b> for all our products that have quality issues including damages on arrival; you can return the product to the delivery person. Other than this goods once bought cannot be exchanged.</p>
                <br>

                <p><b>Does the color of actual product match exactly with what’s shown on screen? </b></p>
                <p>
                    All the mock-ups of artworks and products displayed on website are computer generated and thus <b>minor color variation</b> in the actual product when compared to various screens on which artwork is being viewed is very natural.
                    Moreover, various products with similar artwork could also show slight color variance due to the property of surface, the artwork is printed on.
                    Having said that, do not expect a vast color inconsistency as we take most care in ensuring profiling & managing color range of each artwork being printed on demand giving true art reproduction.
                </p>
                <br>
                <br>
                <p><b>Artist's FAQ's:</b></p> <br>

                <p><b>How do I signup as an Artist with Fearless Strokes? </b></p>
                <p>
                    To sign up as an artist, click on register button under the artist tab on the home page and fill in the form. You will receive an email, where you will be asked to verify your account.
                    Once verified, sign in from your account and update your page with your bio and picture.
                </p>
                <br>

                <p><b>How do I start uploading Art on Fearless Strokes and what file format should I use when uploading images? </b></p>
                <p> After you have registered as an artist, keep sending us your amazing artwork with a title for the artwork in 1080p in the following formats:
                    <ul>
                        <li> If your artwork is on a canvas, scan your artwork and send them to us in .png format. </li>
                        <li>In case of digital work, send in your artwork in either .psd or .eps format. </li>
                    </ul>
                    Email us your artwork with a title to <a href="#">fearless.strokes@gmail.com</a>
                </p>
                <br>

                <p><b>How do I claim my earnings? </b></p>
                <p>
                    You will have your own dashboard, where you will be able to track your sales. We will transfer your earnings to your bank account at the end of each month.
                </p>
                <br>

                <p><b>How long will it take to receive my earnings? </b></p>
                <p>
                    When one of your products is purchased we take care of producing, packing and shipping the product to the customer. Once the order has shipped, you are able to see it as a pending transaction in your dashboard.
                    <br>
                    Please note, there is a 30-day grace period from the time of shipment for each transaction to clear, wherein you will be paid on the first of the following month via the bank account number you have provided us.
                    <br>
                    Example: You sell an Art Print and it ships on January 15th. The 30-day grace period ends on February 15th. You will be paid for that sale on March 1st.
                </p>
                <br>

                <p><b>How are Retail Prices & my earnings decided? </b></p>
                <p>
                    The retail price is fixed by us and is the same for all artists.
                    You will receive a flat 45% on the profit and the rest of the profit will be contributed towards the education of the children of Alokito Hridoy Primary School in Tangail.
                </p>
                <br>

                <p><b>Who prints ships & co-ordinates with the customer? </b></p>
                <p>
                    We use the High Resolution files emailed by you to print process and craft your art into a product as and when an Order is confirmed by a customer.
                    It is <b>our job</b> to handle all order related queries, printing, manufacturing and shipping while also coordinating with the customer as you sit back and work on your next masterpiece.
                </p>
                <br>

                <p><b>What are the content guidelines for artist on Fearless Strokes? </b></p>
                <p>
                    Although we understand <b>freedom of creativity</b> should not be oppressed yet in order to comply with Terms & Conditions of several third party tools our portals uses, we cannot allow any Pornography, Nude or Sexual artwork and content on the website.
                    Apart from that we are strictly against posting of artwork that intentionally promotes Hatred, Crime, Violence, Drug Abuse, Swear Words, Hurts Religious sentiments, Child Abuse, Discrimination against Color, Sex or Ethnicity and defames any human living or dead, religion, religious group or associations.
                    We advise <b>self moderation</b> for Not Safe for Work Mature content and expect you to turn on Safe Filter when the artwork is uploaded. We also request you to ensure no third party logos, designs and photographs are used without prior permission from the owners.
                    The rights of judgement remain with the Fearless Strokes team weather or not to ban content from the portal.
                </p>
                <br>

            </div>

        </div>
    </div>
</div>
</div>

<div class="container">
    <?php include("footer.php"); ?>
</div>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/bootstrap/js/bootstrap-select.js" /></script>
<script>
$(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
});

$(function() {
    $( "#slider-range" ).slider({
        range: true,
        min: 500,
        max: 5000,
        values: [ 500, 5000 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
    });

    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
        " - $" + $( "#slider-range" ).slider( "values", 1 ) );
});
</script>

<script type="text/javascript" src="assets/js/plugin.js"></script>

</body>
</html>