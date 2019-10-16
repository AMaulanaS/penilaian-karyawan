<?php
$a = array(1,5,6,7,2);
$b = array(2,4,3,6,8);

foreach ($a as $key=>$x){
    $temp[] = $x * $b[$key];
}
print_r($temp);
?>