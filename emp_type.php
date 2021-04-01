<?php
include_once 'includes/header.php';
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

$sql = "SELECT * FROM emp_type";
$stmt = $objUser->runQuery($sql);
$stmt->execute();
$emp_type = $stmt->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {
    if (isset($_POST['delEmpType'])) {
        $sql = "DELETE FROM emp_type WHERE emp_type_id = :emp_type_id";
        $stmt = $objUser->runQuery($sql);
        $stmt->bindValue(":emp_type_id", $_POST['emp_type_id']);
        if ($stmt->execute()) {
            header('Location: pen_index.php');
        }
    }
}
?>
<div class="container">
    <div class="row" style="margin-top: 50px;">
        <div class="col-10"></div>
        <div class="col-2">
            <a href="logout.php" class="btn btn-danger btn-sm btn-block" style="margin-top: 10px;">ออกจากระบบ</a>
        </div>
    </div>
    <div class="row" style="margin-top: 50px;">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="display animate__animated animate__pulse" id="emp_type" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ประเภทพนักงาน</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($emp_type as $emp_type) : ?>
                                <tr>
                                    <th scope="row"><?php echo $emp_type->emp_type_id ?></th>
                                    <td><?php echo $emp_type->emp_type ?></td>
                                    <td>
                                        <form method="post" action="emp_type_form_update.php" style="display: inline">
                                            <input type="text" name="emp_type_id" value="<?php echo $emp_type->emp_type_id ?>" hidden>
                                            <input type="text" name="emp_type" value="<?php echo $emp_type->emp_type ?>" hidden>
                                            <input type="submit" name="submit" class="btn btn-outline-warning" value="edit">
                                        </form>
                                        <form method="post" action="" style="display: inline">
                                            <input type="hidden" name="delEmpType">
                                            <input type="text" name="emp_type_id" value="<?php echo $emp_type->emp_type_id ?>" hidden>
                                            <input onclick="return confirm('ต้องการลบข้อมูล ?')" type="submit" name="submit" class="btn btn-outline-danger" value="delete">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="emp_type_form.php" class="btn btn-outline-success btn-sm btn-block" style="margin-top: 10px;">เพิ่ม</a>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('#emp_type').DataTable()
    })
</script>