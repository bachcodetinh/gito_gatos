<?php
session_start();
require_once("settings.php");
if (isset($_SESSION['user'])) { header("Location: manage.php"); exit(); }
$err = "";
if ($_POST) {
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $_POST['u']);
    $stmt->execute();
    if (($row = $stmt->get_result()->fetch_assoc()) && password_verify($_POST['p'], $row['password'])) {
        $_SESSION['user'] = $_POST['u'];
        header("Location: manage.php"); exit();
    }
    $err = "Invalid login.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php include("header.inc"); if ($err) echo "<p>$err</p>"; ?>
    <form method="post" novalidate>
        User: <input name="u"> Pass: <input type="password" name="p"> <button>Login</button>
    </form>
    <?php include("footer.inc"); ?>
</body>
</html>
