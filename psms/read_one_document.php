<?php
// get ID of the product to be read
$document_id = isset($_GET['document_id']) ? $_GET['document_id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/document.php';


 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$document = new document($db);

 
// set ID property of product to be read
$document->document_id = $document_id;
 
// read the details of product to be read
$document->readOne();
$page_title = "Read One Document";
include_once "layout_header.php";
 
// read products button
echo "<div class='right-button-margin'>";
    echo "<a href='view_documents.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Documents";
    echo "</a>";
echo "</div>";

// HTML table for displaying a product details
echo "<table class='table table-hover table-responsive table-bordered'>";
 
    echo "<tr>";
        echo "<td>Document Name</td>";
        echo "<td>{$document->document_name}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>Image</td>";
        echo "<td>{$document->image}</td>";
    echo "</tr>";
 
	
	    echo "<tr>";
        echo "<td>Uploaded At</td>";
        echo "<td>{$document->created}</td>";
    echo "</tr>";

	

 
echo "</table>";
 
// set footer
include_once "layout_footer.php";
?>