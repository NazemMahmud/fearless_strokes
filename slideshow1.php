<html>
    <head>
        
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- Bootstrap -->
<!--    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="assets/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
<!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">-->

        <!-- Latest compiled and minified JavaScript -->
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
               


        
        <style>
            .carousel-control 			 { width:  4%; }
            .carousel-control.left,.carousel-control.right {margin-left:15px;background-image:none;}
            @media (max-width: 767px) {
                .carousel-inner .active.left { left: -100%; }
                .carousel-inner .next        { left:  100%; }
                .carousel-inner .prev		 { left: -100%; }
                .active > div { display:none; }
                .active > div:first-child { display:block; }

            }
            @media (min-width: 767px) and (max-width: 992px ) {
                .carousel-inner .active.left { left: -50%; }
                .carousel-inner .next        { left:  50%; }
                .carousel-inner .prev		 { left: -50%; }
                .active > div { display:none; }
                .active > div:first-child { display:block; }
                .active > div:first-child + div { display:block; }
            }
            @media (min-width: 992px ) {
                .carousel-inner .active.left { left: -25%; }
                .carousel-inner .next        { left:  25%; }
                .carousel-inner .prev		 { left: -25%; }	
            }

        </style>
    </head>
    <body>
        <div class="container-fluid">
            <img  class = "img-responsive" src="assets/images/product/django-logo-positive.svg">
        </div>
        <div class="col-md-12 text-center"><h3>Product Carousel</h3></div>
        <div class="col-md-6 col-md-offset-3">
        <div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="3000" id="myCarousel">
          <div class="carousel-inner">
            <div class="item active">
              <div class="col-md-3 col-sm-6 col-xs-12"><a href="#"><img src="http://placehold.it/500/e499e4/fff&amp;text=1" class="img-responsive"></a></div>
            </div>
            <div class="item">
              <div class="col-md-3 col-sm-6 col-xs-12"><a href="#"><img src="http://placehold.it/500/e477e4/fff&amp;text=2" class="img-responsive"></a></div>
            </div>
            <div class="item">
              <div class="col-md-3 col-sm-6 col-xs-12"><a href="#"><img src="http://placehold.it/500/eeeeee&amp;text=3" class="img-responsive"></a></div>
            </div>
            <div class="item">
              <div class="col-md-3 col-sm-6 col-xs-12"><a href="#"><img src="http://placehold.it/500/f4f4f4&amp;text=4" class="img-responsive"></a></div>
            </div>
            <div class="item">
              <div class="col-md-3 col-sm-6 col-xs-12"><a href="#"><img src="http://placehold.it/500/f566f5/333&amp;text=5" class="img-responsive"></a></div>
            </div>
            <div class="item">
              <div class="col-md-3 col-sm-6 col-xs-12"><a href="#"><img src="http://placehold.it/500/f477f4/fff&amp;text=6" class="img-responsive"></a></div>
            </div>
            <div class="item">
              <div class="col-md-3 col-sm-6 col-xs-12"><a href="#"><img src="http://placehold.it/500/eeeeee&amp;text=7" class="img-responsive"></a></div>
            </div>
            <div class="item">
              <div class="col-md-3 col-sm-6 col-xs-12"><a href="#"><img src="http://placehold.it/500/fcfcfc/333&amp;text=8" class="img-responsive"></a></div>
            </div>
          </div>
          <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
        </div>
        </div>
        <script src="assets/bootstrap/js/bootstrap-select.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--
        <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
-->

        <script>
            $('.carousel[data-type="multi"] .item').each(function(){
              var next = $(this).next();
              if (!next.length) {
                next = $(this).siblings(':first');
              }
              next.children(':first-child').clone().appendTo($(this));

              for (var i=0;i<2;i++) {
                next=next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
              }
            });
        </script>

    </body>
</html>