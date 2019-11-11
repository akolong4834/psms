<?php
class expense{
 
    // database connection and table name
    private $conn;
    private $table_name = "expenses";
 
    // object properties
    public $expense_id;
    public $station_name;
    public $amount;
	    public $image;
	public $description;
    public $timestamp;

 
    public function __construct($db){
        $this->conn = $db;
    }
	
	    // used by select drop-down list
    function read(){
        //select all data
        $query = "SELECT
                    expense_id, station_name
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
                    station_name=:station_name, amount=:amount, image=:image, description=:description,
                    created=:created";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->station_name=htmlspecialchars(strip_tags($this->station_name));
        $this->amount=htmlspecialchars(strip_tags($this->amount));
        $this->description=htmlspecialchars(strip_tags($this->description));
		        $this->image=htmlspecialchars(strip_tags($this->image));


        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');
 
        // bind values 
  
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":station_name", $this->station_name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":created", $this->timestamp);
	
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
	
	function readAll($from_record_num, $records_per_page){
 
    $query = "SELECT
                expense_id, station_name, amount,  image, description, created
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
 
    $query = "SELECT expense_id FROM " . $this->table_name . "";
 
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

// will upload image file to server
function uploadPhoto(){
 
    $result_message="";
 
    // now, if image is not empty, try to upload the image
    if($this->image){
 
        // sha1_file() function is used to make a unique file name
        $target_directory = "uploads/";
        $target_file = $target_directory . $this->image;
        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
 
        // error message is empty
        $file_upload_error_messages="";
		// make sure that file is a real image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if($check!==false){
    // submitted file is an image
}else{
    $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
}
 
// make sure certain file types are allowed
$allowed_file_types=array("jpg", "jpeg", "png", "gif", "pdf");
if(!in_array($file_type, $allowed_file_types)){
    $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
}
 
// make sure file does not exist
if(file_exists($target_file)){
    $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
}
 
// make sure submitted file is not too large, can't be larger than 1 MB
if($_FILES['image']['size'] > (1024000)){
    $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
}
 
// make sure the 'uploads' folder exists
// if not, create it
if(!is_dir($target_directory)){
    mkdir($target_directory, 0777, true);
}

// if $file_upload_error_messages is still empty
if(empty($file_upload_error_messages)){
    // it means there are no errors, so try to upload the file
    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
        // it means photo was uploaded
    }else{
        $result_message.="<div class='alert alert-danger'>";
            $result_message.="<div>Unable to upload photo.</div>";
            $result_message.="<div>Update the record to upload photo.</div>";
        $result_message.="</div>";
    }
}
 
// if $file_upload_error_messages is NOT empty
else{
    // it means there are some errors, so show them to user
    $result_message.="<div class='alert alert-danger'>";
        $result_message.="{$file_upload_error_messages}";
        $result_message.="<div>Update the record to upload photo.</div>";
    $result_message.="</div>";
}
 
    }
 
    return $result_message;
}



}
?>