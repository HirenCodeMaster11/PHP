<?php 

    include('config.php');

    $c1 = new Config();

    $set = isset($_POST['button']);

    if($set)
    {
        $name = $_POST['name'];
        $role = $_POST['role'];
        $phone = $_POST['phone'];  

        $c1->insertData($name,$role,$phone);
    }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
</head> 
<body>
    <center>
    <h1>Employee Details</h1>
    <form method = 'POST'>
        <input placeholder ='Name' name ='name'></input><br><br>
        <input placeholder ='Role' name ='role'></input><br><br>
        <input  type = 'number' placeholder ='Phone' name ='phone'></input><br><br>
        <button name='button' type='submit'>Submit </button>
</form>
</center>
</body>
</html>