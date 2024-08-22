<?php
include 'includes/db.php';

if (isset($_POST['new_expanse'])) {

    mysqli_query($conn, "INSERT INTO expense VALUES(null,'$_POST[description]','$_POST[amount]',current_timestamp())") or die(mysqli_error($conn));

    $query = mysqli_query($conn, "SELECT SUM(money) as total FROM balance") or die(mysqli_error($conn));
    while ($row = mysqli_fetch_array($query)) {
        mysqli_query($conn, "UPDATE balance SET totals= '$row[total]'-'$_POST[amount]'");
    }

    echo ' <script type="text/javascript">
    alert("Expenses Added");
    window.location = "expense.php";
</script>';

}



mysqli_query($conn, "DELETE FROM expense WHERE expense_id = '$_GET[delete_bill_id]'") or die(mysqli_error($conn));
echo ' <script type="text/javascript">
 alert("Expenses Deleted successfully");
 window.location = "expense.php";
</script>';

?>