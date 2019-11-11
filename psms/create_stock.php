<?php
// include database and object files
include_once 'config/database.php';
include_once 'objects/stock.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$stock = new stock($db);

$page_title = "Record Stock delivery";
include_once "layout_header.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='' class='btn btn-default pull-right'>Delivery List</a>";
echo "</div>";
echo "<br>";
echo "<br>";


 
?>

<!-- 'create product' html form will be here -->
<!-- PHP post code will be here -->
<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
 
    // set product property values
    $stock->supplier_name = $_POST['supplier_name'];
    $stock->stock_amount= $_POST['stock_amount'];
    $stock->vehicle_no = $_POST['vehicle_no'];
  $stock->station_name = $_POST['station_name'];
    $stock->pump_id= $_POST['pump_id'];
    $stock->phone = $_POST['phone'];


 
    // create the product
    if($stock->create()){
        echo "<div class='alert alert-success'>Delivery Recorded.</div>";

    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to record.</div>";
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
            <td>Vehicle Registration</td>
             <td><input type='text' name='vehicle_no' class='form-control' /></td>
        </tr>
         <tr>
            <td>Stock Amount</td>
           <td><input type='text' name='stock_amount' class='form-control' /></td>
        </tr>
		        <tr>
            <td>Pump id</td>
          <td><input type='text' name='pump_id' class='form-control' /></td>
        </tr>
		        <tr>
            <td>Station Name</td>
             <td><input type='text' name='station_name' class='form-control' /></td>
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