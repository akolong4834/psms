<?php
// get ID of the product to be edited
$sale_id = isset($_GET['sale_id']) ? $_GET['sale_id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/sale.php';
include_once 'objects/pump.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$sale = new sale($db);
$pump = new pump($db);
 
// set ID property of product to be edited
$sale->sale_id = $sale_id;
 
// read the details of product to be edited
$sale->readOne();
 
 // set page header
$page_title = "Update Sale";
include_once "layout_header.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='view_sales.php' class='btn btn-primary pull-right'>View Sales</a>";
echo "</div>";
echo "<br>";
?>

<!-- 'update product' form will be here -->
<!-- post code will be here -->
<?php 
// if the form was submitted
if($_POST){
 
    // set product property values
    $sale->sreading = $_POST['sreading'];
    $sale->creading = $_POST['creading'];
    $sale->product_name = $_POST['product_name'];
	$sale->difference = $_POST['difference'];
    $sale->cash = $_POST['cash'];
	    $sale->pump_id = $_POST['pump_id'];
    // update the product
    if($sale->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Sale was updated.";
        echo "</div>";
    }
 
    // if unable to update the product, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update sale.";
        echo "</div>";
    }
}
?>
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?sale_id={$sale_id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Start Pump Reading</td>
            <td><input type='text' name='sreading' value='<?php echo $sale->sreading; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Closing Pump Reading</td>
            <td><input type='text' name='creading' value='<?php echo $sale->creading; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Ltrs Sold</td>
            <td><input type='text' name='difference' value='<?php echo $sale->difference; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Product Name</td>
            <td><input type='text' name='product_name' value='<?php echo $sale->product_name; ?>' class='form-control' /></td>
        </tr>
		        <tr>
            <td>Pump ID</td>
            <td>
            <!-- categories from database will be here -->
			<?php
// read the product categories from the database
$stmt = $pump->read();
 
// put them in a select drop-down
echo "<select class='form-control' name='pump_id'>";
    echo "<option>Select category...</option>";
 
    while ($row_pump = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row_pump);
        echo "<option value='{$pump_id}'>{$station_name}</option>";
    }
 
echo "</select>";
?>
            </td>
        </tr>
		 <tr>
            <td>Total Cash</td>
            <td><input type='text' name='cash' value='<?php echo $sale->cash; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update Sale</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
 

 
// set page footer
include_once "layout_footer.php";
?>