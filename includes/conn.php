<?php
session_start();
include("includes/db.php");
require 'includes/functions.php';

function isLoggedIn()
{
    return isset($_SESSION['stock']['loggedIn']);
}
function notLoggedIn()
{
    if (isLoggedIn()) {
        redirect('bills.php');
    }
}
function loggedIn()
{
    if (!isLoggedIn()) {
        redirect("index.php");
    }
}

function accoutant()
{
    if (isLoggedIn()) {
        if ($_SESSION['stock']['role'] == 'admin') {
            return;
        }
    }
    redirect('index.php');
}

function redirect($page)
{
    echo "<script>window.location.href='$page';</script>";
}

function alert($msg, $class = 'error')
{
    echo "
		<div class='alert $class'>
			<div class='body'>$msg</div>
			<div class='close' onclick='this.parentElement.remove()'>&times</div>
		</div>
	";
}

class basic
{
    private $table;
    private $conn;

    public function exists($value, $column = 'id')
    {
        $select = $this->conn - query("SELECT * FROM " . $this->table . " WHERE " . $column . " = '" . $value . ";");
        return count($select) ? true : false;
    }

    public function get($value, $column = 'id')
    {
        $select = $this->conn - query("SELECT * FROM " . $this->table . " WHERE " . $column . " = '" . $value . ";");
        return count($select) ? $select->fetch_assoc() : false;
    }

}

$user = new basic();


?>