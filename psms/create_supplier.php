<?php
// include database and object files
include_once 'config/database.php';
include_once 'objects/supplier.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$supplier = new supplier($db);

$page_title = "Record Supplier";
include_once "layout_header.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='view_suppliers.php' class='btn btn-primary pull-right'>Suppler List</a>";
echo "</div>";


 
?>

<!-- 'create sale' html form will be here -->
<!-- PHP post code will be here -->
<?php 
// if the form was submitted -
if($_POST){
 
    // set sale property values
    $supplier->supplier_name = $_POST['supplier_name'];
    $supplier->phone = $_POST['phone'];
	$supplier->representative = $_POST['representative'];

 
    // create the product
    if($supplier->create()){
        echo "<div class='alert alert-success'>Supplier was Recoreded.</div>";

    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create record.</div>";
    }
}
?>
 
<!-- HTML form for creating a product -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Supplier Name</td>
            <td><input type='text' name='supplier_name' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Phone</td>
            <td><input type='text' name='phone' class='form-control' /></td>
        </tr>
		        <tr>
            <td>Representative</td>
            <td><input type='text' name='representative' class='form-control' /></td>
        </tr>


 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Record Supplier</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
 
// footer
include_once "layout_footer.php";
?>