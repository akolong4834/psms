<?php
// get ID of the product to be read
$sale_id = isset($_GET['sale_id']) ? $_GET['sale_id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/sale.php';


 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$sale = new sale($db);

 
// set ID property of product to be read
$sale->sale_id = $sale_id;
 
// read the details of product to be read
$sale->readOne();
$page_title = "Read One Sale";
include_once "layout_header.php";
 
// read products button
echo "<div class='right-button-margin'>";
    echo "<a href='view_sales.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Sale";
    echo "</a>";
echo "</div>";

// HTML table for displaying a product details
echo "<table class='table table-hover table-responsive table-bordered'>";
 
    echo "<tr>";
        echo "<td>Start Pump Reading</td>";
        echo "<td>{$sale->sreading}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>Closing Pump reading</td>";
        echo "<td>{$sale->creading}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>Litres Sold</td>";
        echo "<td>{$sale->difference}</td>";
    echo "</tr>";
	
	    echo "<tr>";
        echo "<td>Product Name</td>";
        echo "<td>{$sale->product_name}</td>";
    echo "</tr>";
	
	    echo "<tr>";
        echo "<td>Total Cash</td>";
        echo "<td>{$sale->cash}</td>";
    echo "</tr>";
	
	    echo "<tr>";
        echo "<td>Recorded At</td>";
        echo "<td>{$sale->created}</td>";
    echo "</tr>";

	

 
echo "</table>";
 
// set footer
include_once "layout_footer.php";
?>