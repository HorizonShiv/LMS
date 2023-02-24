
</div>
</div>
</div>


<!-- Jquery:js -->
<script src="../js/jquery.js"></script>

<!-- plugins:js -->
<script src="../vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="../vendors/chart.js/Chart.min.js"></script>
<script src="../vendors/datatables.net/jquery.dataTables.js"></script>
<script src="../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="../js/dataTables.select.min.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../js/off-canvas.js"></script>
<script src="../js/hoverable-collapse.js"></script>
<script src="../js/template.js"></script>
<script src="../js/settings.js"></script>
<script src="../js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="../js/dashboard.js"></script>
<script src="../js/Chart.roundedBarCharts.js"></script>
<!-- End custom js for this page-->

<!-- Custom js for this page-->
<script src="../js/file-upload.js"></script>
<script src="../js/typeahead.js"></script>
<script src="../js/select2.js"></script>
<!-- End custom js for this page-->

<script type="text/javascript">
  $(document).ready(function() {
    $('#table_data').DataTable();
  });
</script>

<script>
  $(function() {
    /* ChartJS
     * -------
     * Data and config for chartjs
     */
    "use strict";
    var data = {
      labels: [
        // Printing Year From database
        <?php
        if ($result_complaint_year->num_rows > 0) :
          foreach ($result_complaint_year as $row) :
            echo $row['year'] . ",";
          endforeach;
        endif;
        ?>
      ],
      datasets: [{
        label: "# of Complaints",
        data: [
          // Printing count of Complaints From database
          <?php
          if ($result_complaint_year->num_rows > 0) :
            foreach ($result_complaint_year as $row) :
              echo $row['complaint'] . ",";
            endforeach;
          endif;
          ?>
        ],
        backgroundColor: [
          "rgba(255, 99, 132, 0.2)",
          "rgba(54, 162, 235, 0.2)",
          "rgba(255, 206, 86, 0.2)",
          "rgba(75, 192, 192, 0.2)",
          "rgba(153, 102, 255, 0.2)",
          "rgba(255, 159, 64, 0.2)",
        ],
        borderColor: [
          "rgba(255,99,132,1)",
          "rgba(54, 162, 235, 1)",
          "rgba(255, 206, 86, 1)",
          "rgba(75, 192, 192, 1)",
          "rgba(153, 102, 255, 1)",
          "rgba(255, 159, 64, 1)",
        ],
        borderWidth: 1,
        fill: false,
      }, ],
    };

    var data1 = {
      labels: [
        <?php
        if ($result_complaint_month->num_rows > 0) :
          foreach ($result_complaint_month as $row) :
            echo  "\"" . $row['month'] . "\",";
          endforeach;
        endif;
        ?>
      ],
      datasets: [{
        label: "# of Complaints",
        data: [
          // Printing count of Complaints From database
          <?php
          if ($result_complaint_month->num_rows > 0) :
            foreach ($result_complaint_month as $row) :
              echo $row['complaint'] . ",";
            endforeach;
          endif;
          ?>
        ],
        backgroundColor: [
          "rgba(255, 99, 132, 0.2)",
          "rgba(247, 61, 147,0.2)",
          "rgba(161, 0, 53,0.2)",
          "rgba(15, 52, 96,0.2)",
          "rgba(54, 162, 235, 0.2)",
          "rgba(255, 206, 86, 0.2)",
          "rgba(75, 192, 192, 0.2)",
          "rgba(153, 102, 255, 0.2)",
          "rgba(255, 159, 64, 0.2)",
          // 
          "rgba(142, 151, 117,0.2)",
          "rgba(26, 77, 46,0.2)",
          "rgba(80,63,63,0.2)",

        ],
        borderColor: [
          "rgba(255,99,132,1)",
          "rgba(247, 61, 147,1)",
          "rgba(161, 0, 53,1)",
          "rgba(15, 52, 96,1)",
          "rgba(54, 162, 235, 1)",
          "rgba(255, 206, 86, 1)",
          "rgba(75, 192, 192, 1)",
          "rgba(153, 102, 255, 1)",
          "rgba(255, 159, 64, 1)",
          // 
          "rgba(142, 151, 117,1)",
          "rgba(26, 77, 46,1)",
          "rgba(80,63,63,1)",
        ],
        borderWidth: 1,
        fill: false,
      }, ],
    };

    var options = {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
          },
        }, ],
      },
      legend: {
        display: false,
      },
      elements: {
        point: {
          radius: 0,
        },
      },
    };

    var doughnutPieData = {
      datasets: [{
        data: [<?php echo $count_pending . "," . $count_progess . "," . $count_solved;  ?>],
        backgroundColor: [
          "rgba(255, 99, 132, 0.5)",
          "rgba(255, 206, 86, 0.5)",
          "rgba(54, 162, 235, 0.5)",
          "rgba(75, 192, 192, 0.5)",
          "rgba(153, 102, 255, 0.5)",
          "rgba(255, 159, 64, 0.5)",
        ],
        borderColor: [
          "rgba(255,99,132,1)",
          "rgba(255, 206, 86, 1)",
          "rgba(54, 162, 235, 1)",
          "rgba(75, 192, 192, 1)",
          "rgba(153, 102, 255, 1)",
          "rgba(255, 159, 64, 1)",
        ],
      }, ],

      // These labels appear in the legend and in the tooltips when hovering different arcs
      labels: ["Pending", "In Progress", "Completed"],
    };

    var doughnutPieOptions = {
      responsive: true,
      animation: {
        animateScale: true,
        animateRotate: true,
      },
    };

    // Get context with jQuery - using jQuery's .get() method.
    if ($("#barChart").length) {
      var barChartCanvas = $("#barChart").get(0).getContext("2d");
      // This will get the first returned node in the jQuery collection.
      var barChart = new Chart(barChartCanvas, {
        type: "bar",
        data: data,
        options: options,
      });
    }

    if ($("#barChart1").length) {
      var barChartCanvas = $("#barChart1").get(0).getContext("2d");
      // This will get the first returned node in the jQuery collection.
      var barChart = new Chart(barChartCanvas, {
        type: "bar",
        data: data1,
        options: options,
      });
    }

    if ($("#doughnutChart").length) {
      var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
      var doughnutChart = new Chart(doughnutChartCanvas, {
        type: "doughnut",
        data: doughnutPieData,
        options: doughnutPieOptions,
      });
    }

    if ($("#pieChart").length) {
      var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
      var pieChart = new Chart(pieChartCanvas, {
        type: "pie",
        data: doughnutPieData,
        options: doughnutPieOptions,
      });
    }

    if ($("#browserTrafficChart").length) {
      var doughnutChartCanvas = $("#browserTrafficChart")
        .get(0)
        .getContext("2d");
      var doughnutChart = new Chart(doughnutChartCanvas, {
        type: "doughnut",
        data: browserTrafficData,
        options: doughnutPieOptions,
      });
    }
  });
</script>

<script>
  function cnfdel() {
    var cnf = confirm("Are You Sure?");

    if (cnf == true) {
      return true;
    } else {
      return false;
    }
  }
</script>


</body>

</html>