<?php
class Database
{
    public $connection;
    private $sql_string;

    function __construct()
    {
        $this->open_connection();
    }

    public function open_connection()
    {
        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (mysqli_connect_errno()) {
            die("Database failed to connect: " . mysqli_error($this->connection));
        }
    }

    public function query($sql)
    {
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }

    private function confirm_query($result)
    {
        if (!$result) {
            die("Query Failed");
        }
    }

    public function escape_string($string)
    {
        return mysqli_real_escape_string($this->connection, $string);
    }

    public function the_insert_id()
    {
        return mysqli_insert_id($this->connection);
    }

    function setQuery($sql = '')
    {
        $this->sql_string = $sql;
    }

    function executeQuery()
    {
        return mysqli_query($this->connection, $this->sql_string);
    }

    function loadResultList($key = '')
    {
        $cur = $this->executeQuery();

        $array = array();
        while ($row = mysqli_fetch_object($cur)) {
            if ($key) {
                $array[$row->$key] = $row;
            } else {
                $array[] = $row;
            }
        }
        mysqli_free_result($cur);
        return $array;
    }

    public function get_error()
    {
        return mysqli_error($this->connection);
    }

    public function __get($name)
    {
        if ($name === 'error') {
            return $this->get_error();
        }
        return null;
    }
}

$db = new Database();
?>
