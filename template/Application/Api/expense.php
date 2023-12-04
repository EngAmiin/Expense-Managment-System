<?php
header('Content-Type: application/json');
include '../config/conn.php';

$action= $_POST['action'];

function register_expense($conn){

    extract($_POST);
    $data= array();

    //BUILDING THE QUERTY
    $query= "CALL register_exp_sp('','$amount', '$type', '$decription', 'USR002')";
    
    //EXCUTIONS
    $result= $conn->query($query);

    //CHECKING IF ERROR OR CORRECTMENT
    if($result){
        $row= $result->fetch_assoc();
        if($row['Message'] == 'Deny'){
            $data= array("status"=>false, "data"=>"Insuficent Balance");
        }elseif($row['Message']== 'Registered'){
            $data= array("status"=>true, "data"=>"Registered successfully");
        }

        // $data= array("status"=>true, "data"=>"Registered Succesfully");
    }else{
        $data= array("status"=>false, "data"=>$conn->error);
    }
    echo json_encode($data);
}


function get_expense_info($conn){
    extract($_POST);
    $data= array();
    $array_data= array();
    $query= "SELECT * FROM `expense` WHERE id = '$id'";
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
function delete_expense_info($conn){
    extract($_POST);
    $data= array();
    $array_data= array();
    $query= "DELETE FROM expense WHERE id='$id'";
    $result= $conn->query($query);

    if($result){
        $data= array("status" =>true, "data" =>"Successfully Deleted");
    }else{
        $data= array("status" =>false, "data" =>$conn->error); 
    }
    echo json_encode($data);
}

function get_alltransaction($conn){

    
    $data= array();
    $message= array();
    $query= "SELECT `id`, `amount`, `type`, `description` FROM `expense` WHERE 1";
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