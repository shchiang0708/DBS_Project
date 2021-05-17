<?php
    include "../Connection.php";
    $sql = "SELECT * FROM book_info";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) == 0) {
        echo "<script>";
        echo "alert('目前實驗室並沒有任何書籍可供借閱');";
        echo "location.href = './ShowBorrow.php';";
        echo "</script>";
    }
?>
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
        margin: 30px;
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

    form {
        font-size: 16px;
        margin: 15px;
    }
    </style>
</head>

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
                        <li><a href="./SearchBooks.php">書籍查詢</a></li>
                        <li><a href="./SearchBooksByCategory.php">種類</a></li>
                        <li><a href="./SearchBooksByPublication.php">出版商</a></li>
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
        <div class="row">
            <h3 style="text-align: center;">請輸入書籍資訊: </h3>
        </div>
        <div class="row" style="border-style: double;">
            <div class="col-sm-2"></div>
            <div class="col-sm-9">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="row">
                        <div class="col-sm-3">
                            <label>ISBN: </label>
                            <input type="text" name="isbn" size="15" onkeypress="return isNumber(event)">
                        </div>
                        <div class="col-sm-3">
                            <label>Title: </label>
                            <input type="text" name="title" size="15">
                        </div>
                        <div class="col-sm-3">
                            <label>Author: </label>
                            <input type="text" name="author" size="15">
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2">
                            <input type="submit" name="insert" value="查詢" style="margin-top: 25px;">
                        </div>
                        <script>
                        function isNumber(event) {
                            var keycode = event.keyCode;
                            if (keycode > 48 && keycode < 57) {
                                return true;
                            }
                            return false;
                        }
                        </script>
                    </div>
                    <!-- <div class="row">
                        <div class="col-sm-3">
                            <input type="text" name="isbn">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" name="title">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" name="author">
                        </div>
                        <div class="col-sm-3">
                            <input type="submit" name="insert" value="查詢">
                            <input type="button" onclick="location.href='./ShowBorrow.php'" value="Back">
                        </div>
                    </div> -->
                    <!-- <form action="./SearchResult.php" method="post">
                    <table class='table' border="2" align="center" cellpadding="5" cellspacing="5">
                        <tr>
                            <td>ISBN :</td>
                            <td>
                                <input type="text" name="isbn" size="48">
                            </td>
                        </tr>
                        <tr>
                            <td>Title :</td>
                            <td>
                                <input type="text" name="title" size="48">
                            </td>
                        </tr>
                        <tr>
                            <td>Author :</td>
                            <td>
                                <input type="text" name="author" size="48">
                            </td>
                        </tr>
                        <tr>
                            <td>Edition :</td>
                            <td>
                                <input type="text" name="edition" size="48">
                            </td>
                        </tr>
                        <tr>
                            <td>Publication: </td>
                            <td>
                                <input type="text" name="publication" size="48">
                            </td>
                        </tr>
                        <tr>
                            <td>Category: </td>
                            <td>
                                <input type="text" name="category" size="48">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="insert" value="查詢">
                                <input type="button" onclick="location.href='./ShowBorrow.php'" value="Back">
                            </td>
                        </tr>
                    </table>
                </form> -->
            </div>
        </div>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $isbn = $_POST["isbn"];
                $title = $_POST["title"];
                $author = $_POST["author"];

                $sql = "SELECT * FROM book_info";
                if (!empty($isbn) || !empty($title) || !empty($author)) {
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
                echo "<div class='row'>";
                echo "<div class='col-sm-1'></div>";
                echo "<div class='col-sm-10'><table class='table table-bordered'><thead class='thead-inverse'><tr><th scope='col'>#</th><th scope='col'>ISBN</th><th scope='col'>Title</th><th scope='col'>Author</th><th scope='col'>Publication</th><th scope='col'>Category</th></tr></thead><tbody>";
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
                echo "</tbody></table><div class='col-sm-1'></div></div>";
                echo "</div>";
            }
        ?>
    </div>
</body>

</html>