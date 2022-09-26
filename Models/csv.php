<?php
require_once 'index.php';

class csv
{
  // Skaito validuoja csv
  function Read_Valid($file)
  { 
    $Page = new Page();
    $csv = array();
    $lines = file($file, FILE_IGNORE_NEW_LINES);

    foreach ($lines as $key => $value) {
      $csv[$key] = str_getcsv($value);
    }
    $hdr = $csv[0];
    if ($hdr[0] != 'first_name' || $hdr[1] != 'age' || $hdr[2] != 'gender') return false;
    //return $csv;
    
    $Page->Create_table($csv, 1, 'csv');
  }


}
?>