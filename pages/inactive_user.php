<!-- INCLUDE HEADER -->
<?php include '../inc/header.php'; ?>

<!-- INCLUDE SIDEBAR -->
<?php include '../inc/sidebar.php'; ?>

<!-- INCLUDE  -->
<?php
require_once("../backend/cls_select.php");
?>

<!-- Student List Complaints -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <?php
            if (isset($_SESSION['Admin']) == true) :
                $obj = new Get();
                $result_inactive  = $obj->InactiveUser();
            ?>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">View Students</h4>
                            <p class="card-description">
                                List of <code>Students</code>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table_data">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>User Name</th>
                                            <th>Mobile Number</th>
                                            <th>Email ID</th>
                                            <th>User Role</th>
                                            <th>Action</th>
                                            <th>User status (Inactive)</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($result_inactive->num_rows > 0) :
                                            foreach ($result_inactive as $row) :
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['user_id']; ?></td>

                                                    <td><?php echo $row['name']; ?></td>

                                                    <td><?php echo $row['mobile_number']; ?></td>

                                                    <td><?php echo $row['email']; ?></td>

                                                    <td>
                                                        <?php 
                                                            if($row['role']==1){
                                                            echo 'Technician'; 
                                                            }
                                                            elseif($row['role']==2){
                                                                echo 'Students';
                                                            }
                                                            ?>
                                                    </td>

                                                    <td><?php echo '<a onclick="return cnfdel();" class="btn btn-outline-danger" href="../backend/DB_delete.php?in_user_id='.$row['user_id'].'">Delete</a>'; ?></td>

                                                    <td><?php echo '<a onclick="return cnfdel();" class="btn btn-danger btn-rounded btn-fw" href="../backend/DB_update.php?inactive_user_id='.$row['user_id'].'">Inactive</a>'; ?></td>

                                                </tr>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endif;
            ?>
        </div>

        </div>
    </div>
</div>
<!-- INCLUDE FOOTER -->
<?php include '../inc/footer.php'; ?>