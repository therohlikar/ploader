<?php
if(file_exists("files/".$_GET['path'])){
    header("Content-Disposition: attachment; filename=".basename($_GET['path']));
    header("Content-Transfer-Encoding: quoted_printable");
    header('Pragma: no-cache');
    header('Expires: 0');
    
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    
    header('Content-Transfer-Encoding: binary');
    header("Content-type: application/force-download");
    header('Content-Type: application/octet-stream');
    
    readfile("files/".$_GET["path"]);
}
