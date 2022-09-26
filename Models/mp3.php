<?php

class mp3
{

    function Read_Valid($file){

        $Page = new Page();

        $Page->Load_mp3($file);
    }
}

?>