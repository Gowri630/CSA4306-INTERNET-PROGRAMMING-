<?php
include "db.php";

$error = "";

/* Issue a book */
if (isset($_POST['issue_book'])) {

    $book_id = (int) $_POST['book_id'];
    $member_id = (int) $_POST['member_id'];

    // Check whether the book exists
    $book_check = mysqli_query(
        $conn,
        "SELECT id FROM books WHERE id = $book_id"
    );

    // Check whether the member exists
    $member_check = mysqli_query(
        $conn,
        "SELECT id FROM members WHERE id = $member_id"
    );

    if (
        $book_check &&
        $member_check &&
        mysqli_num_rows($book_check) > 0 &&
        mysqli_num_rows($member_check) > 0
    ) {

        /*
         * Your issues table has a foreign key:
         * user_id references users.id.
         * Find an existing user before inserting.
         */

        $user_check = mysqli_query(
            $conn,
            "SELECT id FROM users WHERE id = $member_id"
        );

        if ($user_check && mysqli_num_rows($user_check) > 0) {

            $sql = "INSERT INTO issues
                    (user_id, book_id, member_id, issue_date, due_date, status)
                    VALUES
                    (?, ?, ?, CURDATE(),
                     DATE_ADD(CURDATE(), INTERVAL 14 DAY), 'Issued')";

            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {

                mysqli_stmt_bind_param(
                    $stmt,
                    "iii",
                    $member_id,
                    $book_id,
                    $member_id
                );

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_close($stmt);

                    header("Location: issue.php");
                    exit();

                } else {
                    $error = "Unable to issue book: " .
                             mysqli_stmt_error($stmt);

                    mysqli_stmt_close($stmt);
                }

            } else {
                $error = "Unable to prepare query: " .
                         mysqli_error($conn);
            }

        } else {
            $error = "The selected member does not have a matching user account. Your users table needs to be configured before issuing books.";
        }

    } else {
        $error = "Please select a valid book and member.";
    }
}

/* Get books */
$books = mysqli_query(
    $conn,
    "SELECT * FROM books ORDER BY id DESC"
);

/* Get members */
$members = mysqli_query(
    $conn,
    "SELECT * FROM members ORDER BY id DESC"
);

if (!$books || !$members) {
    die("Database error: " . mysqli_error($conn));
}

/* Get issued books */
$issues = mysqli_query($conn, "
    SELECT
        issues.id,
        books.title,
        members.name,
        issues.issue_date,
        issues.status
    FROM issues
    INNER JOIN books
        ON issues.book_id = books.id
    INNER JOIN members
        ON issues.member_id = members.id
    ORDER BY issues.id DESC
");

if (!$issues) {
    die("Unable to display issued books: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Issue Book - Library Management System</title>

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

    <h2>Issue Book</h2>

    <?php if (!empty($error)) { ?>
        <p style="color: red; margin-bottom: 20px;">
            <?php echo htmlspecialchars($error); ?>
        </p>
    <?php } ?>

    <div class="form-box">

        <h3>Issue a Book to a Member</h3>

        <form method="POST" action="issue.php">

            <label for="book_id">Select Book</label>

            <select name="book_id" id="book_id" required>
                <option value="">Select Book</option>

                <?php while ($book = mysqli_fetch_assoc($books)) { ?>
                    <option value="<?php echo (int) $book['id']; ?>">
                        <?php echo htmlspecialchars($book['title']); ?>
                    </option>
                <?php } ?>

            </select>

            <label for="member_id">Select Member</label>

            <select name="member_id" id="member_id" required>
                <option value="">Select Member</option>

                <?php while ($member = mysqli_fetch_assoc($members)) { ?>
                    <option value="<?php echo (int) $member['id']; ?>">
                        <?php echo htmlspecialchars($member['name']); ?>
                    </option>
                <?php } ?>

            </select>

            <button type="submit" name="issue_book">
                Issue Book
            </button>

        </form>

    </div>

    <h3>Issued Books</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Book</th>
            <th>Member</th>
            <th>Issue Date</th>
            <th>Status</th>
        </tr>

        <?php while ($issue = mysqli_fetch_assoc($issues)) { ?>
            <tr>
                <td><?php echo (int) $issue['id']; ?></td>

                <td>
                    <?php echo htmlspecialchars($issue['title']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($issue['name']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($issue['issue_date']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($issue['status']); ?>
                </td>
            </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>