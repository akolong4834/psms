<?php
// include database and object files
include_once 'config/database.php';
include_once 'objects/pump.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$pump = new pump($db);

$page_title = "Record Dispenser / Fuel Pump";
include_once "layout_header.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='view_pumps.php' class='btn btn-primary pull-right'>Back To pumps</a>";
echo "</div>";


 
?>

<!-- 'create sale' html form will be here -->
<!-- PHP post code will be here -->
<?php 
// if the form was submitted -
if($_POST){
 
    // set sale property values
    $pump->product_name = $_POST['product_name'];
    $pump->unit_price = $_POST['unit_price'];
	$pump->station_name = $_POST['station_name'];

 
    // create the product
    if($pump->create()){
        echo "<div class='alert alert-success'>Pump was created.</div>";

    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create pump.</div>";
    }
}
?>
 
<!-- HTML form for creating a product -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Product Sold</td>
            <td><input type='text' name='product_name' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Unit Price</td>
            <td><input type='text' name='unit_price' class='form-control' /></td>
        </tr>
		        <tr>
            <td>Station Name</td>
            <td><input type='text' name='station_name' class='form-control' /></td>
        </tr>


 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Record Pump</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
 
// footer
include_once "layout_footer.php";
?>