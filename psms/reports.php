<?php
// core.php holds pagination variables
include_once 'config/core.php';
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/category.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
$category = new Category($db);
 
$page_title = "Petrol Station Management System";
include_once "layout_header.php";
?>

<canvas id="myChart" width="400" height="400"></canvas>

 

<?php 
// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>


