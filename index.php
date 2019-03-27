<?php
include_once('assets/system/headerPA.php');
?>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      
    <button type="button" class="navbar-toggle btn btn-secondary" data-toggle="collapse" data-target="#myNavbar">
        <i class="fa fa-bars"></i>                      
    </button>
    <a href="index.php"><img src="assets/image/saci_logo.png" height="75%" width="80" style="float:left; padding-left:40px;margin-top:4px;"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">HOME</a></li>
        <li><a href="opac.php">OPAC</a></li>
        <li><a href="login.php">LOGIN</a></li>
        <li><a href="#about">ABOUT</a></li>
        <li><a href="#hours">LIBRARY</a></li>
        <li><a href="#values">VALUES</a></li>
        <li><a href="#contact">CONTACT</a></li>
        
      </ul>
    </div>
  </div>
</nav>

<!--CAROUSEL / SLIDER-->
<div class="content">
<div id="myCarousel" class="carousel slide" data-ride="carousel" style="width:100%;">
  <!--carousel indicator-->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
    <li data-target="#myCarousel" data-slide-to="4"></li>
  </ol>

  <!--wrapper for slides-->
  <div class="carousel-inner" style ='height:500px;overflow-y:hidden'>
    <div class="item active">
      <img class="d-block w-100" src="assets/image/book.jpg" alt="First slide" class="tales">
    </div>
    <div class="item">
      <img class="d-block w-100" src="assets/image/lib.jpg" alt="Second slide" class="tales">
    </div>
    <div class="item">
      <img class="d-block w-100" src="assets/image/rules.jpg" alt="Third slide" class="tales">
    </div>
    <div class="item">
      <img class="d-block w-100" src="assets/image/lib1.jpg" alt="fourth slide" class="tales">
    </div>
    <div class="item">
      <img class="d-block w-100" src="assets/image/sacii.png" alt="fifth slide" class="tales">
    </div>
  </div>

  <!--carousel controller-->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" ></span>
    <span class="sr-only">Next</span>
  </a>
  
</div>



<script>
$(document).ready(function(){
    // Activate Carousel
    $("#myCarousel").carousel({interval:3000, pause:"hover"});
    
    // Enable Carousel Indicators
    $(".item").click(function(){
        $("#myCarousel").carousel(0);
    });
    $(".item").click(function(){
        $("#myCarousel").carousel(1);
    });
    $(".item").click(function(){
        $("#myCarousel").carousel(2);
    });
    $(".item").click(function(){
        $("#myCarousel").carousel(3);
    });
    $(".item").click(function(){
        $("#myCarousel").carousel(4);
    });
    
    // Enable Carousel Controls
    $(".left carousel-control").click(function(){
        $("#myCarousel").carousel("prev");
    });
    $(".right carousel-control").click(function(){
        $("#myCarousel").carousel("next");
    });
});
</script>

<!--container for COMPANY-->
<div id="about" class="container-fluid bg-grey">
  <h2 class="text-center"> ABOUT COMPANY </h2>
  <div class="row">
    <div class="col-sm-8">
      
      <p> <strong>Southeast Asian College  </strong> was established in 1975 as the United Doctors Medical Center Colleges focusing on offering programs on healthcare. Initially the institution only offered a program in nursing serving around 200 students in its first year. By 1980, new programs were added namely psychology, medical secretarial and general secretarial courses. The school changed its name to its current name in 1997 and a new management took over.</p>
      
    </div>

    <div class="col-sm-4">
      <span class="glyphicon glyphicon-home logo slideanim"></span>
    </div>
  </div>
</div>

<!--LIBRARY HOURS-->
<div id="hours" class="container-fluid bg-white ">
  <h2 class="text-center"> LIBRARY HOURS </h2>
  <div class="row">
    <div class="col-sm-5">
      
      <p> MONDAY - SATURDAY<br> 8:00AM - 12:00 <br> 12:00 - 1:00PM BREAKTIME <br> 1:00 - 5:00PM </p>
    </div>
    <div class="col-sm-5">
      <span class="glyphicon glyphicon-time logo slideanim"></span>
    </div>
  </div>
</div>

<!--SCHOOL LIBRARY MISSION VISION-->
<div id="values"class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-globe logo slideanim"></span>
    </div>
    <div class="col-sm-8">
      <h2>Our Values</h2><br>
      <h4><strong>MISSION:</strong> A private non-sectarian institution of learning, envision itself as a center for academic
        excellence, dedicated to the service of God, Country and Filipino people. SACI commits itself to provide a system of 
        education that develops individuals who are self-reliant, competent and imbued with a deep sense of professionalism 
        consistent with Filipino virtues and ideas.</h4><br>

      <p><strong>VISION:</strong> Provide relevent, progressive and affordable system of institution utilizing modern education 
        technology.Expose its students to exemplary and qualified men and women commited to give them education of the highest
        quality. Undertake strategic alliance with the leading educational, industrial and government institutions. Increase
        awareness of social resposibility by involving both the facaulty and students in social and civic projects. Develop leaders
        in their profession who can contribute their share to nation building.</p>
    </div>
  </div>
</div>


<!-- Container CONTACT -->
<div id="contact" class="container-fluid text-center bg-white">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-8">
      <p><span class="glyphicon glyphicon-map-marker"></span> Quezon City, Philippines</p>
      <p><span class="glyphicon glyphicon-phone"></span> <!-- +639156372852 --> [contact number of the librarian]</p>
      <p><span class="glyphicon glyphicon-envelope"></span> <!-- myemail@something.com --> [email of the school]</p>
    </div>
    <div class="col-sm-2">
      <span class="glyphicon glyphicon-envelope logo slideanim"></span>
    </div>
  </div>
</div>

<!-- Add Google Maps -->
<div id="googleMap" style="height:400px;width:100%;"></div>
<script>
function myMap() {
var myCenter = new google.maps.LatLng(14.617565, 121.0020055);
var mapProp = {center:myCenter, zoom:20, scrollwheel:false, draggable:false, mapTypeId:google.maps.MapTypeId.ROADMAP};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
var marker = new google.maps.Marker({position:myCenter});
marker.setMap(map);
}
</script>
<script src="assets/js/myMap.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5tfr8oqx6jMCn68iC7iHn9u2kbzKZakE&callback=myMap"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

<?php 
  include_once('assets/system/footerPA.php');
?>