<?php

class Availability extends DB_Object
{
    protected static $db_table = "availability";
    protected static $db_table_fields = array(
        'available_date',
        'available_start_time',
        'available_end_time'
    );

    public $id;
    public $available_date;
    public $available_start_time;
    public $available_end_time;
    
    public function delete_photo() {
        if($this->delete())
        {
           
            return true;
        } else {
            return false;
        }
    }
}

?>


