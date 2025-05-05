<?php

class Quotation extends DB_Object
{
    protected static $db_table = "tblweddingquotation";
    protected static $db_table_fields = array(
        'quotation_id',
        'user_id',
        'quotation_key',
        'quotation_text',
        'quotation_amount',
        'quotation_type'
        
    );

    public $quotation_id;
    public $user_id;
    public $quotation_type;
    public $quotation_key;
    public $quotation_text;
    public $quotation_amount;


    public static function get_quotation_amount() {
        global $db;
        $sql = "SELECT * FROM tblweddingquotation ORDER BY quotation_id ASC";
    
        // Execute the query
        $result_set = $db->query($sql);
    
        // Check if the query was successful
        if ($result_set === false) {
            // Query failed, log the error
            die('Query failed: ' . $db->error);  // Or use error_log() to log the error in a file
        }
    
        // Initialize an empty array to hold the results
        $the_object_array = array();
    
        // Fetch each row from the result set
        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantiation($row);
        }
    
        return $the_object_array;
    }

    

}

?>


