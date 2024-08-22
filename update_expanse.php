<?php
session_start();
include 'includes/db.php';

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Responsive Registration Form | CodingLab </title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
    <link rel="stylesheet" href="kin.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="header">
        <?php
        include("includes/nav.php");

        ?>
    </div>
    <center>
        <div class="container">
            <div class="title">UPDATE EXPANSES</div>
            <div class="content">
                <?php
                $x = 1;
                $query = "SELECT * FROM expense WHERE expense_id='$_GET[bill_id]'";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                while ($row = mysqli_fetch_assoc($result)) {



                    ?>
                    <form action="update_expanse_codes.php" method="post">

                        <div class="mains">
                            <input type="hidden" name="bill_id" value="<?= $_GET['bill_id'] ?>">
                            <div class="user-details">
                                <div class="input-box">
                                    <span class="details">Descroption</span>
                                    <input type="text" name="description" value="<?= $row['description'] ?>">
                                </div>

                                <div class="input-box">
                                    <span class="details">AMOUNT</span>
                                    <input type="number" name="amount" value="<?= $row['amount'] ?>">
                                </div>

                            </div>
                        </div>
                        <div class="button">
                            <input type="submit" name="update_expanses" value="UPDATE EXPANSE">
                        </div>
                    </form>

                    <?php
                }
                ?>
            </div>
        </div>
    </center>
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> -->

</body>

</html>