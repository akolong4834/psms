<?php
class pump{
 
    // database connection and table name
    private $conn;
    private $table_name = "pump";
 
    // object properties
    public $pump_id;
    public $station_name;
    public $unit_price;
	public $product_name;
    public $timestamp;
	public $tank_capacity;
 
    public function __construct($db){
        $this->conn = $db;
    }
	
	    // used by select drop-down list
    function read(){
        //select all data
        $query = "SELECT
                    pump_id, station_name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    station_name";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
 
    // create product
    function create(){
 
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    station_name=:station_name, product_name=:product_name, unit_price=:unit_price,
                    tank_capacity=:tank_capacity, created=:created";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->station_name=htmlspecialchars(strip_tags($this->station_name));
        $this->product_name=htmlspecialchars(strip_tags($this->product_name));
        $this->unit_price=htmlspecialchars(strip_tags($this->unit_price));
		$this->tank_capacity=htmlspecialchars(strip_tags($this->tank_capacity));

        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');
 
        // bind values 
  
        $stmt->bindParam(":unit_price", $this->unit_price);
        $stmt->bindParam(":station_name", $this->station_name);
        $stmt->bindParam(":product_name", $this->product_name);
	    $stmt->bindParam(":tank_capacity", $this->tank_capacity);
        $stmt->bindParam(":created", $this->timestamp);
	
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
	
	function readAll($from_record_num, $records_per_page){
 
    $query = "SELECT
                pump_id, station_name, product_name, unit_price,  tank_capacity, created
            FROM
                " . $this->table_name . "
            ORDER BY
                created ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
}

// used for paging products
public function countAll(){
 
    $query = "SELECT pump_id FROM " . $this->table_name . "";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    $num = $stmt->rowCount();
 
    return $num;
}
function readOne(){
 
    $query = "SELECT
                 station_name, product_name, unit_price,  tank_capacity, created
            FROM
                " . $this->table_name . "
            WHERE
                pump_id = ?
            LIMIT
                0,1";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->pump_id);
    $stmt->execute();
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    $this->station_name = $row['station_name'];
    $this->product_name = $row['product_name'];
    $this->unit_price = $row['unit_price'];
    $this->tank_capacity = $row['tank_capacity'];
	
	  	  $this->created = $row['created'];
}

function update(){
 
    $query = "UPDATE
                " . $this->table_name . "
            SET
                station_name = :station_name,
                product_name = :product_name,
                unit_price = :unit_price,
				tank_capacity = :tank_capacity
			    

            WHERE
                pump_id = :pump_id";
 
    $stmt = $this->conn->prepare($query);
 
    // posted values
    $this->station_name=htmlspecialchars(strip_tags($this->station_name));
    $this->product_name=htmlspecialchars(strip_tags($this->product_name));
    $this->unit_price=htmlspecialchars(strip_tags($this->unit_price));
    $this->tank_capacity=htmlspecialchars(strip_tags($this->tank_capacity));
    $this->pump_id=htmlspecialchars(strip_tags($this->pump_id));
 
    // bind parameters
    $stmt->bindParam(':station_name', $this->station_name);
    $stmt->bindParam(':product_name', $this->product_name);
    $stmt->bindParam(':unit_price', $this->unit_price);
    $stmt->bindParam(':tank_capacity', $this->tank_capacity);
    $stmt->bindParam(':pump_id', $this->pump_id);

 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}



// delete the product
function delete(){
 
    $query = "DELETE FROM " . $this->table_name . " WHERE sale_id = ?";
     
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->sale_id);
 
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}

// read products by search term
public function search($search_term, $from_record_num, $records_per_page){
 
    // select query
    $query = "SELECT
                sale_id, sreading, creading, difference, product_name, cash, created
            FROM
                " . $this->table_name . " 
            WHERE
                sreading LIKE ? OR creading LIKE ?
            ORDER BY
                created DESC
            LIMIT
                ?, ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind variable values
    $search_term = "%{$search_term}%";
    $stmt->bindParam(1, $search_term);
    $stmt->bindParam(2, $search_term);
    $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);
 
    // execute query
    $stmt->execute();
 
    // return values from database
    return $stmt;
}
 
public function countAll_BySearch($search_term){
 
    // select query
    $query = "SELECT
                COUNT(*) as total_rows
            FROM
                " . $this->table_name . " 
            WHERE
                creading LIKE ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind variable values
    $search_term = "%{$search_term}%";
    $stmt->bindParam(1, $search_term);
 
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    return $row['total_rows'];
}



}
?>