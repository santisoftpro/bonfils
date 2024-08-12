<?php

if (isset($_POST['login'])) {
	login();
}
if (isset($_POST['new_user'])) {
	new_user();
}
if (isset($_POST['new_bill'])) {
	new_bill();
}
if (isset($_POST['update_bill'])) {
	update_bill();
}

if (isset($_GET['delete_user_id'])) {
	delete_user();
}

if (isset($_GET['delete_bill_id'])) {
	delete_bill();
}

if (isset($_GET['bill_id'])) {
	getBill();
}

if (isset($_POST['new_aside'])) {
	new_aside();
}

function new_aside()
{
	include 'includes/db.php';
	$client = $_POST['client'];
	$category = $_POST['category'];
	$items = $_POST['items'];
	$type = $_POST['type'];
	$pprice = $_POST['pprice'];
	$sprice = $_POST['sprice'];
	$quantity = $_POST['quantity'];


	foreach ($items as $index => $item) {
		// echo $item . '--' . $pprice[$index] . '--' . $sprice[$index] . '--' . $quantity[$index];

		$s_items = $item;
		$s_type = $type[$index];
		$s_pprice = $pprice[$index];
		$s_sprice = $sprice[$index];
		$s_quantity = $quantity[$index];
		$total = ($s_sprice - $s_pprice) * $s_quantity;
		mysqli_query($conn, "INSERT INTO aside VALUES(null,'$client','$s_items','$category','$s_type','$s_pprice','$s_sprice','$s_quantity','$total',current_timestamp())") or die(mysqli_error($conn));
		echo '<script type="text/javascript">
		alert("Aside Sell Recorded ");
		window.location = "aside.php";
		</script>';


	}

}

function login()
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$error = false;

	$checkUsername = $GLOBALS['conn']->query("SELECT * FROM users WHERE username = '$username' AND deleted=0");
	if ($checkUsername->num_rows) {
		$user = $checkUsername->fetch_assoc();
		if (password_verify($password, $user['password'])) {
			$_SESSION['stock']['loggedIn'] = true;
			$_SESSION['stock']['role'] = $user['role'];
			$_SESSION['stock']['user'] = $user['id'];
			redirect('dashboard.php');
		} else {
			$error = "Incorrect password";
		}
	} else {
		$error = "Unkown username";
	}
	if ($error) {
		alert($error);
	}
}


function all_users()
{
	$select = $GLOBALS['conn']->query('SELECT * FROM users WHERE id!=1 AND deleted=0');
	return $select;
}

function new_user()
{
	if (required(['name', 'username', 'password'])) {


		if (!exists('users', $_POST['username'], 'username')) {
			$insert = $GLOBALS['conn']->prepare("INSERT INTO users(name, username, password) VALUES(?, ?, ?)");
			$insert->bind_param("sss", $name, $username, $password);

			$name = $_POST['name'];
			$username = $_POST['username'];
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

			if ($insert->execute()) {
				alert('User created', 'success');
			} else {
				alert('Failed to create the user');
			}
		} else {
			alert('Username already taken');
		}
	}
}

function new_bill()
{
	include 'includes/db.php';
	$dty = $_POST['item'];
	$items = $_POST['item'];
	$payment = $_POST['payment'];
	$momo = $_POST['momos'];
	$cash = $_POST['cashes'];
	$costs = $_POST['cost'];
	$quantity = $_POST['quantity'];
	$client = htmlspecialchars(trim($_POST['client']));

	date_default_timezone_set('Africa/Kigali');
	$date = date('Y-m-d h:i:s');
	date_default_timezone_set('Africa/Kigali');
	$dates = date('Y/m/d', time());

	$count = count($items);
	$stock_count = count($quantity);
	$og = is_array($dty) ? $dty : array($dty);
	$bill = time();

	$GLOBALS['conn']->query("INSERT INTO bills(id, user_id, client, done_on, momo, cash) VALUES('$bill', '" . $_SESSION['stock']['user'] . "', '$client', '$date' ,'$momo' ,'$cash')");
	// echo("INSERT INTO bills(id, user_id, client) VALUES('$bill', " . $_SESSION['stock']['user'] . "', '$client')");
	$insert = $GLOBALS['conn']->prepare("INSERT INTO bill_items(item, payment, cost, bill_id, quantity) VALUES (?, ?, ?, ?, ?)");
	$insert->bind_param("sssss", $item, $pay, $cost, $bill_id, $quant);
	$rows = 0;

	for ($i = 0; $i < $count; $i++) {

		if ($items[$i] && isset($costs[$i]) && $quantity[$i]) {
			$rows++;
			$item = $items[$i];
			$pay = $payment[$i];
			// $cashes = $cash;
			// $momos = $momo;
			$cost = $costs[$i];
			$bill_id = $bill;
			$quant = $quantity[$i];
			$out_stock = mysqli_query($conn, "SELECT * FROM stock WHERE item='$item'");
			$sticky = mysqli_fetch_array($out_stock);
			if ($quant > $sticky['available_quantity']) {
				echo '<script type="text/javascript">
			  alert("Stock Quantity is not enagh");
			  window.location = "bills.php";
		  </script>';
			} else if ($sticky['available_quantity'] <= 0) {
				echo '<script type="text/javascript">
				alert("Stock is Empty");
				window.location = "bills.php";

			</script>';
			} else {
				$insert->execute();
				mysqli_query($conn, "UPDATE stock SET available_quantity=available_quantity-$quant  WHERE item='$item'") or die(mysqli_error($conn));
				mysqli_query($conn, "UPDATE stock SET total = available_quantity*cost WHERE item='$item'") or die(mysqli_error($conn));
				$report_query = "SELECT * FROM report WHERE items='$item' WHERE dates='$dates'";
				$report_query_run = mysqli_query($conn, $report_query);
				// $cout = mysqli_num_rows($report_query_run);
				// if ($cout == 0) {
				$profit_amount = $sticky['cost'] * $quant;
				mysqli_query($conn, "INSERT INTO report VALUES(null,'$item','$cost','$sticky[cost]','$quant','$profit_amount',current_timestamp(),'$bill_id')");
				// } else {
				// 	$report_update = "UPDATE report SET quantity=qunatity+$quant WHERE dates='$dates'";
				// }

				$money = $cost * $quant;
				mysqli_query($conn, "INSERT INTO balance VALUES(null,'$money','$bill_id',CURDATE())");

			}



		}



	}

	if ($rows) {
		redirect('print_bill.php?bill_id=' . $bill);
	} else {
		alert('All items were blank');
	}

	// $count = 1;
	// $res = mysqli_query($conn, "SELECT * FROM stock WHERE item='Iphone'");
	// $count = mysqli_num_rows($res);




}

function update_bill()
{
	include 'includes/db.php';
	$items = $_POST['item'];
	$payment = $_POST['payment'];
	$costs = $_POST['cost'];
	$quantity = $_POST['quantity'];
	$client = htmlspecialchars(trim($_POST['client']));

	$count = count($items);

	$bill = $_POST['bill_id'];
	$GLOBALS['conn']->query("UPDATE bills SET client='" . $client . "' WHERE id=$bill");
	$GLOBALS['conn']->query("DELETE FROM bill_items WHERE bill_id='" . $_POST['bill_id'] . "'");
	$GLOBALS['conn']->query("DELETE FROM report WHERE bill_id='" . $_POST['bill_id'] . "'");
	$insert = $GLOBALS['conn']->prepare("INSERT INTO bill_items(item, payment, cost, bill_id, quantity) VALUES (?, ?,  ?, ?, ?)");
	$insert->bind_param("sssss", $item, $pay, $cost, $bill_id, $quant);
	// $update_report = $GLOBALS['conn']->prepare("INSERT INTO reports(items,sell_price ,stock_price,quantity,profit_amount,dates,bill_id) VALUES (?, ?, ?, ?, ?, CURDATE(), ?)");
	// $update_report->bind_param("ssssss", $item, $cost, $stock_price, $quant, $profit, $bill_id);
	// $reports = mysqli_query($conn, "SELECT * FROM reports INNER JOIN bills ON reports.bill_id = bills.id WHERE bill_id='$bill'");
	// $tabls_rows = mysqli_fetch_array($reports);
	$rows = 0;
	for ($i = 0; $i < $count; $i++) {
		if ($items[$i] && $costs[$i] && $quantity[$i]) {
			$rows++;
			$item = $items[$i];
			$pay = $payment[$i];
			$cost = $costs[$i];
			$bill_id = $bill;
			$quant = $quantity[$i];

			$out_stock = mysqli_query($conn, "SELECT * FROM stock WHERE item='$item'");
			$sticky = mysqli_fetch_array($out_stock);
			$insert->execute();
			$profit_amount = ($cost - $sticky['cost']) * $quant;
			$bala = $cost * $quant;
			mysqli_query($conn, "INSERT INTO report VALUES(null,'$item','$cost','$sticky[cost]','$quant','$profit_amount',current_timestamp(),'$bill_id')");
			mysqli_query($conn, "UPDATE balance SET money ='$bala' WHERE bill_id='$bill_id'");


		}


	}

	if ($rows) {
		redirect('print_bill.php?bill_id=' . $bill);
	} else {
		alert('All items were blank');
	}
}

function bills()
{
	$date = date('Y-m-d');
	if (isset($_GET['date'])) {
		if (DateTime::createFromFormat('Y-m-d', $_GET['date'])) {
			$date = $_GET['date'];
		}
	}
	if ($_SESSION['stock']['role'] != 'admin' || isset($_GET['user_id'])) {
		$id = isset($_GET['user_id']) ? htmlspecialchars(trim($_GET['user_id'])) : $_SESSION['stock']['user'];

		$GLOBALS['bills'] = $GLOBALS['conn']->query("SELECT bills.*, users.name,bill_items.payment,bill_items.quantity, sum(cost * quantity) AS total, GROUP_CONCAT(item) AS items FROM bills LEFT JOIN users ON users.id=bills.user_id LEFT JOIN bill_items ON bill_items.bill_id=bills.id WHERE users.id='$id' AND DATE(done_on)='$date' GROUP BY bills.id ORDER BY bill_items.id DESC");
	} else {
		$GLOBALS['bills'] = $GLOBALS['conn']->query("SELECT bills.*, users.name,bill_items.payment,bill_items.quantity, sum(cost * quantity) AS total, GROUP_CONCAT(item) AS items FROM bills LEFT JOIN users ON users.id=bills.user_id LEFT JOIN bill_items ON bill_items.bill_id=bills.id WHERE DATE(done_on)='$date' GROUP BY bills.id ORDER BY bill_items.id DESC");
	}
	$GLOBALS['date'] = $date;
}
function aside()
{
	$date = date('Y-m-d');
	if (isset($_GET['date'])) {
		if (DateTime::createFromFormat('Y-m-d', $_GET['date'])) {
			$date = $_GET['date'];
		}
	}
	if ($_SESSION['stock']['role'] != 'admin' || isset($_GET['user_id'])) {
		$id = isset($_GET['user_id']) ? htmlspecialchars(trim($_GET['user_id'])) : $_SESSION['stock']['user'];
		$GLOBALS['bills'] = $GLOBALS['conn']->query("SELECT * FROM bill_items INNER JOIN bills ON bill_items.bill_id=bills.id WHERE DATE(done_on)='$date' && payment = 'momo' ORDER BY bill_items.id DESC");
	} else {
		$GLOBALS['bills'] = $GLOBALS['conn']->query("SELECT * FROM bill_items INNER JOIN bills ON bill_items.bill_id=bills.id WHERE DATE(done_on)='$date' && payment = 'momo' ORDER BY bill_items.id DESC");
	}
	$GLOBALS['date'] = $date;
}
function cash()
{
	$date = date('Y-m-d');
	if (isset($_GET['date'])) {
		if (DateTime::createFromFormat('Y-m-d', $_GET['date'])) {
			$date = $_GET['date'];
		}
	}
	if ($_SESSION['stock']['role'] != 'admin' || isset($_GET['user_id'])) {
		$id = isset($_GET['user_id']) ? htmlspecialchars(trim($_GET['user_id'])) : $_SESSION['stock']['user'];
		$GLOBALS['bills'] = $GLOBALS['conn']->query("SELECT * FROM bill_items INNER JOIN bills ON bill_items.bill_id=bills.id WHERE DATE(done_on)='$date' && payment = 'cash' ORDER BY bill_items.id DESC");
	} else {
		$GLOBALS['bills'] = $GLOBALS['conn']->query("SELECT * FROM bill_items INNER JOIN bills ON bill_items.bill_id=bills.id WHERE DATE(done_on)='$date' && payment = 'cash' ORDER BY bill_items.id DESC");
	}
	$GLOBALS['date'] = $date;
}
function bank()
{
	$date = date('Y-m-d');
	if (isset($_GET['date'])) {
		if (DateTime::createFromFormat('Y-m-d', $_GET['date'])) {
			$date = $_GET['date'];
		}
	}
	if ($_SESSION['stock']['role'] != 'admin' || isset($_GET['user_id'])) {
		$id = isset($_GET['user_id']) ? htmlspecialchars(trim($_GET['user_id'])) : $_SESSION['stock']['user'];
		$GLOBALS['bills'] = $GLOBALS['conn']->query("SELECT * FROM bill_items INNER JOIN bills ON bill_items.bill_id=bills.id WHERE DATE(done_on)='$date' && payment = 'bank' ORDER BY bill_items.id DESC");
	} else {
		$GLOBALS['bills'] = $GLOBALS['conn']->query("SELECT * FROM bill_items INNER JOIN bills ON bill_items.bill_id=bills.id WHERE DATE(done_on)='$date' && payment = 'bank' ORDER BY bill_items.id DESC");
	}
	$GLOBALS['date'] = $date;
}
function credit()
{
	$date = date('Y-m-d');
	if (isset($_GET['date'])) {
		if (DateTime::createFromFormat('Y-m-d', $_GET['date'])) {
			$date = $_GET['date'];
		}
	}
	if ($_SESSION['stock']['role'] != 'admin' || isset($_GET['user_id'])) {
		$id = isset($_GET['user_id']) ? htmlspecialchars(trim($_GET['user_id'])) : $_SESSION['stock']['user'];
		$GLOBALS['bills'] = $GLOBALS['conn']->query("SELECT * FROM bill_items INNER JOIN bills ON bill_items.bill_id=bills.id WHERE DATE(done_on)='$date' && payment = 'credit' ORDER BY bill_items.id DESC");
	} else {
		$GLOBALS['bills'] = $GLOBALS['conn']->query("SELECT * FROM bill_items INNER JOIN bills ON bill_items.bill_id=bills.id WHERE DATE(done_on)='$date' && payment = 'credit' ORDER BY bill_items.id DESC");
	}
	$GLOBALS['date'] = $date;
}

function momoAndCash()
{
	$date = date('Y-m-d');
	if (isset($_GET['date'])) {
		if (DateTime::createFromFormat('Y-m-d', $_GET['date'])) {
			$date = $_GET['date'];
		}
	}
	if ($_SESSION['stock']['role'] != 'admin' || isset($_GET['user_id'])) {
		$id = isset($_GET['user_id']) ? htmlspecialchars(trim($_GET['user_id'])) : $_SESSION['stock']['user'];
		$GLOBALS['bills'] = $GLOBALS['conn']->query("SELECT * FROM bill_items INNER JOIN bills ON bill_items.bill_id=bills.id WHERE DATE(done_on)='$date' && payment = 'momocash' ORDER BY bill_items.id DESC");
	} else {
		$GLOBALS['bills'] = $GLOBALS['conn']->query("SELECT * FROM bill_items INNER JOIN bills ON bill_items.bill_id=bills.id WHERE DATE(done_on)='$date' && payment = 'momocash' ORDER BY bill_items.id DESC");
	}
	$GLOBALS['date'] = $date;

}

function dailyReport()
{
	$date = date('Y-m-d');
	if (isset($_GET['date'])) {
		if (DateTime::createFromFormat('Y-m-d', $_GET['date'])) {
			$date = $_GET['date'];
		}
	}
	if ($_SESSION['stock']['role'] != 'admin' || isset($_GET['user_id'])) {
		$id = isset($_GET['user_id']) ? htmlspecialchars(trim($_GET['user_id'])) : $_SESSION['stock']['user'];
		$GLOBALS['bills'] = $GLOBALS['conn']->query("SELECT * FROM bill_items INNER JOIN bills ON bill_items.bill_id=bills.id WHERE DATE(done_on)='$date' ORDER BY bill_items.id DESC");
	} else {
		$GLOBALS['bills'] = $GLOBALS['conn']->query("SELECT * FROM bill_items INNER JOIN bills ON bill_items.bill_id=bills.id WHERE DATE(done_on)='$date' ORDER BY bill_items.id DESC");
	}
	$GLOBALS['date'] = $date;
}
function getBill()
{
	if (isset($_GET['bill_id'])) {
		$id = htmlspecialchars(trim($_GET['bill_id']));
		$bill = $GLOBALS['conn']->query("SELECT bills.*, users.name FROM bills LEFT JOIN users ON users.id=bills.user_id WHERE bills.id='$id'");
		include 'includes/db.php';

		if ($bill->num_rows) {

			$GLOBALS['bill'] = $bill->fetch_assoc();
			$GLOBALS['items'] = $GLOBALS['conn']->query("SELECT * FROM bill_items WHERE bill_id='$id'");
		} else {
			redirect('bills.php');
		}
	} else {
		redirect('bills.php');
	}
}

function delete_user()
{
	if ($_SESSION['stock']['role'] == 'admin') {
		$delete = $GLOBALS['conn']->prepare('UPDATE users SET deleted=1 WHERE id=?');
		$delete->bind_param("s", $id);
		$id = $_GET['delete_user_id'];
		$delete->execute();
	}
	redirect('users.php');
}

function delete_bill()
{
	if ($_SESSION['stock']['role'] == 'admin') {
		$delete = $GLOBALS['conn']->prepare('DELETE FROM bills WHERE id=?');
		$delete->bind_param("s", $id);
		$report = $GLOBALS['conn']->prepare('DELETE FROM report WHERE bill_id=?');
		$report->bind_param("s", $repo);
		$balance = $GLOBALS['conn']->prepare('DELETE FROM balance WHERE bill_id=?');
		$balance->bind_param("s", $bala);
		$id = $_GET['delete_bill_id'];
		$repo = $_GET['delete_bill_id'];
		$bala = $_GET['delete_bill_id'];
		$delete->execute();
		$report->execute();
		$balance->execute();
	}
	echo '<script type="text/javascript">
alert("Sells Deleted ");
</script>';
	redirect('bills.php');
}

function required($inputs)
{
	foreach ($inputs as $input) {
		if ($_POST[$input] == "" || $_POST[$input] == null) {
			alert('Some inputs are empty. Fill all with *');
			return false;
		}
	}
	return true;
}

function exists($table, $value, $column = 'id')
{
	$select = $GLOBALS['conn']->query("SELECT * FROM " . $table . " WHERE " . $column . " = '" . $value . "'");
	return $select->num_rows ? true : false;
}

function getAll($table)
{
	$select = $GLOBALS['conn']->query("SELECT * FROM " . $table);
	return $select;
}
?>