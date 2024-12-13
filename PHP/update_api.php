<?php
    header("Access-Control-Allow-Method: PUT");
    header("Content-Type: application/json");

    include("config.php");

    $c1 = new Config();

    if($_SERVER['REQUEST_METHOD'] == 'PUT')
    {
        $data = file_get_contents("php://input");
        parse_str($data,$result);
        
        $id = $result['id'];
        $name = $result['name'];
        $role = $result['role'];
        $phone = $result['phone'];

        $res = $c1->update($id,$name,$role,$phone);

        if($res)
        {
            $arr['msg'] = 'Data Update !';
        }
        else
        {
            $arr['msg'] = 'Data not updated !';
        }
    }
    else
    {
        $arr['error'] = 'Only GET type is allowed';
    }

    echo json_encode($arr);
?>