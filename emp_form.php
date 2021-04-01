<?php
include_once 'includes/header.php';

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

if (isset($_POST["submit"])) {
    $emp_id = strip_tags($_POST["emp_id"]);
    $emp_name = strip_tags($_POST["emp_name"]);
    $gender = strip_tags($_POST["gender"]);
    $dept_id = strip_tags($_POST["dept_id"]);
    $work_type_id = strip_tags($_POST["work_type_id"]);
    $emp_type_id = strip_tags($_POST["emp_type_id"]);
    if ($objUser->insert($emp_id, $emp_name, $gender, $dept_id, $work_type_id, $emp_type_id)) {
        header('Location: pen_index.php');
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
                        <h3>เพิ่มพนักงาน</h3>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="emp_name">ชื่อพนักงาน</label>
                                <input type="text" class="form-control" name="emp_name" id="emp_name">
                            </div>
                            <label for="emp_name">เพศ</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="genderM" value="m" checked>
                                <label class="form-check-label" for="exampleRadios1">ชาย</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="genderF" value="f">
                                <label class="form-check-label" for="exampleRadios2">หญิง</label>
                            </div><br>
                            <label for="emp_type_id">ประเภทพนักงาน</label>
                            <select class="form-control" aria-label=".form-select-sm example" name="emp_type_id">
                                <?php
                                $sql = "SELECT emp_type_id, emp_type FROM emp_type";
                                $stmt = $objUser->runQuery($sql);
                                $stmt->execute();
                                $emp = $stmt->fetchAll(PDO::FETCH_OBJ);
                                foreach ($emp as $emp) :
                                ?>
                                    <option value="<?php echo $emp->emp_type_id . '">' . $emp->emp_type; ?></option>
                            <?php endforeach; ?>
                        </select><br>
                        <label for=" work_type_id">ประเภทงาน</label>
                                        <select class="form-control" aria-label=".form-select-sm example" name="work_type_id">
                                            <?php
                                            $sql = "SELECT work_type_id, work_type_name FROM work_type";
                                            $stmt = $objUser->runQuery($sql);
                                            $stmt->execute();
                                            $work = $stmt->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($work as $work) :
                                            ?>
                                                <option value="<?php echo $work->work_type_id . '">' .  $work->work_type_name; ?></option>
                        <?php endforeach; ?>
                        </select><br>
                        <label for=" dept_id">แผนก</label>
                                                    <select class="form-control" aria-label=".form-select-sm example" name="dept_id">
                                                        <?php
                                                        $sql = "SELECT dept_id, dept_name FROM department";
                                                        $stmt = $objUser->runQuery($sql);
                                                        $stmt->execute();
                                                        $dept = $stmt->fetchAll(PDO::FETCH_OBJ);
                                                        foreach ($dept as $dept) :
                                                        ?>
                                                            <option value="<?php echo $dept->dept_id . '">' . $dept->dept_name ?></option>
                        <?php endforeach; ?>
                        </select><br>
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

</html>