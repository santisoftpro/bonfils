<button?php
require 'includes/conn.php';
loggedIn();
$items = getAll('items');
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
<title>Add Expanse</title>

<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

<link rel="stylesheet" href="assets/css/animate.css">

<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

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
    <li>
    <a href="index.html"><img src="assets/img/icons/dashboard.svg" alt="img"><span> Dashboard</span> </a>
    </li>
    <li class="submenu">
    <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span>Stock</span> <span class="menu-arrow"></span></a>
    <ul>
    <li><a href="productlist.html">Stock List</a></li>
    <li><a href="addproduct.html">New Stock</a></li>
    <li><a href="addpurchase.html">Add Stock</a></li>
    </ul>
    </li>
    <li class="submenu">
    <a href="javascript:void(0);"><img src="assets/img/icons/sales1.svg" alt="img"><span> Sales</span> <span class="menu-arrow"></span></a>
    <ul>
    <li><a href="saleslist.html">Sales List</a></li>
    <li><a href="add-sales.html">New Sales</a></li>
    
    </ul>
    </li>
    
    <li class="submenu">
    <a href="javascript:void(0);"><img src="assets/img/icons/expense1.svg" alt="img"><span> Expense</span> <span class="menu-arrow"></span></a>
    <ul>
    <li><a href="expenselist.html">Expense List</a></li>
    <li><a href="createexpense.html" class="active">Add Expense</a></li>
    </ul>
    </li>
    <li class="submenu">
    <a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span> Users</span> <span class="menu-arrow"></span></a>
    <ul>
    <li><a href="newuser.html">New User </a></li>
    <li><a href="userlists.html">Users List</a></li>
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
<h4>Expense Add</h4>
<h6>Add/Update Expenses</h6>
</div>
</div>
<form action="expansei_code.php" method="post">
<div class="card">
<div class="card-body">
<div class="row">

<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Amount</label>
<div class="input-groupicon">
<input type="number" name="amount">
<div class="addonset">
<img src="assets/img/icons/dollar.svg" alt="img">
</div>
</div>
</div>
</div>

<div class="col-lg-12">
<div class="form-group">
<label>Description</label>
<textarea class="form-control" name="description"></textarea>
</div>
</div>
<div class="col-lg-12">
<button type="submit" name="new_expanse" class="btn btn-submit me-2">Submit</button>
<a href="expense.php" class="btn btn-cancel">Cancel</a>
</div>
</div>
</div>
</div>
</form>
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

<script src="assets/js/script.js"></script>
</body>
</html>