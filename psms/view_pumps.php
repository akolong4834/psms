<?php
// core.php holds pagination variables
include_once 'config/core.php';
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/pump.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
$pump = new pump($db);

 
$page_title = "Read Pumps";
include_once "layout_header.php";
 echo "<div class='alert alert-success'>Search pump by  station name.</div>";
// query products
$stmt = $pump->readAll($from_record_num, $records_per_page);
 
// specify the page where paging is used
$page_url = "view_pumps.php?";
 
// count total rows - used for pagination
$total_rows=$pump->countAll();
 
// read_template.php controls how the product list will be rendered
include_once "read_template_pump.php";
 
// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>