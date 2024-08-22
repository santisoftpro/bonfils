<?php
require 'includes/conn.php';
error_reporting(0);
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
<title>New Bill</title>

<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="assets/css/animate.css">
<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<style>
    .user-details:nth-child(even) {
        /* background: #ccc; */
    }
</style>
</head>
<body>
<div id="global-loader">
    <div class="whirly-loader"></div>
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
            <a id="toggle_btn" href="javascript:void(0);"></a>
        </div>

        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li>
                        <a href="index.html"><img src="assets/img/icons/dashboard.svg" alt="img"><span>Dashboard</span></a>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span>Stock</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="stock.php">Stock List</a></li>
                            <li><a href="new_stock.php">New Stock</a></li>
                            <li><a href="add_purchase.php">Add Stock</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="assets/img/icons/sales1.svg" alt="img"><span>Sales</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="bills.php">Sales List</a></li>
                            <li><a href="new_bill.php" class="active">New Sales</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="assets/img/icons/expense1.svg" alt="img"><span>Expense</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="expenselist.html">Expense List</a></li>
                            <li><a href="createexpense.html">Add Expense</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span>Users</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="newuser.html">New User</a></li>
                            <li><a href="userlists.html">Users List</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="logout.php"><img src="assets/img/icons/settings.svg" alt="img"><span>Log Out</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Add Sale</h4>
                    <h6>Add your new sale</h6>
                </div>
            </div>
            <form action="new_bill.php" method="post">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Customer</label>
                                    <input type="text" name="client" placeholder="Enter Customer Name" required>
                                </div>
                            </div>

                            <div id="user-details" class="row user-details">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Item Name</label>
                                        <input type="hidden" name="momos" value="0">
                                        <input type="hidden" name="cashes" value="0">
                                        <select class="chosen item" name="item[]" required>
                                            <option value="" selected hidden>Choose Items</option>
                                            <?php
                                            $query = mysqli_query($conn, "SELECT DISTINCT item FROM stock ORDER BY item ASC");
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo '<option value="' . $row['item'] . '">' . $row['item'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Payment</label>
                                        <select class="chosen" name="payment[]" required>
                                            <option value="" selected hidden>Payment method*</option>
                                            <option value="cash">Cash</option>
                                            <option value="momo">Momo</option>
                                            <option value="bank">Bank slip</option>
                                            <option value="credit">Credit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Quantity*</label>
                                        <input type="text" name="quantity[]" class="qtyVal" placeholder="Enter The Quantity" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Cost</label>
                                        <input type="text" name="cost[]" class="price" placeholder="Enter The Cost" required>
                                    </div>
                                </div>

                                <div class="pad-10 pointer" style="color: red; cursor:pointer;"><br>REMOVE</div>
                            </div>

                            <div class="paste-new-forms"></div>
                            <a href="javascript:void(0)" id="add-input">ADD NEW</a>
                            <div class="col-lg-12">
                                <button type="submit"  name="new_bill" class="btn btn-submit me-2 sbtbtn">Submit</button>
                                <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"></script>
<script src="assets/js/script.js"></script>

<script>
    $(document).ready(function () {
        addSelect();

        function removeItem() {
            $('.pointer').click(function () {
                $(this).parent().remove();
                var itmVal = $('.qtyVal').val();
                var priceVal = $('.price').val();
                $('.amt').val(itmVal * priceVal);
            });
        }

        function addSelect() {
            $('.chosen').chosen();
        }

        $('#add-input').click(function () {
            var html = `
                <div id="user-details" class="row user-details">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Item Name</label>
                            <select class="chosen" name="item[]" required>
                                <option value="" selected hidden>Choose Items</option>
                                <?php
                                $query = mysqli_query($conn, "SELECT DISTINCT item FROM stock ORDER BY item ASC");
                                while ($row = mysqli_fetch_array($query)) {
                                    echo '<option value="' . $row['item'] . '">' . $row['item'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Payment</label>
                            <select class="chosen" name="payment[]" required>
                                <option value="" selected hidden>Payment method*</option>
                                <option value="cash">Cash</option>
                                <option value="momo">Momo</option>
                                <option value="bank">Bank slip</option>
                                <option value="credit">Credit</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Quantity*</label>
                            <input type="text" name="quantity[]" class="qtyVal" placeholder="Enter The Quantity" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Cost</label>
                            <input type="text" name="cost[]" class="price" placeholder="Enter The Cost" required>
                        </div>
                    </div>

                    <div class="pad-10 pointer" style="color: red; cursor:pointer;"><br>REMOVE</div>
                </div>
            `;
            $('.paste-new-forms').append(html);
            addSelect();
            removeItem();
        });
    });
</script>
</body>
</html>
