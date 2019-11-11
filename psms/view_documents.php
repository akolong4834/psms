<?php
// core.php holds pagination variables
include_once 'config/core.php';
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/document.php';

 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
$document = new document($db);

 
$page_title = "Document Repository";
include_once "layout_header.php";
 
// query products
$stmt = $document->readAll($from_record_num, $records_per_page);
 
// specify the page where paging is used
$page_url = "view_documents.php?";
 
// count total rows - used for pagination
$total_rows=$document->countAll();
 
// read_template.php controls how the product list will be rendered
include_once "read_template_document.php";
 
// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>