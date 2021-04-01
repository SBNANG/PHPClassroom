<?php
include_once 'includes/header.php';
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

$sql = "SELECT * FROM department";
$stmt = $objUser->runQuery($sql);
$stmt->execute();
$department = $stmt->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {
    if (isset($_POST['delDept'])) {
        $sql = "DELETE FROM department WHERE dept_id = :dept_id";
        $stmt = $objUser->runQuery($sql);
        $stmt->bindValue(":dept_id", $_POST['dept_id']);
        if ($stmt->execute()) {
            header('Location: index.php');
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
                    <table class="display animate__animated animate__pulse" id="department" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Department</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($department as $department) : ?>
                                <tr>
                                    <th scope="row"><?php echo $department->dept_id ?></th>
                                    <td><?php echo $department->dept_name ?></td>
                                    <td>
                                        <form method="post" action="dept_form_update.php" style="display: inline">
                                            <input type="text" name="dept_id" value="<?php echo $department->dept_id ?>" hidden>
                                            <input type="text" name="dept_name" value="<?php echo $department->dept_name ?>" hidden>
                                            <input type="submit" name="submit" class="btn btn-outline-warning" value="edit">
                                        </form>
                                        <form method="post" action="" style="display: inline">
                                            <input type="hidden" name="delDept">
                                            <input type="text" name="dept_id" value="<?php echo $department->dept_id ?>" hidden>
                                            <input onclick="return confirm('ต้องการลบข้อมูล ?')" type="submit" name="submit" class="btn btn-outline-danger" value="delete">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="dept_form.php" class="btn btn-outline-success btn-sm btn-block" style="margin-top: 10px;">เพิ่ม</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#department').DataTable()
    })
</script>