<!DOCTYPE html>
<html lang="en">
<head>
  <title>Southeast Asian College, Inc.</title>
  <link rel="shortcut icon" href="assets/image/Southeast Asian College.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="assets/js/pace.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/css/pace/pace-theme-corner-indicator.css"  />
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/bootstrap.min.css">
  <link href="assets/css/fonts/montserrat.css" rel="stylesheet" type="text/css">
  <link href="assets/css/fonts/lato.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="assets/css/fontawesome/css/fontawesome.min.css">
  <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="assets/js/popper.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/css/fontawesome/css/font-awesome.min.css">
  
  <style>
 /*nag wa white sya tho di na kita yung pace
  body {display:none}
  body.pace-done {display:inline}*/

  body.pace-running:before {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  z-index: 1500;
  background-color: rgba(0, 0, 0, 0.5);
}

// For a nice fade-in:
body:before {
  background-color: rgba(0, 0, 0, 0);
  -webkit-transition: background-color 200ms;
  -moz-transtition: background-color 200ms;
  -ms-transition: background-color 200ms;
  -o-transition: background-color: 200ms;
  transition: background-color 200ms;
}
  .tales {
  width: 100%;
  height: 200px;
} 

  /* Main content */
  .main {
      margin-top: 30px; /* Add a top margin to avoid content overlay */
  }

  /*COMPANY TEMPLATE*/
  body {
      font: 400 15px Lato, sans-serif;
      line-height: 1.8;
      color: #818181;
  }
  h2 {
      font-size: 24px;
      text-transform: uppercase;
      color: #303030;
      font-weight: 600;
      margin-bottom: 30px;
  }
  h4 {
      font-size: 19px;
      line-height: 1.375em;
      color: #303030;
      font-weight: 400;
      margin-bottom: 30px;
  }  
  .jumbotron {
      background-color: #f4511e;
      color: #fff;
      padding: 100px 25px;
      font-family: Montserrat, sans-serif;
  }
  .container-fluid {
      padding: 60px 50px;
  }
  .bg-grey {
      background-color: #f6f6f6;
  }
  .logo-small {
      color: #f4511e;
      font-size: 50px;
  }
  .logo {
      color: #493867;
      font-size: 200px;
  }
  .thumbnail {
      padding: 0 0 15px 0;
      border: none;
      border-radius: 0;
  }
  .thumbnail img {
      width: 100%;
      height: 100%;
      margin-bottom: 10px;
  }
  .carousel-control.right, .carousel-control.left {
      background-image: none;
      color: #493867;
  }
  .carousel-indicators li {
      border-color: #493867;
  }
  .carousel-indicators li.active {
      background-color: #493867;
  }
  .carousel-inner img {
      width: 100%;
      height: 100%;
  }
  .item h4 {
      font-size: 19px;
      line-height: 1.375em;
      font-weight: 400;
      font-style: italic;
      margin: 70px 0;
  }
  .item span {
      font-style: normal;
  }
  .panel {
      border: 1px solid #f4511e; 
      border-radius:0 !important;
      transition: box-shadow 0.5s;
  }
  .panel:hover {
      box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
      border: 1px solid #f4511e;
      background-color: #fff !important;
      color: #f4511e;
  }
  .panel-heading {
      color: #fff !important;
      background-color: #f4511e !important;
      padding: 25px;
      border-bottom: 1px solid transparent;
      border-top-left-radius: 0px;
      border-top-right-radius: 0px;
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
  }
  .panel-footer {
      background-color: white !important;
  }
  .panel-footer h3 {
      font-size: 32px;
  }
  .panel-footer h4 {
      color: #aaa;
      font-size: 14px;
  }
  .panel-footer .btn {
      margin: 15px 0;
      background-color: #f4511e;
      color: #fff;
  }
  .navbar {
      margin-bottom: 0;
      background-color: #493867;
      z-index: 9999;
      border: 0;
      font-size: 12px !important;
      line-height: 1.42857143 !important;
      letter-spacing: 4px;
      border-radius: 0;
      font-family: Montserrat, sans-serif;
      float:fixed;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
      color: #493867 !important;
      background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #fff !important;
  }
  footer .glyphicon {
      font-size: 20px;
      margin-bottom: 20px;
      color: #493867;
  }
  .slideanim {visibility:hidden;}
  .slide {
      animation-name: slide;
      -webkit-animation-name: slide;
      animation-duration: 1s;
      -webkit-animation-duration: 1s;
      visibility: visible;
  }
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
        width: 100%;
        margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 480px) {
    .logo {
        font-size: 150px;
    }
  }
  .icon-bar{
   margin-bottom:3px;
   height: 2px;
   width:22px; 
  }



  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">