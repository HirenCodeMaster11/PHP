<?php
    header("Access-Control-Allow-Method: GET");
    header("Content-Type: application/json");

    include("config.php");

    $c1 = new Config();

    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $res = $c1->fetch();
        $arr = [];
        if($res)
        {
           while($data = mysqli_fetch_assoc($res))
           {
                array_push($arr,$data);
           } 
        }
        else
        {
            $arr['msg'] = 'Data not found';
        }
    }
    else
    {
        $arr['error'] = 'Only GET type is allowed';
    }

    echo json_encode($arr);
?>