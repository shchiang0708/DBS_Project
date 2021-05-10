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
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="jumbotron text-center">
            <h1>實驗室書籍管理系統</h1>
            <h2>Admin</h2>
        </div>
    </div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-10">
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="./ShowAllBooks.php">Home</a></li>
                        <li><a href="./EnterBooks.php">新增書籍</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href=''>Admin 您好</a></li>
                        <li><a href='../index.php'>Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-1">
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
    </nav>
    <?php
        include "../Connection.php";

        $isbn = $_GET['isbn'];
        $title = $_GET['title'];

        $sql = "DELETE FROM book_info WHERE isbn = '$isbn';";
        $result = mysqli_query($db, $sql);

        echo "<script>";
        echo "alert('已成功刪除 \'$title\'');";
        echo "location.href = './ShowAllBooks.php';";
        echo "</script>";
    ?>

</body>

</html>