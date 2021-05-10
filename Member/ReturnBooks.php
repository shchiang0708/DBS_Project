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
                        <li><a href="./SearchBooks.php">借書</a></li>
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
        $sql = "UPDATE book_info SET borrowed_id = NULL WHERE isbn = '$isbn'";
        $result = mysqli_query($db, $sql);

        if (mysqli_affected_rows($db) > 0) {
            // alert 已成功歸還 'Title name'
            echo "<script>";
            echo "alert('已成功歸還 \'$title\'');";
            echo "location.href = './ShowBorrow.php';";
            echo "</script>";
        } else {
            echo "Something error";
        }
    ?>
    </div>

</body>

</html>