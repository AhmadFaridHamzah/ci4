<?php

function generateBil($start){
    static $number=0;
    $number++;

    return ($number+$start);

}

?>