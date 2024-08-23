<?php
include 'includes/db.php';
if (isset($_POST["query"])) {
    $output = '';
    $query = "SELECT * FROM stock WHERE item LIKE '%" . $_POST["query"] . "%'";
    $result = mysqli_query($conn, $query);
    $output = '<ul class="list-unstyled" >';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output .= '<li>' . $row["item"] . '</li>';
        }
    }
    $output .= '</ul>';
    echo $output;
}
?>