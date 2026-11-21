<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }
require_once("settings.php");
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if (isset($_POST['del'])) {
    $ref = mysqli_real_escape_string($conn, $_POST['dref']);
    mysqli_query($conn, "DELETE es FROM eoi_skills es JOIN eoi e ON es.EOInumber=e.EOInumber WHERE e.job_ref='$ref'");
    mysqli_query($conn, "DELETE FROM eoi WHERE job_ref='$ref'");
}
if (isset($_POST['upd']) && in_array($_POST['st'], ['New', 'Current', 'Final'])) {
    $id = (int)$_POST['id'];
    $st = $_POST['st'];
    mysqli_query($conn, "UPDATE eoi SET status='$st' WHERE EOInumber=$id");
}

$sort = in_array($_GET['sort'] ?? '', ['EOInumber','job_ref','first_name','last_name','status']) ? $_GET['sort'] : 'EOInumber';

$sql = "SELECT e.*, a.*, GROUP_CONCAT(es.skill) AS skills FROM eoi e 
        JOIN applicant a ON e.applicant_id=a.applicant_id 
        LEFT JOIN eoi_skills es ON e.EOInumber=es.EOInumber 
        GROUP BY e.EOInumber ORDER BY $sort";
$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage</title>
</head>
<body>
    <?php include("header.inc"); ?>
    <p><a href="logout.php">Logout</a> | <a href="manage.php">All EOIs</a></p>
    <form method="get" novalidate>
        Sort: <select name="sort">
            <?php foreach(['EOInumber','job_ref','first_name','last_name','status'] as $c) echo "<option ".($sort==$c?'selected':'').">$c</option>"; ?>
        </select>
        <button>Sort</button>
    </form>
    <form method="post" novalidate>
        Delete Ref: <input name="dref"> <button name="del">Delete</button>
    </form>
    <table border="1">
        <tr>
            <th>EOI#</th>
            <th>Ref</th>
            <th>Name</th>
            <th>Email</th>
            <th>Skills</th>
            <th>Other</th>
            <th>Status</th>
        </tr>
    <?php while ($r = $res->fetch_assoc()): ?>
        <tr>
            <td><?=$r['EOInumber']?></td>
            <td><?=htmlspecialchars($r['job_ref'])?></td>
            <td><?=htmlspecialchars($r['first_name'].' '.$r['last_name'])?></td>
            <td><?=htmlspecialchars($r['email'])?></td>
            <td><?=htmlspecialchars($r['skills']??'')?></td>
            <td><?=htmlspecialchars($r['other_skills'])?></td>
            <td>
                <form method="post" novalidate>
                    <input type="hidden" name="id" value="<?=$r['EOInumber']?>">
                    <select name="st">
                        <?php foreach(['New','Current','Final'] as $st) echo "<option ".($r['status']==$st?'selected':'').">$st</option>"; ?>
                    </select>
                    <button name="upd">Save</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
    </table>
    <?php include("footer.inc"); ?>
</body>
</html>
