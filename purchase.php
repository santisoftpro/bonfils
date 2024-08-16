<?php
require 'includes/conn.php';
loggedIn();

if (isset($_POST['purchasebtn'])) {

    $items = $_POST['items'];
    $supplier = $_POST['supplier'];
    $quantity = $_POST['quantity'];
    $minquantuty = $_POST['minquantuty'];
    $cost = $_POST['cost'];
    $sell = $_POST['sell'];
    $category = $_POST['category'];
    $type = "kg";

    foreach ($items as $index => $item) {
        //echo $item . '--' . $quantity[$index] . '--' . $cost[$index] . '--' . $supplier;
        $s_item = $item;
        $s_supplier = $supplier[$index];
        $s_quantity = $quantity[$index];
        $s_minquantuty = $minquantuty[$index];
        $s_cost = $cost[$index];
        $s_sell = $sell[$index];
        $cate = $category[$index];
        $types = $type[$index];
        $total_stock = $s_quantity * $s_cost;

        $query = mysqli_query($conn, "INSERT INTO purchase VALUES(null,'$s_item','$s_supplier','$s_quantity','$s_cost',current_timestamp())") or die(mysqli_error($conn));

        if ($query) {
            $count = 0;
            $res = mysqli_query($conn, "SELECT * FROM stock WHERE item='$s_item'");
            $count = mysqli_num_rows($res);

            if ($count == 0) {
                mysqli_query($conn, "INSERT INTO stock VALUES(null,'$s_item','$s_supplier','$cate','$s_quantity','$s_minquantuty','$s_cost','$s_sell','$types','$total_stock',current_timestamp())") or die(mysqli_error($conn));
            } else {
                mysqli_query($conn, "UPDATE stock SET available_quantity=available_quantity+$s_quantity ,cost='$s_cost' WHERE item='$s_item'") or die(mysqli_error($conn));
                mysqli_query($conn, "UPDATE stock SET total = available_quantity*cost WHERE item='$s_item'") or die(mysqli_error($conn));
            }
        } else {
            "failed to purched";
        }
    }

    ?>
    <script type="text/javascript">
        alert("Stock Added");
        window.location = "stock.php";
    </script>

    <?php
} else {
    $_SESSION['status'] = "Stocks is not Added";
    header("Location: stocks.php");
}


?>