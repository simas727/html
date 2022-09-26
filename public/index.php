<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../Models/index.php'
 
// Senokai dirbau PHP todėl atleiskite :)
//https://www.guru99.com/php-and-xml.html#4
// failu skaitymas / validavimas | Nebaigta
// https://www.digitalocean.com/community/tutorials/how-to-implement-pagination-in-mysql-with-php-on-ubuntu-18-04
//https://www.youtube.com/watch?v=ARxZV8OZ8Cg&list=PLNuh5_K9dfQ3jMU-2C2jYRGe2iXJkpCZj&ab_channel=ZakH.
//https://www.geeksforgeeks.org/sort-a-multidimensional-array-by-date-element-in-php/



  

?>


<html lang="lt">

<head>
  <title>PWP</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="resources/css/main.css">
   <script src="resources/js/main.js"> </script>
</head>

<body>

  <!-- Navbar -->
  <div class="w3-top">
    <div class="w3-bar w3-black w3-card">
      <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="Toggle_Menu()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
      <a href="/" class="w3-bar-item w3-button w3-padding-large">HOME</a>
      <a href="/psl/files" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Failai</a>
      <a href="/psl/notes" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Užrašai</a>


      <a href="/psl/reset" class="w3-padding-large w3-hover-red w3-hide-small w3-right">Reset</a>
    </div>
  </div>

  <!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
  <div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
    <a href="/" class="w3-bar-item w3-button w3-padding-large">HOME</a>
    <a href="/psl/files" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Failai</a>
    <a href="/psl/notes" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Užrašai</a>

  </div>

  <!-- Page content -->
  <div class="w3-content" style="max-width:2000px;margin-top:46px">

    <!-- Automatic Slideshow Images -->
 
    <!-- The Band Section -->

  </div>

  <?php 
$pg = new Page();
$pg->Page_Select();

  ?>

  <!-- End Page Content -->
  </div>


  <!-- Footer -->
  <footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
    <p class="w3-medium">Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>

  </footer>

  
</body>

</html>