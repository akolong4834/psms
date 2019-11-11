<?php

// core.php holds pagination variables
include_once 'config/core.php';
// check if logged in as admin
include_once "login_checker.php"; 
// include database and object files
include_once 'config/database.php';
include_once 'objects/supplier.php';

 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
$supplier = new supplier($db);

 
$page_title = "View Suppliers";
include_once "layout_header.php";
echo "<div class='alert alert-success'>Search  supplier by  supplier name.</div>";
 
// query products
$stmt = $supplier->readAll($from_record_num, $records_per_page);
 
// specify the page where paging is used
$page_url = "view_suppliers.php?";
 
// count total rows - used for pagination
$total_rows=$supplier->countAll();
 
// read_template.php controls how the product list will be rendered
include_once "read_template_supplier.php";
 
// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>