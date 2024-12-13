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
            return $res;
        }

        public function fetch()
        {
            $query = "SELECT * FROM empoyee";
            $res = mysqli_query($this->connection,$query);
            return $res;
        }

        public function delete($id)
        {
            $query = "DELETE FROM empoyee WHERE id = $id";
            $res = mysqli_query($this->connection,$query);
            return $res;
        }

        public function update($id,$name,$role,$phone)
        {
            $query = "UPDATE empoyee SET name='$name',role='$role',phone=$phone WHERE id=$id";
            $res = mysqli_query($this->connection,$query);
            return $res;
        }
    }

?>