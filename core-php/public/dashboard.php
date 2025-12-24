<?php
require_once '../classes/Auth.php';

$auth = new Auth();
if (!$auth->check()) {
    header("Location: login.php");
    exit;
}
?>

<h1>Welcome <?= htmlspecialchars($_SESSION['user_name']) ?></h1>
<a href="logout.php">Logout</a>
