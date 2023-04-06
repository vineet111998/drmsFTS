<?php

function t($arr, $exit = 0) {
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    if ($exit) {
        die("Content Ends Here !");
    }
}

function p($exit=1){
    // Shows all form data sent using POST
    t($_POST,$exit);
}

