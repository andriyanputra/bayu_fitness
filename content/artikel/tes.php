<?php
if(isset($_POST['simpan'])){
    $ffmpeg = "C:\\ffmpeg\\bin\\ffmpeg";
    $vFile = $_FILES['file']['tmp_name'];
    $imgFile = "1.jpg";
    $size = "120x90";
    $getFromSecond = 5;
    echo $ffmpeg."-i". $vFile." -an -ss". $getFromSecond." -s". $size."". $imgFile;
    //echo $vFile;
    /*if(shell_exec($cmd)){
    	echo "Thumbnail created";
    }else{
    	echo "Error Creating Thumbnail";
    }*/
}
?>