<?php
session_start();
require_once("../backend/cls_select.php");


if (isset($_SESSION['Admin']) == true) {
	if (isset($_GET['sDate']) == true && isset($_GET['eDate']) == true) {


		$obj = new GetComplaint();
		$obj->sDate = $_GET['sDate'];
		$obj->eDate = $_GET['eDate'];

		$result_complaint  = $obj->ComplaintGetByDate();


		if ($result_complaint->num_rows > 0) {

			$data = '<html>
					<head>
					<style>
					
					table {
					
						/* Table Styles */
						
						.table-wrapper{
							margin: 40px 5px 0px 5px;
							
						}
						
						.fl-table {
							border-radius: 5px;
							font-size: 12px;
							font-weight: normal;
							border: none;
							border-collapse: collapse;
							width: 100%;
							max-width: 100%;
							white-space: nowrap;
							background-color: white;
						}
						
						.fl-table td, .fl-table th {
							text-align: center;
							padding: 8px;
						}
						
						.fl-table td {
							border-right: 1px solid #f8f8f8;
							font-size: 12px;
						}
						
						.fl-table thead th {
							color: #ffffff;
							background: #324960;
						}
						
						
						.fl-table thead th:nth-child(odd) {
							color: #ffffff;
							background: #324960;
						}
						
						.fl-table tr:nth-child(even) {
							background: #F8F8F8;
						}

						th,td:first-child{
							border: none;
						}
					}
					
					</style>
					</head>
					<body><br><br>
					<div class="table-wrapper">
						<table class="fl-table">
							<thead>
								<tr>
									<th>Complaint ID</th>
									<th>User ID</th>
									<th>PC ID</th>
									<th>Lab Number</th>
									<th>Complaint Type</th>
									<th>Complaint Description</th>
									<th>Date</th>
									<th>Time</th>
									<th>Status</th>
								</tr>
							</thead><tbody>';

			foreach ($result_complaint as $row) {

				if ($row['status'] == 0) {
					$status_type = "Pending";
				} elseif ($row['status'] == 1) {
					$status_type = "In progress";
				} elseif ($row['status'] == 2) {
					$status_type = "Compeleted";
				}

				$data .= '<tr><td>' . $row['complaint_id'] . '</td><td>' . $row['user_id'] . '</td><td>' . $row['err_id'] . '</td><td>' . $row['cat_no'] . '</td><td>' . $row['complaint_type'] . '</td><td>' . $row['complaint_desc'] . '</td><td>' . $row['date'] . '</td><td>' . $row['time'] . '</td><td>' . $status_type . '</td></tr>';
			}
			$data .= '</table>
			</div>
					</body>
					</html>';
		} else {
			header('Location:../error/error-500.php');
		}

		$data1='<html>
		<head>
		</head>
		<body>
			<img src="../images/SALPDF.jpg" height="50px" width="100px"/>
		</body>
		</html>
		';


		require_once("../vendor/autoload.php");
		$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);


		$mpdf->defaultheaderfontsize = 10;
		
		$mpdf->defaultheaderline = 0;
		$mpdf->setAutoTopMargin='stretch';
	
		$mpdf->defaultfooterline = 0;

		$date = date("d-m-Y");
		$mpdf->SetHeader($data1.'| Complaint List |' . $date);
		
		$mpdf->WriteHTML($data);
		$mpdf->SetFooter(' | | Signature of HOD');






		$file_name = date("d-m-y") . ".pdf";

		$mpdf->output($file_name, 'D');
	}
}
