<?php 
    include_once '../../app.php';
    use Models\Country;  
    $objCountry =new Country();
    echo json_encode($objCountry->loadAllData()); 
?>