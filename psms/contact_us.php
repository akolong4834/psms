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
$page_title = "Contact Us Today";
include_once "layout_header.php";
 



 
?>

<?php
 
// footer
include_once "layout_footer.php";
?>