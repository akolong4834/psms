<?php
// include database and object files
include_once 'config/database.php';
include_once 'objects/expense.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$expense = new expense($db);

$page_title = "Record Daily Expense";
include_once "layout_header.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Expenses</a>";
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
    $expense->station_name = $_POST['station_name'];
    $expense->amount= $_POST['amount'];
    $expense->description = $_POST['description'];

	$image=!empty($_FILES["image"]["name"])
        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
$expense->image = $image;
 
    // create the product
    if($expense->create()){
        echo "<div class='alert alert-success'>Expense Recorded.</div>";
		// try to upload the submitted file
// uploadPhoto() method will return an error message, if any.
echo $expense->uploadPhoto();
    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to record.</div>";
    }
}
?>
 
<!-- HTML form for creating a product -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Station Name</td>
            <td><input type='text' name='station_name' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Descrition</td>
            <td><input type='text' name='description' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Amount</td>
            <td><textarea name='amount' class='form-control'></textarea></td>
        </tr>
 
 
		<tr>
    <td>Upload receipt</td>
    <td><input type="file" name="image" /></td>
</tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
 
// footer
include_once "layout_footer.php";
?>