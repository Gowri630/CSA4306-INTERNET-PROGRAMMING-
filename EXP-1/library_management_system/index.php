<?php
include "db.php";

$book_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM books");
$book_data = mysqli_fetch_assoc($book_result);
$total_books = $book_data['total'];

$member_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM members");
$member_data = mysqli_fetch_assoc($member_result);
$total_members = $member_data['total'];

$issue_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM issues WHERE status='Issued'");
$issue_data = mysqli_fetch_assoc($issue_result);
$total_issued = $issue_data['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>Library Management System</h1>

    <nav>
        <a href="index.php">Home</a>
        <a href="books.php">Books</a>
        <a href="members.php">Members</a>
        <a href="issue.php">Issue Book</a>
        <a href="return.php">Return Book</a>
        <a href="about.php">About</a>
    </nav>
</header>

<section class="hero">
    <h2>Welcome to Our Library</h2>
    <p>Manage books, members, issuing and returning easily.</p>
</section>

<section class="dashboard">

    <div class="card">
        <h2><?php echo $total_books; ?></h2>
        <p>Total Books</p>
    </div>

    <div class="card">
        <h2><?php echo $total_members; ?></h2>
        <p>Total Members</p>
    </div>

    <div class="card">
        <h2><?php echo $total_issued; ?></h2>
        <p>Books Issued</p>
    </div>

</section>

<section class="quick">

    <h2>Quick Actions</h2>

    <a href="books.php" class="button">Manage Books</a>
    <a href="members.php" class="button">Manage Members</a>
    <a href="issue.php" class="button">Issue Book</a>
    <a href="return.php" class="button">Return Book</a>

</section>

<footer>
    <p>© 2026 Library Management System</p>
</footer>

</body>
</html>