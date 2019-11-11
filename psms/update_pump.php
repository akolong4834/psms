<?php
// get ID of the product to be edited
$pump_id = isset($_GET['pump_id']) ? $_GET['pump_id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/pump.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$pump = new pump($db);

 
// set ID property of product to be edited
$pump->pump_id = $pump_id;
 
// read the details of product to be edited
$pump->readOne();
 
 // set page header
$page_title = "Update Sale";
include_once "layout_header.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='view_pumps.php' class='btn btn-primary pull-right'>View Pumps</a>";
echo "</div>";
echo "<br>";
?>

<!-- 'update product' form will be here -->
<!-- post code will be here -->
<?php 
// if the form was submitted
if($_POST){
 
    // set product property values
    $pump->station_name = $_POST['station_name'];
	    $pump->product_name = $_POST['product_name'];
		    $pump->unit_price = $_POST['unit_price'];
			    $pump->tank_capacity = $_POST['tank_capacity'];

    // update the product
    if($pump->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Sale was updated.";
        echo "</div>";
    }
 
    // if unable to update the product, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update Pump.";
        echo "</div>";
    }
}
?>
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?pump_id={$pump_id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Station Name</td>
            <td><input type='text' name='station_name' value='<?php echo $pump->station_name; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Product Name</td>
            <td><input type='text' name='product_name' value='<?php echo $pump->product_name; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Unit price</td>
            <td><input type='text' name='unit_price' value='<?php echo $pump->unit_price; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Tank Capacity</td>
            <td><input type='text' name='tank_capacity' value='<?php echo $pump->tank_capacity; ?>' class='form-control' /></td>
        </tr>

 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update Pump</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
 

 
// set page footer
include_once "layout_footer.php";
?>