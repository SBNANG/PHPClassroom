<?php
include_once 'includes/header.php';
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

$sql = "SELECT * FROM employee e
            INNER JOIN department ON e.dept_id = department.dept_id
            INNER JOIN work_type ON e.work_type_id = work_type.work_type_id
            INNER JOIN emp_type ON e.emp_type_id = emp_type.emp_type_id";
$stmt = $objUser->runQuery($sql);
$stmt->execute();
$employee = $stmt->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {
    if (isset($_POST['delEmp'])) {
        if ($objUser->delete($_POST['emp_id'])) {
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
    <div class="row" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <canvas id="myChart" width="300" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="display animate__animated animate__pulse" id="employee" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ชื่อพนักงาน</th>
                                <th scope="col">เพศ</th>
                                <th scope="col">แผนก/ฝ่าย</th>
                                <th scope="col">ประเภทงาน</th>
                                <th scope="col">ประเภทพนักงาน</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employee as $employee) : ?>
                                <tr>
                                    <th scope="row"><?php echo $employee->emp_id ?></th>
                                    <td><?php echo $employee->emp_name ?></td>
                                    <td><?php if ($employee->gender == "m") {
                                            echo "ชาย";
                                        } else {
                                            echo "หญิง";
                                        } ?></td>
                                    <td><?php echo $employee->dept_name ?></td>
                                    <td><?php echo $employee->work_type_name ?></td>
                                    <td><?php echo $employee->emp_type ?></td>
                                    <td>
                                        <form method="post" action="emp_form_update.php" style="display: inline">
                                            <input type="text" name="emp_id" value="<?php echo $employee->emp_id ?>" hidden>
                                            <input type="text" name="emp_name" value="<?php echo $employee->emp_name ?>" hidden>
                                            <input type="text" name="gender" value="<?php echo $employee->gender ?>" hidden>
                                            <input type="text" name="dept_id" value="<?php echo $employee->dept_id ?>" hidden>
                                            <input type="text" name="work_type_id" value="<?php echo $employee->work_type_id ?>" hidden>
                                            <input type="text" name="emp_type_id" value="<?php echo $employee->emp_type_id ?>" hidden>
                                            <input type="submit" name="submit" class="btn btn-outline-warning" value="แก้ไข">
                                        </form>
                                        <form method="post" action="" style="display: inline">
                                            <input type="hidden" name="delEmp">
                                            <input type="text" name="emp_id" value="<?php echo $employee->emp_id ?>" hidden>
                                            <input onclick="return confirm('ต้องการลบข้อมูล ?')" type="submit" name="submit" class="btn btn-outline-danger" value="ลบ">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="emp_form.php" class="btn btn-outline-success btn-sm btn-block" style="margin-top: 10px;">เพิ่ม</a>
                </div>
            </div>

        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $('#employee').DataTable()
    })
    let name = []
    let marks = []
    $.post("graph.php", (data) => {
        for (let i in data) {
            name.push(data[i].emp_type);
            marks.push(data[i].count_emp_type);
        }
    })


    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: name,
            datasets: [{
                label: 'จำนวนพนักงานแต่ละประเภท',
                data: marks,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>