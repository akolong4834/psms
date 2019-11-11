<?php
class sale{
 
    // database connection and table name
    private $conn;
    private $table_name = "sale";
 
    // object properties
    public $sale_id;
    public $sreading;
    public $creading;
    public $difference;
    public $product_name;
    public $cash;
	    public $pump_id;
    public $timestamp;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // create product
    function create(){
 
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    sreading=:sreading, pump_id=:pump_id, creading=:creading, difference=:difference, cash=:cash, product_name=:product_name, created=:created";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->sreading=htmlspecialchars(strip_tags($this->sreading));
        $this->creading=htmlspecialchars(strip_tags($this->creading));
        $this->difference=htmlspecialchars(strip_tags($this->difference));
        $this->product_name=htmlspecialchars(strip_tags($this->product_name));
         $this->cash=htmlspecialchars(strip_tags($this->cash));
		          $this->pump_id=htmlspecialchars(strip_tags($this->pump_id));
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');
 
        // bind values 
        $stmt->bindParam(":sreading", $this->sreading);
        $stmt->bindParam(":creading", $this->creading);
        $stmt->bindParam(":difference", $this->difference);
        $stmt->bindParam(":product_name", $this->product_name);
        $stmt->bindParam(":created", $this->timestamp);
		 $stmt->bindParam(":cash", $this->cash);
		 		 $stmt->bindParam(":pump_id", $this->pump_id);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
	
	function readAll($from_record_num, $records_per_page){
 
    $query = "SELECT
                sale_id, sreading, creading, difference, pump_id, product_name,  cash,   created
            FROM
                " . $this->table_name . "
            ORDER BY
                created DESC
            LIMIT
                {$from_record_num}, {$records_per_page}";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
}

// used for paging products
public function countAll(){
 
    $query = "SELECT sale_id FROM " . $this->table_name . "";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    $num = $stmt->rowCount();
 
    return $num;
}
function readOne(){
 
    $query = "SELECT
                sreading, creading, difference, product_name, cash, created
            FROM
                " . $this->table_name . "
            WHERE
                sale_id = ?
            LIMIT
                0,1";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->sale_id);
    $stmt->execute();
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    $this->sreading = $row['sreading'];
    $this->creading = $row['creading'];
    $this->difference = $row['difference'];
    $this->product_name = $row['product_name'];
	  $this->cash = $row['cash'];
	  	  $this->created = $row['created'];
}

function update(){
 
    $query = "UPDATE
                " . $this->table_name . "
            SET
                sreading = :sreading,
                creading = :creading,
                difference = :difference,
				product_name = :product_name,
			    cash = :cash,
				pump_id = :pump_id

            WHERE
                sale_id = :sale_id";
 
    $stmt = $this->conn->prepare($query);
 
    // posted values
    $this->sreading=htmlspecialchars(strip_tags($this->sreading));
    $this->creading=htmlspecialchars(strip_tags($this->creading));
    $this->difference=htmlspecialchars(strip_tags($this->difference));
    $this->product_name=htmlspecialchars(strip_tags($this->product_name));
    $this->cash=htmlspecialchars(strip_tags($this->cash));
    $this->sale_id=htmlspecialchars(strip_tags($this->sale_id));
     $this->pump_id=htmlspecialchars(strip_tags($this->pump_id));
    // bind parameters
    $stmt->bindParam(':sreading', $this->sreading);
    $stmt->bindParam(':creading', $this->creading);
    $stmt->bindParam(':difference', $this->difference);
    $stmt->bindParam(':product_name', $this->product_name);
    $stmt->bindParam(':sale_id', $this->sale_id);
	$stmt->bindParam(':cash', $this->cash);
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
                sale_id, sreading, creading, pump_id, difference, product_name, cash, created
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