<?php 

    include('config.php');

    session_start();
    $c1 = new Config();

    $set = isset($_POST['button']);

    if($set)
    {
        $name = $_POST['name'];
        $role = $_POST['role'];
        $phone = $_POST['phone'];  

        $c1->insertData($name,$role,$phone);
        header("Location: " . $_SERVER['PHP_SELF']);
            exit();
    } 
    
    $res = $c1->fetch();

    if (isset($_POST['delete'])) {
        $id = $_POST['deleteId'];
        if ($c1->delete($id)) {
            // Redirect to the same page to refresh the data
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    if(isset($_POST['update']))
    {
        $id = $_POST['deleteId'];
        $name = $_POST['nameId'];
        $role = $_POST['roleId'];
        $phone = $_POST['phoneId'];
        
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;
        $_SESSION['phone'] = $phone;

        header('Location: update.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            animation: fadeIn 1s ease-in-out;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .form-container:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .is-invalid ~ .invalid-feedback {
            display: block !important;
        }
        .is-valid {
            border-color: #198754 !important;
        }
        .table-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .table-container:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        button {
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        button:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container mx-auto" style="max-width: 400px;">
            <form method="POST" id="employeeForm" class="needs-validation" novalidate>
                <h1>Employee Registration</h1>
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        class="form-control" 
                        placeholder="Full Name" 
                        name="name" 
                        required 
                        pattern="[a-zA-Z\s]+" 
                        title="Only letters and spaces are allowed.">
                    <div class="invalid-feedback">
                        Please enter a valid name (letters and spaces only).
                    </div>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <input 
                        type="text" 
                        id="role" 
                        class="form-control" 
                        placeholder="Role" 
                        name="role" 
                        required 
                        pattern="[a-zA-Z\s]+" 
                        title="Only letters and spaces are allowed.">
                    <div class="invalid-feedback">
                        Please enter a valid role (letters and spaces only).
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input 
                        type="text" 
                        id="phone" 
                        class="form-control" 
                        placeholder="Phone Number" 
                        name="phone" 
                        required 
                        pattern="\d{10}" 
                        title="Phone number must be 10 digits.">
                    <div class="invalid-feedback">
                        Phone number must be exactly 10 digits.
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100" name="button">Submit</button>
            </form>
        </div>

        <hr class="my-5">

        <div class="table-container mx-auto" style="max-width: 600px;">
            <h2 class="text-center mb-4">Employee List</h2>
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($data = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <th scope="row"><?php echo $data['id']; ?></th>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['role']; ?></td>
                        <td><?php echo $data['phone']; ?></td>
                        <td>
                            <form method="POST" class="d-flex gap-2">
                                <input type="hidden" value="<?php echo $data['id']; ?>" name="deleteId">
                                <input type="hidden" value="<?php echo $data['name']; ?>" name="nameId">
                                <input type="hidden" value="<?php echo $data['role']; ?>" name="roleId">
                                <input type="hidden" value="<?php echo $data['phone']; ?>" name="phoneId">

                                <button type="submit" class="btn btn-warning btn-sm" name="update">Update</button>
                                <button type="submit" class="btn btn-danger btn-sm" name="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Bootstrap validation script
        (function () {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>