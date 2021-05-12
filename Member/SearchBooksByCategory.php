<?php
    include "../Connection.php";
    $sql = "SELECT DISTINCT(Category) FROM book_info";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) == 0) {
        echo "<script>";
        echo "alert('目前實驗室並沒有任何書籍可供借閱');";
        echo "location.href = './ShowBorrow.php';";
        echo "</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

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
        font-size: 20px;
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
            <div class="col-sm-5"></div>
            <div class="col-sm-4">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <select name="option" style="margin-right: 20px; width:100px;">
                        <?php
                            while ($row = $result->fetch_row()) {
                                echo "<option>" . $row[0] . "</option>";
                            }
                        ?>
                    </select>
                    <input type="submit">
                </form>
            </div>
        </div>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $option = $_POST['option'];

                $sql = "SELECT * FROM book_info WHERE CATEGORY = '$option';";
                $result = mysqli_query($db, $sql);

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