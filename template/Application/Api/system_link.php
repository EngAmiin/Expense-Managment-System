<?php
header('Content-Type: application/json');
include '../config/conn.php';

$action= $_POST['action'];



function read_all_link(){
    $data= array();
    $data_array= array();



$search_result= glob('../views/*.php');

// print_r($search_result);

foreach($search_result as $sr){
    $pure_link= explode("/",$sr);
    $data_array[] = $pure_link[2];
}

if(count($search_result)> 0){
    $data = array("status"=>true, "data"=>$data_array);
}else{
    $data= array("status"=>false, "data"=>"not found");
}

echo json_encode($data);

}


function register_link($conn){

    extract($_POST);
    $data= array();

    //BUILDING THE QUERTY
    $query= "INSERT INTO `sytem_link` (name, link, category_id) VALUES ('$name' , '$link_id', '$category')";
    
    //EXCUTIONS
    $result= $conn->query($query);

    //CHECKING IF ERROR OR CORRECTMENT
    if($result){
        $data= array("status"=>true, "data"=>"Successfully Registered");
    }else{
        $data= array("status"=>false, "data"=>$conn->error);
    }
    echo json_encode($data);
}

function get_link_info($conn){
    extract($_POST);
    $data= array();
    $array_data= array();
    $query= "SELECT * FROM `sytem_link` WHERE id = '$id'";
    $result= $conn->query($query);

    if($result){
        $row= $result->fetch_assoc();
        $data= array("status" =>true, "data" =>$row);
    }else{
        $data= array("status" =>false, "data" =>$conn->error); 
    }
    echo json_encode($data);
}

function Update_link($conn){

    extract($_POST);;
    $data= array();
    $query= "UPDATE `sytem_link` SET name= '$name', Link= '$link_id', category_id='$category' WHERE id='$id'";
    $result= $conn->query($query);
    if($result){
        $data= array("status"=>true, "data"=>"Successfully Updated");
    }else{
        $data= array("status"=>false, "data"=>$conn->error);
    }
    echo json_encode($data);
}
function delete_link_info($conn){
    extract($_POST);
    $data= array();
    $array_data= array();
    $query= "DELETE FROM `sytem_link` WHERE id='$id'";
    $result= $conn->query($query);

    if($result){
        $data= array("status" =>true, "data" =>"Successfully Deleted");
    }else{
        $data= array("status" =>false, "data" =>$conn->error); 
    }
    echo json_encode($data);
}

function read_all_links($conn){
    $data= array();
    $message= array();
    $query= "SELECT * FROM `sytem_link` ";
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
function get_user_statement ($conn){
    extract($_POST);
    $data= array();
    $message= array();
    $query= "CALL get_user_statement('USR002', '$from', '$to')";
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


if(isset($_POST['action'])){
    $action= $_POST['action'];
    $action($conn);
}else{
    echo json_encode(array('status'=>false, 'data'=>'Action required....'));
}

?>