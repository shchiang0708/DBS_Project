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
    nav {
        font-size: 20px;
        font-weight: bold;
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
                        <!-- <li class="active"><a href="./">Default <span class="sr-only">(current)</span></a></li>
              <li><a href="../navbar-static-top/">Static top</a></li>
              <li><a href="../navbar-fixed-top/">Fixed top</a></li> -->
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
            $isbn = $_GET['isbn'];
            $title = $_GET['title'];
            include '../Connection.php';
            $sql = "SELECT borrowed_id FROM book_info WHERE isbn = '$isbn'";
            $result = mysqli_query($db, $sql);

            // if no one borrowed the books
            $borrowed_id = $result->fetch_row()[0];
            if ($borrowed_id == null) {
                $sql = "UPDATE book_info SET borrowed_id = '$mID' WHERE isbn = '$isbn'";
                $result = mysqli_query($db, $sql);
                echo "<script>";
                echo "alert('已成功借閱 \'$title\'');";
                echo "location.href = './ShowBorrow.php';";
                echo "</script>";
            } else {
                //if you are the one who borrowed the book
                if ($borrowed_id == $mID) {
                    echo "<script>";
                    echo "alert('\'$title\' 正被您借閱');";
                    echo "location.href = './ShowBorrow.php';";
                    echo "</script>";
                } else {
                    // if someone have borrowed the books, notified he/she to return the books
                    include '../Sendmail.php';
                    $sql = "SELECT email FROM Member WHERE mID = '$borrowed_id'";
                    $result = mysqli_query($db, $sql);
                    $email = $result->fetch_row()[0];
                    sendMailForReturning($borrowed_id, $title, $email);
                    echo "<script>";
                    echo "alert('\'$title\' 有人借閱，已透過Email通知其歸還');";
                    echo "location.href = './ShowBorrow.php';";
                    echo "</script>";
                }
            }
        ?>
    </div>

</body>

</html>