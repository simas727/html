<?php
require_once 'index.php';

$Page = new Upload();
class Page
{

 // klaidų rodymas
 function Show_Error($head, $body)
 {
   echo '<div class="w3-panel w3-red">
     <h3>' . $head . '</h3>
     <p>' . $body . '</p>
   </div> ';
 }


  //nuotraukos header'is su tekstu presset'as
  function Slider()
  {
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

  function Create_Table($array, $start_index, $type)
  {
    $c = $array;
    // var_dump($array);
    echo '<table border="1"><tr><td>Vardas</td><td>Amžius</td><td>lytis</td></tr>';
    echo '';
    for ($i = $start_index; count($array) > $i; $i++) {
      if ($type === "json") {
        echo '<tr><td>' . $array[$i]["first_name"] . '</td><td>' . $c[$i]["age"] . '</td><td>' . $c[$i]["gender"] . '</td></tr>';
      } elseif ($type === "csv") {
        echo '<tr><td>' . $array[$i][0] . '</td><td>' . $c[$i][1] . '</td><td>' . $c[$i][2] . '</td></tr>';
      }
    }
    echo '</table>';
  }
  // Pridedam užrašą
  function Add_Note()
  {

    if (isset($_POST["submit2"])) {
      $name = $_POST['name'];
      $note = $_POST['text'];
      $ar = array(
        array('name' => $name, 'note' => $note, 'pin' => 0, 'date' => date("Y-m-d h:i:s")),
      );
      if (empty($name) || empty($note)) return $this->Show_Error('Klaida!', 'Laukeliai negali būti tušti!');
      if (isset($name) || isset($note)) {
        if (is_array($_SESSION['notes'])) {
          array_push($_SESSION['notes'], (array('name' => $name, 'note' => $note, 'pin' => 1, 'date' => date("Y-m-d h:i:s"))));
          $this->Sort_By(0);
        } else {


          $_SESSION['notes'] = $ar;
          $this->Sort_By(0);
        }
      }
    }
  }

    // Rodom pažymėtus
  function Display_Pins($arg)
  {


    // Sort the array 

    //var_dump($_SESSION['notes']);

    if (!count($_SESSION['notes'])) return;
    for ($i = 0; $i < count($arg); $i++) {

      echo '<div class="w3-panel w3-leftbar w3-sand  w3-serif">
        <h2>' . $arg[$i]['name'] . '</h2>
        <p>' . $arg[$i]['note'] . '</p>
        <p>' . $arg[$i]['date'] . '</p>
        <p>PIN(' . $arg[$i]['pin'] . ')</p>
        <a href="?psl=delnote&id=' . $i . '" class="w3-btn w3-red">Ištrinti</a>
        <a href="?psl=pinnote&id=' . $i . '" class="w3-btn w3-yellow">žimėti</a>
       
        </div> ';
    }
    echo '  <a href="?psl=sortbydate" class="w3-btn w3-blue-grey">Rušiuoti pagal data</a>
  <a href="?psl=sortbypin" class="w3-btn w3-blue-grey">Rušiuoti pagal žymas</a>
';
  }
  // rušiuoti
  function Sort_By($type)
  {
    $arg = $_SESSION['notes'];

    if ($type === 1) {

      /*  usort($arg, function ($element1, $element2) {
      $datetime1 = strtotime($element1['date']);
      
      $datetime2 = strtotime($element2['date']);
      return $datetime1 - $datetime2;
    } );*/
      // usort($arg, function($a, $b) { return $b['date'] <=> $a['date']; });
      array_multisort(array_column($arg, 'date'), SORT_DESC, $arg);

      $this->Display_Pins($arg);
    } elseif ($type === 2) {

      usort($arg, function ($a, $b) {
        return $b['pin'] <=> $a['pin'];
      });

      $this->Display_Pins($arg);
    } else {
      $this->Display_Pins($arg);
    }
  }
  // puslapis Failai
  function Page_Files()
  { 
    $UPLOAD = new Upload();
    echo ' <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="file">
  <p class="w3-justify">
  <form  method="post" enctype="multipart/form-data">

 <input type="file" name="fileToUpload" id="fileToUpload">
  <button class="w3-btn w3-blue-grey" name="submit">Pateikti</button>
</form>
 </div>
' . $UPLOAD->Uploadfile();
  }
  // Puslapis užrašai
  function Page_Notes()
  {

    echo '<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="note">
  <p class="w3-justify">
  <form  method="post" enctype="multipart/form-data">
 <label>Pavadinimas:</label>
 <input type="text" name="name" class="w3-input w3-border" id="name">
 <label>Užrašas:</label>
 <textarea name="text" class="w3-input w3-border"  id="text"></textarea>
  
 <button class="w3-btn w3-blue-grey" name="submit2">Pateikt</button> 

</form>
 
' . $this->Add_note() . '
 
<br/><br/>



</div>';
  }
  

  function Page_Select(){

    switch ($_GET["psl"]) {
        case '':
  
  
          // if(!$a) return;
          $this->Sort_By(0);
          break;
        case 'sortbypin':
          $this->Sort_By(2);
          break;
        case 'sortbydate':
          $this->Sort_By(1);
          break;
        case 'delnote':
          $id = $_GET['id'];
          array_splice($_SESSION['notes'], $id, 1);
          header('Location: ../');
          break;
        case 'pinnote':
          $array = $_SESSION['notes'];
          $id = $_GET['id'];
  
          if ($array[$id]['pin']) {
            $array[$id]['pin'] = 0;
            $_SESSION['notes'] = $array;
            header('Location: ../');
          } else {
            $array[$id]['pin'] = 1;
            $_SESSION['notes'] = $array;
            header('Location: ../');
          }
          break;
        case 'files':
          $this->Page_Files();
          break;
        case 'notes':
          $this->Page_Notes();
          break;
        case 'reset':
          session_unset();
          header('Location: ../');
          break;
        default:
          # code...
          break;
      }
  }
}

?>