<!--CONTAINER FOR FOOTER-->
<footer class="container-fluid text-center bg-white">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>
 <?php
  date_default_timezone_set('Asia/Manila');
  
 // print("Copyright ".date('Y-m-d H:i:s'));
  print('Copyright @ '.date('Y').' Southeast Asian College, Inc. ');
?></p>
<a href="https://facebook.com/SACI.EDU.PH/"><i class="fa fa-facebook-square fa-3x"></i></a>
</div>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>
<!--https://facebook.com/SACI.EDU.PH/-->
</body>
</html>

