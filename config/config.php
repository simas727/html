<?php
 spl_autoload_register(function ($class_name) {
    include '../models/'.$class_name . '.php';
});
$formatai = array('json'=>json::class,'csv'=>csv::class,'mp3'=>mp3::class,'jpg'=>jpg::class);
     
?>