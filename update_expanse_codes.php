<?php

include 'includes/db.php';
if (isset($_POST['update_expanses'])) {

    $query = mysqli_query($conn, "UPDATE `expense` SET `description`='$_POST[description]',`amount`='$_POST[amount]'  WHERE `expense_id`='$_POST[bill_id]' ");
    if ($query) {
        ?>

        <script type="text/javascript">
            alert("Expanses Updated seccessfully");
            window.location = "expense.php";
        </script>;

        <?
    } else {
        ?>
        <script type="text/javascript">
            alert("Expanses Note Updated seccessfully");
            window.location = "expense.php";
        </script>;
        <?php
    }

}
?>