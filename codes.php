<?php
include 'includes/db.php';

mysqli_query($conn, "DELETE stock FROM stock WHERE stock_id = '$_GET[delete_bill_id]'") or die(mysqli_error($conn));

echo '<script type="text/javascript">
alert("Stock Deleted ");
window.location = "stock.php";
</script>';



if (isset($_POST['update_stock'])) {
    $total_stock = $_POST['quantity'] * $_POST['cost'];
    mysqli_query($conn, "UPDATE `stock` SET `item`='$_POST[item]',`supplier`='$_POST[supplier]',`category`='$_POST[category]',`available_quantity`='$_POST[quantity]',`min_quantity`='$_POST[minquantuty]',`cost`='$_POST[cost]',sell='$_POST[sell]',`total`='$total_stock' WHERE stock_id = '$_POST[bill_id]'") or die(mysqli_error($conn));
    header("Location: stock.php");
}




?>