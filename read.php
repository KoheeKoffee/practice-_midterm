<?php 
session_start();
#since database is created at config folder include the db.php instead of putting the whole database connection code 
include 'config/db.php';

$students = [];
try {
    $result = $conn->query("SELECT * FROM students");
    $students = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = "Error loading records: " . $e->getMessage();
    $popupType = "error";
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Student Record Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="background-overlay"></div>
<h2>List of Students</h2>
<?php if (count($students) > 0): ?>
<table>
    <tr>
        <th>ID</th>
        <th>Student_Number</th>
        <th>Fullname</th>
        <th>Branch</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Date Added</th>
        <th>Update</th>
    </tr>
    <?php foreach ($students as $row): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['student_no']); ?></td>
        <td><?php echo htmlspecialchars($row['fullname']); ?></td>
        <td><?php echo htmlspecialchars($row['branch']); ?></td>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td><?php echo $row['contact']; ?></td>
        <td><?php echo htmlspecialchars($row['date_added']); ?></td>
                <td>
            <a href="update.php" class="btn edit-btn">Edit</a>
        </form>
                <a href="delete.php" class="btn delete-btn">Delete</a>
            </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p style="text-align:center;">No student records found.</p>
<?php endif; ?>
</body>
</html>