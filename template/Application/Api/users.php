<?php

use function PHPSTORM_META\elementType;

header('Content-Type: application/json');
include '../config/conn.php';

$action= $_POST['action'];

function register_user($conn){

    extract($_POST);
    $data= array();
    $error_array= array();
    $new_id= generate($conn);


    $file_name= $_FILES['image']['name'];
    $file_type= $_FILES['image']['type'];
    $file_size= $_FILES['image']['size'];

    $save_name= $new_id. ".png";

    //Allowed IMagges
    $allowedImages= ["image/jpg", "image/jpeg", "image/png", "image/jfif", "images/jpg"];
    $max_size= 5*1024*1024;
    if(in_array($file_type,$allowedImages)){
        if($file_size>$max_size){
            $error_array[]= "File size must be Less Then". $max_size;
        }
    }else{
        $error_array[]= "This File Is Not Allowed";
    }

    if(count($error_array)<=0){
        $query= "INSERT INTO `users`(`id`, `Username`, `Password`, `Image`) VALUES ('$new_id', '$Username', MD5('$password'), '$save_name')";
        //EXCUTIONS
        $result= $conn->query($query);
    
        //CHECKING IF ERROR OR CORRECTMENT
        if($result){
            move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$save_name);
            $data= array("status"=>true, "data"=>"successfully Registered");
        }else{
            $data= array("status"=>false, "data"=>$conn->error);
        }
}else{
    $data= array("status"=>false, "data"=>$error_array);
}
echo json_encode($data);

}

function update_user($conn){

    extract($_POST);
    $data= array();

    if(!empty($_FILES['image']['tmp_name'])){

    $error_array= array();
    $new_id= generate($conn);
    $file_name= $_FILES['image']['name'];
    $file_type= $_FILES['image']['type'];
    $file_size= $_FILES['image']['size'];
    $save_name= $update_useriD. ".png";


    $allowedImages= ["image/jpg", "image/jpeg", "image/png", "image/jfif", "images/jpg"];
    $max_size= 5*1024*1024;
    if(in_array($file_type,$allowedImages)){
        if($file_size>$max_size){
            $error_array[]= "File size must be Less Then". $max_size;
        }
    }else{
        $error_array[]= "This File Is Not Allowed";
    }
 
    if(count($error_array)<=0){
        $query= "UPDATE users set users.username= '$Username' WHERE users.id= '$update_useriD' ";   
        //EXCUTIONS
        $result= $conn->query($query);
        //CHECKING IF ERROR OR CORRECTMENT
        if($result){
            move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$save_name);
            $data= array("status"=>true, "data"=>"successfully Updated");  
        }else{
            $data= array("status"=>false, "data"=>$conn->error);
        }
}else{
    $data= array("status"=>false, "data"=>$error_array);
}
}else{
    $query= "UPDATE users set users.username= '$Username' WHERE users.id= '$update_useriD' ";
    
    //EXCUTIONS
    $result= $conn->query($query);

    //CHECKING IF ERROR OR CORRECTMENT
    if($result){

      //  move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$save_name);
        $data= array("status"=>true, "data"=>"successfully Updated","the id"=> $update_useriD);
    }else{
        $data= array("status"=>false, "data"=>$conn->error);
    }

}


echo json_encode($data);
} 

function get_user_info($conn){
    extract($_POST);
    $data= array();
    $array_data= array();
    $query= "SELECT * FROM `users` WHERE id = '$id' ";
    $result= $conn->query($query);

    if($result){
        $row= $result->fetch_assoc();
        $data= array("status" =>true, "data" =>$row);
    }else{
        $data= array("status" =>false, "data" =>$conn->error); 
    }
    echo json_encode($data);
}

function Update_expense($conn){

    extract($_POST);;
    $data= array();
    $query= "UPDATE `expense` SET amount= '$amount', type= '$type' WHERE id='$id'";
    $result= $conn->query($query);
    if($result){
        $data= array("status"=>true, "data"=>"Successfully Updated");
    }else{
        $data= array("status"=>false, "data"=>$conn->error);
    }
    echo json_encode($data);
}
function delete_user_info($conn){
    extract($_POST);
    $data= array();
    $array_data= array();
    $query= "DELETE FROM users WHERE id='$id'";
    $result= $conn->query($query);

    if($result){
        unlink('../uploads/'.$id.".png");
        $data= array("status" =>true, "data" =>"Successfully Deleted");
    }else{
        $data= array("status" =>false, "data" =>$conn->error); 
    }
    echo json_encode($data);
}

function loadall($conn){
    $data= array();
    $message= array();
    $query= "SELECT *FROM `users` ";
    $result= $conn->query($query);
    if($result){
        while($row= $result->fetch_assoc()){
            $data []= $row;
            $message= array("status"=>true, "data"=>$data);
        }
        echo json_encode($message);
    }else{
        $message= array("status"=>false, "data"=>$conn->error);
    }
}


//GENERATING ID
function generate($conn){
    $new_id= '';
    $data= array();
    $message= array();
    $query= "SELECT *  FROM  `users` order by users.id DESC limit 1";
    $result= $conn->query($query);
    if($result){

        $num_rows= $result->num_rows;

        if($num_rows > 0){
            $row= $result->fetch_assoc();
            $new_id= ++$row['id'];
        }else{
            $new_id= "DR001";
        }

        $row= $result->fetch_assoc();
        // $message= array("status"=>true, "data"=>$new_id);
    }else{
        $message= array("status"=>false, "data"=>$conn->error);
    }
    // echo json_encode($message);
    return $new_id;
}

if(isset($_POST['action'])){
    $action= $_POST['action'];
    $action($conn);
}else{
    echo json_encode(array('status'=>false, 'data'=>'Action required....'));
}




// validators
function hasStateTrue(string $imagePath): bool
{
    if (file_exists($imagePath))
        return true;

    return false;
}

function isUnLinked(string $imagePath): bool
{
    if (unlink($imagePath))
        return true;

    return false;
}


function uploadFile($fromPath, $toPath): bool
{
    if (move_uploaded_file($fromPath, $toPath))
        return true;

    return false;
}

function updateImageFromDatabase($image, $id, $conn)
{
    $sql = "UPDATE images SET image='$image' where id='$id'";
    $result = $conn->query($sql);
    if ($result)
        return true;

    return false;
}

?>