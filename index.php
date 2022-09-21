<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Senokai dirbau PHP todėl atleiskite :)
//https://www.guru99.com/php-and-xml.html#4
// failu skaitymas / validavimas | Nebaigta
// https://www.digitalocean.com/community/tutorials/how-to-implement-pagination-in-mysql-with-php-on-ubuntu-18-04
//https://www.youtube.com/watch?v=ARxZV8OZ8Cg&list=PLNuh5_K9dfQ3jMU-2C2jYRGe2iXJkpCZj&ab_channel=ZakH.
//https://www.geeksforgeeks.org/sort-a-multidimensional-array-by-date-element-in-php/



// Pagrindine klase 
include 'Class.php';

$pg = new Core();
$pg->he();

?>


<html lang="lt">

<head>
  <title>PWP</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      font-family: "Lato", sans-serif
    }

    .mySlides {
      display: none
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <div class="w3-top">
    <div class="w3-bar w3-black w3-card">
      <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
      <a href="index.php" class="w3-bar-item w3-button w3-padding-large">HOME</a>
      <a href="?psl=files" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Failai</a>
      <a href="?psl=notes" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Užrašai</a>


      <a href="?psl=reset" class="w3-padding-large w3-hover-red w3-hide-small w3-right">Reset</a>
    </div>
  </div>

  <!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
  <div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large">HOME</a>
    <a href="?psl=files" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Failai</a>
    <a href="?psl=notes" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Užrašai</a>

  </div>

  <!-- Page content -->
  <div class="w3-content" style="max-width:2000px;margin-top:46px">

    <!-- Automatic Slideshow Images -->

    <?php

    switch ($_GET["psl"]) {
      case '':


        // if(!$a) return;
        $pg->Sort_By(0);
        break;
      case 'sortbypin':
        $pg->Sort_By(2);
        break;
      case 'sortbydate':
        $pg->Sort_By(1);
        break;
      case 'delnote':
        $id = $_GET['id'];
        array_splice($_SESSION['notes'], $id, 1);
        header('Location: index.php');
        break;
      case 'pinnote':
        $array = $_SESSION['notes'];
        $id = $_GET['id'];

        if ($array[$id]['pin']) {
          $array[$id]['pin'] = 0;
          $_SESSION['notes'] = $array;
          header('Location: index.php');
        } else {
          $array[$id]['pin'] = 1;
          $_SESSION['notes'] = $array;
          header('Location: index.php');
        }
        break;
      case 'files':
        $pg->Page_Files();
        break;
      case 'notes':
        $pg->Page_Notes();
        break;
      case 'reset':
        session_unset();
        header('Location: index.php');
        break;
      default:
        # code...
        break;
    }


    ?>
    <!-- The Band Section -->

  </div>



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

  <script>
    // Automatic Slideshow - change image every 4 seconds
    var myIndex = 0;
    carousel();

    function carousel() {
      var i;
      var x = document.getElementsByClassName("mySlides");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      myIndex++;
      if (myIndex > x.length) {
        myIndex = 1
      }
      x[myIndex - 1].style.display = "block";
      setTimeout(carousel, 4000);
    }

    // Used to toggle the menu on small screens when clicking on the menu button
    function myFunction() {
      var x = document.getElementById("navDemo");
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
      } else {
        x.className = x.className.replace(" w3-show", "");
      }
    }

    // When the user clicks anywhere outside of the modal, close it
    var modal = document.getElementById('ticketModal');
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>

</body>

</html>