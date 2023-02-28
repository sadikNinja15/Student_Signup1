<?php 


// session_start();

// if(!isset($_SESSION['first_name'])){
//     header("location: one.html");
// }

// SIGNLETON design-
// ->A private static variable, holding the only instance of the class.
// ->A private constructor, so it can not be instantiated anywhere else.
// ->A publice static method , to return the single instance of the class.
 class Singleton{
    private static $instance = NULL;
    private function __construct(){
        echo "DB Connected<br/>";
    }

    public static function getInstance(){
        if(self::$instance==Null){
            self::$instance = new static();
        } else {
            echo "already connected<br/>";
        }
        return self::$instance;
    }

    public static function getDBConn(){
        try{
            $db = self::$instance;
            $db = new mysqli('localhost','root','','student');
            return $db;
            echo "done";

        }catch(Exception $e){
            echo 'error: '.$e->getMessage();
        }
    }


 }


// $obj1 = Singleton::getInstance();        //$obj1 = Singleton::getInstance(); we call like this bcz getInstance() is static
// $obj2 = Singleton::getInstance();
// var_dump(($obj1));

// $obj->getInstance();
$conn = Singleton::getDBConn();
// $sql = "SELECT * FROM `students`";
// $result = mysqli_query($conn, $sql);
// while($row = mysqli_fetch_assoc($result)){
//     // echo var_dump($row);
//     echo $row['id'] .  ". Hello ". $row['first_name'] .$row['last_name']. " your email is ". $row['email']." your DOB ".$row['date_of_birth'];
//     echo "<br>";
// }

// $filename= $files['name'];
// $fileerror = $files['error'];
// $filetmp = $files['tmp_name'];
// $fileext = explode('.',$filename);
// $filecheck = strtolower((end($fileext)));

//$fileextstored = array('png','jpg','jpeg');

// if(in_array(($filecheck,$fileextstored))){
//     $desctinationfile = 'upload/'.$filename;
//     move_uploaded_file($filetmp,$desctinationfile);

//     $q = "insert into students () values ($desctinationfile)";
//     $query = mysqli_query(($conn,$q));
// }

?>
























