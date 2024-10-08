<?php
require 'includes/conn.php';
loggedIn();
bills();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="POS - Bootstrap Admin Template">
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<meta name="robots" content="noindex, nofollow">
<title>Stock management</title>

<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/css/animate.css">

<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div id="global-loader">
<div class="whirly-loader"> </div>
</div>

<div class="main-wrapper">

<?php 
include './includes/head.php';
?>


<div class="sidebar" id="sidebar">
<div class="sidebar-inner slimscroll">
<div id="sidebar-menu" class="sidebar-menu">
<ul>
<li class="active">
<a href="dashboard.php"><img src="assets/img/icons/dashboard.svg" alt="img"><span> Dashboard</span> </a>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span>Stock</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="stock.php">Stock List</a></li>
<li><a href="new_stock.php">New Stock</a></li>
<li><a href="add-purchase.php">Add Stock</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/sales1.svg" alt="img"><span> Sales</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="bills.php">Sales List</a></li>
<li><a href="new_bill.php">New Sales</a></li>

</ul>
</li>

<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/expense1.svg" alt="img"><span> Expense</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="expense.php">Expense List</a></li>
<li><a href="new_expense.php">Add Expense</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span> Users</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="user.php">New User </a></li>
<li><a href="user.php">Users List</a></li>
</ul>
</li>

<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/time.svg" alt="img"><span> Report</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="report.php" class="">Sales Report</a></li>
<!-- <li><a href="invoicereport.html">Invoice Report</a></li>
<li><a href="purchasereport.html">Purchase Report</a></li>
<li><a href="supplierreport.html">Supplier Report</a></li>
 <li><a href="customerreport.html">Customer Report</a></li> -->
</ul>
</li>

</ul>
</div>
</div>
</div>

<div class="page-wrapper">
<div class="content">
<div class="row">
<div class="col-lg-3 col-sm-6 col-12">
<div class="dash-widget">
<div class="dash-widgetimg">
<span><img src="assets/img/icons/dash1.svg" alt="img"></span>
</div>
<div class="dash-widgetcontent">
<?php 
        $query = "SELECT SUM((quantity*cost)) AS total FROM `purchase` WHERE dates >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);
    ?>
<h5>RWF <span class="counters" data-count="<?=$row['total']; ?>"></span></h5>
<h6>3 months Total Purchase</h6>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="dash-widget dash1">
<div class="dash-widgetimg">
<span><img src="assets/img/icons/dash2.svg" alt="img"></span>
</div>
<div class="dash-widgetcontent">
<?php 
        $query1 = "SELECT SUM(amount) AS expenseAmount FROM `expense` WHERE dates >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)";
        $expense = mysqli_query($conn,$query1);
        $expenseAmount = mysqli_fetch_array($expense);
    ?>
<h5>RWF <span class="counters" data-count="<?= $expenseAmount['expenseAmount']; ?>"></span></h5>
<h6>3 Months Total Expense</h6>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="dash-widget dash2">
<div class="dash-widgetimg">
<span><img src="assets/img/icons/dash3.svg" alt="img"></span>
</div>
<div class="dash-widgetcontent">
<?php 
        $query2 = "SELECT SUM(profit_amount) AS profit FROM `report` WHERE dates >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)";
        $profit = mysqli_query($conn,$query2);
        $profitAmount = mysqli_fetch_array($profit);
    ?>
<h5>RWF <span class="counters" data-count="<?= $profitAmount['profit'] ?>"></span></h5>
<h6>3 Months Profit Amount</h6>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="dash-widget dash3">
<div class="dash-widgetimg">
<span><img src="assets/img/icons/dash4.svg" alt="img"></span>
</div>
<div class="dash-widgetcontent">
<?php 
        $query3 = "SELECT SUM(quantity*cost) AS totalSales FROM `bill_items` WHERE dateon >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)";
        $sales = mysqli_query($conn,$query3);
        $totalSales = mysqli_fetch_array($sales);
    ?>
<h5>RWF <span class="counters" data-count="<?=$totalSales['totalSales'] ?>"></span></h5>
<h6>3 Months Sale Amount</h6>
</div>
</div>
</div>

 
<div class="col-lg-3 col-sm-6 col-12 d-flex">
<div class="dash-count das2">
<div class="dash-counts">
<h4>Today</h4>
<?php 
$query4 = "SELECT SUM(quantity * cost) AS dayTotal
FROM `bill_items`
WHERE DATE(dateon) = CURDATE();
";

$today = mysqli_query($conn,$query4);
$dayTotal = mysqli_fetch_array($today);
?>
<?php
$query5 = "SELECT SUM((quantity*cost)) AS total FROM `purchase` WHERE DATE(dates) = CURDATE();";

$purchase = mysqli_query($conn,$query5);
$dayPurchase = mysqli_fetch_array($purchase);
?>
<h5><b>Sell:</b> RWF <?=number_format($dayTotal['dayTotal'])?></h5>
<h5><b>Buy:</b> RWF <?=number_format($dayPurchase['total'])?></h5>
</div>
<div class="dash-imgs">
<i data-feather="file-text"></i>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12 d-flex">
<div class="dash-count das2">
<div class="dash-counts">
<h4>Monthly</h4>
<?php 
$query6 = "SELECT SUM(quantity * cost) AS dayTotal
FROM `bill_items`
WHERE dateon >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);
";

$mon = mysqli_query($conn,$query6);
$monTotal = mysqli_fetch_array($mon);
?>
<?php
$query7 = "SELECT SUM((quantity*cost)) AS total FROM `purchase` WHERE dates >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);";

$monPurc = mysqli_query($conn,$query7);
$monPurchase = mysqli_fetch_array($monPurc);
?>
<h5><b>Sell:</b> RWF <?=number_format($monTotal['dayTotal'])?></h5>
<h5><b>Buy:</b> RWF <?=number_format($monPurchase['total'])?></h5>
</div>
<div class="dash-imgs">
<i data-feather="file-text"></i>
</div>
</div>
</div>

</div>

<div class="card mb-0">

</div>
</div>
</div>
</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/js/jquery.slimscroll.min.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="assets/plugins/apexchart/chart-data.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>