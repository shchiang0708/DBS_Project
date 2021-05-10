<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>實驗室書籍管理系統</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style media="screen">
    div.container table {
        font-size: 20px;
    }

    nav {
        font-size: 20px;
        font-weight: bold;
    }

    .thead-inverse th {
        color: #fff;
        background-color: #373a3c;
    }
    </style>
</head>

<body>

    <body>
        <div class="container-fluid">
            <div class="jumbotron text-center">
                <h1>實驗室書籍管理系統</h1>
                <h2>Member</h2>
            </div>
        </div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-10">
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="./ShowBorrow.php">Home</a></li>
                            <li><a href="./SearchBooks.php">借書</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php
                                $mID = $_COOKIE['mID'];
                                echo "<li><a class='nav-link disabled' aria-disabled='true'>$mID 您好</a></li>";
                                echo "<li><a href='../index.php'>Logout</a></li>";
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-1">
                </div>
                <!--/.nav-collapse -->
            </div>
            <!--/.container-fluid -->
        </nav>
        <div class="container">
            <?php
                include "../Connection.php";

                $isbn = $_POST["isbn"];
                $title = $_POST["title"];
                $author = $_POST["author"];
                // $edition = $_POST["edition"];
                $publication = $_POST["publication"];
                $category = $_POST['category'];

                $sql = "SELECT * FROM book_info";
                if (!empty($isbn) || !empty($title) || !empty($author) || !empty($publication) || !empty($category)) {
                    $sql = $sql . " WHERE ";

                    // For ISBN, edition, and category, there should be 'Full-Text Search'.
                    if (!empty($isbn)) {
                        $sql = $sql . "isbn = '$isbn' AND ";
                    }
                    if (!empty($title)) {
                        $sql = $sql . "title LIKE '%$title%' AND ";
                    }
                    if (!empty($author)) {
                        $sql = $sql . "author LIKE '%$author%' AND ";
                    }
                    // if (!empty($edition)) {
                    //     $sql = $sql . "edition = '$edition' AND ";
                    // }
                    if (!empty($publication)) {
                        $sql = $sql . "publication = '%$publication%' AND ";
                    }
                    if (!empty($category)) {
                        $sql = $sql . "category = '$category' AND ";
                    }

                    // Delete the last 'AND', Because cannot determined the number of column which has value;
                    $sql = substr($sql, 0, -4);
                } else {
                    echo "<script>";
                    echo "alert('至少要填一個欄位');";
                    echo "location.href = './SearchBooks.php';";
                    echo "</script>";
                    exit();
                }
                $sql = $sql . ";"; // Add SEMICOLON to the end of SQL stmt;
                // echo $sql;
                $result = mysqli_query($db, $sql);
                if (mysqli_num_rows($result) == 0) {
                    echo "<script>";
                    echo "alert('查無此書');";
                    echo "location.href = './SearchBooks.php';";
                    echo "</script>";
                }
            ?>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <table class='table table-bordered'>
                        <thead class='thead-inverse'>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ISBN</th>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <!-- <th scope="col">Edition</th> -->
                                <th scope="col">Publication</th>
                                <th scope="col">Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $count = 1;
                                while ($book_to_show = $result->fetch_row()) {
                                    echo "<tr>";
                                    echo "<td>" . $count . "</td>";
                                    echo "<td>" . $book_to_show[0] . "</td>";
                                    echo "<td>" . $book_to_show[1] . "</td>";
                                    echo "<td>" . $book_to_show[2] . "</td>";
                                    echo "<td>" . $book_to_show[3] . "</td>";
                                    echo "<td>" . $book_to_show[4] . "</td>";
                                    // echo "<td>" . $book_to_show[5] . "</td>";
                                    $title = urlencode($book_to_show[1]); // To solve some special symbol like '&'
                                    echo "<td><a class='btn btn-primary' href='BorrowBooks.php?isbn=$book_to_show[0]&title=$title'>借閱</a></td>";
                                    $count = $count + 1;
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>

    </body>

</html>