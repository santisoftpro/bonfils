<?php
require 'includes/conn.php';
loggedIn();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>STOCK | Print bill</title>
    <link rel="stylesheet" type="text/css" href="includes/css.css">

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
        }

        body {
            background: #efefef;
            color: #666;
            padding: 0;
            font-family: Leelawadee;
            margin: 0;
        }

        .nav {
            display: flex;
            align-items: center;
            background: #fff;
            box-shadow: 5px 10px 10px 5px rgba(0, 0, 0, 0.1);
            padding: 10px 30px;
            justify-content: space-between;
        }

        .nav .brand {
            font-weight: bold;
            color: #000;
            font-size: 130%;
        }

        .nav a {
            padding: 10px 25px;

        }

        .nav a:hover {
            color: #000;
            text-shadow: 0.5px 0.5px currentColor;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            color: #000;
        }

        a.btn,
        button {
            background: rgba(100, 20, 0, 0.3);
            background: black;
            border-radius: 10px;
            color: #fff;

        }

        .flex {
            display: flex;
            align-items: center;
            justify-content: space-between;


        }

        .flex-center {
            display: flex;
            align-items: center;
        }

        .pad-big {
            padding: 40px;
        }

        .pad-10 {
            padding: 10px;
        }

        .no-pad {
            padding: 0;
            margin: 0;
        }

        .form,
        .table {
            background: #fff;
            margin: 50px auto;
            border-radius: 10px;
            padding: 50px;
            box-shadow: 5px 10px 10px 5px rgba(0, 0, 0, 0.1);
            max-width: 600px;

        }

        .table {
            max-width: 900px;
        }

        .form .input {
            padding: 10px 20px;
        }

        .form label {
            display: block;
        }

        .input input,
        .input select {
            padding: 12px;
            margin-left: 5%;
            background: rgba(0, 0, 0, 0.01);
            border: hidden;
            width: 95%;
            border-radius: 10px;
            border: 1px solid #000;
        }

        .flex .input {
            padding-left: 0;
            padding-right: 0;

        }

        button[type="submit"] {
            padding: 12px;
            background: rgba(0, 0, 0, 1);
            border: hidden;
            width: 70%;
            display: block;
            margin: auto;
            margin-top: 15px;
            border-radius: 10px;
        }

        table {
            width: 100%;
            padding: 10px 60px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        input,
        button {
            font-family: inherit;
            font-size: inherit;
        }

        .title {
            color: #000;
            font-weight: bold;
            font-size: 130%;
            text-align: center;
        }

        .white {
            background: #ffffff;
            border-radius: 20px;
        }

        .centered {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .alert {
            position: fixed;
            top: 50px;
            right: 50px;
            min-width: 400px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            border-radius: 10px;
            box-shadow: 5px 10px 10px 5px rgba(0, 0, 0, 0.1);
        }

        .close {
            cursor: pointer;
        }

        .alert>div {
            padding: 15px 15px;
        }

        .alert.error {
            background: #a00;
        }

        .alert.success {
            background: #0a0;
        }

        .no-pad {
            padding: 20px;
        }

        .bill {
            background-color: #fff;
            color: #000;
            max-width: 350px;
            overflow: hidden;
            padding: 40px 25px;
            font-size: 13px;
            font-family: Consolas;
        }

        .bill * {
            text-transform: uppercase;
        }

        .bill table {
            width: 100%;
            padding: 0;
            margin: 2px;
        }

        input {
            border: 1px solid #000;
        }

        .bill table.items {
            padding: 10px 0;
        }

        .bill table.items td {
            padding: 0;
        }

        .bill table.inner {
            width: 90%;
            margin: 1px auto;
        }

        .bill td {
            border-bottom-color: transparent;
        }

        .bill table {
            border-bottom: 1px dashed currentColor;
        }

        .bill label {
            padding-right: 15px;
        }

        .bill pre {
            width: 100%;
        }

        @media print {
            body {
                padding: 0;
                margin: 0;
                background-color: #fff;

            }

            .no-print {
                display: none;
            }
        }

        .change-date button[type="submit"] {
            margin-top: 0;
            max-width: 150px;
        }

        .table-responsive {
            overflow-x: auto;
            max-width: 100%;
        }

        .table-responsive table {
            min-width: 850px;
        }

        .ham-menu {
            display: inline-block;
            position: relative;
            margin: 20px 0;
            font-size: 70%;
        }

        /* margin = (width-height)/2 */
        .ham-menu,
        .ham-menu::before,
        .ham-menu::after {
            width: 10px;
            height: 3px;
            border-radius: 7px;
            background-color: black;
        }

        .ham-menu::before,
        .ham-menu::after {
            content: "";
            display: block;
            position: absolute;
        }

        .ham-menu::before {
            bottom: 130%;
        }

        .ham-menu::after {
            top: 130%;
        }

        #toggle-dropdown,
        .nav .brand label,
        .right-menu {
            display: none;
        }

        @media screen and (max-width: 768px) {

            form,
            table,
            .pad-big {
                padding: 2vw;
            }

            .flex.no-small {
                display: block;
            }

            .change-date .input {
                width: 100%;
            }

            .change-date {
                margin-bottom: 50px;
            }

            .nav,
            .brand {
                display: block;
                width: 100%;
                position: relative;
            }

            .nav .brand label {
                display: block;
                float: right;
            }


            .nav .middle,
            .nav .right {
                display: none;
            }

            .middle a {
                display: block;
            }

            .middle {
                position: absolute;
                top: 100%;
                width: 90%;
                left: 5%;
                background: white;
                border-radius: 10px;
                box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 50px;
            }

            #toggle-dropdown:checked~.middle {
                display: block;
            }
        }

        @media screen and (max-width: 1000px) {
            .table-responsive table {
                padding: 2vw;
            }

            .table-responsive table a {
                display: block;
                padding: 3px 10px;
            }
        }


        .header {
            width: 100%;
            background: #eceaff;
            color: #535353;
        }

        nav {
            background: #1a1a1a;
            width: 100%;
            padding: 10px 10%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        .logo {
            width: 120px;
        }

        .user-pic {
            width: 40px;
            border-radius: 50%;
            cursor: pointer;
            margin-left: 30px;
        }

        nav ul {
            width: 100%;
            text-align: right;

        }

        nav ul li {
            display: inline-block;
            list-style: none;
            margin: 10px 20px;
        }

        nav ul li:hover {
            background-color: #79290a;
            color: #ccc;

        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        nav ul li ul.dropdown li {
            display: block;
            text-align: center;
            padding: 8px;
        }

        nav ul li ul.dropdown {
            width: 200px;
            background: #1a1a1a;
            position: absolute;
            z-index: 999;
            display: none;
        }

        nav ul li:hover ul.dropdown {
            display: block;
        }

        .sub-menu-wrap {
            position: absolute;
            top: 100%;
            right: 10%;
            width: 320px;
            max-height: 0px;
            overflow: hidden;
            transition: max-height 0.5s;
        }

        .sub-menu-wrap.open-menu {
            max-height: 400px;
        }

        .sub-menu {
            background-color: #f1f1f1;
            padding: 20px;
            margin: 10px;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info h3 {
            font-weight: 500;
        }

        .user-info img {
            width: 60px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .sub-menu hr {
            border: 0;
            height: 1px;
            width: 100%;
            background: #ccc;
            margin: 15px 0 10px;
        }

        .sub-menu-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #525252;
            margin: 12px 0;
        }

        .sub-menu-link p {
            width: 100%;
        }

        .sub-menu-link img {
            width: 40px;
            background: #e5e5e5;
            border-radius: 50%;
            padding: 8px;
            margin-right: 15px;
        }

        .sub-menu-link span {
            font-size: 22px;
            transition: transform 0.5s;
        }

        .sub-menu-link:hover span {
            transform: translateX(5px);
        }

        .sub-menu-link:hover p {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="no-print pad-10">
        <a class="btn" onclick="window.print()">Print bill</a>
        <a class="btn" href="bills.php">GO back</a>
    </div>

    <div class="bill">

        <div>
            <table>
                <tr>
                    <td class="centered">
                        Palace Home Decor<br>
                    </td>
                </tr>
            </table>
            <table></table>
            <table class="inner">
                <tr>
                    <td class="centered">
                        <label>RECEIPT</label>#
                        <?= $bill['id'] ?><br><strong>
                            <?= $bill['client'] ?>
                        </strong>
                    </td>
                </tr>
            </table>
            <table class="inner"></table>
            <table class="inner items">
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
                <?php $total = 0;
                foreach ($items as $item) {
                    $total += $item['cost'] * $item['quantity']; ?>
                    <tr>
                        <td>
                            <?= $item['item'] ?>
                        </td>
                        <td>(
                            <?= $item['quantity'] ?>
                            x
                            <?= $item['cost'] ?>)
                        </td>
                        <td class="right">
                            <?= $item['cost'] * $item['quantity'] ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <table class="inner"></table>
            <table>
                <tr>
                    <td class="right">
                        <label><strong></label>
                        <?= $total ?></strong></label>
                    </td>
                </tr>
            </table>
            <table></table>


            <p class="centered"><label for="">Date</label>
                <?= date_format(date_create($bill['done_on']), 'Y-m-d') ?><br><label for="">BY</label>
                <?= $bill['name'] ?>
            </p>

        </div>
    </div>
</body>

</html>