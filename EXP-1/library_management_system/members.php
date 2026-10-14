<?php
include "db.php";

if (isset($_POST['add_member'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO members (name, email, phone)
            VALUES ('$name', '$email', '$phone')";

    mysqli_query($conn, $sql);

    header("Location: members.php");
    exit();
}

if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM members WHERE id=$id");

    header("Location: members.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM members ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Members - Library</title>
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

<div class="container">

    <h2>Manage Members</h2>

    <div class="form-box">

        <h3>Add New Member</h3>

        <form method="POST">

            <input type="text"
                   name="name"
                   placeholder="Member Name"
                   required>

            <input type="email"
                   name="email"
                   placeholder="Email"
                   required>

            <input type="text"
                   name="phone"
                   placeholder="Phone Number"
                   required>

            <button type="submit" name="add_member">
                Add Member
            </button>

        </form>

    </div>

    <h3>Library Members</h3>

    <table>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>

        <?php while ($member = mysqli_fetch_assoc($result)) { ?>

        <tr>

            <td><?php echo $member['id']; ?></td>

            <td><?php echo $member['name']; ?></td>

            <td><?php echo $member['email']; ?></td>

            <td><?php echo $member['phone']; ?></td>

            <td>

                <a class="delete"
                   href="members.php?delete=<?php echo $member['id']; ?>"
                   onclick="return confirm('Delete this member?')">

                   Delete

                </a>

            </td>

        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>