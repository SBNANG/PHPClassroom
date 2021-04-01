<?php
session_start();
require_once './classes/user.php';
$objUser = new User();
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
if (isset($_SESSION['username'])) {
    $objUser->redirect('pen_index.php');
}

if (isset($_POST["submit"])) {
    $username   = strip_tags($_POST['username']);
    $password  = strip_tags($_POST['password']);
    try {
        $sql = "select * from users where username = ?";
        $stmt = $objUser->runQuery($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if (md5($password) == $user['password']) {
            $username = $user['username'];
            $_SESSION['username'] = $username;
            $objUser->redirect('pen_index.php');
        } else {
            $objUser->redirect('index.php');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link href="https://fonts.googleapis.com/css2?family=Niramit&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>เข้าสู่ระบบ</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="username" id="username" class="form-control" placeholder="ชื่อผู้ใช้" autofocus>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" id="password" class="form-control" placeholder="รหัสผ่าน" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="submit" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>