<?php
header('Content-Type: application/json');
include '../config/conn.php';

$action= $_POST['action'];

function read_system_authority($conn){
    $data= array();
    $message= array();
    $query= "SELECT * FROM `system_authority_views` ";
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