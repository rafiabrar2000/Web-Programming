<?php

Class Sign_in{
        private $conn;
        public function __construct(){
            
            $dbhost='localhost';
            $dbuser='root';
            $dbpass="";
            $dbname='dbmsproject';

            $this->conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

            if(!$this->conn){
                die("Database Connection Error!");
            }
        }
        public function add_data($data){
            $User_Name=$data['username'];
            $User_email=$data['email'];
            $User_passcode=$data['passcode'];
            $User_phone=$data['phone'];

            $query="INSERT INTO signin(username,email,passcode,phone) VALUE('$User_Name','$User_email','$User_passcode','$User_phone')";

            if(mysqli_query($this->conn,$query)){
                return "Information is inserted successfully";
            }
        }

        public function display_data(){
            $query="SELECT * FROM students";
            if(mysqli_query($this->conn,$query)){
                $return_data=mysqli_query($this->conn,$query);
                return $return_data;
            }
        }

       

        

        
    }

?>