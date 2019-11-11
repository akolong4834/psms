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
    echo "<a href='create_sale.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Record Pump";
    echo "</a>";
echo "</div>";
echo "<br>";
echo "<br>";
 
// display the products if there are any
if($total_rows>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
		    echo "<th>Pump Id</th>";
            echo "<th>Station Name</th>";
            echo "<th>Pump Product</th>";
            echo "<th>Unit price</th>";
            echo "<th>Tank Capacity</th>";
            echo "<th>Actions</th>";
        echo "</tr>";
 
        while ($row_pump = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row_pump);
 
            echo "<tr>";
                echo "<td>{$pump_id}</td>";
                echo "<td>{$station_name}</td>";
                echo "<td>{$product_name}</td>";
                echo "<td>{$unit_price}</td>";
                echo "<td>{$tank_capacity}</td>";
                echo "<td>";
 
                    // read product button
                    echo "<a href='read_one_pump.php?pump_id={$pump_id}' class='btn btn-primary left-margin'>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read";
                    echo "</a>";
 
                    // edit product button
                    echo "<a href='update_pump.php?pump_id={$pump_id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a>";
 
                    // delete product button
                    echo "<a delete-id='{$pump_id}' class='btn btn-danger delete-object'>";
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