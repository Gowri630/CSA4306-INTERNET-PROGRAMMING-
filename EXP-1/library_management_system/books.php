<?php
include "db.php";

if (isset($_POST['add_book'])) {

    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];

    $sql = "INSERT INTO books (title, author, category)
            VALUES ('$title', '$author', '$category')";

    mysqli_query($conn, $sql);

    header("Location: books.php");
    exit();
}

if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM books WHERE id=$id");

    header("Location: books.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM books ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Books - Library</title>
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

    <h2>Manage Books</h2>

    <div class="form-box">

        <h3>Add New Book</h3>

        <form method="POST">

            <input type="text" name="title" placeholder="Book Title" required>

            <input type="text" name="author" placeholder="Author Name" required>

            <input type="text" name="category" placeholder="Category" required>

            <button type="submit" name="add_book">Add Book</button>

        </form>

    </div>

    <h3>Available Books</h3>

    <table>

        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Action</th>
        </tr>

        <?php while ($book = mysqli_fetch_assoc($result)) { ?>

        <tr>

            <td><?php echo $book['id']; ?></td>

            <td><?php echo $book['title']; ?></td>

            <td><?php echo $book['author']; ?></td>

            <td><?php echo $book['category']; ?></td>

            <td>
                <a class="delete"
                   href="books.php?delete=<?php echo $book['id']; ?>"
                   onclick="return confirm('Delete this book?')">
                   Delete
                </a>
            </td>

        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>