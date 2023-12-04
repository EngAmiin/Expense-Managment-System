<?php
header('Content-Type: application/json');
include '../config/conn.php';

$action= $_POST['action'];

function register_system_action($conn){
    extract($_POST);
    $data= array();
    $query= "INSERT INTO `system_actions` (name, action, link_id) VALUES ('$name' , '$system_action', '$link_id')";
    $result= $conn->query($query);
    if($result){
        $data= array("status"=>true, "data"=>"Successfully Registered");
    }else{  
        $data= array("status"=>false, "data"=>$conn->error);
    }
    echo json_encode($data);
}

function update_system_action($conn){
    extract($_POST);
    $data= array();
    $query= "UPDATE `system_actions` set name= '$name' , action= '$system_action', link_id= '$link_id' WHERE id= '$id'";
    $result= $conn->query($query);
    if($result){
        $data= array("status"=>true, "data"=>"Successfully Updated");
    }else{
        $data= array("status"=>false, "data"=>$conn->error);
    }
    echo json_encode($data);
}


function read_all_system_actions($conn){
    $data= array();
    $message= array();
    $query= "SELECT * FROM `system_actions`";
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

function get_system_action_info($conn){
    extract($_POST);
    $data= array();
    $array_data= array();
    $query= "SELECT * FROM `system_actions` WHERE id = '$id'";
    $result= $conn->query($query);
    if($result){
        $row= $result->fetch_assoc();
        $data= array("status" =>true, "data" =>$row);
    }else{
        $data= array("status" =>false, "data" =>$conn->error); 
    }
    echo json_encode($data);
}

function delete_system_action($conn){
    extract($_POST);
    $data= array();
    $array_data= array();
    $query= "DELETE FROM `system_actions` WHERE id='$id'";
    $result= $conn->query($query);

    if($result){
        $data= array("status" =>true, "data" =>"Successfully Deleted");
    }else{
        $data= array("status" =>false, "data" =>$conn->error); 
    }
    echo json_encode($data);
}


if(isset($_POST['action'])){
    $action= $_POST['action'];
    $action($conn);
}else{
    echo json_encode(array('status'=>false, 'data'=>'Action required....'));
}

?>