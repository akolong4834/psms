<?php
// include database and object files
include_once 'config/database.php';
include_once 'objects/sale.php';
include_once 'objects/category.php';
 include_once 'objects/product.php';
  include_once 'objects/pump.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$sale = new sale($db);
$product = new product($db);
$category = new Category($db);
$pump = new pump($db);
$page_title = "Create Sale";
include_once "layout_header.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='view_sales.php' class='btn btn-primary pull-right'>Back To Sales</a>";
echo "</div>";


 
?>

<!-- 'create sale' html form will be here -->
<!-- PHP post code will be here -->
<?php 
// if the form was submitted -
if($_POST){
 
    // set sale property values
    $sale->sreading = $_POST['sreading'];
    $sale->creading = $_POST['creading'];
	$sale->difference = $_POST['difference'];
    $sale->product_name = $_POST['product_name'];
    $sale->pump_id = $_POST['pump_id'];
	    $sale->cash= $_POST['cash'];
 
    // create the product
    if($sale->create()){
        echo "<div class='alert alert-success'>Product was created.</div>";

    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create product.</div>";
    }
}
?>
 
<!-- HTML form for creating a product -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Start Pump Reading</td>
            <td><input type='text' name='sreading' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Closing Pump Reading</td>
            <td><input type='text' name='creading' class='form-control' /></td>
        </tr>
		        <tr>
            <td>Difference</td>
            <td><input type='text' name='difference' class='form-control' /></td>
        </tr>
		        <tr>
            <td>Product Name</td>
            <td><input type='text' name='product_name' class='form-control' /></td>
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
            <td>Tota Cash</td>
            <td><input type='text' name='cash' class='form-control' /></td>
        </tr>

 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Record</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
 
// footer
include_once "layout_footer.php";
?>