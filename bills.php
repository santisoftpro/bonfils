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
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<meta name="robots" content="noindex, nofollow">
<title>Bills</title>

<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/css/animate.css">

<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

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

<div class="header">

<div class="header-left active">
<a href="index.html" class="logo">
<img src="assets/img/logo.png" alt="">
</a>
<a href="index.html" class="logo-small">
<img src="assets/img/logo-small.png" alt="">
</a>
<a id="toggle_btn" href="javascript:void(0);">
</a>
</div>

<a id="mobile_btn" class="mobile_btn" href="#sidebar">
<span class="bar-icon">
<span></span>
<span></span>
<span></span>
</span>
</a>

<ul class="nav user-menu">

<li class="nav-item">
<div class="top-nav-search">
<a href="javascript:void(0);" class="responsive-search">
<i class="fa fa-search"></i>
</a>
<form action="#">
<div class="searchinputs">
<input type="text" placeholder="Search Here ...">
<div class="search-addon">
<span><img src="assets/img/icons/closes.svg" alt="img"></span>
</div>
</div>
<a class="btn" id="searchdiv"><img src="assets/img/icons/search.svg" alt="img"></a>
</form>
</div>
</li>

</ul>

</div>

<div class="sidebar" id="sidebar">
<div class="sidebar-inner slimscroll">
<div id="sidebar-menu" class="sidebar-menu">
<ul>
<li class="">
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
<li><a href="bills.php" class="active">Sales List</a></li>
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
<li><a href="create_user.php">New User </a></li>
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
<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/settings.svg" alt="img"><span>Log Out</span> <span class="menu-arrow"></span></a>


</li>
</ul>
</div>
</div>
</div>


<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Sales List</h4>
<h6>Manage your sales</h6>
</div>
<div class="page-btn">
<a href="new_bill.php" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Add Sales</a>
</div>
</div>

<div class="card">
<div class="card-body">
<div class="table-top">
<div class="search-set">
<div class="search-path">
<a class="btn btn-filter" id="filter_search">
<img src="assets/img/icons/filter.svg" alt="img">
<span><img src="assets/img/icons/closes.svg" alt="img"></span>
</a>
</div>
<div class="search-input">
<a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
</div>
</div>
<div class="wordset">
<ul>
<li>
<a id="exportExcel" data-bs-toggle="tooltip" data-bs-placement="top" title="Export to Excel">
            <img src="assets/img/icons/excel.svg" alt="Export to Excel">
        </a>
</li>
<li>
<a id="printTable" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Table">
            <img src="assets/img/icons/printer.svg" alt="Print Table">
        </a>
</li>
</ul>
</div>
</div>
<form action="bills.php" method="get" class="change-date">
<div class="card" id="filter_inputs">
<div class="card-body pb-0">
<div class="row">

<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<?php if (isset($_GET['user_id'])) { ?>
    <input type="hidden"  name="user_id" value="<?= $_GET['user_id'] ?>">
<?php } ?>
<input type="date" name="date" value="<?= $date ?>" required>
</div>
</div>

<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<button type="submit" class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg" alt="img"></button>

</div>
</div>
</div>
</div>
</div>
</form>
<div class="table-responsive">
<?php
if ($bills->num_rows) {
    $n = 0;
   
   $totals = 0; ?>
<table class="table  datanew">
<thead>
<tr>
<th>
<label class="checkboxs">
<input type="checkbox" id="select-all">
<span class="checkmarks"></span>
</label>
</th>
<th>By User</th>
<th>Time</th>
<th>Client</th>
<th>Item Name</th>
<th>Quantity</th>
<th>Total</th>

<th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php foreach ($bills as $bill) {
$items = explode(",", $bill['items']);
$qty = explode(",", $bill['quantity']);
$totals += $bill['total']; ?>
<tr>
<td>
<label class="checkboxs">
<span class="checkmarks"></span>
</label>
</td>
<td><?= $bill['name'] ?></td>
<td> <?= date_format(date_create($bill['done_on']), 'h:i') ?></td>
<td> <?= $bill['client'] ?></td>
<td><ol>
    <?php foreach ($items as $item) { ?>
      
            <?= $item ?>
        </li>
    <?php } ?>
</ol></td>
<td>  <span class="badges bg-lightgreen"> <?= $bill['quantity'] ?></span></td>
<td><span class="badges bg-primary"> <?= $bill['total'] ?></span></td>

<td class="text-center">
<a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
</a>
<ul class="dropdown-menu">
<li>
<a href="sales-details.html" class="dropdown-item"><img src="assets/img/icons/eye1.svg" class="me-2" alt="img">Sale Detail</a>
</li>
<li>
<a href="edit-sales.html" class="dropdown-item"><img src="assets/img/icons/edit.svg" class="me-2" alt="img">Edit Sale</a>
</li>

<li>
<button href="javascript:void(0);" class="dropdown-item confirm-text"><img src="assets/img/icons/delete1.svg" class="me-2" alt="img">Delete Sale</button>
</li>
</ul>
</td>
</tr>


<?php } ?>
</tbody>
</table>
<?php if ($_SESSION['stock']['role'] == 'admin') { ?>
<div class="pad-big centered">
<strong> TOTAL:
    <?php echo $totals ?>
</strong>
</div>
<?php } ?>
<?php } else { ?>
<p>Nothing was found on that day</p>
<?php } ?>
</div>
</div>
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

<script src="assets/plugins/select2/js/select2.min.js"></script>

<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>


<script src="assets/js/script.js"></script>

<script>
    document.getElementById('exportExcel').addEventListener('click', function() {
        var table = document.querySelector('.datanew');
        var wb = XLSX.utils.table_to_book(table, { sheet: "Sheet JS" });
        XLSX.writeFile(wb, 'stock_data.xlsx');
    });

    document.getElementById('printTable').addEventListener('click', function() {
        var printContents = document.querySelector('.table-responsive').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload(); // Reload the page to restore the original state
    });
</script>

</body>
</html>