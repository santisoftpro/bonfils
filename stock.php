<?php
require 'includes/conn.php';
loggedIn();
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
<title>Stock</title>

<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

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

<?php
include './includes/head.php';
?>

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
<li><a href="stock.php" class="active">Stock List</a></li>
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
<a href="logout.php"><img src="assets/img/icons/settings.svg" alt="img"><span>Log Out</span> <span class="menu-arrow"></span></a>


</li>
</ul>
</div>
</div>
</div>

<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Stock Details</h4>
<h6>Manage your stock</h6>
</div>
<div class="page-btn">
<a href="new_stock.php" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Add New Product</a>
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

<div class="card mb-0" id="filter_inputs">
<div class="card-body pb-0">
<div class="row">
<div class="col-lg-12 col-sm-12">
<!-- <div class="row">
<div class="col-lg col-sm-6 col-12">
<div class="form-group">
<select class="select">
<option>Choose Product</option>
<option>Macbook pro</option>
<option>Orange</option>
</select>
</div>
</div>
<div class="col-lg col-sm-6 col-12">
<div class="form-group">
<select class="select">
<option>Choose Category</option>
<option>Computers</option>
<option>Fruits</option>
</select>
</div>
</div>
<div class="col-lg col-sm-6 col-12">
<div class="form-group">
<select class="select">
<option>Choose Sub Category</option>
<option>Computer</option>
</select>
</div>
</div>
<div class="col-lg col-sm-6 col-12">
<div class="form-group">
<select class="select">
<option>Brand</option>
<option>N/D</option>
</select>
</div>
</div>
<div class="col-lg col-sm-6 col-12 ">
<div class="form-group">
<select class="select">
<option>Price</option>
<option>150.00</option>
</select>
</div>
</div>
<div class="col-lg-1 col-sm-6 col-12">
<div class="form-group">
<a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg" alt="img"></a>
</div>
</div>
</div> -->
</div>
</div>
</div>
</div>

<div class="table-responsive">
<table class="table  datanew">
<thead>
<tr>
<th>
<label class="checkboxs">
<input type="checkbox" id="select-all">
<span class="checkmarks"></span>
</label>
</th>
<th>Item Name</th>
<th>Time</th>
<th>Supplier </th>
<th>Category</th>
<th>Available Stock</th>
<th>Cost</th>
<th>Sell Price</th>
<th>Total</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$x = 1;
$totals = 0;
$query = "SELECT * FROM stock ORDER BY dates DESC";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
while ($row = mysqli_fetch_assoc($result)) {

$totals = $totals + $row['total'];

?>
<tr>
<td>
<label class="checkboxs">
<input type="checkbox">
<span class="checkmarks"></span>
</label>
</td>
<td><?php echo $row['item']; ?></td>
</td>
<td><?php echo date($row['dates']); ?></td>
<td> <?php echo $row['supplier']; ?></td>
<td>  <?php echo $row['category']; ?></td>
<td> <?php echo $row['available_quantity']; ?></td>
<td><?php echo $row['cost']; ?> </td>
<td> <?php echo $row['sell']; ?></td>
<td><?php echo $row['total']; ?></td>
<td>
<?php if ($_SESSION['stock']['role'] == 'admin') { ?>
<a class="me-3" href="update_stock.php?bill_id=<?= $row['stock_id'] ?>">
<img src="assets/img/icons/edit.svg" alt="img">
</a>
<button type="button" class="confirm-delete" value="<?= $row['stock_id'] ?>" style="border: none;">
<!-- <a class="confirm-text confirm-delete" href="javascript:void(0);"> -->
<img src="assets/img/icons/delete.svg" alt="img">
</a>
</button>
<?php } ?>
</td>
</tr>

    <?php
    }
    ?>
</tbody>
</table>
</div>
</div>
</div>

</div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/js/jquery.slimscroll.min.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/select2/js/select2.min.js"></script>

<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>


<script src="assets/js/script.js"></script>



     <script>
        $(document).ready(function () {
            $(".confirm-delete").click(function (e) { 
                e.preventDefault();
                confirmDialog = confirm("Are you sure you want to delete? this data.");
                if (confirmDialog){
                    var id = $(this).val();
                   $.ajax({
                    type: "POST",
                    url: "codes.php?delete_bill_id="+id,
                    success: function (response) {
                        alert("Data successfully deleted");
                        window.location.reload();
                    }
                   });
                }
                
            });


            $("#live_search").keyup(function(){
                var input = $(this).val();
               
                    $.ajax({
                        url: "livesearch.php",
                        method: "POST",
                        data: {input:input},
                        success: function (data) {
                            $("#searchresult").html(data);

                        }
                    });
                 
            });

        });
     </script>
    <script>
        let subMenu = document.getElementById("subMenu");
        function toggleMenu() {
            subMenu.classList.toggle("open-menu");
        }
    </script>

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