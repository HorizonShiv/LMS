    <?php require_once("../backend/cls_select.php"); ?>
    <?php

    if (isset($_SESSION['success_login']) != TRUE) {
      header('Location:login.php');
    }

    $count_pending = 0;
    $count_progess = 0;
    $count_solved = 0;
    
    ?>
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="row">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Welcome
                  <?php
                  if (isset($_SESSION['Admin']) == true) {
                    echo $_SESSION['Admin_name'].' ('.$_SESSION['Admin'].')';
                  } elseif (isset($_SESSION['manager']) == true) {
                    echo $_SESSION['manager_name'].' ('.$_SESSION['manager'].')';
                  } elseif (isset($_SESSION['student']) == true) {
                    echo $_SESSION['student_name'].' ('.$_SESSION['student'].')';
                  }
                  ?></h3> <h6>Sal Education - Complaint Management Portal!</h6>
              </div>
            </div>
          </div>
        </div>



        <?php
        if (isset($_SESSION['Admin']) == true || isset($_SESSION['manager']) == true){


          $obj_complaint = new GetComplaint();
          $result_complaint  = $obj_complaint->ComplaintGet();
          $result_complaint_year  = $obj_complaint->ComplaintGetByYear();
          $result_complaint_month  = $obj_complaint->ComplaintGetByMonth();

          if ($result_complaint->num_rows > 0) {

            foreach ($result_complaint as $row) {

              if ($row['status'] == 0) {
                $count_pending++;
              } elseif ($row['status'] == 1) {
                $count_progess++;
              } elseif ($row['status'] == 2) {
                $count_solved++;
              }
            }
          }

          $obj_user = new Get();
          $result_lab = $obj_user->GetAllUser();

          if ($result_lab->num_rows > 0) {
            $count_technician = 0;
            $count_student = 0;

            foreach ($result_lab as $row) {

              if ($row['role'] == 1) {
                $count_technician++;
              } elseif ($row['role'] == 2) {
                $count_student++;
              }
            }
          }

          $obj_lab = new Get();
          $result_lab = $obj_lab->GetLab();

          if ($result_lab->num_rows > 0) {
            $count_lab = 0;
            foreach ($result_lab as $row) {
              $count_lab++;
            }
          }

          }

        if (isset($_SESSION['Admin']) == true) :
        ?>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="../images/dashboard/people.svg" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h3 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>
                          <?php
                          echo date("d/m/Y")
                          ?>
                        </h3>
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-normal">Ahmedabad</h4>
                        <h6 class="font-weight-normal">India</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Pending Complaints</p>
                      <p class="fs-30 mb-2"><?php echo $count_pending; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>

                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">In Progess Complaints</p>
                      <p class="fs-30 mb-2"><?php echo $count_progess; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>

                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Solved Complaints</p>
                      <p class="fs-30 mb-2"><?php echo $count_solved; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>

                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Total Complaints</p>
                      <p class="fs-30 mb-2"><?php echo $count_pending + $count_progess + $count_solved; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Total Studnets</p>
                      <p class="fs-30 mb-2"><?php echo $count_student; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Technicians</p>
                      <p class="fs-30 mb-2"><?php echo $count_technician; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Labs</p>
                      <p class="fs-30 mb-2"><?php echo $count_lab; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">yearly Complaints</h4>
                  <canvas id="barChart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Total Complaints</h4>
                  <canvas id="doughnutChart"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-1"></div>
            <div class="col-lg-10 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Monthly Complaints</h4>
                  <canvas id="barChart1"></canvas>
                </div>
              </div>
            </div>
          </div>

        <?php
        endif;
        ?>

        <?php
        if (isset($_SESSION['manager']) == true) :
        ?>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="../images/dashboard/people.svg" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h3 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>
                          <?php
                          echo date("d/m/Y")
                          ?>
                        </h3>
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-normal">Ahmedabad</h4>
                        <h6 class="font-weight-normal">India</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Pending</p>
                      <p class="fs-30 mb-2"><?php echo $count_pending; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">In Progess </p>
                      <p class="fs-30 mb-2"><?php echo $count_progess; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Completed</p>
                      <p class="fs-30 mb-2"><?php echo $count_solved; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Total Complaints</p>
                      <p class="fs-30 mb-2"><?php echo $count_pending + $count_progess + $count_solved; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        <?php
        endif;
        ?>

        <?php
        if (isset($_SESSION['student']) == true) :
          $obj = new GetComplaint();
          $obj->id = $_SESSION['student'];
          $result_complaint  = $obj->ComplaintGetStudent();

          if ($result_complaint->num_rows > 0) {

            foreach ($result_complaint as $row) {
              if ($row['status'] == 0) {
                $count_pending++;
              } elseif ($row['status'] == 1) {
                $count_progess++;
              } elseif ($row['status'] == 2) {
                $count_solved++;
              }
            }
          }
        ?>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="../images/dashboard/people.svg" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h3 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>
                          <?php
                          echo date("d/m/Y")
                          ?>
                        </h3>
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-normal">Ahmedabad</h4>
                        <h6 class="font-weight-normal">India</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Pending</p>
                      <p class="fs-30 mb-2"><?php echo $count_pending; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">In Progess </p>
                      <p class="fs-30 mb-2"><?php echo $count_progess; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Completed</p>
                      <p class="fs-30 mb-2"><?php echo $count_solved; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Total Complaints</p>
                      <p class="fs-30 mb-2"><?php echo $count_pending + $count_progess + $count_solved; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        <?php
        endif;
        ?>


      </div>
    </div>