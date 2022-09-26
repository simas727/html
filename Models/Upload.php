<?php 
require_once 'index.php';


class UPLOAD{
    
     // Ikelimo funkcija pgr
  function Uploadfunc($name, $target_file)
  {
    $Page = new PAGE();
    if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
      echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    } else {
        $Page->Show_Error('Klaida!', 'kažkas ne taip, ikelti nepavyko!');
    }
  }
 
 
  // failo ikelimas
  function Uploadfile()
  {
    require_once '../config/config.php';
    $target_dir = ",,.public/f/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $Page = new PAGE();
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
      $uploadOk = 0;
      if (!in_array($imageFileType, $formatai)) $Page->Show_Error('Klaida!', 'Netinkamas formatas!');
      $this->Uploadfunc("fileToUpload", $target_file);
       $Type_Exec = new $formatai[$imageFileType];
       $Type_Exec->Read_Valid();
     
      /*if (file_exists($target_file)) {
        $this->Error('Klaida!', 'Failas jau egzistuoja');
        $uploadOk = 0;
      }*/ 
 
      
    }
  }
}

?>