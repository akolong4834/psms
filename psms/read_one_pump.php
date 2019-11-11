<?php
// get ID of the product to be read
$pump_id = isset($_GET['pump_id']) ? $_GET['pump_id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/pump.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$pump = new pump($db);

 
// set ID property of product to be read
$pump->pump_id = $pump_id;
 
// read the details of product to be read
$pump->readOne();
$page_title = "Read One Pump";
include_once "layout_header.php";
 
// read products button
echo "<div class='right-button-margin'>";
    echo "<a href='view_pumps.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Pumps";
    echo "</a>";
echo "</div>";

// HTML table for displaying a product details
echo "<table class='table table-hover table-responsive table-bordered'>";
 
    echo "<tr>";
        echo "<td>Pump ID</td>";
        echo "<td>{$pump->pump_id}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>Station name</td>";
        echo "<td>{$pump->station_name}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>Product Name</td>";
        echo "<td>{$pump->product_name}</td>";
    echo "</tr>";
	
	    echo "<tr>";
        echo "<td>Unit Price</td>";
        echo "<td>{$pump->unit_price}</td>";
    echo "</tr>";
	
	    echo "<tr>";
        echo "<td>Tank Capacity</td>";
        echo "<td>{$pump->tank_capacity}</td>";
    echo "</tr>";
 

	

 
echo "</table>";
 
// set footer
include_once "layout_footer.php";
?>