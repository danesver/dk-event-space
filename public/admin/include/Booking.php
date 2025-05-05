<?php

class Booking extends DB_Object
{
    protected static $db_table = "tblweddingbook";
    protected static $db_table_fields = array(
        'booking_id',
        'user_id',
        'bride',
        'groom',
        'wedding_type',
        'other_wedding_type',
        'user_email',
        'wedding_date',
        'organizer_id',
        'other_no_of_guests',
        'no_of_guest',
        'event_slot',
        'textarea',
        'seating_arrangement',
        'av_requirements',
        'special_requests',
        'wedding_status',
        'visit_date',
        'visit_time',
        'amount',
        'firstname',
        'lastname',
        'phone',
        'city',
        'description',
        'remaing_amount',
        'payment_attachment',
        'payment',
        'pdf'


    );

    public $booking_id;
    public $user_id;
    public $wedding_date;
    public $firstname;
    public $lastname;
    public $user_email;
    public $wedding_type;
    public $other_wedding_type;
    public $pdf;
    public $phone;
    public $city;
    public $organizer_id;
    public $no_of_guest;
    public $other_no_of_guests;
    public $event_slot;
    public $textarea;
    public $seating_arrangement;
    public $av_requirements;
    public $special_requests;
    public $wedding_status;
    public $vist_date_time;
    public $visit_date;
    public $visit_time;
    public $amount;
    public $description;
    public $remaing_amount;
    public $payment;
    public $payment_attachment;
    

    public $upload_directory = "upload/users";
    public $image_placeholder = "http://placehold.it/64x64&text=images";
    public $errors = array();

    public $upload_errors_array = array(
    UPLOAD_ERR_OK         => "There is no error",
    UPLOAD_ERR_INI_SIZE   => "The uploaded file exceeds the upload_max_filesize disc",
    UPLOAD_ERR_FORM_SIZE  => "The uploaded file exceeds the MAX_FILE_SIZE directives",
    UPLOAD_ERR_PARTIAL    => "The uploaded file was only partially uploaded.",
    UPLOAD_ERR_NO_FILE    => "No file was uploaded",
    UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
    UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
    UPLOAD_ERR_EXTENSION  => "A PHP extension stopped the file upload."
    );
     public function check_wedding_date($date) {
        global $db;
        
        $sql = "SELECT * FROM " . self::$db_table . " WHERE wedding_date = '{$date}'";
        $result = $db->query($sql);

        if(mysqli_num_rows($result) == 1) {
            return true;
        } else {
            return false;
        }
    }


    public static function getBooking() {
        global $db;
        $sql = "SELECT * FROM tblweddingbook WHERE tblweddingbook.wedding_status  != 'confrim' ORDER BY booking_id ASC";
        $result_set = $db->query($sql);

        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantiation($row);
        }
        return $the_object_array;
    }

    public static function getPendingBooking() {
        global $db;
        $sql = "SELECT * FROM tblweddingbook WHERE tblweddingbook.wedding_status = 'Pending Visit' ORDER BY booking_id ASC";
        $result_set = $db->query($sql);

        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantiation($row);
        }
        return $the_object_array;
    }

    public static function getConfrimVistBooking() {
        global $db;
        $sql = "SELECT * FROM tblweddingbook WHERE tblweddingbook.wedding_status = 'Confirm Visit' ORDER BY booking_id ASC";
        $result_set = $db->query($sql);

        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantiation($row);
        }
        return $the_object_array;
    }
    public function set_file($file)
    {
        if(empty($file) || !$file || !is_array($file))
        {
           
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->payment_attachment = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }
     public static function ConfirmedBooking() {
        global $db;
        $sql = "SELECT * FROM tblweddingbook WHERE tblweddingbook.wedding_status = 'Confirm Booking' ORDER BY booking_id ASC";
        $result_set = $db->query($sql);

        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantiation($row);
        }

        return $the_object_array;
    }

    public static function CancelBooking() {
        global $db;
        $sql = "SELECT * FROM tblweddingbook WHERE tblweddingbook.wedding_status = 'Cancel Booking' ORDER BY booking_id ASC";
        $result_set = $db->query($sql);

        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantiation($row);
        }

        return $the_object_array;
    }
    public static function pendingBooking() {
        global $db;
        $sql = "SELECT * FROM tblweddingbook WHERE tblweddingbook.wedding_status  = 'Pending Booking' ORDER BY booking_id ASC";
        $result_set = $db->query($sql);

        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantiation($row);
        }

        return $the_object_array;
    }
    public static function count_upomming_visit() {
        global $db;
        $sql = "SELECT COUNT(booking_id) FROM " . self::$db_table . " 
                WHERE wedding_status = 'Confirm Visit' 
                AND DATE(wedding_date) > CURDATE()";
        
        $result_count = $db->query($sql);
        $row = mysqli_fetch_array($result_count);
        return array_shift($row);
    }

    public static function count_booking() {
        global $db;
        $sql = "SELECT COUNT(booking_id) FROM " . self::$db_table . " 
                WHERE wedding_status = 'Confirm Booking' 
                AND DATE(wedding_date) > CURDATE()";
        
        $result_count = $db->query($sql);
        $row = mysqli_fetch_array($result_count);
        return array_shift($row);
    }
    
    public static function count_completed() {
        global $db;
        $sql = "SELECT COUNT(booking_id) FROM " . self::$db_table . " 
                WHERE wedding_status = 'Confirm Booking' 
                AND DATE(wedding_date) <= CURDATE()";
        
        $result_count = $db->query($sql);
        $row = mysqli_fetch_array($result_count);
        return array_shift($row);
    }

    public static function count_user() {
        global $db;
        $sql = "SELECT COUNT(DISTINCT user_id) AS unique_users FROM " . self::$db_table;
        $result_count = $db->query($sql);
        $row = mysqli_fetch_array($result_count);
        return array_shift($row);

    }
    
    // saving image
    public function save_image()
    {
            if(!empty($this->errors))
            {
                return false;
            }

            if(empty($this->payment_attachment) || empty($this->tmp_path))
            {
                $this->errors[] = "The file was not available";
                return false;
            }
            
            $target_path =  SITE_ROOT . DS .  $this->upload_directory . DS . $this->payment_attachment;
                     
            if(file_exists($target_path))
            {
                $this->errors[] = "The file {$this->payment_attachment} already exists";
                return false;
            }

            if(move_uploaded_file($this->tmp_path, $target_path))
            {
                unset($this->tmp_path);
                return true;
            } else {
                $this->errors[] = "The File directory probably does not have permession";
                return false;
            }
    }

}

?>


