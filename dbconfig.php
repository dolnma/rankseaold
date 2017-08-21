<?php

function conn(){
    $link = mysqli_connect("localhost", "root", "usbw", "ranksea_db");
    return $link;
}

