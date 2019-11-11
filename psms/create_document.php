<?php
// check if logged in as admin
include_once "login_checker.php";
// include database and object files
include_once 'config/database.php';
include_once 'objects/document.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$document = new document($db);

$page_title = "upload Scanned Document";
include_once "layout_header.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='view_documents.php' class='btn btn-default pull-right'>Documents Repository</a>";
echo "</div>";


 
?>

<!-- PHP post code will be here -->
<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
 
    // set product property values
    $document->document_name = $_POST['document_name'];

	$image=!empty($_FILES["image"]["name"])
        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
$document->image = $image;
 
    // create the product
    if($document->create()){
        echo "<div class='alert alert-success'>Document Uploaded successfully.</div>";
		// try to upload the submitted file
// uploadPhoto() method will return an error message, if any.
echo $document->uploadPhoto();
    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to Upload.</div>";
    }
}
?>
 
<!-- HTML form for creating a product -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Document Name</td>
            <td><input type='text' name='document_name' class='form-control' /></td>
        </tr>

		<tr>
    <td>Upload Document</td>
    <td><input type="file" name="image" /></td>
</tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Upload</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
 
// footer
include_once "layout_footer.php";
?>