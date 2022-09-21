<?php
class Core
{
  // klaidų rodymas
  function Error($head, $body)
  {
    echo '<div class="w3-panel w3-red">
      <h3>' . $head . '</h3>
      <p>' . $body . '</p>
    </div> ';
  }
  // Ikelimo funkcija pgr
  function Uploadfunc($name, $target_file)
  {
    if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
      echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    } else {
      $this->Error('Klaida!', 'kažkas ne taip, ikelti nepavyko!');
    }
  }
  //nuotraukos header'is su tekstu presset'as
  function he()
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
  // skaito validuoja JSON
  function read_valid_json($file)
  {

    // Read the JSON file 
    $json = file_get_contents($file);

    // Decode the JSON file
    $json_data = json_decode($json, true);
    if (!array_key_exists('first_name', $json_data[0])) return false;
    // Display data

    return $json_data;
  }
  //Skaito Validuoja XML | NEPAVYKO
  function read_valid_xml($file)
  {
    $xml = simplexml_load_file($file);

    $array = array();
    $list = $xml->item;
    //var_dump($xml);
    $on = true;
    for ($i = 0; $i < count($list); $i++) {
      if (!isset($list[$i]->first_name)) return $array = false;
      $array[$i] = array($list[$i]->first_name, $list[$i]->age, $list[$i]->gender);
    }
    return $array;
  }
  // Skaito validuoja csv
  function read_valid_csv($file)
  {
    $csv = array();
    $lines = file($file, FILE_IGNORE_NEW_LINES);

    foreach ($lines as $key => $value) {
      $csv[$key] = str_getcsv($value);
    }
    $hdr = $csv[0];
    if ($hdr[0] != 'first_name' || $hdr[1] != 'age' || $hdr[2] != 'gender') return false;
    return $csv;
  }
  // failo ikelimas
  function Uploadfile()
  {
    include 'config.php';
    $target_dir = "f/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
      $uploadOk = 0;
      if (!in_array($imageFileType, $formatai)) $this->Error('Klaida!', 'Netinkamas formatas!');
      /*if (file_exists($target_file)) {
        $this->Error('Klaida!', 'Failas jau egzistuoja');
        $uploadOk = 0;
      }*/ 
 
      if ($imageFileType === 'json') {
        $uploadOk = 1;
        $this->Uploadfunc("fileToUpload", $target_file);
        $json = $this->read_valid_json($target_file);
        $this->Create_table($json, 0, $imageFileType);
      }
      if ($imageFileType === 'csv') {
        $uploadOk = 1;
        $this->Uploadfunc("fileToUpload", $target_file);
        $json = $this->read_valid_csv($target_file);
        $this->Create_table($json, 1, $imageFileType);
      }
    }
  }
  // kuriam lentele
  function Create_table($array, $start_index, $type)
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
  function Add_note()
  {

    if (isset($_POST["submit2"])) {
      $name = $_POST['name'];
      $note = $_POST['text'];
      $ar = array(
        array('name' => $name, 'note' => $note, 'pin' => 0, 'date' => date("Y-m-d h:i:s")),
      );
      if (empty($name) || empty($note)) return $this->Error('Klaida!', 'Laukeliai negali būti tušti!');
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
  // nenaudojama
  function date_compare($element1, $element2)
  {
    $datetime1 = strtotime($element1['datetime']);
    $datetime2 = strtotime($element2['datetime']);
    return $datetime1 - $datetime2;
  }
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
    echo ' <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="file">
  <p class="w3-justify">
  <form  method="post" enctype="multipart/form-data">

 <input type="file" name="fileToUpload" id="fileToUpload">
  <button class="w3-btn w3-blue-grey" name="submit">Pateikti</button>
</form>
 </div>
' . $this->Uploadfile();
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
}
?>