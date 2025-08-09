<?php
require 'authentication.php';

// Auth check
$user_id = $_SESSION['admin_id'];
$user_name = $_SESSION['name'];
$security_key = $_SESSION['security_key'];
if ($user_id == NULL || $security_key == NULL) {
    header('Location: index.php');
}

$page_name = "Task Statistics";
include("include/sidebar.php");

// Get statistics from employee_performance view instead of task_statistics
$sql = "SELECT ep.*, a.fullname 
        FROM employee_performance ep
        JOIN tbl_admin a ON ep.user_id = a.user_id
        ORDER BY ep.completion_rate DESC";
$stats = $obj_admin->manage_all_info($sql);
?>

<div class="row">
    <div class="col-md-12">
        <div class="well well-custom">
            <h2 class="text-center">Employee Performance Statistics</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Total Tasks</th>
                            <th>Completed Tasks</th>
                            <th>Completion Rate</th>
                            <th>Total Skills</th>
                            <th>Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $stats->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $row['fullname']; ?></td>
                            <td><?php echo $row['total_tasks']; ?></td>
                            <td><?php echo $row['completed_tasks']; ?></td>
                            <td><?php echo number_format($row['completion_rate'], 1); ?>%</td>
                            <td><?php echo $row['total_skills']; ?></td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-<?php 
                                        echo $row['completion_rate'] >= 75 ? 'success' : 
                                            ($row['completion_rate'] >= 50 ? 'info' : 
                                            ($row['completion_rate'] >= 25 ? 'warning' : 'danger')); 
                                        ?>" 
                                        role="progressbar" 
                                        aria-valuenow="<?php echo $row['completion_rate']; ?>" 
                                        aria-valuemin="0" 
                                        aria-valuemax="100" 
                                        style="width: <?php echo $row['completion_rate']; ?>%">
                                        <?php echo number_format($row['completion_rate'], 1); ?>%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?> 