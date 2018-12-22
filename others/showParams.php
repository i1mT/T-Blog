<?php

header("Content-Type: text/html; charset=UTF-8");
error_reporting(0);

$default_p_before = "<p style='font-size:18px'>";
$default_p_after = "</p>";

if(count($_POST) > 0){
    //POST方法
    echo $default_p_before . "POST:" . $default_p_after;
    foreach($_POST as $key => $val) {
        if(is_array($val)) {
            $str = "";
            $mark = 0;
            foreach($val as $s) {
                if($mark == 0){
                    $str .= $s;
                    $mark = 1;
                } else {
                    $str .= ", " . $s;
                }
            }
            $val = $str;
        }
        echo "<p>" . $key . ": " . $val . "</p>";
    }
} else if(count($_GET) > 0) {
    //GET方法
    echo $default_p_before . "GET:" . $default_p_after;
    foreach($_GET as $key => $val) {
        if(is_array($val)) {
            $str = "";
            $mark = 0;
            foreach($val as $s) {
                if($mark == 0){
                    $str .= $s;
                    $mark = 1;
                } else {
                    $str .= ", " . $s;
                }
            }
            $val = $str;
        }
        echo "<p>" . $key . ": " . $val . "</p>";
    }
} else {
    //既不是POST 也不是GET
    echo "<p style='font-size:18px;color: red'>" . "既不是POST，也不是GET，或参数为空。" . "</p>";
}
?>