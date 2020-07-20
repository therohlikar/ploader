<?php

$targetDir = "files/";
$file = $targetDir . basename($_FILES['file']['name']);
if(file_exists($file)){
    echo json_encode(array("msg"=>"exists"));
}else{
    if(move_uploaded_file($_FILES['file']['tmp_name'], $file)){
        echo json_encode(array("msg"=>"success"));
    }else{
        echo json_encode(array("msg"=>"error"));
    }
}