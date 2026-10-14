<?php
include "db.php";

if (isset($_GET['return'])) {

    $id = $_GET['return'];

    mysqli_query($conn, "

        UPDATE issues

        SET status='Returned',
            return_date=CURDATE()

        WHERE id=$id

    ");

    header("Location: return.php");
    exit();
}

$result = mysqli_query($conn, "

    SELECT issues.id,
           books.title,
           members.name,
           issues.issue_date,
           issues.return_date,
           issues.status

    FROM issues

    JOIN books
    ON issues.book_id = books.id

    JOIN members
    ON issues.member_id = members.id

    ORDER BY issues.id DESC

");
?>

<!DOCTYPE html>
<html>

<head>

    <title>Return Book</title>

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

    <h2>Return Book</h2>

    <table>

        <tr>

            <th>ID</th>
            <th>Book</th>
            <th>Member</th>
            <th>Issue Date</th>
            <th>Return Date</th>
            <th>Status</th>
            <th>Action</th>

        </tr>


        <?php while ($issue = mysqli_fetch_assoc($result)) { ?>

        <tr>

            <td><?php echo $issue['id']; ?></td>

            <td><?php echo $issue['title']; ?></td>

            <td><?php echo $issue['name']; ?></td>

            <td><?php echo $issue['issue_date']; ?></td>

            <td>
                <?php echo $issue['return_date']; ?>
            </td>

            <td>
                <?php echo $issue['status']; ?>
            </td>

            <td>

                <?php

                if ($issue['status'] == "Issued") {

                ?>

                    <a class="button-small"
                       href="return.php?return=<?php echo $issue['id']; ?>">

                        Return

                    </a>

                <?php

                } else {

                    echo "Completed";

                }

                ?>

            </td>

        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>