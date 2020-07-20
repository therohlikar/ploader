<?php

if(file_exists("files/".$_GET['file'])){
    unlink("files/".$_GET['file']);

    header("Location: index.php");
}
