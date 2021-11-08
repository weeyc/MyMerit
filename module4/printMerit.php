<?php

header('content-type:image/jpeg');
$font=realpath('Arial.ttf');
$image=imagecreatefromjpeg("cert.jpg");
$color=imagecolorallocate($image,5,93,171);




$id = $_GET['sID'];
$name = $_GET['sName'];
$Merit = $_GET['totalMerit']; 
$sem = $_GET['sem'];

/*
$id ="Cb18068";
$name = "Wee Yuu Cheng";
$Merit ="999"; 
*/

imagettftext($image, 18, 0, 450, 380, $color, $font, $name);
imagettftext($image, 18, 0, 475, 420, $color, $font, $id);
imagettftext($image, 17, 0, 867, 496, $color, $font, $Merit);
imagettftext($image, 18, 0, 460, 650, $color, $font, $sem);


imagejpeg($image);
imagedestoy($image);  


?>

