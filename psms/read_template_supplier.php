<?php
// search form
echo "<form role='search' action='search_pump.php'>";
    echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Type product name or pump reading...' name='s' id='srch-term' required {$search_value} />";
        echo "<div class='input-group-btn'>";
            echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
        echo "</div>";
    echo "</div>";
echo "</form>";
 
// create product button
echo "<div class='right-button-margin'>";
    echo "<a href='create_supplier.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Record Supplier";
    echo "</a>";
echo "</div>";
echo "<br>";
echo "<br>";
 
// display the products if there are any
if($total_rows>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
		    echo "<th>Supplier Name</th>";
            echo "<th>Phone</th>";
            echo "<th>Contact Person</th>";

            echo "<th>Actions</th>";
        echo "</tr>";
 
        while ($row_supplier = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row_supplier);
 
            echo "<tr>";
                echo "<td>{$supplier_name}</td>";
                echo "<td>{$phone}</td>";
                echo "<td>{$representative}</td>";

                echo "<td>";
 
                    // read product button
                    echo "<a href='read_one_supplier.php?supplier_id={$supplier_id}' class='btn btn-primary left-margin'>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read";
                    echo "</a>";
 
                    // edit product button
                    echo "<a href='update_supplier.php?supplier_id={$supplier_id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a>";
 
                    // delete product button
                    echo "<a delete-id='{$supplier_id}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                    echo "</a>";
 
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
    // paging buttons
    include_once 'paging.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No sales found.</div>";
}
?>