<?php
include_once 'includes/header.php';

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

if (isset($_POST["submit"])) {
    $emp_type_id = strip_tags($_POST["emp_type_id"]);
    $emp_type = strip_tags($_POST["emp_type"]);
    if (isset($_POST['update'])) {
        $sql = "UPDATE emp_type SET emp_type = :emp_type WHERE emp_type_id = :emp_type_id";
        $stmt = $objUser->runQuery($sql);
        $stmt->bindparam(":emp_type_id", $emp_type_id);
        $stmt->bindparam(":emp_type", $emp_type);
        if ($stmt->execute()) {
            header('Location: emp_type.php');
        }
    }
}

?>

<body>
    <div class="container">
        <div class="row" style="margin-top: 100px;">
            <div class="col"></div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h3>แก้ไขประเภทพนักงาน</h3>
                        <form action="" method="post">
                            <input type="text" name="update" value="update" hidden>
                            <div class="form-group">
                                <label for="emp_type_id">ไอดีประเภทพนักงาน</label>
                                <input type="text" class="form-control" name="emp_type_id" value="<?php echo $emp_type_id; ?>">
                            </div>
                            <div class="form-group">
                                <label for="emp_type">ชื่อประเภทพนักงาน</label>
                                <input type="text" class="form-control" name="emp_type" value="<?php echo $emp_type; ?>">
                            </div>
                            <div class=" d-grid gap-1">
                                <input type="submit" name="submit" value="แก้ไข" class="btn btn-success btn-block">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>