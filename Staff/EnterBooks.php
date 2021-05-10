<!DOCTYPE HTML>
<html>

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
    <div class="container">
        <div class="row">
            <h3 style="text-align: center">請輸入書籍資訊: </h3>
        </div>
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <form action="./InsertBooks.php" method="post">
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
                                <input type="submit" name="insert" value="新增">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

</body>

</html>