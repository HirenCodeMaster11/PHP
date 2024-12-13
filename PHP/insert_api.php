<?php
    header("Access-Control-Allow-Method: POST");
    header("Content-Type: application/json");

    include("config.php");

    $c1 = new Config();

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $name = $_POST['name'];
        $role = $_POST['role'];
        $phone = $_POST['phone'];

        $res = $c1->insertData($name,$role,$phone);

        if($res)
        {
            $arr['msg'] = 'Data inserted !';
        }
        else
        {
            $arr['msg'] = 'Data not inserted !';
        }
    }
    else
    {
        $arr['error'] = 'Only POST type is allowed';
    }

    echo json_encode($arr);
?>