<?php

class Users extends DB_Object
{
    protected static $db_table = "tblusers";
    protected static $db_table_fields = array(
        'firstname',
        'lastname',
        'gender',
        'username',
        'password',
        'email',
        'designation',
        'address',
        'access_level',
        'profile_picture',
        'date_created'
    );

    public $id;
    public $firstname;
    public $lastname;
    public $gender;
    public $username;
    public $password;
    public $email;
    public $designation;
    public $access_level;
    public $address;
    public $profile_picture;
    public $date_created;

    public $upload_directory = "upload/users";
    public $image_placeholder = "http://placehold.it/64x64&text=images";
    public $errors = array();

    public $upload_errors_array = array(
        UPLOAD_ERR_OK         => "There is no error",
        UPLOAD_ERR_INI_SIZE   => "The uploaded file exceeds the upload_max_filesize directive.",
        UPLOAD_ERR_FORM_SIZE  => "The uploaded file exceeds the MAX_FILE_SIZE directive.",
        UPLOAD_ERR_PARTIAL    => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE    => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION  => "A PHP extension stopped the file upload."
    );

    public function set_file($file)
    {
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded.";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            // Get extension and validate it
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($ext, $allowed)) {
                $this->errors[] = "Invalid file type. Only JPG, PNG, and GIF are allowed.";
                return false;
            }

            // Generate unique name
            $unique_name = uniqid('user_', true) . '.' . $ext;

            $this->profile_picture = $unique_name;
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];

            return true;
        }
    }

    public function profile_picture_picture()
    {
        return empty($this->profile_picture) ? $this->image_placeholder : $this->upload_directory . '/' . $this->profile_picture;
    }

    public function picture_path()
    {
        return $this->upload_directory . '/' . $this->profile_picture;
    }

    public function delete_photo()
    {
        if ($this->delete()) {
            $target_path = SITE_ROOT . DS . $this->upload_directory . DS . $this->profile_picture;
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }

    public function save_image()
    {
        if (!empty($this->errors)) {
            return false;
        }

        if (empty($this->profile_picture) || empty($this->tmp_path)) {
            $this->errors[] = "The file was not available.";
            return false;
        }

        $target_path = SITE_ROOT . DS . $this->upload_directory . DS . $this->profile_picture;

        if (file_exists($target_path)) {
            $this->errors[] = "The file {$this->profile_picture} already exists.";
            return false;
        }

        if (move_uploaded_file($this->tmp_path, $target_path)) {
            unset($this->tmp_path);
            return true;
        } else {
            $this->errors[] = "The file directory probably does not have permission.";
            return false;
        }
    }

    public function save()
    {
        if ($this->id) {
            return $this->update();
        } else {
            if (!empty($this->errors)) {
                return false;
            }

            if (empty($this->profile_picture) || empty($this->tmp_path)) {
                $this->errors[] = "The file was not available.";
                return false;
            }

            $target_path = SITE_ROOT . '/' . $this->upload_directory . '/' . $this->profile_picture;

            if (file_exists($target_path)) {
                $this->errors[] = "The file {$this->profile_picture} already exists.";
                return false;
            }

            if (move_uploaded_file($this->tmp_path, $target_path)) {
                if ($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
            } else {
                $this->errors[] = "The file directory probably does not have permission.";
                return false;
            }
        }
    }

    public static function user_account_login($email, $password)
    {
        global $db;
        $email = $db->escape_string($email);
        $password = md5($db->escape_string($password));

        $sql = "SELECT * FROM " . self::$db_table . " WHERE email = '{$email}' AND password='{$password}'";
        $result_array = self::find_by_query($sql);

        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function email_exists($email)
    {
        global $db;
        $email = $db->escape_string($email);
        $sql = "SELECT user_id FROM " . self::$db_table . " WHERE email = '{$email}'";
        $result = $db->query($sql);

        return (mysqli_num_rows($result) === 1);
    }
}

?>
