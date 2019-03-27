<?php
	session_start();
	if(isset($_SESSION['user'])){
		header('Location: home.php');
		exit(0);
	}
	include("mysql_connect_init.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Student Assistant and Graduate Assistant Program</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
    <meta charset="utf-8">
    <script>
      $(document).ready(function() {
        $('.ui.button').click(function() {
          $('.ui.modal').modal('show');
					$('.longer.modal').modal('show');
          $('.ui.embed').embed({

          });
        });
      });
    </script>
    <style>
      h1 {
        color: black;
      }

      h3 {
        color: black;
      }

			.container1 {
				margin: 10px;
			}
    </style>
  </head>
  <body>
		<!--------------------------HEADER--------------------------->
    <header class="main-header">
      <div class="main-header logos">
        <a href="https://www.up.edu.ph/"><img class="up-logo" src="../assets/images/up-logo.png" height="100" alt="University of the Philippines"></a>
        <a href="http://osss.up.edu.ph/"><img class="osss-logo" src="../assets/images/osss-logo.png" height="100" alt="Office of Scholarships and Student Services"></a>
      </div>
      <div class="main-header title">
        <div class="title small">
          <a href="https://www.up.edu.ph/"><h3 class="up-name">University of the Philippines</h3></a>
          <a href="http://osss.up.edu.ph/"><h3 class="osss-name">Office of Scholarships and Student Services</h3></a>
        </div>
        <div class="title large">
          <a href="http://osss.up.edu.ph/"><h1 class="saga-name">Student Assistant and Graduate Assistant Program</h1></a>
        </div>
      </div>
    </header>
    <header class="nav">
      <div class="ui large menu" id="menu">
        <a class="item" href="home.html" id="link1">
          Home
        </a>
        <a class="item" href="program-goals.html" id="link1">
          Program Goals
        </a>
        <a class="item" href="job-vacancy.html" id="link1">
          Job Vacancies
        </a>
        <a class="item" href="flowchart.html" id="link1">
          Flowchart
        </a>
        <div class="right item">
          <div class="ui button primary" id="login">Login</div>
          <div class="ui modal">
            <i class="close icon"></i>
            <div class="content">
              <div class="ui embed" data-url="login.php"></div>
            </div>
          </div>
        </div>
      </div>
    </header>
		<!------------------------END_OF_HEADER------------------------>

		<!-----------------------Job vacancies post----------------------->
		<div class="container1">
		<?php
		$query = 'SELECT jobs.*,
			faculty.fname as fname,
			faculty.lname as lname
			FROM jobs
			INNER JOIN faculty
			ON faculty.FN = jobs.faculty_no
		';

		$res = mysqli_query($conn, $query);

		echo "
			<div class=\"job-vacancies\">
				<h2>Job Vacancies</h2>
				<div class=\"ui four cards\">

		";
		while($row=mysqli_fetch_assoc($res)) {
			echo "
			<a class=\"ui card\" href=view_jobs.php?id=".$row['jobID'].">
				<div class=\"image\">
					<img src=\"https:\/\/scontent.fmnl4-2.fna.fbcdn.net/v/t1.0-9/28055884_1561194627263832_6514717213170390806_n.png?_nc_cat=101&_nc_ht=scontent.fmnl4-2.fna&oh=e64ebfd1821dbb386cffdfafd25b0628&oe=5CB85DC5\">
				</div>
				<div class=\"content\">
					<div class=\"header\">".$row['title']."</div>
					<div class=\"meta\">
						".$row['office_college']."
					</div>
					<div class=\"description\">
						".$row['description']."
					</div>
				</div>
				<div class=\"extra content\">
					<span class=\"right floated\">
						".$row['date_created']."
					</span>
					<span>
						<i class=\"user icon\"></i>
						".$row['slot_alotted']."
					</span>
				</div>
			</a>
			";
		}

		echo "
				</div>
			</div>
		";
		?>
		</div>
		<!-----------------------End of Job vacancies post----------------------->


		<!---------------------------------Footer-------------------------------->
    <div class="ui vertical footer segment" style="background-color: #7B1113">
        <div class="ui center aligned container">
          <div class="ui stackable inverted divided grid">
            <div class="eight wide column">
              <h4 class="ui inverted header" style="text-decoration: underline">Quick Links</h4>
              <div class="ui inverted link list">
                <a href="#" class="item" id = "link2">About Us</a>
                <a href="#" class="item" id = "link2">Contact Us</a>
                <a href="#" class="item" id = "link2">Donate</a>
                <a href="#" class="item" id = "link2" >FAQs</a>
                <a href="#" class="item" id = "link2">Feedback</a>
                <a href="#" class="item" id = "link2">Forms</a>
              </div>
            </div>
            <div class="eight wide column">
              <h4 class="ui inverted header" style="text-decoration: underline">Office of Scholarships and Student Services</h4>
              <p style="color: #FFFFFF">Address<br />Contact Number<br/>Operating Hours<br/></p>
            </div>
    			</div>
    		</div>
      </div>
			<!-------------------------------End of Footer----------------------------->
  </body>
</html>
