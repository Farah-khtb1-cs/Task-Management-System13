<?php

require 'authentication.php'; // admin authentication check 

// auth check
$user_id = $_SESSION['admin_id'];
$user_name = $_SESSION['name'];
$security_key = $_SESSION['security_key'];
if ($user_id == NULL || $security_key == NULL) {
    header('Location: index.php');
}

// check admin
$user_role = $_SESSION['user_role'];


if(isset($_GET['delete_task'])){
  $action_id = $_GET['task_id'];
  
  $sql = "DELETE FROM task_info WHERE task_id = :id";
  $sent_po = "task-info.php";
  $obj_admin->delete_data_by_this_method($sql,$action_id,$sent_po);
}

if(isset($_POST['add_task_post'])){
    $obj_admin->add_new_task($_POST);
}

$page_name="Task_Info";
include("include/sidebar.php");
// include('ems_header.php');


?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog add-category-modal">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title text-center">Assign New Task</h2>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <form role="form" action="" method="post" autocomplete="off">
                <div class="form-horizontal">
                  <div class="form-group">
                    <label class="control-label col-sm-5">Task Title</label>
                    <div class="col-sm-7">
                      <input type="text" placeholder="Task Title" id="task_title" name="task_title" list="expense" class="form-control" id="default" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-5">Task Description</label>
                    <div class="col-sm-7">
                      <textarea name="task_description" id="task_description" placeholder="Text Deskcription" class="form-control" rows="5" cols="5"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-5">Start Time</label>
                    <div class="col-sm-7">
                      <input type="text" name="t_start_time" id="t_start_time" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-5">End Time</label>
                    <div class="col-sm-7">
                      <input type="text" name="t_end_time" id="t_end_time" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-5">Required Skill</label>
                    <div class="col-sm-7">
                      <select name="required_skill" id="required_skill" class="form-control" required onchange="updateEmployeeList()">
                        <option value="">Select Required Skill...</option>
                        <?php
                        // Get unique skills from employee_skills table
                        $sql = "SELECT DISTINCT skill_name FROM employee_skills ORDER BY skill_name";
                        $skills = $obj_admin->manage_all_info($sql);
                        while($skill = $skills->fetch(PDO::FETCH_ASSOC)) {
                          echo "<option value='" . htmlspecialchars($skill['skill_name']) . "'>" . htmlspecialchars($skill['skill_name']) . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-5">Assign To</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="assign_to" id="assign_to" required>
                        <option value="">Select Employee...</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-3">
                      <button type="submit" name="add_task_post" class="btn btn-success-custom">Assign Task</button>
                    </div>
                    <div class="col-sm-3">
                      <button type="submit" class="btn btn-danger-custom" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </form> 
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>





    <div class="row">
      <div class="col-md-12">
        <div class="well well-custom">
          <div class="gap"></div>
          <div class="row">
            <div class="col-md-8">
              <div class="btn-group">
                <?php if($user_role == 1){ ?>
                <div class="btn-group">
                  <button class="btn btn-warning btn-menu" data-toggle="modal" data-target="#myModal">Assign New Task</button>
                </div>
              <?php } ?>
              <div class="btn-group">
                <a href="task-statistics.php" class="btn btn-info btn-menu">View Statistics</a>
              </div>
              </div>

            </div>

            
          </div>
          <center ><h3>Task Management Section</h3></center>
          <div class="gap"></div>

          <div class="gap"></div>

          <div class="table-responsive">
            <table class="table table-codensed table-custom">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Task Title</th>
                  <th>Assigned To</th>
                  <th>Required Skill</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Status</th>
                  <?php if($user_role == 2) { ?>
                  <th>Assignment</th>
                  <?php } ?>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

              <?php 
                if($user_role == 1){
                  $sql = "SELECT a.*, b.fullname, e.proficiency_level 
                        FROM task_info a
                        INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id)
                        LEFT JOIN employee_skills e ON(b.user_id = e.user_id AND a.required_skill = e.skill_name)
                        ORDER BY a.task_id DESC";
                }else{
                  $sql = "SELECT a.*, b.fullname, e.proficiency_level 
                  FROM task_info a
                  INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id)
                  LEFT JOIN employee_skills e ON(b.user_id = e.user_id AND a.required_skill = e.skill_name)
                  WHERE a.t_user_id = $user_id
                  ORDER BY a.task_id DESC";
                } 
                
                  $info = $obj_admin->manage_all_info($sql);
                  $serial  = 1;
                  $num_row = $info->rowCount();
                  if($num_row==0){
                    echo '<tr><td colspan="7">No Data found</td></tr>';
                  }
                      while( $row = $info->fetch(PDO::FETCH_ASSOC) ){
              ?>
                <tr>
                  <td><?php echo $serial; $serial++; ?></td>
                  <td><?php echo $row['t_title']; ?></td>
                  <td><?php echo $row['fullname']; ?> 
                      <?php if($row['proficiency_level']) echo "(" . $row['proficiency_level'] . ")"; ?>
                  </td>
                  <td><?php echo $row['required_skill']; ?></td>
                  <td><?php echo $row['t_start_time']; ?></td>
                  <td><?php echo $row['t_end_time']; ?></td>
                  <td>
                    <?php  if($row['status'] == 1){
                        echo "In Progress <span style='color:#d4ab3a;' class=' glyphicon glyphicon-refresh' >";
                    }elseif($row['status'] == 2){
                       echo "Completed <span style='color:#00af16;' class=' glyphicon glyphicon-ok' >";
                    }else{
                      echo "Incomplete <span style='color:#d00909;' class=' glyphicon glyphicon-remove' >";
                    } ?>
                    
                  </td>
                  <?php if($user_role == 2 && $row['assignment_status'] == 'pending') { ?>
                    <td>
                      <button class="btn btn-xs btn-success" onclick="updateAssignmentStatus(<?php echo $row['task_id']; ?>, 'accepted')">Accept</button>
                      <button class="btn btn-xs btn-danger" onclick="updateAssignmentStatus(<?php echo $row['task_id']; ?>, 'rejected')">Reject</button>
                    </td>
                  <?php } else { ?>
                    <td>
                      <span class="label label-<?php 
                        echo $row['assignment_status'] == 'accepted' ? 'success' : 
                            ($row['assignment_status'] == 'rejected' ? 'danger' : 'warning'); 
                      ?>">
                        <?php echo ucfirst($row['assignment_status']); ?>
                      </span>
                    </td>
                  <?php } ?>
                 <td><a title="Update Task"  href="edit-task.php?task_id=<?php echo $row['task_id'];?>"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
                  <a title="View" href="task-details.php?task_id=<?php echo $row['task_id']; ?>"><span class="glyphicon glyphicon-folder-open"></span></a>&nbsp;&nbsp;
                  <?php if($user_role == 1){ ?>
                  <a title="Delete" href="?delete_task=delete_task&task_id=<?php echo $row['task_id']; ?>" onclick=" return check_delete();"><span class="glyphicon glyphicon-trash"></span></a></td>
                <?php } ?>
                </tr>
                <?php } ?>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


<?php

include("include/footer.php");



?>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script type="text/javascript">
  flatpickr('#t_start_time', {
    enableTime: true
  });

  flatpickr('#t_end_time', {
    enableTime: true
  });

</script>

<script>
function updateEmployeeList() {
  const skill = document.getElementById('required_skill').value;
  const assignSelect = document.getElementById('assign_to');
  
  // Clear current options
  assignSelect.innerHTML = '<option value="">Select Employee...</option>';
  
  if(skill) {
    // Fetch employees with the selected skill using AJAX
    fetch('get_skilled_employees.php?skill=' + encodeURIComponent(skill))
      .then(response => response.json())
      .then(employees => {
        employees.forEach(emp => {
          const option = document.createElement('option');
          option.value = emp.user_id;
          option.textContent = `${emp.fullname} (${emp.proficiency_level})`;
          assignSelect.appendChild(option);
        });
      });
  }
}
</script>

<script>
function updateAssignmentStatus(taskId, status) {
  if(confirm('Are you sure you want to ' + status + ' this task?')) {
    fetch('update_assignment_status.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        task_id: taskId,
        status: status
      })
    })
    .then(response => response.json())
    .then(data => {
      if(data.success) {
        location.reload();
      } else {
        alert('Error updating assignment status');
      }
    });
  }
}
</script>
