<?php
require_once '../classes/Auth.php';
require_once '../helpers/csrf.php';

$auth = new Auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf_token'])) {
        die("Invalid CSRF token");
    }

    try {
        $auth->register($_POST['name'], $_POST['email'], $_POST['password']);
        header("Location: login.php");
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<form method="post">
    <?= csrf_field() ?>
    <input name="name" placeholder="Name" required>
    <input name="email" type="email" required>
    <input name="password" type="password" required>
    <button>Register</button>
</form>

<?= $error ?? '' ?>
