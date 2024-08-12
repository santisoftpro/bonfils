<nav>
    <span class="logo" style="color:#fff; font-size:17px; font-weight: bold;">Bless.</span>
    <center>
        <ul>
            <?php if (isset($_SESSION['stock']['role']) && $_SESSION['stock']['role'] == 'admin') { ?>
                <li><a href="users.php">USERS</a></li>
            <?php } ?>
            <li><a href="bills.php">SALES</a>
                <ul class="dropdown">

                    <a href="new_bill.php">
                        <li>NEW SELE</li>
                    </a>
                </ul>
            </li>
            <li><a href="stock.php">STOCK</a>
                <ul class="dropdown">
                    <a href="stock.php">
                        <li>VIEW STOCK</li>
                    </a>
                    <a href="new_stock.php">
                        <li>NEW STOCK</li>
                    </a>
                    <a href="add-purchase.php">
                        <li>ADD STOCK</li>
                    </a>

                </ul>
            </li>
            <li><a href="#">REPORTS</a>
                <ul class="dropdown">
                    <a href="daily-report.php">
                        <li>SALES REPORT</li>
                    </a>
                    <a href="print-purchase.php">
                        <li>STOCK REPORT</li>
                    </a>

                    <a href="purchase_list.php">
                        <li>PURCHASE_REPORT</li>
                    </a>

                </ul>
            </li>

            <!-- <li><a href="expense.php">Expanse</a>
            <ul class="dropdown">
                <li><a href="new_expense.php">New Expanse</a></li>
                <li><a href="balance.php">Balance</a></li>
            </ul>
        </li> -->
            <?php if (isset($_SESSION['stock']['role']) && $_SESSION['stock']['role'] == 'admin') { ?>
                <!-- <li><a href="purchase_list.php">Purchase Report</a></li> -->
            <?php } ?>
            <!-- <li><a href="report.php">Sales Report</a></li> -->
            <li><a href="#">Payment Report</a>
                <ul class="dropdown">
                    <a href="momo.php">
                        <li>Mobile Money</li>
                    </a>
                    <a href="bank.php">
                        <li>Bank Slip</li>
                    </a>
                    <a href="cash.php">
                        <li>Cash</li>
                    </a>
                    <a href="loarn-manager.php">
                        <li>Credit</li>
                    </a>
                    <a href="momo-cash.php">
                        <li>Momo & Cash</li>
                    </a>
                </ul>
            </li>
        </ul>
    </center>
    <a href="logout.php">
        <img src="images/logout.jpg" class="user-pic" onclick="toggleMenu()">
    </a>
    <!-- <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
            
                <div class="user-info">
                    <img src="images/user-g77ddb064f_640.png">
                    <h3>LogOut</h3>
                </div>
          
            <hr>
        </div>
    </div> -->
</nav>