<?php 

    class Config
    {
        private $host = 'localhost';
        private $username = 'root';
        private $password = '';
        private $database = 'demo';
        private $connection;
        

        public function __construct() {
            $this->connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);
        }

        public function insertData($name,$role,$phone){
            $query = "INSERT INTO empoyee (name,role,phone) VALUES('$name','$role',$phone)";
            $res =  mysqli_query($this->connection,$query);

            if($res)
            {
                echo 'data inserted !';
            }
            else
            {
                echo 'data not inserted !';
            }
        }

        // function insertData()
        // {
        //     $query = "INSERT INTO empoyee (name,role,phone) VALUES()";
        // }
    }

?>