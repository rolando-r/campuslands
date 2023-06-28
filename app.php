<?php 
    require_once 'vendor/autoload.php';
    use Clases\Database;
    $db = new Database();
    $conn = $db->getConnection('mysql');
?>