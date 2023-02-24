<!-- INCLUDE HEADER -->
<?php include '../inc/header.php'; ?>

<!-- INCLUDE SIDEBAR -->
<?php include '../inc/sidebar.php'; ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Change Password</h4>
                        <p class="card-description">
                            Fill it correctly
                        </p>

                        <form class="forms-sample" method="post" action="../backend/DB_update.php" enctype="multipart/form-data" onsubmit="return validate();">

                            <!-- Old PW -->
                            <div class="form-group">
                                <label for="pc_no">Existing Password</label>
                                <input type="password" class="form-control" name="old_pw" id="" placeholder="Enter Existing Password" required>
                            </div>

                            <!-- NEW PW -->
                            <div class="form-group">
                                <label for="pc_no">New Password</label>
                                <input type="password" class="form-control" name="new_pw" id="ps" placeholder="Enter New Password" required>
                            </div>

                            <!-- RE-ENTER PW -->
                            <div class="form-group">
                                <label for="pc_no">Re-enter New Password</label>
                                <input type="password" class="form-control" name="rnew_pw" id="cps" placeholder="Re-Enter New Password" required>
                                <small id="errorprint"></small>
                            </div>

                            <!-- Submit Button-->
                            <button type="submit" class="btn btn-primary mr-2" name="change_password">Submit</button>
                            <button type="reset" class="btn btn-light">Reset</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chnage Password Validation -->
<script>
    function validate() {
        var ps = document.getElementById('ps').value;
        var cps = document.getElementById('cps').value;
        var error = document.getElementById('errorprint');

        if (ps == cps) {
            alert("Password Change Successully.")
            return true;
        } else {
            error.innerHTML = "password must be same";
            return false;
        }
    }
</script>
<!-- INCLUDE FOOTER -->
<?php include '../inc/footer.php'; ?>