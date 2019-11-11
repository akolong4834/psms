<?php

// core.php holds pagination variables
include_once 'config/core.php';
// check if logged in as admin
include_once "login_checker.php"; 
// include database and object files
include_once 'config/database.php';
include_once 'objects/sale.php';

 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
$sale = new sale($db);

 
$page_title = "View Sales";
include_once "layout_header.php";
echo "<div class='alert alert-success'>Search  sale by  station name, pump reading.</div>";
 
// query products
$stmt = $sale->readAll($from_record_num, $records_per_page);
 
// specify the page where paging is used
$page_url = "view_sales.php?";
 
// count total rows - used for pagination
$total_rows=$sale->countAll();
 
// read_template.php controls how the product list will be rendered
include_once "read_template_sale.php";
 
// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>