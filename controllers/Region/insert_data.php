<?php 
    include_once dirname(__DIR__) . '../../app.php';
    use Models\Region;
    Region::setConn($conn);
    $_METHOD = $_SERVER["REQUEST_METHOD"];
    $_DATA = ($_METHOD=="POST" && count($_FILES)) ? array_merge($_POST,$_FILES): json_decode(file_get_contents("php://input"), true);
    $objCountry =new Region();
    echo json_encode($objCountry->saveData($_DATA)); 
?>