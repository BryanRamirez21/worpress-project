<?php

    $name = "nigga";

    echo "<p> hello $name </p>";
    echo bloginfo('name');
    echo "<br>";
    echo bloginfo('description');
    echo "<br>";

    $arr = array("one","two","three","four");
    $count = 0;
    while($count < count($arr)){
        echo "$arr[$count] ";
        $count++;
    }
    echo "<br>";
    foreach($arr as $element){
        echo "$element ";
    }
?>