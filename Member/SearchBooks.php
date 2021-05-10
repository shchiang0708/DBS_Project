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
        <div class="row">
            <h3 style="text-align: center;">請輸入書籍資訊: </h3>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <!-- <form action="./SearchResult.php" role="form">
                    <div class="row">
                        <div class="col-sm-3">
                            <label>ISBN: </label>
                        </div>
                        <div class="col-sm-3">
                            <label>Title: </label>
                        </div>
                        <div class="col-sm-3">
                            <label>Author: </label>
                        </div>
                    </div>
                    <div class="row">
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
                <form action="./SearchResult.php" method="post">
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
                        <!-- <tr>
                            <td>Edition :</td>
                            <td>
                                <input type="text" name="edition" size="48">
                            </td>
                        </tr> -->
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
                </form>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
    </div>

</body>

</html>