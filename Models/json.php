<?php 
require_once 'index.php';

class json
{

      // skaito validuoja JSON
  function Read_Valid($file)
  { 
    $Page = new Page();
    // Read the JSON file 
    $json = file_get_contents($file);

    // Decode the JSON file
    $json_data = json_decode($json, true);
    if (!array_key_exists('first_name', $json_data[0])) return false;
    // Display data

   
    $Page->Create_table($json_data, 0, 'json');
  } 

}

?>