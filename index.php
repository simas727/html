<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Senokai dirbau PHP todėl atleiskite :)
//https://www.guru99.com/php-and-xml.html#4
// failu skaitymas / validavimas | Nebaigta
// https://www.digitalocean.com/community/tutorials/how-to-implement-pagination-in-mysql-with-php-on-ubuntu-18-04
//https://www.youtube.com/watch?v=ARxZV8OZ8Cg&list=PLNuh5_K9dfQ3jMU-2C2jYRGe2iXJkpCZj&ab_channel=ZakH.
//https://www.geeksforgeeks.org/sort-a-multidimensional-array-by-date-element-in-php/
$list = array (
  array('first_name', 'age', 'gender'),
  array('Kiestis', 32,'male'),
  array('Kiestis', 32,'male'),
  array('Kiestis', 32,'male'),
 // array("name"=>'qw', "age"=>44, "scode"=>2254),
);

 


/*
$fp = fopen('f/file.csv', 'w+');
 
foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
 
$csv = csvToArray('f/file.csv');
foreach($csv as $value){
  //Print the element out.
  if(!is_array($val)){
    echo $val, '<br>';
}
}*/

 //if(!in_array('json',$formatai)) die('Noo');
class Core {
  
    function he(){
        echo "<div class='mySlides w3-display-container w3-center'>
        <img src='https://wallpaperaccess.com/full/1278165.jpg' style='width:100%; height: 50vw; '>
        <div class='w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small' style='font-family: 'Times New Roman', Georgia, serif;' >
          <h3>Simas Devainis</h3>
          <p> Anksčiau dirbau su PHP, dabar įgūdžiai kiek pasene. </p>   
        </div>
        </div>
        <div class='mySlides w3-display-container w3-center'>
        <img src='https://wallpaperaccess.com/full/3909225.jpg' style='width:100%; height: 50vw;'>
        <div class='w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small'>
          <h3>Simas Devainis</h3>
          <p> Dirbu su Node js (discord.js,express,exec)  </p>    
        </div>
        </div>
        <div class='mySlides w3-display-container w3-center'>
        <img src='https://static.vecteezy.com/system/resources/thumbnails/006/464/622/small/modern-background-abstract-gaming-background-vector.jpg' style='width:100%; height: 50vw;'>
        <div class='w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small'>
          <h3>Simas Devainis</h3>
          <p> Laisvalaikiu mokinuosi naujas kalbas, žaidžiu kompiuterinius žaidimus arba skiriu laika šeimai t.y Tėvams, broliui. </p>    
        </div>
        </div>";

    }

    function read_valid_json($file){

      // Read the JSON file 
    $json = file_get_contents($file);
      
    // Decode the JSON file
    $json_data = json_decode($json,true);
      if(!array_key_exists('first_name',$json_data[0])) return false;
    // Display data
     
      return $json_data;
    }
    
    function read_valid_xml($file){
      $xml = simplexml_load_file($file);
     
    $array = array();
    $list = $xml->item;
    //var_dump($xml);
    $on = true;
    for ($i = 0; $i < count($list); $i++) {
        if(!isset($list[$i]->first_name)) return $array = false;
        $array[$i] = array($list[$i]->first_name,$list[$i]->age,$list[$i]->gender);
    }
    return $array;
    }
    
    function read_valid_csv($file){
    $csv = array();
    $lines = file($file, FILE_IGNORE_NEW_LINES);
    
    foreach ($lines as $key => $value)
    {
        $csv[$key] = str_getcsv($value);
    }
    $hdr = $csv[0];
    if($hdr[0] != 'first_name' || $hdr[1] != 'age' || $hdr[2] != 'gender') return false;
     return $csv;
    } 
    // failo ikelimas
    function Uploadfile(){
      include 'config.php';
      $target_dir = "f/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $uploadOk = 0;
  if(!in_array($imageFileType,$formatai)) die('Klaida');
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
  if($imageFileType === 'json'){
    $uploadOk = 1;
    $json = $this->read_valid_json($target_file);
    $this->Create_table($json,0,$imageFileType);
  }
  if($imageFileType === 'csv'){
    $uploadOk = 1;
    $json = $this->read_valid_csv($target_file);
    $this->Create_table($json,1,$imageFileType);
  }
}
    }
  function Create_table($array,$start_index,$type){
    $c = $array;
   // var_dump($array);
    echo '<table border="1"><tr><td>Vardas</td><td>Amžius</td><td>lytis</td></tr>';
         echo '';
         for($i = $start_index; count($array) > $i; $i++){
          if($type === "json"){
          echo '<tr><td>'.$array[$i]["first_name"].'</td><td>'.$c[$i]["age"].'</td><td>'.$c[$i]["gender"].'</td></tr>';
          }elseif($type === "csv"){
            echo '<tr><td>'.$array[$i][0].'</td><td>'.$c[$i][1].'</td><td>'.$c[$i][2].'</td></tr>';
         

          }
        }
         echo '</table>';
  }
  
}
 
 $pg = new Core();
 $pg->he();

 
 switch ($_GET["psl"]) {
    case '':
    
         
        // if(!$a) return;
         
        break;
    case 'pg':
        echo 'pg';
        break;
    default:
        # code...
        break;
 }
 
 

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
body {font-family: "Lato", sans-serif}
.mySlides {display: none}
</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">HOME</a>
    <a href="#band" class="w3-bar-item w3-button w3-padding-large w3-hide-small">BAND</a>
    <a href="#tour" class="w3-bar-item w3-button w3-padding-large w3-hide-small">TOUR</a>
    <a href="#contact" class="w3-bar-item w3-button w3-padding-large w3-hide-small">CONTACT</a>
    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-padding-large w3-button" title="More">MORE <i class="fa fa-caret-down"></i></button>     
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="#" class="w3-bar-item w3-button">Merchandise</a>
        <a href="#" class="w3-bar-item w3-button">Extras</a>
        <a href="#" class="w3-bar-item w3-button">Media</a>
      </div>
    </div>
    <a href="javascript:void(0)" class="w3-padding-large w3-hover-red w3-hide-small w3-right"><i class="fa fa-search"></i></a>
  </div>
</div>

<!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
  <a href="#band" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">BAND</a>
  <a href="#tour" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">TOUR</a>
  <a href="#contact" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">CONTACT</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">MERCH</a>
</div>
 
<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">

  <!-- Automatic Slideshow Images -->
 

  <!-- The Band Section -->
  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="file">
   <p class="w3-justify">
   <form  method="post" enctype="multipart/form-data">

  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Pateikti" name="submit">
</form>
<?php 
 $pg->Uploadfile();
?>
    </div>
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
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
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
