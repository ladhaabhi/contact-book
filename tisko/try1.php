<?php
$dob = "12/23/2011";
$yy = substr($dob, 6, 4);
    $mm = substr($dob, 0, 2);
    $dd = substr($dob, 3, 2);

    $date = $yy."-".$mm."-".$dd;
   $to_array = array();
    $to_array = split(';',"");
    
    var_dump($to_array);
    
    foreach ($to_array as $value) {
echo $value." sdf";    
}
       
?>
