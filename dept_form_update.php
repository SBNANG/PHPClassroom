<?php
include_once 'includes/header.php';

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

if (isset($_POST["submit"])) {
    $dept_id = strip_tags($_POST["dept_id"]);
    $dept_name = strip_tags($_POST["dept_name"]);
    if (isset($_POST['update'])) {
        $sql = "UPDATE department SET dept_name = :dept_name WHERE dept_id = :dept_id";
        $stmt = $objUser->runQuery($sql);
        $stmt->bindparam(":dept_id", $dept_id);
        $stmt->bindparam(":dept_name", $dept_name);
        if ($stmt->execute()) {
            header('Location: dept.php');
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
                        <h3>เพิ่มแผนก</h3>
                        <form action="" method="post">
                            <input type="text" name="update" value="update" hidden>
                            <div class="form-group">
                                <label for="dept_id">ไอดีแผนก</label>
                                <input type="text" class="form-control" name="dept_id" value="<?php echo $dept_id; ?>">
                            </div>
                            <div class="form-group">
                                <label for="dept_name">ชื่อแผนก</label>
                                <input type="text" class="form-control" name="dept_name" value="<?php echo $dept_name; ?>">
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