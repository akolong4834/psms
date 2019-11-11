<?php
// core.php holds pagination variables
include_once 'config/core.php';
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/category.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
$category = new Category($db);
 
$page_title = "Introducing Petrol Station Management System v1";
include_once "layout_header.php";

?>

<div class="row">

 

<div class="col-md-2 ">

<a  href="reports.php"><i class="fa fa-pie-chart" style="font-size:60px;color:red"></i><br>
Reports</a>

</div>

<div class="col-md-2">
<a  href="view_sales.php"><i class="fa fa-money" style="font-size:60px;color:red"></i><br>
Sales</a>
</div>
<div class="col-md-2">
<a  href="view_products.php"><i class="fas fa-fire" style="font-size:60px;color:red"></i><br>
Products</a>
</div>

<div class="col-md-2">
<a  href="view_pumps.php"><i class="fas fa-door-closed" style="font-size:60px;color:red"></i><br>
Pumps</a>
</div>
<div class="col-md-2">
<a  href="view_users.php"><i class="fas fa-address-book" style="font-size:60px;color:red"></i><br>
Users</a>
</div>
<div class="col-md-2">
<a  href="view_documents.php"><i class="fas fa-address-book" style="font-size:60px;color:red"></i><br>
Documents</a>
</div>
</div>
<div class="chart-container" style="position: relative; height:40vh; width:80vw">
<canvas id="myChart" width="400" height="400"></canvas>
</div>
<br>
<br>
<br>
<br>
<br>
<br>

 

<?php 
// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>