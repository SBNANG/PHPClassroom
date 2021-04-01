<?php
include_once 'includes/header.php';

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

if (isset($_POST["submit"])) {
    $work_type_id = strip_tags($_POST["work_type_id"]);
    $work_type_name = strip_tags($_POST["work_type_name"]);
    $sql = "INSERT INTO work_type (work_type_id, work_type_name) VALUES(:work_type_id,:work_type_name)";
    $stmt = $objUser->runQuery($sql);
    $stmt->bindparam(":work_type_id", $work_type_id);
    $stmt->bindparam(":work_type_name", $work_type_name);
    if ($stmt->execute()) {
        header('Location: work_type.php');
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
                        <h3>เพิ่มประเภทงาน</h3>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="work_type_id">ไอดีประเภทงาน</label>
                                <input type="text" class="form-control" name="work_type_id">
                            </div>
                            <div class="form-group">
                                <label for="work_type_name">ชื่อประเภทงาน</label>
                                <input type="text" class="form-control" name="work_type_name">
                            </div>
                            <div class=" d-grid gap-1">
                                <input type="submit" name="submit" value="เพิ่มข้อมูล" class="btn btn-success btn-block">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>